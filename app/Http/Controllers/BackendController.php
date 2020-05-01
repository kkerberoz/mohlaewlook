<?php

namespace App\Http\Controllers;

use App\Aircraft;
use App\Aircraft_brand;
use App\Aircraft_model;
use App\Airport;
use App\Employee;
use App\Customer;
use App\Work_schedule;
use App\Flight;
use App\Class_price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class BackendController extends Controller
{

    public function getAirports()
    {
        $AirportID = Airport::all();
        return response()->JSON($AirportID);
    }

    public function getAircraftAndCrew(Request $request)
    {
        // Get Aircraft
        $initial_location = "BKK";
        $location = $request->location;
        $date = $request->date;
        $datetime = $request->date . " " . $request->time;
        $All_Aircraft = Aircraft::all();
        $Flight_Filter = [];
        foreach ($All_Aircraft as $aircraft) { // check location of each aircraft
            //$Flight = Flight::select('*')->orderBy('depart_datetime', 'desc')->where('arrive_datetime', '>', $datetime)->where('depart_datetime', '<', $datetime)->where('aircraft_id', $aircraft['aircraft_id'])->first();
            $Flight = Flight::select('*')->orderBy('arrive_datetime', 'desc')->where('aircraft_id', $aircraft['aircraft_id'])->first();
            if (isset($Flight)) {
                 // $Flight = Flight::select('*')->orderBy('depart_datetime', 'desc')->where('arrive_datetime', '<', $datetime)->where('aircraft_id', $aircraft['aircraft_id'])->first();
                 if (!strcmp($Flight['arrive_location'], $location) && $Flight['arrive_datetime'] < $datetime) array_push($Flight_Filter, $Flight);
            }
        }
        $Other_Aircraft = []; $Other_Brand = []; $Other_Model = [];
        if(!strcmp($location, $initial_location)){ // get all aircraft that start in the initial locations
            $Temp = [];
            $Aircraft_Id_In_Flight = Flight::select('aircraft_id')->get();
            foreach ($Aircraft_Id_In_Flight as $AIIF) array_push($Temp, $AIIF['aircraft_id']);
            $Other_Aircraft = Aircraft::select('*')->whereNotIn('aircraft_id', $Temp)->get();
            foreach ($Other_Aircraft as $OA) {
                array_push($Other_Brand, Aircraft_brand::select('*')->where('brand_id', $OA['brand_id'])->first());
                array_push($Other_Model, Aircraft_model::select('*')->where('model_id', $OA['model_id'])->first());
            }
        }
        $Aircraft_Brand = []; $Aircraft_Model = []; $Aircraft = []; $Flight_Time = [];
        foreach ($Flight_Filter as $flight) {
            $aircraft = Aircraft::select('*')->where('aircraft_id', $flight['aircraft_id'])->first();
            array_push($Aircraft, $aircraft);
            array_push($Aircraft_Brand, Aircraft_brand::select('*')->where('brand_id', $aircraft['brand_id'])->first());
            array_push($Aircraft_Model, Aircraft_model::select('*')->where('model_id', $aircraft['model_id'])->first());
            array_push($Flight_Time, Flight::select('*')->where('aircraft_id', $flight['aircraft_id'])->count());
        }
        // Get Crew
        $Pilot = []; $Attendant = [];
        $All_Pilot = Employee::select('*')->where('user_id', 'LIKE', '%PLT%')->get();
        foreach ($All_Pilot as $pilot) {
            $Recently_Work_Flight = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->
                                    select('*')->orderBy('arrive_datetime', 'desc')->where('user_id', $pilot['user_id'])->where('work_date', $date)->where('confirm_status', 'confirm')->first();
            if(isset($Recently_Work_Flight) && !strcmp($Recently_Work_Flight['arrive_location'], $location) &&
                       $Recently_Work_Flight['arrive_datetime'] < $datetime) array_push($Pilot, $Recently_Work_Flight);

            $New_Work_Flight = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->
                               select('*')->where('user_id', $pilot['user_id'])->where('work_date', $date)->where('confirm_status', 'free')->first();
            if(isset($New_Work_Flight)){
                $Last_Work_Flight = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->
                                    select('*')->orderBy('arrive_location', 'desc')->first();
                if(isset($Last_Work_Flight) && !strcmp($Last_Work_Flight['arrive_location'], $location)) array_push($Pilot, $Last_Work_Flight);
            }
        }


        return response()->JSON([
            "Flight_Info" => $Flight_Filter, "Aircraft" => $Aircraft, "Aircraft_Brand" => $Aircraft_Brand, "Aircraft_Model" => $Aircraft_Model,
            "Flight_Time" => $Flight_Time, "Other_Aircraft" => $Other_Aircraft, "Other_Brand" => $Other_Brand, "Other_Model" => $Other_Model,
            "test" => $Pilot
        ]);
    }

    public function getWorkSchedule(Request $request)
    {
        $start_date = $request->date;
        $Work_Schedule = Work_schedule::select('*')->where('work_date', $start_date)->get();
        $Pilot = [];
        $Attendant = [];
        foreach ($Work_Schedule as $work) {
            $temp = Employee::select('*')->where('user_id', 'LIKE', '%PLT%')->where('user_id', $work['user_id'])->first();
            if (isset($temp)) array_push($Pilot, $temp);
            $temp = Employee::select('*')->where('user_id', 'LIKE', '%FAD%')->where('user_id', $work['user_id'])->first();
            if (isset($temp)) array_push($Attendant, $temp);
        }
        return response()->JSON([
            "Work_Schedule" => $Work_Schedule,
            "Pilot" => $Pilot,
            "Attendant" => $Attendant
        ]);
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

        $model_check = Aircraft_model::where('model_name', $input_Data['model'])->first();
        $brand_check = Aircraft_brand::where('brand_name', $input_Data['brand'])->first();
        if (isset($brand_check)) {
            if (isset($model_check)) //Add only aircraft
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
        } else {
            if (isset($model_check)) { //Add brand & aircraft
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
            return response()->json('This Airport ID is already exist', 408);
        }
        if (isset($checkAirport_name)) {
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

    public function addPrice(Request $request)
    {
        $data = $request->input;
        $class_price = new Class_price;
        // $priceData = DB::select('select * FROM class_prices WHERE flight_no = ?',[$data['flightNo']]);
        $priceData = Class_price::where('flight_no',$data['flightNo'])->first();
        $class_price->flight_no = $data['flightNo'];
        $class_price->eco_price = $data['ecoPrice'];
        $class_price->bus_price = $data['businessPrice'];
        $class_price->first_price = $data['firstPrice'];
        if(isset($priceData)){
            Class_price::where('flight_no',$priceData['flight_no'])->update(['eco_price'=>$class_price->eco_price,'bus_price'=>$class_price->bus_price,'first_price'=>$class_price->first_price]);
        }
        else{
            $class_price->save();
        }
    }


    public function getFlightNo()
    {
        $flightNo = Flight::distinct()->get(['flight_no','depart_location','arrive_location']);

        $C_flight_no = Class_price::get('flight_no');
        $miss_flight_no = [];

        foreach ($C_flight_no as $each_no) {
            $check = Flight::where('flight_no',$each_no['flight_no'])->first();
            if(!isset($check)){
                array_push($miss_flight_no,$each_no);
            }
        }
        return response()->JSON([$flightNo,$miss_flight_no]);
    }
}
