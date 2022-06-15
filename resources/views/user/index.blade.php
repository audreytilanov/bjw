<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJW</title>
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('user/assets/Logo BJW 2022/FIX BJW 2K22-01.png') }}">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script src="https://use.fontawesome.com/cc559646f0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <link rel="stylesheet" href="/VenoBox-master/dist/venobox.min.css" type="text/css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Web Fonts  -->

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.0/venobox.min.css">
    
</head>
<body>
    <div id="loading">
        <img id="loading-image" src="{{ URL::asset('user/assets/load.gif') }}" alt="Loading..." />
    </div>
    <div class="test">
        <a id="navbar" href="javaScript:void(0)">START</a>
    </div>
    <div class="box">
        <div class="menu">
            <a href="{{ route('user.about') }}">About</a>
            <a href="">Event</a>
            <div class="comp-container">
                <a class="comp" href="">
                    Competition
                </a>
                <div class="comp-hover">
                    <a href="{{ route('user.feature') }}">Features</a>
                    <a href="{{ route('user.newsanchor') }}">News Anchor</a>
                    <a href="{{ route('user.video') }}">Video</a>
                    <a href="{{ route('user.mininews') }}">Mini News Paper</a>
                </div>
            </div>
            <a href="">Sponsorship</a>
        </div>
        
    </div>
    <div id="main">
        
        <div data-depth="0.2">
            <img src="{{ URL::asset('user/assets/Logo BJW 2022/FIX BJW 2K22-01.png') }}" alt="">
        </div>
        
    </div>
</body>
<script>
    $(window).on('load', function () {
      $('#loading').hide();
    }) 
</script>
<script>
    $(document).ready( function(){
        $("#navbar").click(function () {
            $(".box").toggleClass('largeWidth');
        });
    });
    var scene = document.getElementById('main');
    var parallaxInstance = new Parallax(scene);
    </script>
</html>