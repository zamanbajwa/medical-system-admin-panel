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
                    <span class="logout-opener">LinkeMerg</span>
                    <ul class="logout-area list-none">
                        <li><a href="{{ URL::to('admin/login') }}">Logout</a></li>

                    </ul>
                </div>
            </div>
        </header>
        <main id="main">
            <a href="#" class="btn-sidebar">&#9776;</a>
            <aside id="sidebar">
                {{--<ul class="menu list-none">--}}
                    <ul class="side-list">

                        @if (Auth::user()->user_type == 3)
                            <li class="active"><a href="{{ URL::to('/admindashboard') }}"> <i class="fa fa-user"></i>Hospitals</a> </li>
                            <li class=""><a href="{{ URL::to('change-password')}}"> <i class="fa fa-user"></i>Change Password</a> </li>
                            <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                        @else

                            <li class="active"><a href=""> <i class="fa fa-user"></i>User</a> </li>
                            <li><a href="{{ URL::to('/admin/login') }}"><i class="fa fa-power-off"></i> Logout</a> </li>
                        @endif
                    </ul>
                {{--</ul>--}}
            </aside>
            <div id="content">
                <header class="header border">
                    <a href="{{ URL::to('admindashboard') }}" class="align-right">Go Back</a>
                    <ul class="breadcrumbs list-none">
                        <li><a href="{{ URL::to('/admindashboard') }}">Dashboard</a></li>
                        <li>Edit Hospital Details</li>

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

                            <form action="{{ URL::to('/edit_hospital') }}/{{$hospitals->id}}" class="add-product-form" method="POST">
                                {{csrf_field()}}

                                <fieldset class="form-fields">
                                    <label class="half-field">
                                        <span>Name</span>
                                        <input type="text" name="name" value="{{$hospitals->name}}" id="p-name" placeholder="Enter Hospital Name" >
                                    </label>
                                    <label class="half-field">
                                        <span>Area</span>
                                        <input type="text" id="autocomplete" name="area" value="{{$hospitals->area}}" placeholder="Enter Hospital area" onfocusout="geolocate()">
                                    </label>
                                    <label class="half-field">
                                        <span>Email</span>
                                        <input type="text" id="p-email" name="email" value="{{$users->email}}" placeholder="Enter Email here">
                                    </label>
                                    <label class="half-field">
                                        <span>Password</span>
                                        <input type="password" id="p-password" name="password"  value="" placeholder="Enter New Password">
                                    </label>
                                    <label class="half-field">
                                        <span>Latitude</span>
                                        <input type="text" id="lat" name="lat" value="{{$hospitals->lat}}" placeholder="Your latitude">
                                    </label>
                                    <label class="half-field">
                                        <span>Longitude</span>
                                        <input type="text" id="lng" name="lng" value="{{$hospitals->lng}}" placeholder="Your longitude">
                                    </label>

                                    <label class="half-field btn-field">
                                        <input type="submit" value="Update" name="submit" class="btn-primary save">
                                    </label>
                                    <label class="half-field btn-field">
                                        <input type="button" value="Cancel" name="cancel" class="btn-primary save" onclick="window.location='{{ URL::to('/admindashboard') }}'">
                                    </label>

                                </fieldset>

                            </form>
                        </div>
                    </div>
                </div>

        </main>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            {{--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>--}}



            <script>
                // This example displays an address form, using the autocomplete feature
                // of the Google Places API to help users fill in the information.

                // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


                // const LAT="";
                // const LNG="";
                var placeSearch, autocomplete;
                var componentForm = {
                    street_number: 'short_name',
                    route: 'long_name',
                    locality: 'long_name',
                    administrative_area_level_1: 'short_name',
                    country: 'long_name',
                    postal_code: 'short_name'
                };

                function initAutocomplete() {
                    // Create the autocomplete object, restricting the search to geographical
                    // location types.
                    autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                        {types: ['geocode']});

                    // When the user selects an address from the dropdown, populate the address
                    // fields in the form.
                    autocomplete.addListener('place_changed', fillInAddress);
                }

                function fillInAddress() {
                    // Get the place details from the autocomplete object.
                    var place = autocomplete.getPlace();

                    lat= place.geometry.location.lat();
                    lng=  place.geometry.location.lng();

                    $('#lng').val(lng);
                    $('#lat').val(lat);

                    for (var component in componentForm) {
                        document.getElementById(component).value = '';
                        document.getElementById(component).disabled = false;
                    }

                    // Get each component of the address from the place details
                    // and fill the corresponding field on the form.
                    for (var i = 0; i < place.address_components.length; i++) {
                        var addressType = place.address_components[i].types[0];
                        if (componentForm[addressType]) {
                            var val = place.address_components[i][componentForm[addressType]];
                            document.getElementById(addressType).value = val;
                        }
                    }
                }

                // Bias the autocomplete object to the user's geographical location,
                // as supplied by the browser's 'navigator.geolocation' object.
                function geolocate() {

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var geolocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude

                            }




                            var circle = new google.maps.Circle({
                                center: geolocation,
                                radius: position.coords.accuracy,

                            });
                            autocomplete.setBounds(circle.getBounds());

                        });
                    }
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd6BzQsclBDvRdG0EHE6O3Ta4U4SfglUo&libraries=places&callback=initAutocomplete"async defer></script>


            {{--</div>--}}
        </div>
    </div>
@endsection