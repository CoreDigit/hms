<!-- Title -->
<title> @yield('title') </title>
<!-- Favicon -->
<link rel="icon" href="{{ URL::asset('backend/assets/img/brand/favicon.png') }}" type="image/x-icon" />
<!-- Icons css -->
<link href="{{ URL::asset('backend/assets/css/icons.css') }}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{ URL::asset('backend/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
<!--  Right-sidemenu css -->
<link href="{{ URL::asset('backend/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
@yield('css')

@if (App::getLocale() == 'ar')
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css-rtl/sidemenu.css') }}">
    <!--- Style css -->
    <link href="{{ URL::asset('backend/assets/css-rtl/style.css') }}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{ URL::asset('backend/assets/css-rtl/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('backend/assets/css-rtl/skin-modes.css') }}" rel="stylesheet">
@else
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('backend/assets/css/sidemenu.css') }}">
    <!-- Maps css -->
    <link href="{{ URL::asset('backend/assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <!-- style css -->
    <link href="{{ URL::asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/css/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('backend/assets/css/skin-modes.css') }}" rel="stylesheet" />
@endif