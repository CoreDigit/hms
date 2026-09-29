@extends('frontend.layouts.titled-page')

@section('main-title', __('general.about.us'))

@section('page-title', __('general.about.zg450'))

@section('breadcrumb-title', __('general.about.'))

@section('content+')
    <!-- Health Section -->
    @include('frontend.partials.health-section')
    <!-- End Health Section -->

    <!-- Featured Section -->
    @include('frontend.partials.featured-section')
    <!-- End Featured Section -->

    <!-- Counter Section -->
    @include('frontend.partials.counter-section')
    <!-- End Counter Section -->
@endsection
