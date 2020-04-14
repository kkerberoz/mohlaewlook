<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Customer;

class UserController extends Controller
{
    public function register(Request $request){
        $register = new Customer;
        $register->username = $request->username;
        $register->password = $request->password;
        $register->title = $request->title;
        $register->name = $request->name;
        $register->surname = $request->surname;
        $register->DOB = $request->DOB;
        $register->email = $request->email;
        $register->timestamps = false;
        $register->save();

        return redirect()->back();
    }
}
