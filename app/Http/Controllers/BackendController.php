<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Aircraft;
use App\Employee;
use App\Aircraft_brand;
use App\Aircraft_model;
use App\Work_schedule;
use App\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{

    public function getAirports()
    {
        $AirportID = Airport::all();
        return response()->JSON($AirportID);
    }

    public function getAircraftAndCrew(Request $request){
        $initial_location = "BKK";
        $location = $request->location;
        $datetime = $request->dateate. " ". $request->time;
        $Flight = Flight::select('*')->where('arrive_location', $location)->where('arrive_datetime', "<", $datetime)->groupBy('aircraft_id')->havingRaw('MAX(arrive_datetime)')->get();


        return response()->JSON($Flight);
        // $Aircraft_Brand = [];
        // $Aircraft_Model = [];
        // foreach($Aircraft as $aircraft){
        //     array_push($Aircraft_Brand, Aircraft_brand::select('*')->where('brand_id', $aircraft['brand_id'])->first());
        //     array_push($Aircraft_Model, Aircraft_model::select('*')->where('model_id', $aircraft['model_id'])->first());
        // }
        // return response() -> JSON(["Aircraft" => $Aircraft,
        //                            "Aircraft_Brand" => $Aircraft_Brand,
        //                            "Aircraft_Model" => $Aircraft_Model]);
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

    public function addAirport(Request $request)
    {
        $checkAirport_id = Airport::select('airport_id')->where('airport_id', $request->airportID)->first();
        $checkAirport_name = Airport::select('airport_name')->where('airport_name', $request->airportName)->first();
        if (isset($checkAirport_id)) {
            return response()->json('This Airport ID is already exist', 409);
        } else if (isset($checkAirport_name)) {
            return response()->json('This Airport name is already exist', 409);
        }
        $airport = new Airport;
        $airport->airport_id = $request->airportID;
        $airport->airport_name = $request->airportName;
        $airport->airport_cap = $request->airportCap;
        $airport->airport_address = $request->airportAddress;
        $airport->airport_region = $request->airportRegion;
        $airport->save();
        return response()->json('success', 200);
    }
}
