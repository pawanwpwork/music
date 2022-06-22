<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Music | Dashboard</title>
    @include('backend/components/include/head')
    <!-- Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
    <!-- Icon -->
</head>

<body>
    <div id="wrapper">
        @include('backend/components/include/nav-side')

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                @include('backend/components/include/nav-top')
            </div>
           @yield('content')
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2015
                </div>
            </div>
        </div>

    </div>

    @include('backend/components/include/footer')
</body>

</html>