
@extends('layouts.masters.mainone')

<div id="wrapper">

    @section('content')

        <header id="header">
            <a href="" class="logo"><img src="{{ URL::asset('dashboard/images/login-logo.png')}}" alt="Linkmerge" class="login-logo" ></a>
            <div class="client-area">
                {{--<form action="#" class="search-form">--}}
                {{--<fieldset>--}}
                {{--<input type="submit" value="submit">--}}
                {{--<input type="search">--}}
                {{--</fieldset>--}}
                {{--</form>--}}
                <div class="user-info">
                    {{--<div class="img-holder">--}}
                    {{--<img src="" alt="User Image" class="img-responsive">--}}
                    {{--<a href="#" class="count-msg">2</a>--}--}}
                    {{--</div>--}}
                    {{--{{ Auth::user()->hospital->name }}--}}
                    @if (Auth::user()->user_type == 3)
                        <span class="logout-opener">LinkeMerg</span>
                        <ul class="logout-area list-none">
                            <li><a href="{{ URL::to('/admin/login') }}">Logout</a></li>

                        </ul>
                    @else
                        <span class="logout-opener">{{ Auth::user()->hospital->name }}</span>
                        <ul class="logout-area list-none">
                            <li><a href="{{ URL::to('/admin/login') }}">Logout</a></li>
                        </ul>
                </div>
                @endif
            </div>
        </header>
        <main id="main">
            <a href="#" class="btn-sidebar">&#9776</a>
            <aside id="sidebar">
                <ul class="side-list">

                    @if (Auth::user()->user_type == 3)
                        <li class=""><a href="{{ URL::to('/admindashboard') }}"> <i class="fa fa-user"></i>Hospitals</a> </li>
                        <li class="active"><a href=""> <i class="fa fa-user"></i>Change Password</a>
                        {{--<li class=""><a href="javascript:history.back()"> <i class="fa fa-user"></i>Users</a> </li>--}}
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @else


                        <li class=""><a href="javascript:history.back()"> <i class="fa fa-user"></i>Users</a> </li>
                        <li class="active"><a href=""> <i class="fa fa-user"></i>Change Password</a>
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @endif
                </ul>
            </aside>
            <div id="content">
                <header class="header">
                    <ul class="breadcrumbs list-none">
                        {{--<li><a href="">Dashboard</a></li>--}}
                        <li>Change Password

                            {{--@if(Session::has('message'))--}}
                                {{--<div class="alert alert-success"> {{Session::get('message')}}</div>--}}
                            {{--@endif--}}


                        </li>

                    </ul>
                    @include('layouts.partials.form_errors')
                    @if(Session::has('message'))
                        <ul class="list-none error-list">
                            <li>{{Session::get('message')}}</li>
                        </ul>
                    @endif
                    
                </header>



                <form class="login-form" action="{{ URL::to('change-password') }}" method="POST">
                    {{csrf_field()}}

                    <h3>Old Password:</h3>
                    <input type="password"   name="old_password" placeholder="Enter your old Password" value="{{ old('password') }}"/>
                    <h3>New Password:</h3>
                    <input type="password" name="password" placeholder="Enter your New Password" />
                    <h3>Confirm Password:</h3>
                    <input type="password" name="confirm_password" placeholder="Confirm your Password" />
                    <br>
                    <input type="submit" name="submit" value="Save Password" class="login-button"/>
                    <br>


                    <a class="sign-up"></a>
                    <br>

                    <h6 class="no-access"></h6>

                </form>
            </div>
            <div class="error-page">
                <div class="try-again"></div>

            </div>

        </main>
</div>
@endsection

