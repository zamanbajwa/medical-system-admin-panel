<head>
    <title>Hospital</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo asset('hospital/css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?php echo asset('hospital/css/nice-select.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo asset('hospital/css/style.css')?>">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.5.1/socket.io.min.js"></script> 
    <script>

        var socket = io('<?php echo env('SOCKETS'); ?>');
        //   var socket = io('http://localhost:3000');
    </script>

</head>
