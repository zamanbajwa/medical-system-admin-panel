<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ URL::asset('dashboard/css/flexslider.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i" rel="stylesheet">

    <link href="{{ URL::asset('dashboard/css/all.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('dashboard/css/chosen.css')}}">


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->

    <script src="{{URL::asset('dashboard/js/main.js')}}"></script>
    <script src="{{URL::asset('dashboard/js/circle-progress.js')}}"></script>

    
    <script src="{{URL::asset('dashboard/js/chosen.js')}}"></script>


                <!-- FlexSlider -->

    <script src="{{URL::asset('dashboard/js/jquery.flexslider.js')}}"></script>
    <script src="{{URL::asset('dashboard/js/custom.js')}}"></script>

    <script>
//        $(function() {
//            SyntaxHighlighter.all();
//        });

        //Table search
        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
</head>

<body>
@yield('content')

</body>

</html>