<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{


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
            $count = Customer::count();
            if($count<10)
                $value = '0000000'.(string)$count;
            else if($count >= 10 && $count<100)
                $value = '000000'.(string)$count;
            else if($count>=100 && $count<1000)
                $value = '00000'.(string)$count;
            else if($count >=1000&&$count<10000)
                $value = '0000'.(string)$count;
            else if($count >=10000 && $count<100000)
                $value = '000'.(string)$count;
            else if($count>=100000 && $count<1000000)
                $value = '00'.(string)$count;
            else if($count>=1000000 && $count < 10000000)
                $value = '0'.(string)$count;
            else if($count>=10000000 && $count < 100000000)
                $value = (string)$count;

            $register = new Customer;
            $register->user_id = 'CST'.$value;
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
