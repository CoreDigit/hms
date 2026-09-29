<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', __('general.project.name'))</title>
    <!-- Stylesheets -->
    @include('frontend.includes.styles')
    @yield('styles')

    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/x-icon">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>
    <div class="page-wrapper {{ LaravelLocalization::getCurrentLocale() === 'ar' ? 'rtl' : '' }}">
        <!-- Preloader -->
        <div class="preloader"></div>

        @include('frontend.includes.header')
        <!-- End Main Header -->

        @yield('content')
        
        <!--Main Footer-->
        @include('frontend.includes.footer')
    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

    @include('frontend.includes.scripts')
    @yield('scripts')
</body>

</html>
