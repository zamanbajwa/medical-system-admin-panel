<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;
use App\Hospital;
use Illuminate\Support\Facades\Input;

class ChangePasswordController extends Controller
{

//    public function getChangePassword($id)
//    {
//
//        $hospitals = Hospital::find($id);
//        $users= User::find($hospitals->id);
//        return view('admindashboard.ChangePassword', compact('hospitals','users'));
//
//
//    }


    public function ChangePassword(Request $request)
    {

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:7',


        ]);
//
//        $old_password = $request->input('old_password');
//        if (Hash::check($old_password, Auth::user()->password)) {
//
////
//        }
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        if ($password != $confirm_password) {
            Session::flash('message', 'Your password and confirm password does not match.');
            return redirect()->back()->withInput(Input::all());
        }

        $data = $request->all();
        $user = User::find(Auth::id());
        $hashedPassword = $user->password;


        if (Hash::check($request->old_password, $hashedPassword)) {
            //Change the password

            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            Session::flash('message', 'Your password has been successfully changed.');
            return redirect()->back();

        } else {
            Session::flash('message', 'You entered wrong Old Password .Please Try again.');
            return redirect()->back()->withInput(Input::all());
    }
    }

}
?>
<!--<script>-->
<!--    function validate(){-->
<!---->
<!--        var a = document.getElementById("password").value;-->
<!--        var b = document.getElementById("confirm password").value;-->
<!--        if (a!=b) {-->
<!--            alert("Passwords do no match");-->
<!--            return false;-->
<!--        }-->
<!--    }-->
<!--</script>-->


