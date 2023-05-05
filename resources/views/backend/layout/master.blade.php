<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="{{ asset('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/favicon-fp.png">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>

    {{--    favicon image--}}
    <link rel="icon" href="{{ url('assets/favicon/favicon-fp.png') }}">

    <link rel="stylesheet" href="frontend/css/lib-icons.css" type="text/css">

    <link rel="stylesheet" href="backend/css/simplebar.css">
    <!-- Main styles for this application-->
    <link href="backend/css/style.css" rel="stylesheet">
    <link href="backend/css/admin.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="backend/css/examples.css" rel="stylesheet">
    <link href="backend/css/coreui-chartjs.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    @yield('script')
</head>

<body>



@auth
    @include('backend.layout.components.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('backend.layout.components.header')
        <div class="page-title">
            <h3 class="title">@yield('title')</h3>
        </div>
        <div class="body body-admin flex-grow-1 px-3">
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

            <div class="container-lg">
                @yield('body')
            </div>
        </div>

        @include('backend.layout.components.footer')

    </div>
@endauth




<!-- Js Plugins -->
<!-- CoreUI and necessary plugins-->
<script src="backend/js/coreui.bundle.min.js"></script>
<script src="backend/js/simplebar.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="backend/js/chart.min.js"></script>
<script src="backend/js/coreui-chartjs.js"></script>
<script src="backend/js/coreui-utils.js"></script>
<script src="backend/js/main.js"></script>
<script src="backend/assets/CKEditor/ckeditor4.20.2/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>


</body>

</html>
