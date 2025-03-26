@extends('layouts.masters.mainone')
<style>{{URL::asset('assets/dashboard/css/all.css')}}</style>
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
        <div id="main">
                    <a href="" class="btn-sidebar">&#9776;</a>
            <aside id="sidebar">
                {{--{{dd($staff[0]['first_name'])}}--}}
                {{--<ul class="side-list">--}}
                    {{--<li><a href="#"> <i class="fa fa-hospital-o"></i> Hospitals</a> </li>--}}
                    {{--<li><a href="#"><i class="fa fa-power-off"></i> Logout</a> </li>--}}
                {{--</ul>--}}

                <ul class="side-list">

                    @if (Auth::user()->user_type == 3)

                        <li><a href="{{ URL::to('/admindashboard') }}"> <i class="fa fa-user"></i>Hospitals</a> </li>
                        <li class="active"><a href="{{url('/')}}/admindashboard/hospital/{{$staff[0]->hospital->id}}"> <i class="fa fa-user"></i>Users</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @else

                        <li class="active"><a href="{{url('/')}}/admindashboard/hospital/{{$staff[0]->hospital->id}}"> <i class="fa fa-user"></i>Users</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>

                    @endif

                </ul>
            </aside>

            <div id="content">

                <header class="header border">
                    {{--/{{$hospital->id}}--}}
                    <a href="{{url('/')}}/admindashboard/hospital/{{$staff[0]->hospital->id}}" class="align-right">Go Back</a>
                    <ul class="breadcrumbs list-none">
                        <li><a href="{{url('/')}}/admindashboard/hospital/{{$staff[0]->hospital->id}}">Dashboard</a></li>
                        <li>Edit Staff Details</li>

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
                                @include('layouts.partials.form_errors')
                                @if(Session::has('message'))
                                    <div class="alert alert-success"> {{Session::get('message')}}</div>
                                @endif

                            </header>
                            <form action="" class="add-product-form" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <fieldset class="form-fields">
                                    <label class="full-width">
                                        <span>First Name</span>

                                        <input type="text" id="p-first_name" name="first_name" value="{{$staff[0]['first_name']}}"  placeholder="Enter your first name">
                                    </label>
                                    <label class="full-width">
                                        <span>Last Name</span>
                                        <input type="text" id="p-last_name" name="last_name" value="{{$staff[0]['last_name']}}"  placeholder="Enter your last name">
                                    </label>

                                    <div class="full-width staff">
                                        <span>Select Staff Image</span>
                                        <div class="custom-input">
                                            <input type="file" name="user_image" value="{{$staff[0]['user_image']}}" id="file2">
                                            {{--<input type="text" name="user_image" value="{{$staff[0]['user_image']}}" id="file2">--}}
                                            <img src="{{ URL::asset($staff[0]['user_image'])}}" class="upload-image" alt="{{$staff[0]['user_image']}}" />
                                        </div>
                                    </div>

                                    <div class="full-width staff">
                                        <span>Upload Documents</span>
                                        <div class="custom-input">
                                        <input type="file" name="staff_documents[]" multiple id="file2" >
                                        {{--<a href="{{$hospital_staff_documents->document_path}}"></a>--}}



                                    {{--</label>--}}
                                    {{--<label>--}}
                                            <ul class="uploaded-files list-none">
                                        @foreach($staff[0]['documents'] as $document)
                                                <li>
                                                    <a target="_blank" href="{{url('/').$document['document_path']}}">View Document </a>
                                                    <a href="#dialogue{{$document['id']}}" class="btn-confirm"><i class="fa fa-trash"></i></a>
                                                </li>
                                                    <div id="dialogue{{$document['id']}}" class="dialogue">
                                                        <div class="dialogue-holder">
                                                            <div class="confirm-msg">
                                                                <div class="confirm-txt">
                                                                    <header class="header">
                                                                        <h2>Delete File</h2>
                                                                        <a href="" class="btn-close">x</a>
                                                                    </header>
                                                                    <div class="txt">
                                                                        <img  src="../../dashboard/images/img10.png" alt="Danger">
                                                                        <p>Are you sure you want to delete this file?</p>
                                                                        <div class="btns">
                                                                            <a href="" class="btn-primary cancel">Cancel</a>
                                                                            <a href="{{ URL::to('/admin/edit_staff') }}/document/{{$document['id']}}" class="btn-primary delete">Delete File</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                            </ul>
                                    </div>
                                    </div>

                                    <label class="full-width">


                                        <span>Email</span>
                                        <input type="text" id="p-email" name="email" value="{{$staff[0]['user']['email']}}"  placeholder="Enter your Email">
                                    </label>
                                    <div class="full-width">


                                        <span>User Type</span>

                                        <select>
                                            <option>First Responder</option>
                                            <option>Nurse</option>
                                        </select>
                                    </div>
                                    <div class="full-width">
                                    <label class="half-field btn-field">
                                        <input type="submit" value="Update" name="submit" class="btn-primary save">
                                    </label>
                                    <label class="half-field btn-field">
                                        <input type="button" value="Cancel" name="cancel" class="btn-primary save" onclick="window.location='{{url('/')}}/admindashboard/hospital/{{$staff[0]->hospital->id}}'">
                                    </label>
                                    </div>


                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>

        </main>


</div>
@endsection