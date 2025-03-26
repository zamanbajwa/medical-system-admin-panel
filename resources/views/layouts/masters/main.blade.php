<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linkmerge</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700,700i" rel="stylesheet">

    <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>

    <link href="{{ URL::asset('dashboard/css/all.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/css/font-awesome.min.css')}}" rel="stylesheet">


    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

    {{--<script src="../admin/js/index.js"></script>--}}
    <script src="{{URL::asset('admin/js/index.js')}}"></script>

</head>
<body>

@yield('content')
</body>
</html>
