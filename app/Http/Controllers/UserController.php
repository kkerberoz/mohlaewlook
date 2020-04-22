<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{

    public function init()
    {
        // $customer = Auth::guard('customers')->user();
        $customer = Auth::user();

        return response()->json([
            'customer' => $customer
        ], 200);
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $customer = Auth::user();
            // $customer = Auth::guard('customers')->user();
            return response()->json($customer, 200);
        } else {
            return response()->json([
                'error' => 401
            ]);
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
            $count = Customer::count();
            if ($count < 10)
                $value = '0000000' . (string) $count;
            else if ($count >= 10 && $count < 100)
                $value = '000000' . (string) $count;
            else if ($count >= 100 && $count < 1000)
                $value = '00000' . (string) $count;
            else if ($count >= 1000 && $count < 10000)
                $value = '0000' . (string) $count;
            else if ($count >= 10000 && $count < 100000)
                $value = '000' . (string) $count;
            else if ($count >= 100000 && $count < 1000000)
                $value = '00' . (string) $count;
            else if ($count >= 1000000 && $count < 10000000)
                $value = '0' . (string) $count;
            else if ($count >= 10000000 && $count < 100000000)
                $value = (string) $count;

            $customer = new Customer;
            $customer->user_id = 'CST' . $value;
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
    public function logout()
    {
        Auth::logout();

        return response()->json(true, 200);
    }
}
