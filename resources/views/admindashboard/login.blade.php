@extends('layouts.masters.main')

@section('content')
<div class="login-form-area">
<div class="login-form-holder">
    <div class="login">

        <div class="login-header">

            <h4>Login</h4>
                <p>Login with your existing credentials.</p>
        </div>




        <form class="login-form" action="{{ URL::to('admin/login') }}" method="POST">
            {{csrf_field()}}
            @include('layouts.partials.form_errors')
            @if(Session::has('message'))
                <ul class="list-none error-list">
                    <li>{{Session::get('message')}}</li>
                </ul>
            @endif
                <img src="{{ URL::asset('dashboard/images/login-logo.png')}}" alt="Linkmerge" class="login-logo" >
                <div class="login-area">
                <h3>Email:</h3>
                <input type="text"   name="email" placeholder="Email" value="{{ old('email') }}"/>
                <h3>Password:</h3>
                <input type="password" name="password" placeholder="Password" />
                <input type="submit" name="login" value="Login" class="login-button"/>
                </div>


                <a class="sign-up"></a>
                <br>

                <h6 class="no-access"></h6>

        </form>
    </div>
    <div class="error-page">
        <div class="try-again"></div>
    </div>
</div>
</div>



@endsection