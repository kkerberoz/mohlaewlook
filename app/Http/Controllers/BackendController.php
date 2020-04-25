<?php

namespace App\Http\Controllers;

use App\Aircraft;
use App\Aircraft_brand;
use App\Aircraft_model;
use App\Airport;
use App\Customer;
use Illuminate\Http\Request;
use App\Employee;
use App\Disease;
use App\Education;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{

    public function getAirports()
    {
        $AirportID = Airport::all();
        return response()->JSON($AirportID);
    }

    public function getModelBrand()
    {
        $model = Aircraft_model::all();
        $brand = Aircraft_brand::all();
        return response()->JSON([$model,$brand]);
    }

    public function addAircraft(Request $request)
    {
        $aircraft = new Aircraft;
        $aircraft_brand = new Aircraft_brand;
        $aircraft_model = new Aircraft_model;

        $input_Data = $request->input;



        $model_check = Aircraft_model::where('model_name',$input_Data['model'])->first();
        $brand_check = Aircraft_brand::where('brand_name',$input_Data['brand'])->first();
        if(isset($brand_check))
        {
            if(isset($model_check))//Add only aircraft
            {
                $model_check = Aircraft_model::where('model_name',$input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name',$input_Data['brand'])->first();
                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();



            }
            else//Add model and aircraft
            {
                $aircraft_model->model_name = $input_Data['model'];
                $aircraft_model->fuel_capacity = $input_Data['fuelCap'];
                $aircraft_model->number_of_engine = $input_Data['numberEng'];
                $aircraft_model->engine_type = $input_Data['typeEng'];
                $aircraft_model->eco_cap = $input_Data['ecoCap'];
                $aircraft_model->bus_cap = $input_Data['busCap'];
                $aircraft_model->first_cap =  $input_Data['firstCap'];
                $aircraft_model->eco_pattern = $input_Data['ecoPat'];
                $aircraft_model->bus_pattern = $input_Data['busPat'];
                $aircraft_model->first_pattern = $input_Data['firstPat'];
                $aircraft_model->save();

                $model_check = Aircraft_model::where('model_name',$input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name',$input_Data['brand'])->first();
                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();




            }
        }

        else
        {
            if(isset($model_check)){//Add brand & aircraft
                $aircraft_brand->brand_name = $input_Data['brand'];
                $aircraft_brand->country = $input_Data['country'];
                $aircraft_brand->save();

                $model_check = Aircraft_model::where('model_name',$input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name',$input_Data['brand'])->first();

                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();

            }
            else{// Add all data
                $aircraft_brand->brand_name = $input_Data['brand'];
                $aircraft_brand->country = $input_Data['country'];
                $aircraft_brand->save();

                $aircraft_model->model_name = $input_Data['model'];
                $aircraft_model->fuel_capacity = $input_Data['fuelCap'];
                $aircraft_model->number_of_engine = $input_Data['numberEng'];
                $aircraft_model->engine_type = $input_Data['typeEng'];
                $aircraft_model->eco_cap = $input_Data['ecoCap'];
                $aircraft_model->bus_cap = $input_Data['busCap'];
                $aircraft_model->first_cap =  $input_Data['firstCap'];
                $aircraft_model->eco_pattern = $input_Data['ecoPat'];
                $aircraft_model->bus_pattern = $input_Data['busPat'];
                $aircraft_model->first_pattern = $input_Data['firstPat'];
                $aircraft_model->save();

                $model_check = Aircraft_model::where('model_name',$input_Data['model'])->first();
                $brand_check = Aircraft_brand::where('brand_name',$input_Data['brand'])->first();

                $aircraft->aircraft_startdate = $input_Data['date'];
                $aircraft->brand_id = $brand_check['brand_id'];
                $aircraft->model_id = $model_check['model_id'];
                $aircraft->save();
            }


        }

    }
}
