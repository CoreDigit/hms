@extends('frontend.layouts.index')

@section('title1', __('cruds.appointments'))

@section('content+')
	<!-- Price Section -->
    @include('frontend.partials.price-section')
    
	<!-- Appointment Section -->
    @include('frontend.partials.appointment-section')
@endsection
