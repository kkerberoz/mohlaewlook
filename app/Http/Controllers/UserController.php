<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    // public function queryusername(Request $request)
    // {

    // }

    public function register(Request $request)
    {
        $usernameCheck = DB::table('customers')->select('username')->where('username', $request->username)->first();
        $emailCheck = DB::table('customers')->select('email')->where('email', $request->email)->first();
        if(isset($usernameCheck)){
            return response()->json(['error'=>'This username is already exist.']);
        }
        else if(isset($emailCheck)){
            return response()->json(['error'=>'This E-mail is already exist.']);
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
        }

    }
}
