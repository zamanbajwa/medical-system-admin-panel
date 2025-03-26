@extends('layouts.masters.main')
@section('content')
<link href='http://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>

<div class="login">

    <div class="login-header">
        @include('layouts.partials.form_errors')
        <h4>Register here</h4>
    </div>
    <form class="login-form" action="{{url('/')}}/admin/register" method="POST">
        {{csrf_field()}}
    <div class="login-form">
        <h3>Email:</h3>

        <input type="text" name="email" placeholder="Email"/><br>
        <h3>Password:</h3>
        <input type="password" name="password" placeholder="Password"/>
        <br>
        <input type="submit" name="register" value="Register" class="login-button"/>
        <br>
        <a class="sign-up"></a>
        <br>
        @if(Session::has('message'))
            <div class="alert alert-success"> {{Session::get('message')}}</div>
        @endif
        <h6 class="no-access"></h6>
    </div>
    </form>
</div>
<div class="error-page">
    <div class="try-again"></div>
</div>

@endsection
