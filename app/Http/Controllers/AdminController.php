<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Disease;
use App\Education;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{

    public function init()
    {
        $employee = Employee::all();
        return response()->json($employee, 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $employee = Auth::guard('employee')->user();
            return response()->json($employee, 200);
        } else {
            return response()->json([
                'error' => "can't log you in"
            ], 401);
        }
    }

    public function addEmployee(Request $request)
    {
        // data
        $detail_data = $request->details;
        $education_data = $request->educations;
        $diseases_data = $request->diseases;
        // calculate user_id
        $employee_role = array(
            array("role_name" => "staff", "initial" => "STA"),
            array("role_name" => "pilot", "initial" => "PLT"),
            array("role_name" => "flight_attendant", "initial" => "FAD")
        );
        foreach ($employee_role as $role) {
            if (!strcmp(strtolower($detail_data['role']), $role["role_name"])) {
                $user_id_search = Employee::select('user_id')->where('user_id', 'LIKE', "%" . $role["initial"] . "%")->get();
                if (!sizeof($user_id_search)) $user_id = $role["initial"] . "00000001";
                else {
                    for ($i = 0; $i < sizeof($user_id_search); ++$i)
                        $id[$i] = str_replace($role["initial"], "", $user_id_search[$i]['user_id']);
                    $user_id = $role["initial"] . sprintf("%08d", max($id) + 1);
                }
            }
        }
        // add into employees table
        $employee = new Employee;
        $employee->user_id = $user_id;
        $employee->username = $detail_data['username'];
        $employee->password = HASH::make($detail_data['password']);
        $employee->title = $detail_data['title'];
        $employee->name = $detail_data['firstname'];
        $employee->surname = $detail_data['lastname'];
        $employee->gender = $detail_data['gender'];
        $employee->id_card = $detail_data['idcard'];
        $employee->DOB = $detail_data['DOB'];
        $employee->height = $detail_data['height'];
        $employee->weight = $detail_data['weight'];
        if (isset($detail_data['email'])) $employee->email = $detail_data['email'];
        $employee->phone = $detail_data['phone'];
        $employee->address = $detail_data['address'];
        $employee->start_date = $detail_data['start_date'];
        $employee->salary = $detail_data['salary'];
        $employee->employee_role = strtolower($detail_data['role']);
        if (isset($detail_data['airport'])) $employee->airport_id = $detail_data['airport'];
        $employee->is_work = $detail_data['status'];
        $employee->save();
        // add into educations table
        for ($i = 0; $i < sizeof($education_data); ++$i) {
            $education = new Education;
            $education->user_id = $user_id;
            $education->degree = $education_data[$i]['degree'];
            $education->university = $education_data[$i]['university'];
            $education->faculty = $education_data[$i]['faculty'];
            $education->department = $education_data[$i]['department'];
            $education->GPA = $education_data[$i]['gpa'];
            $education->save();
        }
        // add into diseases table
        for ($i = 0; $i < sizeof($diseases_data) && $diseases_data[$i]['info'] != null && $diseases_data[$i]['note'] != null; ++$i) {
            $diseases = new Disease;
            $diseases->user_id = $user_id;
            $diseases->disease_name = $diseases_data[$i]['info'];
            $diseases->note = $diseases_data[$i]['note'];
            $diseases->save();
        }
        return response()->json('success', 200);
    }


    public function logout()
    {
        // Auth::guard('employee')->logout();
        Auth::logout();
        return response()->json(true, 200);
    }
}
