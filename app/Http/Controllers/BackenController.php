<?php

namespace App\Http\Controllers;

use App\Airport;
use Illuminate\Http\Request;
use App\Employee;
use App\Disease;
use App\Education;
use Illuminate\Support\Facades\Hash;

class BackenController extends Controller
{
    public function addEmployee(Request $request){
        $test = Employee::all();

        $diseases = new Disease;
        $diseases->user_id = "S01";
        $diseases->disease_name = "AA";
        $diseases->note = "BB";
        $diseases->save();

        // Add into employee table
        // $employee = new Employee;
        // $employee->user_id = "S01";
        // $employee->username = $request->details['username'];
        // $employee->password = HASH::make($request->details['password']);
        // $employee->title = $request->details['title'];
        // $employee->name = $request->details['firstname'];
        // $employee->surname = $request->details['lastname'];
        // $employee->gender = $request->details['gender'];
        // $employee->id_card = $request->details['idcard'];
        // $employee->DOB = $request->details['DOB'];
        // $employee->height = $request->details['height'];
        // $employee->weight = $request->details['weight'];
        // $employee->email = $request->details['email'];
        // $employee->phone = $request->details['phone'];
        // $employee->address = $request->details['address'];
        // $employee->start_date = $request->details['start_date'];
        // $employee->salary = $request->details['salary'];
        // $employee->employee_role = $request->details['role'];
        // $employee->airport_id = $request->details['airport'];
        // $employee->is_work = $request->details['status'];
        // $employee->save();

        // Add into diseases table

        // return response() -> JSON([$diseases]);
    }
    public function getAirports(){
        $AirportID = Airport::select('airport_id', 'airport_name')->get();
        return response() -> JSON([$AirportID]);
    }
}
