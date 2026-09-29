@extends('frontend.layouts.show')

@section('title1', __('cruds.departments'))

@section('title1-link', route('web.departments.index'))

@section('title2', $department->name)

@section('content+')
    <!--Sidebar Page Container-->
    @include('frontend.partials.sidebar-page-container')

    <!-- Doctors Section Two -->
    @include('frontend.partials.doctor-section-2')
    <!-- End Doctors Section Two -->
@endsection
