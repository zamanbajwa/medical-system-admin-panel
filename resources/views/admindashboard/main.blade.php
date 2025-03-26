@extends('layouts.masters.mainone')
<div id="wrapper">

    @section('content')
        <header id="header">
            <a href="" class="logo"><img src="{{ URL::asset('dashboard/images/login-logo.png')}}" alt="Linkmerge"></a>
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
                        {{--<a href="#" class="count-msg">2</a>--}}
                    {{--</div>--}}
                    @if (Auth::user()->user_type == 3)
                    <span class="logout-opener">LinkeMerg</span>
                    <div class="logout-area list-none">
                        <a href="{{ URL::to('/logout') }}">Logout</a>
                        @else
                            <span class="logout-opener">{{ Auth::user()->hospital->name }}</span>
                                <div class="logout-area list-none">
                                <a href="{{ URL::to('/logout') }}">Logout</a>

                                </div>
                    </div>
                    @endif
                </div>

            </div>
        </header>
        <main id="main">
            <a href="#" class="btn-sidebar">&#9776</a>
            <aside id="sidebar">
                <ul class="side-list">
             {{--@if($user->user_type==3)--}}

                    @if (Auth::user()->user_type == 3)
                        <li class="active"><a href=""> <i class="fa fa-user"></i>Hospitals</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @else

                        <li class="active"><a href=""> <i class="fa fa-user"></i> users</a> </li>
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @endif


                </ul>
            </aside>
            <div id="content">
                <header class="header">
                    <ul class="breadcrumbs list-none">
                        <li><a href="">Dashboard</a></li>
                        <li>Main Panel</li>
                    </ul>
                    
                </header>


                <div class="content-area">
                    <div class="search-area">
                        <div class="search-query">
                            <a href="{{ URL::to('add_hospital') }}" class="btn-primary align-right">Add New Hospital</a>
                            <div class=" search-panel">
                                <strong>Search</strong>
                                <form action="#">
                                    <fieldset>
                                        <input type="submit" id="submit" name="submit" value="submit">
                                        <input type="search" placeholder="" id="myInput" onkeyup="myFunction()">
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-holder">
                        <table id="myTable">
                            <thead>

                            <tr>
                                <th class="empty-th"></th>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Area</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  $count = 1; ?>
                            @foreach($hospitals as $hospital)
                            <tr>
                                <td class="empty-td"></td>
                                <td>{{ $count++ }}</td>
                                <td>  <a href="{{ URL::to('admindashboard/hospital')}}/{{$hospital->id}}">{{$hospital->name}}</a></td>
                                <td>{{$hospital->area}}</td>
                                @if($hospital->user->is_approved==1 )

                                   <td>
                                       <a href="{{ URL::to('/edit_hospital') }}/{{$hospital->id}}">
                                           <i class="fa fa-edit"></i>
                                       </a>

                                       <a href="#dialogue{{$hospital->user->id}}" class="btn-confirm">
                                           <i class="fa fa-trash"></i>
                                       </a>

                                       @else

                                    <td>
                                        <form method="post" action="{{url('/')}}/admindashboard/hospital/{{$hospital->id}}">{{csrf_field()}}<button><i class="fa fa-check"></i></button></form>
                                       {{--<a href="{{url('/')}}/admindashboard/hospital/{{$hospital->id}}"><i class="fa fa-check"></i> </a>--}}
                                       {{--<a href="{{ URL::to('admindashboard')}}"> <i class="fa fa-close"></i></a>--}}
                                         <form method="post" action="{{url('/')}}/admindashboard/hospitalreject/{{$hospital->user->id}}"> {{csrf_field()}} <button><i class="fa fa-close"></i></button> </form>
                                        </td>

                            </tr>
                            @endif

                            <div id="dialogue{{$hospital->user->id}}" class="dialogue">
                                <div class="dialogue-holder">
                                    <div class="confirm-msg">
                                        <div class="confirm-txt">
                                            <header class="header">
                                                <a href="" class="btn-close">x</a>
                                            </header>
                                            <div class="txt">
                                                <img src="dashboard/images/img10.png" alt="Danger">
                                                <p>Are you sure you want to delete this Information?</p>
                                                <div class="btns">
                                                    <a href="" class="btn-primary cancel">Cancel</a>

                                                    <a href="{{ URL::to('admindashboard') }}/{{$hospital->user->id}}" class="btn-primary delete">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
</div>
@endsection
