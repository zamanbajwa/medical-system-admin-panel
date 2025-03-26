@extends('layouts.masters.main')

@section('content')
    <div class="login">

        <div class="login-header">

            <h4>Login</h4>
        </div>
        <form class="login-form" action="{{url('/')}}/admin/hospital/login" method="POST">
            {{csrf_field()}}
            <div class="login-form">
                <h3>Email:</h3>
                <input type="text"   name="email" placeholder="Email"/><br>
                <h3>Password:</h3>
                <input type="password" name="password" placeholder="Password"/>
                <br>
                <input type="submit" name="login" value="Login" class="login-button"/>
                <br>
                @if(Session::has('message'))
                    {{--<div class="alert alert-success"> {{Session::get('message')}}</div>--}}
                    <div class="alert alert-error"> {{Session::get('message')}}</div>
                @endif
                <a class="sign-up"></a>
                <br>
                @include('layouts.partials.form_errors')
                <h6 class="no-access"></h6>
            </div>
        </form>
    </div>
    <div class="error-page">
        <div class="try-again"></div>
    </div>


@endsection