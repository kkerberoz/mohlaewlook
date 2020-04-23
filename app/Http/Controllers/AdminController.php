<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class AdminController extends Controller
{

    public function init()
    {
        $employee = Employee::count();
        return response()->json($employee, 200);
    }

    public function login(Request $request)
    {
        if (Auth::guard('employee')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $employee = Auth::guard('employee')->user();
            // $customer = Auth::guard('customers')->user();
            return response()->json($employee, 200);
        } else {
            return response()->json([
                'error' => "HElll"
            ], 401);
        }

        // $request->validate([
        //     'username' => ['required'],
        //     'password' => ['required']
        // ]);

        // if (Auth::guard('employee')->attempt($request->only('username', 'password'))) {
        //     return response()->json(Auth::guard('employee')->user(), 200);
        // }

        // throw ValidationException::withMessages([
        //     'email' => ['The provided credentials are incorrect.']
        // ]);
    }


    public function logout()
    {
        Auth::guard('employee')->logout();

        return response()->json(true, 200);
    }
}
