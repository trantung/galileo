<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = Date('H');
$day = true;
if( $now > 17 | $now < 6 ) $day = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <title>{{ $code or '404' }} Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      

        <script type="text/javascript" src="{{ asset('/errors/js/jquery-1.8.3.min.js') }}"></script>

        <link href='http://fonts.googleapis.com/css?family=Finger+Paint' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('/errors/css/animate.min.css') }}">
        <script src="{{ asset('/errors/js/preloader.js') }}"></script> 
        <link rel="stylesheet" href="{{ asset('/errors/css/style.css') }}">

        <script type="text/javascript" src="{{ asset('/errors/js/css_browser_selector.js') }}"></script>
         <script type="text/javascript" src="{{ asset('/errors/js/plax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/errors/js/jquery.spritely-0.6.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/errors/js/script.js') }}"></script>
    </head>
    <body class="{{ ($day) ? 'day' : 'night' }}">
        <div id="indicator"></div>
      
        <div class="wrapper">
            <div class="grass  init"></div>
            @if ($day)
            <div class="clouds init"> </div>
           
            <div class="sun init"></div>
            <div class="owl init">
                 <div class="eyes"></div>
               
                <img src="{{ asset('/errors/images/noface.png') }}" />
                 <div class="balloon init">
                <div class="text">
                    <h2>Tin xấu!!</h2>
                    <h3>
                        {{ $message }}
                    </h3>
                    <h4>LỖI {{ $code or 'unknow' }}</h4>
                </div>
            </div>
            </div>

            @else
                <div class="stars init"> </div>
               
                <div class="moon init"></div>
                <div class="owl init">
                    <img src="{{ asset('/errors/images/owl_night.png') }}" />
                     <div class="balloon init">
                    <div class="text">
                        <h2>Tin xấu!!</h2>
                        <h3>Trang không tìm thấy!</h3>
                        <h4>LỖI {{ $code or '404' }}</h4>
                    </div>
                </div>
                </div>
            @endif
        
        </div>
    </body>
</html>
