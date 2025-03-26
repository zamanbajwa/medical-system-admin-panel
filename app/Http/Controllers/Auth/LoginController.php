<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }

    public function getlogin()
    {

        return view('auth.login');
    }

    public function login(Request $request)
    {

        /*<form action="<?php echo asset('/hospital/patients_list_view');?>">*/

        $this->validate($request, [
            'email' => 'required|exists:users,email,user_type,4|max:255',
            'password' => 'required|max:255|min:7',
        ]);

         $email = $request->email;
         $password = $request->password;
    
            if (Auth::attempt(['email' => $email, 'password' => $password])) {

                

                return redirect('hospital/dashboard');

            } else {
                
                return redirect('/login');
            }
    }
}
