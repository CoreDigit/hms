@extends('frontend.layouts.master2')

@section('content')
    <!-- Main Slider Three -->
    @include('frontend.partials.main-slider-2')
    <!-- End Main Slider -->

    <!-- Department Section -->
    @include('frontend.partials.department-section')
    <!-- End Department Section -->

    <!-- Fluid Section One -->
    @include('frontend.partials.fluid-section')

    <!-- Services Section -->
    @include('frontend.partials.service-section')

    <!-- Counter Section -->
    @include('frontend.partials.counter-section')
    <!-- End Counter Section -->

    <!-- Team Section -->
    @include('frontend.partials.team-section')
    <!-- End Team Section -->

    <!-- FullWidth Section -->
    @include('frontend.partials.fullwidth-section')
    <!-- End FullWidth Section -->

    <!-- Testimonial Section -->
    @include('frontend.partials.testimonial-section')
    <!-- End Testimonial Section Two -->
@endsection
