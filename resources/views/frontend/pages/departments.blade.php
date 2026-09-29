@extends('frontend.layouts.index')

@section('title1', __('cruds.departments'))

@section('content+')
    <!-- Department Section -->
    @include('frontend.partials.department-section')
    <!-- End Department Section -->

    <!-- Department Section Three -->
    @include('frontend.partials.department-section-3')
    <!-- End Department Section -->

    <!-- Department Section Two -->
    @include('frontend.partials.department-section-2')
    <!-- End Department Section Two -->
@endsection
