<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function getAll(){
        return response()->json(Speciality::where('status', '=', 1)->get());
    }
}
