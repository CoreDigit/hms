@extends('layouts.master2')

@section('css')
    <!--- Internal Fontawesome css-->
    <link href="{{ URL::asset('backend/assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!---Ionicons css-->
    <link href="{{ URL::asset('backend/assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <!---Internal Typicons css-->
    <link href="{{ URL::asset('backend/assets/plugins/typicons.font/typicons.css') }}" rel="stylesheet">
    <!---Internal Feather css-->
    <link href="{{ URL::asset('backend/assets/plugins/feather/feather.css') }}" rel="stylesheet">
    <!---Internal Falg-icons css-->
    <link href="{{ URL::asset('backend/assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
@endsection

@section('title', '404 ' . __('validation.error.'))

@section('content')
    <!-- Page -->
    <div class="page">
        <!-- Main-error-wrapper -->
        <div class="main-error-wrapper  page page-h ">
            <img src="{{ URL::asset('backend/assets/img/media/404.png') }}" class="error-page" alt="error">
            <h2>{{ __('validation.error.message.0') }}</h2>
            <h6>{{ __('validation.error.message.1') }}</h6>
            <a class="btn btn-outline-danger" href="{{ route('web.index') }}">
                {{ __('validation.error.redirect') }}
            </a>
        </div>
        <!-- /Main-error-wrapper -->
    </div>
    <!-- End Page -->
@endsection
