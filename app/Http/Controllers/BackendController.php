<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Aircraft;
use App\Employee;
use App\Aircraft_brand;
use App\Aircraft_model;
use App\Work_schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{

    public function getAirports()
    {
        $AirportID = Airport::all();
        return response()->JSON($AirportID);
    }

    public function getIntoFlights(){
        $Airport = Airport::all();
        $Aircraft = Aircraft::all();
        foreach($Aircraft as $aircraft){
            $Aircraft_Brand[$aircraft['aircraft_id']] = Aircraft_brand::select('*')->where('brand_id', $aircraft['brand_id'])->first();
            $Aircraft_Model[$aircraft['aircraft_id']] = Aircraft_model::select('*')->where('model_id', $aircraft['model_id'])->first();
        }
        return response() -> JSON(["Airport" => $Airport,
                                   "Aircraft" => $Aircraft,
                                   "Aircraft_Brand" => $Aircraft_Brand,
                                   "Aircraft_Model" => $Aircraft_Model]);
    }

    public function getWorkSchedule(Request $request){
        $start_date = $request->date;
        $Work_Schedule = Work_schedule::select('*')->where('work_date', $start_date)->get();
        $Pilot = [];
        $Attendant = [];
        foreach($Work_Schedule as $work){
            $temp = Employee::select('*')->where('user_id', 'LIKE', '%PLT%')->where('user_id', $work['user_id'])->first();
            if(isset($temp)) array_push($Pilot, $temp);
            $temp = Employee::select('*')->where('user_id', 'LIKE', '%FAD%')->where('user_id', $work['user_id'])->first();
            if(isset($temp)) array_push($Attendant, $temp);
        }
        return response() -> JSON(["Work_Schedule" => $Work_Schedule,
                                   "Pilot" => $Pilot,
                                   "Attendant" => $Attendant]);
    }
}
