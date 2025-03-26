<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Controllers\Controller;
//use App\Http\Middleware\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use Illuminate\Http\Request;
use App\User;
use App\Hospital;
use Illuminate\Support\Facades\Input;



class RegisterController extends Controller
{
    public function getRegister(){

        return view('admindashboard.register');
    }

    public function registerHospital(Request $request)
    {


        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|max:255|min:7',
            'name' => 'required',
            'area' => 'required',
        ]);
//        $messages = array(
//            'email.required' => 'please enter email address',
//            'password.required' => 'please enter password',
//        );
//        // apply validation rules to fields
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
            'area' => 'required',
       );

//
//        $users->name=Input::get("name");
//        $users->email=Input::get("email");
//        $users->password=Input::get("password");

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput(Input::all());
        } else {

            $users = new User();
        $users->email = $request['email'];
        $hashed = bcrypt($request['password']);
        $users->password = $hashed;
        $users->user_type = 4;
        $users->save();


        $hospitals = new Hospital();
        $hospitals->name = $request['name'];
        $hospitals->area = $request['area'];
        $hospitals->lng = $request['lng'];
        $hospitals->lat = $request['lat'];
        $hospitals->user_id = $users->id;

        $hospitals->save();

            Session::flash('message', 'You has been successfully registered. Please wait for Approval');
            return redirect()->back();
        }
    }
}


