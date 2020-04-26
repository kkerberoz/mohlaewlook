<?php

namespace App\Http\Controllers;

use App\Aircraft;
use App\Aircraft_brand;
use App\Aircraft_model;
use App\Airport;
use App\Employee;
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
        $datetime = $request->date. " ". $request->time;
        $All_Aircraft = Aircraft::all();
        $Flight_Filter = [];
        foreach($All_Aircraft as $aircraft){
            $Flight = Flight::select('*')->orderBy('flight_id', 'desc')->where('arrive_datetime', '>', $datetime)->where('depart_datetime', '<', $datetime)->where('aircraft_id', $aircraft['aircraft_id'])->first();
            if(!isset($Flight)){
                $Flight = Flight::select('*')->orderBy('flight_id', 'desc')->where('arrive_datetime', '<', $datetime)->where('aircraft_id', $aircraft['aircraft_id'])->first();
                if(!strcmp($Flight['arrive_location'], $location) && $Flight['depart_datetime']) array_push($Flight_Filter, $Flight);
            }
        }

        return response()->JSON($Flight_Filter);
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

    public function getModelBrand()
    {
        $model = Aircraft_model::all();
        $brand = Aircraft_brand::all();
        return response()->JSON([$model, $brand]);
    }

    public function addAircraft(Request $request)
    {
        $aircraft = new Aircraft;
        $aircraft_brand = new Aircraft_brand;
        $aircraft_model = new Aircraft_model;

        $input_Data = $request->input;

<<<<<<< HEAD
        $model_check = Aircraft_model::where('model_name',$input_Data['model'])->first();
        $brand_check = Aircraft_brand::where('brand_name',$input_Data['brand'])->first();
        if(isset($brand_check))
        {
            if(isset($model_check))//Add only aircraft
=======


        $model_check = Aircraft_model::where('model_name', $input_Data['model'])->first();
        $brand_check = Aircraft_brand::where('brand_name', $input_Data['brand'])->first();
        if (isset($brand_check)) {
            if (isset($model_check)) //Add only aircraft
>>>>>>> db86a67ffe55d823c0f0dbd73b5d392c89ac1742
            {
                $model_check = Aircraft_model::where('model_name', $input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name', $input_Data['brand'])->first();
                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();
            } else //Add model and aircraft
            {
                $aircraft_model->model_name = $input_Data['model'];
                $aircraft_model->fuel_capacity = $input_Data['fuelCap'];
                $aircraft_model->number_of_engine = $input_Data['numberEng'];
                $aircraft_model->engine_type = $input_Data['typeEng'];
                $aircraft_model->eco_cap = $input_Data['ecoCap'];
                $aircraft_model->bus_cap = $input_Data['busCap'];
                $aircraft_model->first_cap =  $input_Data['firstCap'];
                $aircraft_model->eco_pattern = $input_Data['ecoPat'];
                $aircraft_model->bus_pattern = $input_Data['busPat'];
                $aircraft_model->first_pattern = $input_Data['firstPat'];
                $aircraft_model->save();

                $model_check = Aircraft_model::where('model_name', $input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name', $input_Data['brand'])->first();
                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();
            }
<<<<<<< HEAD
        }
        else
        {
            if(isset($model_check)){//Add brand & aircraft
=======
        } else {
            if (isset($model_check)) { //Add brand & aircraft
>>>>>>> db86a67ffe55d823c0f0dbd73b5d392c89ac1742
                $aircraft_brand->brand_name = $input_Data['brand'];
                $aircraft_brand->country = $input_Data['country'];
                $aircraft_brand->save();

                $model_check = Aircraft_model::where('model_name', $input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name', $input_Data['brand'])->first();

                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();
            } else { // Add all data
                $aircraft_brand->brand_name = $input_Data['brand'];
                $aircraft_brand->country = $input_Data['country'];
                $aircraft_brand->save();

                $aircraft_model->model_name = $input_Data['model'];
                $aircraft_model->fuel_capacity = $input_Data['fuelCap'];
                $aircraft_model->number_of_engine = $input_Data['numberEng'];
                $aircraft_model->engine_type = $input_Data['typeEng'];
                $aircraft_model->eco_cap = $input_Data['ecoCap'];
                $aircraft_model->bus_cap = $input_Data['busCap'];
                $aircraft_model->first_cap =  $input_Data['firstCap'];
                $aircraft_model->eco_pattern = $input_Data['ecoPat'];
                $aircraft_model->bus_pattern = $input_Data['busPat'];
                $aircraft_model->first_pattern = $input_Data['firstPat'];
                $aircraft_model->save();

                $model_check = Aircraft_model::where('model_name', $input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name', $input_Data['brand'])->first();

                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();
            }
        }
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
