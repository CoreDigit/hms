@extends('frontend.layouts.show')

@section('title1', __('users.doctors'))

@section('title1-link', route('web.doctors.index'))

@section('title2', $doctor->name)

@section('content+')
    <!-- Doctor Detail Section -->
    @include('frontend.partials.doctor-section')
    <!-- End Doctor Detail Section -->
@endsection
