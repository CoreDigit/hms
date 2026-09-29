@extends('frontend.layouts.titled-page')

@section('main-title', __('general.contact.'))

@section('page-title', __('general.contact.zg450'))

@section('breadcrumb-title', __('general.contact.us'))

@section('content+')
    <!-- Contact Page Section -->
    @include('frontend.partials.contact-page-section')
    <!-- End Contact Page Section -->

    <!-- Contact Map Section -->
    @include('frontend.partials.contact-map-section')
    <!-- End Map Section -->
@endsection

@section('scripts')
    <!--Google Map APi Key-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD39_Mb1wKUcuRD-0KPmQT6SQHhEMVX1O0"></script>
    <script src="{{ asset('frontend/assets/js/map-script.js') }}"></script>
    <!--End Google Map APi-->
@endsection
