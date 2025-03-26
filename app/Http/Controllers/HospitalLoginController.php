<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\authenticate;
use Session;
use App\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class HospitalLoginController extends Controller
{

    public function getlogin()
    {

        return view('hospitaldashboard.login');

    }

    public function hospitallogin(Request $request)

    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255|min:7',
        ]);
        $remember = $request->get('remember');
        $auth = auth()->guard('web');
        if ($auth->attempt(['email' => $request['email'], 'password' => $request['password']], $remember)) {
            
            return Redirect::to('hospital/dashboard');
        }
        else
        {
            Session::flash('message','Information you entered is not matching with our record');
            return Redirect::to('hospital/login_view');

        }


    }


//    public function create(Request $request)
//    {
////        return $request;
//        return Admin::create([
//
//            'email' => $request['email'],
//            'password' => bcrypt($request['password']),
//        ]);
//    }

//        public function authenticate( Request $request)
//        {
//            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
//                return redirect()->route('/admin/dashboard');
//            } else {
//                return ('please enter valid details');
////            return view('auth.login');
//            }
//        }

    public function getlogout()
    {

        $auth = auth()->guard('web');
        $auth->logout();
        return Redirect::to('hospital/login_view');

    }

}
