<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;

class AppointmentTypeController extends Controller
{

    public function getAll(){
        return response()->json(AppointmentType::where('status', '=', 1)->get());
    }
}
