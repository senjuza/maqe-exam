<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Chaipat Mangmeenam">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>ส่งแบบทดสอบ</title>
    <link rel="apple-touch-icon" sizes="57x57" href="https://maqe.github.io/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://maqe.github.io/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://maqe.github.io/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://maqe.github.io/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://maqe.github.io/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://maqe.github.io/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://maqe.github.io/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://maqe.github.io/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://maqe.github.io/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="https://maqe.github.io/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="https://maqe.github.io/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="https://maqe.github.io/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="https://maqe.github.io/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="https://maqe.github.io/favicon-16x16.png" sizes="16x16">
    <link rel="mask-icon" href="https://maqe.github.io/safari-pinned-tab.svg" color="#3a4454">

    {{--<!-- Bootstrap core CSS -->--}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/ex/sweetalert2/sweetalert2.css') }}" rel="stylesheet">


    <![endif]-->
    @stack('scripts-top')
    @yield('css-include')
</head>

<body>

<section id="container" >

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @yield('breadcrumb')
            @yield('page-content-wrap')
        </section>
    </section>


    <!--footer start-->
    <!--<footer class="site-footer">
        <div class="text-center">
            xxx
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>-->
    <!--footer end-->


</section>

<!-- begin tuning merge js -->
<script src="{{ asset('js/ex/jquery.js') }}"></script>
<script src="{{ asset('js/ex/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- end tuning merge js -->

@stack('scripts')



</body>
</html>
