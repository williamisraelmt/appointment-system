<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\DoctorNonWorkingDay;
use App\Models\DoctorSchedule;
use App\Models\Holiday;
use Carbon\CarbonPeriod;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Nexmo\Call\Collection;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    public function getNextCustomerPossibleSchedules(Request $request)
    {

        $customer_id = $request->get('customer_id');
        $speciality_id = $request->get('speciality_id');
        $doctor_id = $request->get('doctor_id');

        $last_appointment = Appointment::lastAppointment($customer_id, $doctor_id, $speciality_id)->first();

        $availability = [];

        if (isset($last_appointment)) {

            $last_appointment = $last_appointment->toArray();

        } else {

            $last_appointment = [];

        }

        try {

            $retries = 0;

            $start_date = Carbon::tomorrow();
            $end_date = Carbon::tomorrow()->addDays(7);

            if ($last_appointment['scheduled_date']){

                $last_appointment['days_of_week'] = [Carbon::createFromFormat('Y-m-d', $last_appointment['scheduled_date'])->format('w')];

            }

            do {

                $last_appointment['scheduled_dates'] = [$start_date->toDateString(), $end_date->toDateString()];

                $availability = $this->getAvailableSchedules(
                    $last_appointment['doctor_id'] ?? null,
                    null,
                    $last_appointment['doctor_id'] ?? null,
                    $last_appointment['scheduled_dates'] ?? [],
                    $last_appointment['days_of_week'] ?? []
                );

                if (empty($availability)){
                    $start_date = $start_date->addDays(8);
                    $end_date = $end_date->addDays(8);
                }

                $retries+= 1;

            } while (empty($availability) && $retries < 4);


            $response_status = 200;

        } catch (\Exception $e) {

            $error_message = $e->getMessage();
            $response_status = 500;

        }


        return response()->json([
            'payload' => $availability,
            'message' => $error_message ?? null,
        ], $response_status);

    }

    public function getAll(Request $request)
    {

        $speciality_id = $request->get('speciality_id');
        $gender = $request->get('gender');
        $doctor_id = $request->get('doctor_id');
        $dates = $request->get('appointment_dates') ?? [];
        $days_of_week = $request->get('day_of_week') ?? [];
        $excluded_dates = $request->get('excluded_dates') ?? [];

        try {
            $availability = $this->getAvailableSchedules(
                $doctor_id,
                $gender,
                $speciality_id,
                $dates,
                $days_of_week,
                $excluded_dates
            );

            $response_status = 200;

        } catch (\Exception $e) {

            $error_message = $e->getMessage();
            $response_status = 500;

        }

        return response()->json([
            'payload' => $availability ?? [],
            'message' => $error_message ?? null,
        ], $response_status);

    }

    public function getAvailableSchedules(
        $doctorId = null,
        $gender = null,
        $specialityId = null,
        $dates = [],
        $daysOfWeek = [],
        $excludedDates = [])
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
