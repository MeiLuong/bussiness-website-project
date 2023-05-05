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

    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/lib-icons.css" type="text/css">


    <link rel="stylesheet" href="frontend/css/products/checkout.css" type="text/css">


    @yield('style')

</head>

<body>
    @include('frontend.layout.header_micro')

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

    @include('frontend.layout.footer_micro')

</body>
