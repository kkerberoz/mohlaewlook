<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Employee;
use App\Airport;
use App\Flight;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function getCustomer()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $customer = Auth::user();
            // $customer = Auth::guard('customers')->user();
            return response()->json($customer, 200);
        } else {
            return response()->json([
                'error' => "Cloud not log you in"
            ], 401);
        }
    }



    public function register(Request $request)
    {
        $usernameCheck = Customer::select('username')->where('username', $request->username)->first();
        $emailCheck = Customer::select('email')->where('email', $request->email)->first();

        if (isset($usernameCheck)) {
            return response()->json(['errorU' => 1, 'errorE' => 0]);
        }

        if (isset($emailCheck)) {
            return response()->json(['errorE' => 1, 'errorU' => 0]);
        } else {

            $user_id_search = Customer::select('user_id')->where('user_id', 'LIKE', "%" . 'CST' . "%")->get();
            if (!sizeof($user_id_search)) $user_id = 'CST' . "00000001";
            else {
                for ($i = 0; $i < sizeof($user_id_search); ++$i)
                    $id[$i] = str_replace('CST', "", $user_id_search[$i]['user_id']);
                $user_id = 'CST' . sprintf("%08d", max($id) + 1);
            }

            $customer = new Customer;
            $customer->user_id = $user_id;
            $customer->username = $request->username;
            $customer->password = HASH::make($request->password);
            $customer->title = $request->title;
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->DOB = $request->DOB;
            $customer->email = $request->email;
            // $customer->timestamps = false;
            $customer->save();
            // Auth::login($customer, true);

            return response()->json(['errorE' => 0, 'errorU' => 0]);
        }
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->username = $request->username;
        if (isset($request->password)) $customer->password = HASH::make($request->password);
        $customer->title = $request->title;
        $customer->name = $request->name;
        $customer->surname = $request->surname;
        $customer->DOB = $request->DOB;
        $customer->email = $request->email;
        $customer->save();

        return response()->json(['message' => 'Customer Update'], 200);
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        // delete the user

        $customer->delete();

        return response()->json(['message' => 'Customer Deleted'], 200);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(true, 200);
    }

    public function getLocation(){
        $airport = Airport::all();
        return response() -> JSON($airport);
    }
    public function getFlight(Request $request){
        $class = $request->input['class'];
        $no_of_passenger = $request->passengerCount;
        // for depart
        $from = $request->input['flightFrom']['value']['airport_id'];
        $to = $request->input['flightTo']['value']['airport_id'];
        list($day,$month,$year) = explode("/", $request->input['departDate']);
        $depart_date = $year."-".sprintf("%02d",$month)."-".sprintf("%02d",$day);
        $all_flight = Flight::leftJoin('class_prices', 'flights.flight_no', '=', 'class_prices.flight_no')->
                              where('depart_location', $from)->where('arrive_location', $to)->
                              where('depart_datetime', 'LIKE', $depart_date. "%")->get();
        $avaliable_flight = [];
        foreach($all_flight as $flight){
            $flight_detail = DB::select("SELECT * FROM flights AS d1 INNER JOIN aircrafts AS d2 ON (d1.aircraft_id = d2.aircraft_id) INNER JOIN aircraft_models AS d3 ON (d2.model_id = d3.model_id) WHERE d1.flight_id = ?", [$flight['flight_id']]);
            if(isset($flight_detail)){
                $ticketCount = Ticket::where('class_name', $class)->where('flight_id', $flight['flight_id'])->count();
                $class_type = (!strcmp($class, "Economy")) ? "eco_cap" : ((!strcmp($class, "Business")) ? "bus_cap" : "first_cap");
                if($flight_detail[0]->$class_type - $ticketCount > $no_of_passenger){
                    array_push($avaliable_flight, $flight);
                }
            }
        }
        return response() -> JSON($avaliable_flight);
    }
    public function reserveSendData(Request $request){
        $passenger_array = $request->passenger;
        $seat_array = $request->seat;

    }
}
