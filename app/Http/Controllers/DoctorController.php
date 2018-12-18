<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getAll(){
        return response()->json(Doctor::where('status', '=', 1)->selectRaw("*, CONCAT(first_name, ' ', last_name) as name")->get());
    }
}
