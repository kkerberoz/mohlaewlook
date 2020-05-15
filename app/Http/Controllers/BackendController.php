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
use App\Ticket;
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
        $initial_location = "MHK";
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
        $Other_Aircraft = [];
        $Other_Brand = [];
        $Other_Model = [];
        if (!strcmp($location, $initial_location)) { // get all aircraft that start in the initial locations
            $Temp = [];
            $Aircraft_Id_In_Flight = Flight::select('aircraft_id')->get();
            foreach ($Aircraft_Id_In_Flight as $AIIF) array_push($Temp, $AIIF['aircraft_id']);
            $Other_Aircraft = Aircraft::select('*')->whereNotIn('aircraft_id', $Temp)->get();
            foreach ($Other_Aircraft as $OA) {
                array_push($Other_Brand, Aircraft_brand::select('*')->where('brand_id', $OA['brand_id'])->first());
                array_push($Other_Model, Aircraft_model::select('*')->where('model_id', $OA['model_id'])->first());
            }
        }
        $Aircraft_Brand = [];
        $Aircraft_Model = [];
        $Aircraft = [];
        $Flight_Time = [];
        foreach ($Flight_Filter as $flight) {
            $aircraft = Aircraft::select('*')->where('aircraft_id', $flight['aircraft_id'])->first();
            array_push($Aircraft, $aircraft);
            array_push($Aircraft_Brand, Aircraft_brand::select('*')->where('brand_id', $aircraft['brand_id'])->first());
            array_push($Aircraft_Model, Aircraft_model::select('*')->where('model_id', $aircraft['model_id'])->first());
            array_push($Flight_Time, Flight::select('*')->where('aircraft_id', $flight['aircraft_id'])->count());
        }
        // Get Crew
        $Pilot = [];
        $Attendant = [];
        $All_Pilot = Employee::select('*')->where('user_id', 'LIKE', '%PLT%')->get();
        foreach ($All_Pilot as $pilot) {
            $Recently_Work_Flight = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->select('*')->orderBy('arrive_datetime', 'desc')->where('user_id', $pilot['user_id'])->where('work_date', $date)->where('confirm_status', 'confirm')->first();
            // when flight in one day
            if (
                isset($Recently_Work_Flight) && !strcmp($Recently_Work_Flight['arrive_location'], $location) &&
                $Recently_Work_Flight['arrive_datetime'] < $datetime
            )
                array_push($Pilot, array('data' => $Recently_Work_Flight, 'type' => 1));

            $New_Work_Flight = Work_schedule::select('*')->where('user_id', $pilot['user_id'])->where('work_date', $date)->where('confirm_status', 'free')->first();
            if (isset($New_Work_Flight)) {
                $Last_Work_Flight = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->select('*')->orderBy('arrive_datetime', 'desc')->where('user_id', $pilot['user_id'])->where('confirm_status', 'confirm')->first();
                // check last position
                if (isset($Last_Work_Flight)) {
                    if (!strcmp($Last_Work_Flight['arrive_location'], $location)) array_push($Pilot, array('data' => $New_Work_Flight, 'type' => 2));
                }
                // when new user
                else if (!isset($Last_Work_Flight) && !strcmp($initial_location, $location)) array_push($Pilot, array('data' => $New_Work_Flight, 'type' => 3));
            }
        }
        $All_FAD = Employee::select('*')->where('user_id', 'LIKE', '%FAD%')->get();
        foreach ($All_FAD as $FAD) {
            $Recently_Work_FAD = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->select('*')->orderBy('arrive_datetime', 'desc')->where('user_id', $FAD['user_id'])->where('work_date', $date)->where('confirm_status', 'confirm')->first();
            // when flight in one day
            if (
                isset($Recently_Work_FAD) && !strcmp($Recently_Work_FAD['arrive_location'], $location) &&
                $Recently_Work_FAD['arrive_datetime'] < $datetime
            )
                array_push($Attendant, array('data' => $Recently_Work_FAD, 'type' => 1));

            $New_Work_FAD = Work_schedule::select('*')->where('user_id', $FAD['user_id'])->where('work_date', $date)->where('confirm_status', 'free')->first();
            if (isset($New_Work_FAD)) {
                $Last_Work_FAD = Work_schedule::leftJoin('flights', 'work_schedules.flight_id', '=', 'flights.flight_id')->select('*')->orderBy('arrive_datetime', 'desc')->where('user_id', $FAD['user_id'])->where('confirm_status', 'confirm')->first();
                // check last position
                if (isset($Last_Work_FAD)) {
                    if (!strcmp($Last_Work_FAD['arrive_location'], $location)) array_push($Attendant, array('data' => $New_Work_FAD, 'type' => 2));
                }
                // when new user
                else if (!isset($Last_Work_FAD) && !strcmp($initial_location, $location)) array_push($Attendant, array('data' => $New_Work_FAD, 'type' => 3));
            }
        }
        $Personal_Detail = [];
        foreach ($Pilot as $i) {
            $Personal_Detail += array($i['data']['user_id'] => Employee::select('*')->where('user_id', $i['data']['user_id'])->first());
            $Personal_Detail[$i['data']['user_id']]->count = Work_schedule::select('*')->where('user_id', $i['data']['user_id'])->where('confirm_status', 'confirm')->count();
        }
        foreach ($Attendant as $i) {
            $Personal_Detail += array($i['data']['user_id'] => Employee::select('*')->where('user_id', $i['data']['user_id'])->first());
            $Personal_Detail[$i['data']['user_id']]->count = Work_schedule::select('*')->where('user_id', $i['data']['user_id'])->where('confirm_status', 'confirm')->count();
        }
        return response()->JSON([
            "Flight_Info" => $Flight_Filter, "Aircraft" => $Aircraft, "Aircraft_Brand" => $Aircraft_Brand, "Aircraft_Model" => $Aircraft_Model,
            "Flight_Time" => $Flight_Time, "Other_Aircraft" => $Other_Aircraft, "Other_Brand" => $Other_Brand, "Other_Model" => $Other_Model,
            "Pilot" => $Pilot, "Attendant" => $Attendant, "Personal_Detail" => $Personal_Detail
        ]);
    }

    public function addFlight(Request $request)
    {
        $flight = new Flight;
        $flight->flight_no = $request->flightNo["flight_no"];
        $flight->depart_location = $request->departLocation["value"];
        $flight->arrive_location = $request->arriveLocation["value"];
        $flight->depart_datetime = $request->departDate . " " . $request->departTime;
        $flight->arrive_datetime = $request->arriveDate . " " . $request->arriveTime;
        $flight->aircraft_id = $request->aircraftID["value"];
        $flight->save();

        $flightID = Flight::select('flight_id')->where('flight_no', $request->flightNo["flight_no"])->where('depart_datetime', $request->departDate . " " . $request->departTime)->where('aircraft_id', $request->aircraftID["value"])->first();
        // captian
        $work_already = Work_schedule::where('work_id', $request->captain['work_id'])->first();
        if (isset($work_already)) {
            if ($request->captain['type'] == 1) {
                $work_schedule = new Work_schedule;
                $work_schedule->user_id = $request->captain['value'];
                $work_schedule->work_date = $request->departDate;
                $work_schedule->flight_id = $flightID['flight_id'];
                $work_schedule->confirm_status = "confirm";
                $work_schedule->save();
            } else {
                work_schedule::where('work_id', $request->captain['work_id'])->update(['flight_id' => $flightID['flight_id'], 'confirm_status' => 'confirm']);
            }
        }
        // co-pilot
        $work_already = Work_schedule::where('work_id', $request->coPilot['work_id'])->first();
        if (isset($work_already)) {
            if ($request->coPilot['type'] == 1) {
                $work_schedule = new Work_schedule;
                $work_schedule->user_id = $request->coPilot['value'];
                $work_schedule->work_date = $request->departDate;
                $work_schedule->flight_id = $flightID['flight_id'];
                $work_schedule->confirm_status = "confirm";
                $work_schedule->save();
            } else {
                work_schedule::where('work_id', $request->coPilot['work_id'])->update(['flight_id' => $flightID['flight_id'], 'confirm_status' => 'confirm']);
            }
        }
        // attendant
        foreach ($request->crew as $crew) {
            $work_already = Work_schedule::where('work_id', $crew['work_id'])->first();
            if (isset($work_already)) {
                if ($crew['type'] == 1) {
                    $work_schedule = new Work_schedule;
                    $work_schedule->user_id = $crew['value'];
                    $work_schedule->work_date = $request->departDate;
                    $work_schedule->flight_id = $flightID['flight_id'];
                    $work_schedule->confirm_status = "confirm";
                    $work_schedule->save();
                } else {
                    work_schedule::where('work_id', $crew['work_id'])->update(['flight_id' => $flightID['flight_id'], 'confirm_status' => 'confirm']);
                }
            }
        }

        return response()->JSON($flightID);
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
        $priceData = Class_price::where('flight_no', $request->flight_no)->first();
        $class_price->flight_no = $request->flight_no;
        $class_price->eco_price = $data['ecoPrice'];
        $class_price->bus_price = $data['businessPrice'];
        $class_price->first_price = $data['firstPrice'];
        if (isset($priceData)) {
            Class_price::where('flight_no', $priceData['flight_no'])->update(['eco_price' => $class_price->eco_price, 'bus_price' => $class_price->bus_price, 'first_price' => $class_price->first_price]);
        } else {
            $class_price->save();
        }
    }

    public function getPrice()
    {
        $price_data = Class_price::all();
        return response()->JSON($price_data);
    }

    public function editPrice(Request $request)
    {
        $priceEdit = $request->input;
        $priceData = Class_price::where('flight_no', $priceEdit['flightNo'])->first();
        if (isset($priceData)) {
            Class_price::where('flight_no', $priceEdit['flightNo'])->update(['eco_price' => $priceEdit['ecoPrice'], 'bus_price' => $priceEdit['businessPrice'], 'first_price' => $priceEdit['firstPrice']]);
        }
    }
    public function getFlightNo()
    {
        $flightNo = Class_price::select('flight_no')->get();
        return response()->JSON($flightNo);
    }

    public function analytic1_show(Request $request)
    {
        if (isset($request->year)) {
            $year = $request->year;
            $yearLIKE = ($year) . "%";
        } else {
            $year = date('Y');
            $yearLIKE = ($year) . "%";
        }
        $analyticData = DB::select('SELECT flight_no,COUNT(*) AS flight_no_count FROM flights WHERE depart_datetime LIKE ? GROUP BY flight_no ORDER BY flight_no_count DESC', [$yearLIKE]);
        return response()->JSON(['year' => $year, 'analysis' => $analyticData]);
    }

    public function analytic1_get()
    {
        $data = DB::select('SELECT DISTINCT YEAR(depart_datetime) AS year FROM flights');
        return response()->JSON($data);
    }

    public function analytic2_show(Request $request)
    {
        $scope = $request;
        $data = DB::select('SELECT class_name,COUNT(*) AS class_count
                            FROM tickets
                            WHERE flight_id IN (SELECT flight_id FROM flights WHERE depart_datetime BETWEEN ? AND ?)
                            GROUP BY class_name', [$scope['first'], $scope['second']]);
        return response()->JSON($data);
    }

    public function analytic3_show(Request $request)
    {
        $data = DB::select('SELECT c.user_id,c.username, COUNT(*) AS reserve_count
                            FROM reservations r LEFT JOIN
                            customers c ON r.user_id = c.user_id
                            WHERE r.reservation_status = "confirm"
                            GROUP BY r.user_id
                            ORDER BY reserve_count DESC
                            LIMIT ?', [$request->top]);
        return response()->JSON($data);
    }

    public function analytic4(Request $request)
    {
        $start_year = $request->start;
        $end_year = $request->end;
        $value = [];
        for ($year = $start_year; $year <= $end_year; ++$year) {
            $flight_year = Flight::select('flight_id')->where('depart_datetime', 'LIKE', $year . '%')->get();
            $M = 0;
            $F = 0;
            foreach ($flight_year as $flight) {
                $M += Ticket::leftJoin('passengers', 'tickets.passenger_id', '=', 'passengers.passenger_id')
                    ->where('flight_id', $flight['flight_id'])->where('gender', 'male')->count();
                $F += Ticket::leftJoin('passengers', 'tickets.passenger_id', '=', 'passengers.passenger_id')
                    ->where('flight_id', $flight['flight_id'])->where('gender', 'female')->count();
            }


            array_push($value, ['male' => $M, 'female' => $F, 'year' => $year]);
        }

        return response()->JSON(['value' => $value]);
    }

    public function schedule(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $data = Work_schedule::select('*')->where('user_id', $employee->user_id)->get();
        return response()->JSON($data);
    }

    public function addNewWork(Request $request)
    {

        $array_date = $request->array_date;
        foreach ($array_date as $each_date) {
            $schedule = new Work_schedule;
            list($day, $month, $year) = explode("/", $each_date['date']);
            $newDate = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);

            $schedule->user_id = $request->user_id;
            $schedule->work_date = $newDate;
            $schedule->confirm_status = "free";
            $schedule->save();
        }
    }

    public function getflightdetail(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        $data = DB::select('SELECT *
                            FROM flights
                            WHERE flight_id IN (SELECT flight_id FROM work_schedules w WHERE w.user_id = ? AND confirm_status = ?)
                            ORDER BY depart_datetime DESC', [$employee->user_id, "confirm"]);
        return response()->JSON([$employee->user_id, $data]);
    }

    public function getworkday(Request $request)
    {
        $data_array = [];
        $user_id = $request->user_id;
        $array_date = $request->array_date;

        if (isset($user_id) && sizeof($array_date) != 0) {

            foreach ($array_date as $each_date) {
                list($day, $month, $year) = explode("/", $each_date['date']);
                $newDate = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);
                $data = DB::select('SELECT w.flight_id,w.work_id,w.user_id,w.work_date,w.confirm_status,e.title,e.name,e.surname
                                FROM work_schedules w LEFT JOIN
                                employees e ON w.user_id = e.user_id
                                WHERE w.user_id = ?
                                AND w.work_date = ?
                                AND w.confirm_status IN ("confirm","free")', [$user_id, $newDate]);
                foreach ($data as $e_data) {
                    array_push($data_array, $e_data);
                }
            }
        } else if (isset($user_id) && sizeof($array_date) == 0) {

            $data = DB::select('SELECT w.flight_id,w.work_id,w.user_id,w.work_date,w.confirm_status,e.title,e.name,e.surname
                            FROM work_schedules w LEFT JOIN
                            employees e ON w.user_id = e.user_id
                            WHERE w.user_id = ?
                            AND w.confirm_status IN ("confirm","free")', [$user_id]);
            $data_array = $data;
        } else if (!isset($user_id) && sizeof($array_date) != 0) {
            foreach ($array_date as $each_date) {
                list($day, $month, $year) = explode("/", $each_date['date']);
                $newDate = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);
                $data = DB::select('SELECT w.flight_id,w.work_id,w.user_id,w.work_date,w.confirm_status,e.title,e.name,e.surname
                                FROM work_schedules w LEFT JOIN
                                employees e ON w.user_id = e.user_id
                                WHERE w.work_date = ?
                                AND w.confirm_status IN ("confirm","free")', [$newDate]);
                foreach ($data as $e_data) {
                    array_push($data_array, $e_data);
                }
            }
        }
        return response()->JSON($data_array);
    }

    public function updateWorkStatus(Request $request)
    {

        Work_schedule::where('work_id', $request->work_id)->update(['confirm_status' => "cancel", 'flight_id' => null]);
        return response()->JSON($request->work_id);
    }


    public function getCount()
    {

        $userCount = DB::table('customers')->count();
        $employeeCount = DB::table('employees')->count();
        $pilotCount = DB::table('employees')->where('employee_role', 'pilot')->count();
        $airCount = DB::table('employees')->where('employee_role', 'flight_attendant')->count();
        $staffCount = DB::table('employees')->where('employee_role', 'staff')->count();
        $airportCount = DB::table('airports')->count();
        $aircraftCount = DB::table('aircrafts')->count();

        return response()->JSON(['user' => $userCount, 'employee' => $employeeCount, 'pilot' => $pilotCount, 'staff' => $staffCount,  'air' => $airCount, 'airport' => $airportCount, 'aircraft' => $aircraftCount]);
    }
}
