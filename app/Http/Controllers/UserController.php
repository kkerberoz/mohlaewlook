<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Employee;
use App\Payment;
use App\Passenger;
use App\Reservation;
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
            // $count = Customer::count();
            // if ($count < 10)
            //     $value = '0000000' . (string) $count;
            // else if ($count >= 10 && $count < 100)
            //     $value = '000000' . (string) $count;
            // else if ($count >= 100 && $count < 1000)
            //     $value = '00000' . (string) $count;
            // else if ($count >= 1000 && $count < 10000)
            //     $value = '0000' . (string) $count;
            // else if ($count >= 10000 && $count < 100000)
            //     $value = '000' . (string) $count;
            // else if ($count >= 100000 && $count < 1000000)
            //     $value = '00' . (string) $count;
            // else if ($count >= 1000000 && $count < 10000000)
            //     $value = '0' . (string) $count;
            // else if ($count >= 10000000 && $count < 100000000)
            //     $value = (string) $count;

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

    public function reserveSendData(Request $request)
    {

        $reserve_data = $request->reserve_data;
        $user_id = $request->user_id;
        $passenger_array = $request->passenger;
        $seat_array = $request->seat;
        $payment_method = $request->payment_method;
        $price = $request->price;
        $payment_card = $request->payment_card;
        $flight_id_array = $request->flight_id;

        //reservation Table

        $reservation = new Reservation;
        $currrent_date = date("Y-m-d H:i:s");
        $reservation->user_id = $user_id;
        $reservation->reservation_datetime = $currrent_date;
        $reservation->reservation_status = $reserve_data['status'];
        $reservation->save();




        //passenger Table
        foreach ($passenger_array as $each_passenger) {
            $passenger = new Passenger;
            $passenger_oldID = "";
            if (isset($each_passenger['idcard']) && !isset($each_passenger['passport'])) {
                $passenger_oldID = Passenger::select('passenger_id')->where('passenger_idcard', $each_passenger['idcard']);
            } else //if(!isset($each_passenger['idcard']) && isset($each_passenger['passport'])){
            {
                $passenger_oldID = Passenger::select('passenger_id')->where('passenger_passport', $each_passenger['passport']);
            }

            if (isset($passenger_oldID)) {
                $passenger->passenger_id = $passenger_oldID;
                $passenger->passenger_title = $each_passenger['title'];
                $passenger->passenger_name = $each_passenger['name'];
                $passenger->passenger_surname = $each_passenger['surname'];
                $passenger->passenger_DOB = $each_passenger['dob'];
                $passenger->gender = $each_passenger['gender'];
                $passenger->passenger_nationality = $each_passenger['national'];
                $passenger->passenger_religion = $each_passenger['religion'];
                $passenger->passenger_idcard = $each_passenger['idcard'];
                $passenger->passenger_passport = $each_passenger['passport'];
                $passenger->passenger_phone = $each_passenger['phone'];
                $passenger->passenger_email = $each_passenger['email'];
                $passenger->save();
            } else {
                $prefix = "";
                $age = floor(((date_diff(date_create($each_passenger['dob']), date_create(date('Y-m-d'))))->days) / 365);
                if ($age >= 18) {
                    if (!strcmp($each_passenger['gender'], "male")) {
                        $prefix = "M";
                    } else if (!strcmp($each_passenger['gender'], "female")) {
                        $prefix = "F";
                    }
                } else {
                    $prefix = "K";
                }

                $check_id = Passenger::select('passenger_id')->where('passenger_id', 'LIKE', $prefix . "%")->order_By('passenger_id', 'desc')->first();
                $number = str_replace($prefix, "", $check_id['passenger_id']) + 1;
                $passenger->passenger_id = $prefix . sprintf("%08d", $number);
                $passenger->passenger_title = $each_passenger['title'];
                $passenger->passenger_name = $each_passenger['name'];
                $passenger->passenger_surname = $each_passenger['surname'];
                $passenger->passenger_DOB = $each_passenger['dob'];
                $passenger->gender = $each_passenger['gender'];
                $passenger->passenger_nationality = $each_passenger['national'];
                $passenger->passenger_religion = $each_passenger['religion'];
                $passenger->passenger_idcard = $each_passenger['idcard'];
                $passenger->passenger_passport = $each_passenger['passport'];
                $passenger->passenger_phone = $each_passenger['phone'];
                $passenger->passenger_email = $each_passenger['email'];
                $passenger->save();
            }
        }

        //payment

        $payment = new Payment;
        $reserve_id = Reservation::select('reservation_id')->where('user_id', $user_id)->where('reservation_datetime', $currrent_date)->first();
        $payment->payment_method = $payment_method;
        $payment->payment_card = $payment_card;
<<<<<<< refs/remotes/origin/master
        $payment ->total_price = $price;
=======
        $payment->total_price = $price;
>>>>>>> fix payment
        $payment->reservaton_id = $reserve_id;
        $payment->reservation_status = "confirm";
        $payment->save();


        //ticket create
        foreach ($seat_array as $seat_each_flight) {
            $j = 0;
            $ticket = new Ticket;
            for ($i = 0; $i < sizeof($passenger_array[$j]); $i++) {
                $ticket->seat_no = $seat_each_flight[$i];
                $ticket->class_name = $reserve_data['class'];
                $ticket->flight_id = $flight_id_array[$j];
                $ticket->reservation_id = $reserve_id;
                $ticket->passenger_id = $passenger_array[$j][$i];
            }
            $j++;
        }
    }

    public function getLocation()
    {
        $airport = Airport::all();
        return response()->JSON($airport);
    }
    public function getFlight(Request $request)
    {
        $class = $request->input['class'];
        $no_of_passenger = $request->passengerCount;
        // for depart
        $from = $request->input['flightFrom']['value']['airport_id'];
        $to = $request->input['flightTo']['value']['airport_id'];
        list($day, $month, $year) = explode("/", $request->input['departDate']);
        $depart_date = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);
        $all_flight = Flight::leftJoin('class_prices', 'flights.flight_no', '=', 'class_prices.flight_no')->where('depart_location', $from)->where('arrive_location', $to)->where('depart_datetime', 'LIKE', $depart_date . "%")->get();
        $avaliable_flight = [];
        foreach ($all_flight as $flight) {
            $flight_detail = DB::select("SELECT * FROM flights AS d1 INNER JOIN aircrafts AS d2 ON (d1.aircraft_id = d2.aircraft_id) INNER JOIN aircraft_models AS d3 ON (d2.model_id = d3.model_id) WHERE d1.flight_id = ?", [$flight['flight_id']]);
            if (isset($flight_detail)) {
                $ticketCount = Ticket::where('class_name', $class)->where('flight_id', $flight['flight_id'])->count();
                $class_type = (!strcmp($class, "Economy")) ? "eco_cap" : ((!strcmp($class, "Business")) ? "bus_cap" : "first_cap");
                if ($flight_detail[0]->$class_type - $ticketCount > $no_of_passenger) {
                    array_push($avaliable_flight, $flight);
                }
            }
        }
        return response()->JSON($avaliable_flight);
    }
}
