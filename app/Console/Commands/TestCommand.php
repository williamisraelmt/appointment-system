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

        $times = [
            [
                'start_time' => '08:00:00',
                'end_time' => '11:00:00'
            ],
            [
                'start_time' => '11:00:00',
                'end_time' => '11:15:00'
            ],
        ];

        $available_times = [
            [
                'start_time' => '08:00:00',
                'end_time' => '12:00:00'
            ]
        ];

        $previous_time = 0;

        foreach ($times as $time) {

            $doctor_start_time = Carbon::createFromFormat('H:i:s', $available_times[$previous_time]['start_time']);
            $doctor_end_time = Carbon::createFromFormat('H:i:s', $available_times[$previous_time]['end_time']);

            $appointment_start_time = Carbon::createFromFormat('H:i:s', $time['start_time']);
            $appointment_end_time = Carbon::createFromFormat('H:i:s', $time['end_time']);

            if ($doctor_start_time->toTimeString() === $appointment_start_time->toTimeString() &&
                $doctor_end_time->toTimeString() === $appointment_end_time->toTimeString()){
                $available_times = [];
                break;
            }

            if ($appointment_start_time->toTimeString() != $doctor_start_time->toTimeString()) {

                    $available_times[$previous_time] = [
                        'start_time' => $doctor_start_time->toTimeString(),
                        'end_time' => $appointment_start_time->toTimeString()
                    ];

                if ($doctor_end_time->diffInSeconds($appointment_end_time, true) > 1) {

                    $available_times[] = [
                        'start_time' => $appointment_end_time->toTimeString(),
                        'end_time' => $doctor_end_time->toTimeString()
                    ];

                }

                $previous_time += 1;

            } else {

                if ($doctor_end_time->diffInSeconds($appointment_end_time, true) > 1) {

                    $available_times[$previous_time] = [
                        'start_time' => $appointment_end_time->toTimeString(),
                        'end_time' => $doctor_end_time->toTimeString()
                    ];

                }

            }
        }

        var_dump($available_times);
    }
}
