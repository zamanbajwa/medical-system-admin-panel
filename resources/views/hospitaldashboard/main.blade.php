
@extends('layouts.masters.mainone')

<div id="wrapper">

    @section('content')

        <header id="header">
            <a href="" class="logo"><img src="" alt=""></a>
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
                    <span class="logout-opener">Syed Shah Hassan</span>
                    <ul class="logout-area list-none">
                        <li><a href="{{ URL::to('/hospitallogout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <main id="main">
            <aside id="sidebar">
                {{--<ul class="menu list-none">--}}

                    {{--<li class="store active"><a href="main.php">Store</a></li>--}}

                {{--</ul>--}}
            </aside>
            <div id="content">
                <header class="header">
                    <ul class="breadcrumbs list-none">
                        <li><a href="">Dashboard</a></li>
                        <li>Main Panel</li>
                    </ul>
                    <a href="#" class="btn-sidebar">&#9776</a>
                </header>


                <div class="content-area">
                    <div class="search-area">
                        <strong>Search</strong>
                        <div class="search-query">
                            <a href="add_staff" class="btn-primary align-right">Add New Staff</a>
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
                                <th>Sr No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <?php  $count = 1; ?>
                            @foreach($staff as $staff)
                            <tbody>

                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{$staff->first_name}}</td>
                                <td>{{$staff->last_name}}</td>
                                <td>{{$staff->user_type}}</td>

                                  <td>  <a href="{{ URL::to('admin/edit_staff') }}/{{$staff->id}}" class="btn-action edit">Edit</a>
                                   <a href="#dialogue{{$staff->id}}" class="btn-action delete btn-confirm">Delete</a> </td>


                            </tr>
                            <div id="dialogue{{$staff->id}}" class="dialogue">
                                <div class="dialogue-holder">
                                    <div class="confirm-msg">
                                        <div class="confirm-txt">
                                            <header class="header">
                                                <h2>Delete Product</h2>
                                                <a href="#" class="btn-close">x</a>
                                            </header>
                                            <div class="txt">
                                                <img src="../dashboard/images/img10.png" alt="Danger">
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

</div>


@endsection