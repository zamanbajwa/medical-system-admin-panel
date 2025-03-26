
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd6BzQsclBDvRdG0EHE6O3Ta4U4SfglUo&libraries=places&callback=initAutocomplete"
        async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>



{{--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>--}}
@extends('layouts.masters.main')

@section('content')
<div class="login-form-area">
<div class="login-form-holder">
    <div class="login">

        <div class="login-header">

            <h4>Hospital Register Form</h4>
        </div>

        <form class="login-form" action="{{ URL::to('hospital/register/form') }}" method="POST">
            {{csrf_field()}}
            @include('layouts.partials.form_errors')
            @if(Session::has('message'))
                <ul class="list-none error-list">
                    <li>{{Session::get('message')}}</li>
                </ul>
            @endif
                <div class="register-area">
                <h3>Name:</h3>
                <input type="text"   name="name" value="{{ old('name') }}" placeholder="Name"/>
                <h3>Area:</h3>
                <input type="text" name="area" id="autocomplete" value="{{ old('area') }}" placeholder="Area" onfocus="geolocate()"/>
                <h3>Email:</h3>
                <input type="text"   name="email" value="{{ old('email') }}" placeholder="Email"/>
                <h3>Password:</h3>
                <input type="password" name="password" placeholder="Password"/>
                <h3></h3>
                <input type="hidden" id="lat" name="lat"  placeholder="Your latitude">

                <h3></h3>
                <input type="hidden" id="lng" name="lng"  placeholder="Your longitude">

                <input type="submit" name="register" value="Register" class="login-button"/>
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

{{--<script>--}}
    {{--// This example displays an address form, using the autocomplete feature--}}
    {{--// of the Google Places API to help users fill in the information.--}}

    {{--// This example requires the Places library. Include the libraries=places--}}
    {{--// parameter when you first load the API. For example:--}}
    {{--// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">--}}
    {{--var placeSearch, autocomplete;--}}
    {{--var componentForm = {--}}
        {{--street_number: 'short_name',--}}
        {{--route: 'long_name',--}}
        {{--locality: 'long_name',--}}
        {{--administrative_area_level_1: 'short_name',--}}
        {{--country: 'long_name',--}}
        {{--postal_code: 'short_name'--}}
    {{--};--}}

    {{--function initAutocomplete() {--}}
        {{--// Create the autocomplete object, restricting the search to geographical--}}
        {{--// location types.--}}
        {{--autocomplete = new google.maps.places.Autocomplete(--}}
{{--//            @type {!HTMLInputElement}--}}
            {{--(document.getElementById('autocomplete')),--}}
            {{--{types: ['geocode']});--}}

        {{--// When the user selects an address from the dropdown, populate the address--}}
        {{--// fields in the form.--}}
        {{--autocomplete.addListener('place_changed', fillInAddress);--}}
    {{--}--}}

    {{--function fillInAddress() {--}}
        {{--// Get the place details from the autocomplete object.--}}
        {{--var place = autocomplete.getPlace();--}}

        {{--lat= place.geometry.location.lat();--}}
        {{--lng=  place.geometry.location.lng();--}}

        {{--$('#lng').val(lng);--}}
        {{--$('#lat').val(lat);--}}

        {{--for (var component in componentForm) {--}}
            {{--document.getElementById(component).value = '';--}}
            {{--document.getElementById(component).disabled = false;--}}
        {{--}--}}

        {{--// Get each component of the address from the place details--}}
        {{--// and fill the corresponding field on the form.--}}
        {{--for (var i = 0; i < place.address_components.length; i++) {--}}
            {{--var addressType = place.address_components[i].types[0];--}}
            {{--if (componentForm[addressType]) {--}}
                {{--var val = place.address_components[i][componentForm[addressType]];--}}
                {{--document.getElementById(addressType).value = val;--}}
            {{--}--}}
        {{--}--}}
    {{--}--}}

    {{--// Bias the autocomplete object to the user's geographical location,--}}
    {{--// as supplied by the browser's 'navigator.geolocation' object.--}}
    {{--function geolocate() {--}}

        {{--if (navigator.geolocation) {--}}
            {{--navigator.geolocation.getCurrentPosition(function(position) {--}}
                {{--var geolocation = {--}}
                    {{--lat: position.coords.latitude,--}}
                    {{--lng: position.coords.longitude--}}

                {{--}--}}


                {{--var circle = new google.maps.Circle({--}}
                    {{--center: geolocation,--}}
                    {{--radius: position.coords.accuracy--}}

                {{--});--}}
                {{--autocomplete.setBounds(circle.getBounds());--}}

            {{--});--}}
        {{--}--}}
    {{--}--}}
{{--</script>--}}

<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
//    jQuery(document).ready(function () {
//        initialize(); });

    var placeSearch, autocomplete;
//    var componentForm = {
//        street_number: 'short_name',
//        route: 'long_name',
//        locality: 'long_name',
//        administrative_area_level_1: 'short_name',
//        country: 'long_name',
//        postal_code: 'short_name'
//    };

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
//            document.getElementById(component).value = '';
//            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
//        for (var i = 0; i < place.address_components.length; i++) {
//            var addressType = place.address_components[i].types[0];
//            console.log(addressType)
//            if (componentForm[addressType]) {
//                var val = place.address_components[i][componentForm[addressType]];
//                document.getElementById(addressType).value = val;
//            }
//        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
