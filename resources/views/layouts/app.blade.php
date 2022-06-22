<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php $siteSetting = siteSetting(); @endphp
    <title>{{ (isset($siteSetting->title) ? ($siteSetting->title) : 'All Music All Artist') }}</title>

    @include('include/functions-css')

    @yield('head-css')
    <!-- Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.png')}}" />
    <!-- Icon -->
    <style type="text/css">
.pagination .active a {
     color: #FFF;
     background-color: transparent;
     font-weight: 600;
}
 .pagination .active a:hover {
     background-color: transparent;
     color: #FFF;
     border: 0px;
}
 .pagination .active a:focus {
     background-color: transparent;
     color: #FFF;
     outline: none;
}
 .pagination li a {
     border: 1px;
     margin-left: 0px;
     color: #707070;
     padding: 7px 2px;
     margin: 0px 20px;
}
 .pagination li a:hover {
     background-color: transparent;
     color: #4a90e2;
     padding-bottom: 2px;
     border-bottom: 1px solid;
}
 .pagination li a:focus {
     outline: none;
     background-color: transparent;
    /*color:#707070;
    */
}
 .pagination li:first-child a, .pagination li:last-child a {
     border: 2px solid #FFF !important;
     border-radius: 6px;
     margin: 0px;
     padding: 6px 12px;
     border: 2px solid;
     font-size: 14px;
     color: #FFF;
}
 .pagination li:first-child a:hover, .pagination li:last-child a:hover {
     text-decoration: none !important;
     color: #fff;
     background-color: #FFF;
}
 .pagination li:first-child a:focus, .pagination li:last-child a:focus {
     outline: none;
}
 
    </style>
    
</head>

<body class="homepage">

    @include('include/header')

    @yield('content')

    @include('include/footer')

    <!-- background-slider -->
    @include('include/background-slider')
    <!-- JavaScript plugins -->
    @include('include/functions-js')

    @yield('footer-js')

    @yield('scripts')

    <script type="text/javascript">
        $(".terms-checkbox .input-checkbox").removeClass('form-control');

        $(".music-terms-and-conditions-link").on('click',function(){
            var data_toggle = $(this).attr('data-toggle');
            $("."+data_toggle).toggleClass('open-terms');
        });
    </script>
</body>

</html>