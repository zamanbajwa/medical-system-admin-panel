@extends('layouts.masters.mainone')
<div id="wrapper">
    @section('content')
        <header id="header">
            <a href="" class="logo"><img src="{{ URL::asset('dashboard/images/login-logo.png')}}" alt="Linkmerge" class="login-logo" ></a>
            <div class="client-area">

                <div class="user-info">

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
            <a href="#" class="btn-sidebar">&#9776;</a>
            <aside id="sidebar">

                <ul class="side-list">
                    @if (Auth::user()->user_type == 3)
                        <li><a href="{{ URL::to('/admindashboard') }}"> <i class="fa fa-user"></i>Hospitals</a> </li>
                        <li class="active"><a href="{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}"> <i class="fa fa-user"></i>Users</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>

                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @else

                        <li class="active"><a href="{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}"> <i class="fa fa-user"></i>Users</a> </li>
                        <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                        <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                    @endif
                </ul>
            </aside>
            <div id="content">
                <header class="header border">
                    <a href="{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}" class="align-right">Go Back</a>
                    <ul class="breadcrumbs list-none">
                        <li><a href="{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}">Dashboard</a></li>
                        <li>Enter Staff Details</li>

                    </ul>
                </header>
                <div class="content-area p-details">
                    <div class="slider-cols add">

                    </div>

                    <div class="col">
                        <header class="heading-txt add">
                            @if(Session::has('message'))
                                <div class="alert alert-success"> {{Session::get('message')}}</div>
                            @endif
                            @include('layouts.partials.form_errors')

                        </header>

                        <form action="{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}/add_staff" class="add-product-form" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <fieldset class="form-fields">
                                <div class="row">
                                    <span>First Name</span>
                                    <input type="text" id="p-first_name"  name="first_name" value="{{ old('first_name') }}" placeholder="Enter your first name">
                                </div>
                                <div class="row">
                                    <span>Last Name</span>
                                    <input type="text" id="p-last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name">
                                </div>
                                <div class="row">
                                    <span>Select Staff Image</span>
                                    <input type="file" name="user_image" value="{{ old('user_image') }}" id="file1">
                                </div>

                                <div class="row">
                                    <span>Upload Documents</span>
                                    <input type="file" name="staff_documents[]" value="{{ old('document_path') }}" multiple id="file2">
                                </div>

                                <div class="row">
                                    <span>Email</span>
                                    <input type="text" id="p-email" name="email" value="{{ old('email') }}" placeholder="Enter your Email">
                                </div>

                                <div class="row">
                                    <span>Password</span>
                                    <input type="password" id="p-password" name="password"  placeholder="Enter your Password">
                                </div>


                                <div class="full-width">
                                    <span>User Type</span>
                                    <select name="user_type" id="staff">
                                        <option value="">Select Type...</option>
                                        <option value="1">First Responder</option>
                                        <option value="2">Nurse</option>
                                    </select>
                                </div>
                                
                                <div class="fist_reponder">
                                    <div class="full-width">
                                        <span>About</span>
                                        <textarea name="about" placeholder="Enter Detail...">{{ old('about') }}</textarea>
                                    </div>
                                    <div class="full-width">
                                        <span>Address</span>
                                        <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Enter address...">
                                    </div>
                                    <div class="full-width">
                                        <span>Business Hours</span>
                                        <select name="business_days_from">
                                            <option value="">Select Day...</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thrusday">Thrusday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                    <strong>To</strong>
                                    <div class="full-width">
                                        <select name="business_days_to">
                                            <option value="">Select Day...</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thrusday">Thrusday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="full-width">
                                        <span>Business Hours</span>
                                        <select name="business_hours_from" >
                                            <option value="12:00AM">12:00AM</option>
                                            <option value="12:30AM">12:30AM</option>
                                            <option value="1:00AM">1:00AM</option>
                                            <option value="1:30AM">1:30AM</option>
                                            <option value="2:00AM">2:00AM</option>
                                            <option value="2:30AM">2:30AM</option>
                                            <option value="3:00AM">3:00AM</option>
                                            <option value="3:30AM">3:30AM</option>
                                            <option value="4:00AM">4:00AM</option>
                                            <option value="4:30AM">4:30AM</option>
                                            <option value="5:00AM">5:00AM</option>
                                            <option value="5:30AM">5:30AM</option>
                                            <option value="6:00AM">6:00AM</option>
                                            <option value="6:30AM">6:30AM</option>
                                            <option value="7:00AM">7:00AM</option>
                                            <option value="7:30AM">7:30AM</option>
                                            <option value="8:00AM">8:00AM</option>
                                            <option value="8:30AM">8:30AM</option>
                                            <option value="9:00AM">9:00AM</option>
                                            <option value="9:30AM">9:30AM</option>
                                            <option value="10:00AM">10:00AM</option>
                                            <option value="10:30AM">10:30AM</option>
                                            <option value="11:00AM">11:00AM</option>
                                            <option value="11:30AM">11:30AM</option>
                                            <option value="12:00PM">12:00PM</option>
                                            <option value="12:30PM">12:30PM</option>
                                            <option value="1:00PM">1:00PM</option>
                                            <option value="1:30PM">1:30PM</option>
                                            <option value="2:00PM">2:00PM</option>
                                            <option value="2:30PM">2:30PM</option>
                                            <option value="3:00PM">3:00PM</option>
                                            <option value="3:30PM">3:30PM</option>
                                            <option value="4:00PM">4:00PM</option>
                                            <option value="4:30PM">4:30PM</option>
                                            <option value="5:00PM">5:00PM</option>
                                            <option value="5:30PM">5:30PM</option>
                                            <option value="6:00PM">6:00PM</option>
                                            <option value="6:30PM">6:30PM</option>
                                            <option value="7:00PM">7:00PM</option>
                                            <option value="7:30PM">7:30PM</option>
                                            <option value="8:00PM">8:00PM</option>
                                            <option value="8:30PM">8:30PM</option>
                                            <option value="9:00PM">9:00PM</option>
                                            <option value="9:30PM">9:30PM</option>
                                            <option value="10:00PM">10:00PM</option>
                                            <option value="10:30PM">10:30PM</option>
                                            <option value="11:00PM">11:00PM</option>
                                            <option value="11:30PM">11:30PM</option>
                                        </select>
                                    </div>
                                    <strong>To</strong>
                                    <div class="full-width">
                                        <select name="business_hours_to" >
                                            <option value="12:00AM">12:00AM</option>
                                            <option value="12:30AM">12:30AM</option>
                                            <option value="1:00AM">1:00AM</option>
                                            <option value="1:30AM">1:30AM</option>
                                            <option value="2:00AM">2:00AM</option>
                                            <option value="2:30AM">2:30AM</option>
                                            <option value="3:00AM">3:00AM</option>
                                            <option value="3:30AM">3:30AM</option>
                                            <option value="4:00AM">4:00AM</option>
                                            <option value="4:30AM">4:30AM</option>
                                            <option value="5:00AM">5:00AM</option>
                                            <option value="5:30AM">5:30AM</option>
                                            <option value="6:00AM">6:00AM</option>
                                            <option value="6:30AM">6:30AM</option>
                                            <option value="7:00AM">7:00AM</option>
                                            <option value="7:30AM">7:30AM</option>
                                            <option value="8:00AM">8:00AM</option>
                                            <option value="8:30AM">8:30AM</option>
                                            <option value="9:00AM">9:00AM</option>
                                            <option value="9:30AM">9:30AM</option>
                                            <option value="10:00AM">10:00AM</option>
                                            <option value="10:30AM">10:30AM</option>
                                            <option value="11:00AM">11:00AM</option>
                                            <option value="11:30AM">11:30AM</option>
                                            <option value="12:00PM">12:00PM</option>
                                            <option value="12:30PM">12:30PM</option>
                                            <option value="1:00PM">1:00PM</option>
                                            <option value="1:30PM">1:30PM</option>
                                            <option value="2:00PM">2:00PM</option>
                                            <option value="2:30PM">2:30PM</option>
                                            <option value="3:00PM">3:00PM</option>
                                            <option value="3:30PM">3:30PM</option>
                                            <option value="4:00PM">4:00PM</option>
                                            <option value="4:30PM">4:30PM</option>
                                            <option value="5:00PM">5:00PM</option>
                                            <option value="5:30PM">5:30PM</option>
                                            <option value="6:00PM">6:00PM</option>
                                            <option value="6:30PM">6:30PM</option>
                                            <option value="7:00PM">7:00PM</option>
                                            <option value="7:30PM">7:30PM</option>
                                            <option value="8:00PM">8:00PM</option>
                                            <option value="8:30PM">8:30PM</option>
                                            <option value="9:00PM">9:00PM</option>
                                            <option value="9:30PM">9:30PM</option>
                                            <option value="10:00PM">10:00PM</option>
                                            <option value="10:30PM">10:30PM</option>
                                            <option value="11:00PM">11:00PM</option>
                                            <option value="11:30PM">11:30PM</option>
                                        </select>
                                    </div>
                                    <div class="full-width">
                                        <span>Phone Number</span>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number...">
                                    </div>
                                    <div class="full-width">
                                        <span>Certificates</span>
                                        <select data-placeholder="Choose a Country..." class="chosen-select" multiple name="certifications">
                                            <option value=""></option>
                                            <option value="United States">United States</option>
                                            <option value="United States">United States</option>
                                            <option value="United States">United States</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <label class="half-field btn-field">
                                        <input type="submit" value="Save" name="submit" class="btn-primary save">
                                    </label>
                                    <label class="half-field btn-field">
                                        <input type="button" value="Cancel" name="cancel" class="btn-primary save" onclick="window.location='{{ URL::to('admindashboard/hospital') }}/{{$hospital->id}}'">
                                    </label>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    
    $(document).ready(function(){
        $('.chosen-select').chosen();
        
        $('.fist_reponder').hide();
        $( "#staff" ).change(function () {
            
            $( "#staff option:selected" ).each(function() {
                var type = $( this ).val();
                console.log($( this ).val());
                if(type == 1){
                    console.log('responder');
                    $('.fist_reponder').show(300);
                }
                else{
                    $('.fist_reponder').hide(300);
                }
            });
        });
        
    });
    

</script>