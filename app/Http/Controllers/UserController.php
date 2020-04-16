<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // public function queryusername(Request $request)
    // {

    // }

    public function register(Request $request)
    {
        $usernameCheck = Customer::select('username')->where('username', $request->username)->first();
        $emailCheck = Customer::select('email')->where('email', $request->email)->first();
        if(isset($usernameCheck)){
            return response()->json(['errorU'=>1,'errorE'=>0]);
        }

        if(isset($emailCheck)){
            return response()->json(['errorE'=>1,'errorU'=>0]);
        }

        else{
            $register = new Customer;
            $register->username = $request->username;
            $register->password = HASH::make($request->password);
            $register->title = $request->title;
            $register->name = $request->name;
            $register->surname = $request->surname;
            $register->DOB = $request->DOB;
            $register->email = $request->email;
            $register->timestamps = false;
            $register->save();
            return response()->json(['errorE'=>0,'errorU'=>0]);
        }



    }
}
