<?php

namespace App\Http\Controllers;

use App\Models\ThirdParty;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getAll(){
        return response()->json(ThirdParty::doctors()->selectRaw("*, CONCAT(first_name, ' ', last_name) as name")->get());
    }
}
