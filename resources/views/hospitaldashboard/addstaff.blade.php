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
                        {{--<img src="images/img1.png" alt="User Image" class="img-responsive">--}}
                        {{--<a href="#" class="count-msg">2</a>--}}
                    {{--</div>--}}
                    <span class="logout-opener">Syed Shah Hassan</span>
                    <ul class="logout-area list-none">
                        <li><a href="{{ URL::to('/hospitallogout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main id="main">
                    <a href="#" class="btn-sidebar">&#9776;</a>
            {{--<aside id="sidebar">--}}
                {{--<ul class="menu list-none">--}}
                    {{--<li><a href=""></a></li>--}}
                    {{--<li class="store active"><a href="store.html">Store</a></li>--}}

                    {{--<li class="logout"><a href="index.html">Logout</a></li>--}}
                {{--</ul>--}}
            {{--</aside>--}}
            <div id="content">
                <header class="header border">
                    <a href="HospitalDashboard" class="align-right">Go Back</a>
                    <ul class="breadcrumbs list-none">
                        <li><a href="HospitalDashboard">Dashboard</a></li>
                        <li>Enter Staff Details</li>

                    </ul>
                </header>
                <div class="content-area p-details">
                    <div class="slider-cols add">
                        {{--<div class="col">--}}
                            {{--<form action="#" class="add-images">--}}

                            {{--</form>--}}
                        </div>

                        <div class="col">
                            <header class="heading-txt add">
                                @if(Session::has('message'))
                                    <div class="alert alert-success"> {{Session::get('message')}}</div>
                                @endif
                                @include('layouts.partials.form_errors')

                            </header>

                            <form action="{{ URL::to('admin/add_staff') }}" class="add-product-form" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <fieldset>
                                    <div class="row">
                                        <label for="p-first_name">First Name</label>
                                        <input type="text" id="p-first_name"  name="first_name" placeholder="Enter your first name">
                                    </div>
                                    <div class="row">
                                        <label for="p-last_name">Last Name</label>
                                        <input type="text" id="p-last_name" name="last_name" placeholder="Enter your last name">
                                    </div>
                                    <div class="row">
                                        <div class="align-left"><label for="p-image">Select Staff Image</label></div>
                                        <div class="align-right"> <label class="new"><input type="file" name="user_image" id="file2"></label></div>

                                    </div>

                                    <div class="row">
                                        <div class="align-left"><label for="p-document">Upload Documents</label></div>
                                        <div class="align-right"> <label class="new"><input type="file" name="staff_document" id="file2"></label></div>

                                    </div>

                                    <div class="row">
                                        <label for="p-email">Email</label>
                                        <input type="text" id="p-email" name="email" placeholder="Enter your Email">
                                    </div>
                                    <div class="row">
                                        <label for="p-password">Password</label>
                                        <input type="password" id="p-password" name="password" placeholder="Enter your Password">
                                    </div>

                                    <div class="row">

                                        <div class="align-left">
                                        <label for="p-user_type" >User Type</label>
                                        </div>
                                        <div class="align-right">
                                        <select name="user_type">
                                            <option value="1">First Responder</option>
                                            <option value="2">Nurse</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="row btns">

                                        <input type="submit" value="Save" name="submit" class="btn-primary save">
                                        <input type="button" value="Cancel" name="cancel" class="btn-primary save" onClick="window.location.reload()">

                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
        <div id="dialogue" class="dialogue">
            <div class="dialogue-holder">
                <div class="confirm-msg">
                    <div class="confirm-txt">
                        <header class="header">
                            <h2>Delete Product</h2>
                            <a href="#" class="btn-close">x</a>
                        </header>
                        <div class="txt">
                            <img src="dashboard/images/img10.png" alt="Danger">
                            <p>Are you sure you want to delete this product?</p>
                            <div class="btns">
                                <a href="" class="btn-primary cancel">Cancel</a>
                                <a href="" class="btn-primary delete">Delete Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection