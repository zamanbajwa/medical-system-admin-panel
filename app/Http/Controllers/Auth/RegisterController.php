<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([

            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
//    public function getRegister()
//    {
//        return view('auth.register');
//    }
//    public function postRegister(Request $request)
//    {
////        $this->validate($request, [
////            'email' => 'required|unique:users|max:255',
////            'password' => 'required|max:255|min:7',
////        ]);
////
////
//////        $users->name=Input::get("name");
//////        $users->email=Input::get("email");
//////        $users->password=Input::get("password");
////        $users=new User();
////        $users->email = $request['email'];
////        $users->password = $request['password'];
////        $users->save();
//        Session::flash('message','Your data has been successfully submitted');
//        return redirect() ->back();




}
