<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="{{ asset('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileImage" content="assets/favicon/favicon-fp.png">
    <title>@yield('title')</title>

{{--    favicon image--}}
    <link rel="icon" href="{{ url('assets/favicon/favicon-fp.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="frontend/css/web/_web.css" type="text/css">
{{--    <link rel="stylesheet" href="frontend/css/pages/login_register.css" type="text/css">--}}

{{--    <link rel="stylesheet" href="frontend/css/website.css" type="text/css">--}}
    <link rel="stylesheet" href="frontend/css/pages/home.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/pages/vendor.css" type="text/css">

    <link rel="stylesheet" href="frontend/css/lib-icons.css" type="text/css">

{{--    <link rel="stylesheet" href="frontend/css/app.css" type="text/css">--}}
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" >

    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

{{--    <link rel="stylesheet" href="frontend/css/font-awesome.min.css" type="text/css">--}}
{{--    <link rel="stylesheet" href="frontend/css/themify-icons.css" type="text/css">--}}
{{--    <link rel="stylesheet" href="frontend/css/elegant-icons.css" type="text/css">--}}
{{--    <link rel="stylesheet" href="frontend/css/owl.carousel.min.css" type="text/css">--}}
{{--    <link rel="stylesheet" href="frontend/css/nice-select.css" type="text/css">--}}
    <link rel="stylesheet" href="frontend/css/jquery-ui.min.css" type="text/css">
{{--    <link rel="stylesheet" href="frontend/css/slicknav.min.css" type="text/css">--}}
{{--    <link rel="stylesheet" href="frontend/css/style.css" type="text/css">--}}
{{--    <link rel="stylesheet" href="frontend/css/products/listing_page.css" type="text/css">--}}

    @yield('style')
</head>

<body class="">


    @include('frontend.layout.block.search.search')


    @include('frontend.layout.header')

    <div class="container">
        <div class="breadcrumbs">
            @yield('breadcrumbs')
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('body')

    @include('frontend.layout.footer')



<!-- Js Plugins -->

<script src="frontend/js/website.js"></script>
{{--<script src="frontend/js/script.js"></script>--}}
<script src="frontend/js/app.js"></script>
<script src="frontend/js/jquery-3.3.1.min.js"></script>
<script src="frontend/js/bootstrap.min.js"></script>
<script src="frontend/js/jquery-ui.min.js"></script>
<script src="frontend/js/jquery.countdown.min.js"></script>
<script src="frontend/js/jquery.nice-select.min.js"></script>
<script src="frontend/js/jquery.zoom.min.js"></script>
<script src="frontend/js/jquery.dd.min.js"></script>
<script src="frontend/js/jquery.slicknav.js"></script>
<script src="frontend/js/owl.carousel.min.js"></script>
<script src="frontend/js/main.js"></script>
<script src="frontend/js/web/focus.js"></script>
    <script src="frontend/js/web/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="frontend/js/web/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="frontend/js/web/plugins.js"></script>
    <script type="text/javascript" src="frontend/js/web/script.js"></script>

@yield('scripts')

<script>

</script>

</body>

</html>
