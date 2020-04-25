<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Customer;
use Illuminate\Http\Request;
use App\Employee;
use App\Disease;
use App\Education;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{

    public function getAirports()
    {
        $AirportID = Airport::all();
        return response()->JSON($AirportID);
    }
}
