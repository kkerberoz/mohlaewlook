<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function register(Request $request)
    {
        $username = $request->username;
        #$checkUsername = DB::select("SELECT username FROM customers WHERE username == $username");
        if(true){
            return response()->json([$username]);
        }
        else {
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
