
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

                    <li><a href="{{ URL::to('/admindashboard') }}"> <i class="fa fa-user"></i>Hospitals</a> </li>
                        <li class="active"><a href=""> <i class="fa fa-user"></i>Users</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                    <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @else

                    <li class="active"><a href=""> <i class="fa fa-user"></i>Users</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                    <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                        @endif
                </ul>
            </aside>
            <div id="content">
                <header class="header">
                    <ul class="breadcrumbs list-none">
                        {{--<li><a href="">Dashboard</a></li>--}}
                        <li>Hospital</li>
                    </ul>
                </header>

                @if($user->is_approved == 1)



                <div class="content-area">
                    <div class="search-area search-query">

                        <a href="{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}/add_staff" class="btn-primary align-right">Add New Staff</a>
                        <div class=" search-panel">
                            <strong>Search</strong>
                            <form action="#">
                                <fieldset>
                                    <input type="submit" value="submit">
                                    <input type="search" placeholder="" id="myInput" onkeyup="myFunction()">
                                </fieldset>

                            </form>
                        </div>
                    </div>

                    <div class="table-holder">
                        <table id="myTable">
                            <thead>
                            <tr>
                                <th class="empty-th"></th>
                                <th>Sr No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                {{--<th>User Name</th>--}}
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <?php  $count = 1; ?>

                            @foreach($staff as $staff)

                                <tbody>

                                <tr>
                                    <td class="empty-td"></td>
                                    <td>{{ $count++ }}</td>
                                    <td>{{$staff->first_name}}</td>
                                    <td>{{$staff->last_name}}</td>
                                    {{--<td>{{$staff->user_name}}</td>--}}
                                    @if($staff->user_type==1)>
                                    <td>{{$staff->user_type="First Responder"}}</td>
                                        @else  @if($staff->user_type==2)
                                        <td>{{$staff->user_type="Nurse"}}</td>
                                        @endif
                                @endif


                          {{--@if($staff->is_approved==1)--}}

                                    <td>
                                        <a href="{{ URL::to('admin/edit_staff') }}/{{$staff->id}}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="#dialogue{{$staff->user->id}}" class="btn-confirm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        {{--<a href="{{ URL::to('admin/edit_staff') }}/{{$staff->id}}" class="btn-action edit">Edit</a>
                                        <a href="#dialogue{{$staff->user->id}}" class="btn-action delete btn-confirm">Delete</a>--}}
                                    </td>
                                  {{--@else--}}
                                    {{--<td>--}}
                                        {{--<a href="" >tick</a>--}}
                                        {{--<a href="">cross</a>--}}

                                    {{--</td>--}}

                                </tr>
                                {{--@endif--}}
                                <div id="dialogue{{$staff->user->id}}" class="dialogue">
                                    <div class="dialogue-holder">
                                        <div class="confirm-msg">
                                            <div class="confirm-txt">
                                                <header class="header">
                                                    <a href="#" class="btn-close">x</a>
                                                </header>
                                                <div class="txt">
                                                    <img src="../../dashboard/images/img10.png" alt="Danger">
                                                    <p>Are you sure you want to delete this Information?</p>
                                                    <div class="btns">
                                                        <a href="" class="btn-primary cancel">Cancel</a>
                                                        <a href="{{ URL::to('/admin/HospitalDashboard') }}/{{$staff->id}}" class="btn-primary delete">Delete</a>

                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
@endif
</div>

@endsection