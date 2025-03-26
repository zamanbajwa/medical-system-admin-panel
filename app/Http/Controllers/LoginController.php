<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\authenticate;
use App\Admin;
use App\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
Use Session;
Use Illuminate\Support\Facades\Input;


class LoginController extends Controller
{
//    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
//        $this->middleware('Admin')->except('logout');
    }

    public function getlogin()
    {

        return view('admindashboard.login');

    }

//    public function login(Request $request)
//
//    {
//            $this->validate($request, [
//            'email' => 'required|email|max:255',
//            'password' => 'required|max:255|min:7',
//        ]);
//
//        $auth = auth()->guard('admin');
//        if ($auth->attempt(['email' => $request['email'], 'password' => $request['password']])) {
////          return view('admindashboard.main');
//
////             return redirect('/admin/dashboard');
//
//           return Redirect::to('admindashboard');
//
//        }
//        else
//
//        {
//            Session::flash('message','Information you entered is not matching with our record');
//            return Redirect::to('admin/login');
//
////
//        }
//
//
//    }

public function login(Request $request)
{

    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:7',
    ]);
    //$auth = auth()->guard('admin');

    if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'is_approved' => 1])) {

        if (Auth::user()->user_type == 3) {

            return Redirect::to('admindashboard');

        } else if (Auth::user()->user_type == 4) {
            $hos = Hospital::where('user_id', Auth::user()->id)->first();
            return Redirect::to('admindashboard/hospital/' . $hos->id);
        }
  }

 else{
     Session::flash('message', 'Information you entered is not matching with our record');
     return Redirect::to('admin/login')->withInput(Input::all());
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
//
//            public function getlogout()
//        {
//
//            $auth = auth()->guard('admin');
//            $auth->logout();
////            return redirect()->route('admin/login');
//                return Redirect::to('admin/login');
//
//        }
//

    public function getlogout()
    {

        Auth::logout();

//            return redirect()->route('admin/login');
        return Redirect::to('admin/login');
    }

}
