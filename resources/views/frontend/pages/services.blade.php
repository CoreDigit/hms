@extends('frontend.layouts.index')

@section('title1', __('cruds.services.'))

@section('content+')
	<!-- Services Section -->
	@include('frontend.partials.service-section')
	<!-- Fluid Section One -->

	<!-- Services Section Two -->
    @include('frontend.partials.service-section-2')
	<!-- End Services Section Two -->
@endsection
