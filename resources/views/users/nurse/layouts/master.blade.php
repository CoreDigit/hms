<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nurse Dashboard - Hospital Management System</title>
    @include('layouts.head')
</head>
<body class="main-body app sidebar-mini dark-theme">
    <div id="global-loader">
        <img src="{{ URL::asset('backend/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    @include('users.nurse.layouts.main-sidebar')

    <div class="main-content app-content">
        @include('users.admin.layouts.main-header')
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('layouts.footer')
            @include('layouts.footer-scripts')
        </div>
    </div>
</body>
</html>
