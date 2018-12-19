<?php

namespace App\Console\Commands;

use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $availability = [];

        $doctors = Doctor::with('specialities', 'schedules');

        if (isset($doctorId) && is_numeric($doctorId)) {

            $doctors = $doctors->where('id', '=', $doctorId);

        } else {

            if (isset($gender) && is_numeric($gender)) {
                $doctors = $doctors->where('gender', '=', $gender);
            }

            if (isset($specialityId) && is_numeric($specialityId)) {
                $doctors = $doctors->whereHas('specialities', function (Builder $query) use ($specialityId) {
                    $query->where('speciality_id', '=', $specialityId);
                });
            }

        }

        if (!empty($dates)) {

            $start_date = Carbon::createFromFormat('Y-m-d', $dates[0])->toDateString();
            $end_date = Carbon::createFromFormat('Y-m-d', $dates[1])->toDateString();

            $date_ranges = collect(CarbonPeriod::create($start_date, $end_date));

        } else {

            $date_ranges = collect(CarbonPeriod::create(Carbon::now()->toDateString(), Carbon::now()->addDays(30)->toDateString()));

        }

        // Looking for dates that
        if (!empty($daysOfWeek)) {

            $date_ranges = $date_ranges->filter(function ($date) use ($daysOfWeek) {
                return in_array($date->format('w'), $daysOfWeek);
            });

        }

        $date_ranges = $date_ranges->map(function ($date) {
            return $date->format('Y-m-d');
        })->values();

        //Retrieving holidays in order to remove them
        $holidays = Holiday::all()->map(function (Holiday $holiday) {
            return $holiday->holiday;
        })->toArray();

        //Retrieving date ranges that are not in holidays
        $date_ranges = $date_ranges->whereNotIn(null, array_merge($holidays, $excludedDates));


        // If there are no available dates it is not necessary to look for doctors.
        if ($date_ranges->isNotEmpty()) {

            collect($doctors->get())->each(function (Doctor $doctor) use (
                $date_ranges,
                &$availability
            ) {

                $doctor_working_dates = [];

                // Days of week that doctor works
                $schedules_days_of_week = $doctor->schedules->map(function ($schedule) {
                    return $schedule['day_of_week'];
                })->unique()->toArray();

                // Dates that doctor doesnt work (Can be out of the country because of a conference, etc)
                $doctor_non_working_dates = $doctor->nonWorkingDays->map(function ($row) {
                    return $row['non_working_date'];
                })->toArray();


                // Removing non working days from arrays
                collect($date_ranges)->whereNotIn(null, $doctor_non_working_dates)->each(function ($date) use (
                    &$doctor_working_dates,
                    $schedules_days_of_week
                ) {

                    $day_of_week = Carbon::createFromFormat('Y-m-d', $date)->format('w');

                    if (in_array($day_of_week, $schedules_days_of_week)) {
                        $doctor_working_dates[] = $date;
                    }

                });

                collect($doctor_working_dates)->each(function ($working_date) use (&$availability, $doctor) {

                    $appointments = Appointment::where([
                        ['doctor_id', '=', $doctor->id],
                        ['scheduled_date', '=', $working_date]
                    ])->get();

                    $schedules = DoctorSchedule::where([
                        ['doctor_id', '=', $doctor->id],
                        ['day_of_week', '=', Carbon::createFromFormat('Y-m-d', $working_date)->format('w')]
                    ])->get();

                    $availability[$working_date][$doctor->id] = [
                        'id' => $doctor->id,
                        'first_name' => $doctor->first_name,
                        'last_name' => $doctor->last_name,
                        'gender' => $doctor->gender
                    ];

                    $schedules->each(function (DoctorSchedule $schedule) use (
                        $doctor,
                        $appointments,
                        &$availability,
                        $working_date
                    ) {

                        $schedule_arr = $schedule->toArray();

                        // Setting up the initial doctor's availability
                        $availability[$working_date][$doctor->id]['available_schedules'][] = [
                            'start_time' => $schedule->start_time,
                            'end_time' => $schedule->end_time
                        ];

                        // If there are no appointments, it's not necessary to search
                        if ($appointments->isEmpty()) {
                            return;
                        }

                        $previous_time = 0;

                        // Checking availability after appointments
                        $appointments->each(function (Appointment $appointment) use (
                            $doctor,
                            &$availability,
                            &$schedule_arr,
                            $working_date,
                            &$previous_time
                        ) {

                            if ($appointment->status == 'canceled') {
                                return;
                            }

                            $availability[$working_date][$doctor->id]['busy_schedules'][] = [
                                'start_time' => $appointment->start_time,
                                'end_time' => $appointment->end_time
                            ];

                            $start_time = $availability[$working_date][$doctor->id]['available_schedules'][$previous_time]['start_time'];
                            $doctor_start_time = Carbon::createFromFormat('H:i:s', $start_time);

                            $end_time = $availability[$working_date][$doctor->id]['available_schedules'][$previous_time]['end_time'];
                            $doctor_end_time = Carbon::createFromFormat('H:i:s', $end_time);

                            $appointment_start_time = Carbon::createFromFormat('H:i:s', $appointment->start_time);
                            $appointment_end_time = Carbon::createFromFormat('H:i:s', $appointment->end_time);

                            if ($doctor_start_time->toTimeString() === $appointment_start_time->toTimeString() &&
                                $doctor_end_time->toTimeString() === $appointment_end_time->toTimeString()) {
                                $availability = [];
                                return;
                            }

                            if ($appointment_start_time->toTimeString() != $doctor_start_time->toTimeString()) {

                                $availability[$working_date][$doctor->id]['available_schedules'][$previous_time] = [
                                    'start_time' => $doctor_start_time->toTimeString(),
                                    'end_time' => $appointment_start_time->toTimeString()
                                ];

                                if ($doctor_end_time->diffInSeconds($appointment_end_time, true) > 1) {

                                    $availability[$working_date][$doctor->id]['available_schedules'][] = [
                                        'start_time' => $appointment_end_time->toTimeString(),
                                        'end_time' => $doctor_end_time->toTimeString()
                                    ];

                                }

                                $previous_time += 1;

                            } else {

                                if ($doctor_end_time->diffInSeconds($appointment_end_time, true) > 1) {

                                    $availability[$working_date][$doctor->id]['available_schedules'][$previous_time] = [
                                        'start_time' => $appointment_end_time->toTimeString(),
                                        'end_time' => $doctor_end_time->toTimeString()
                                    ];

                                }

                            }

                        });

                    });

                });

            });

        }

        return $availability;
    }
}
