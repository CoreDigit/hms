@extends('frontend.layouts.titled-page')

@section('main-title', __('general.faq.'))

@section('page-title', __('general.faq.zg450'))

@section('breadcrumb-title', __('general.faq.*'))

@section('content+')
	<!-- Faq Page Section -->
    @include('frontend.partials.faq-page-section')
	<!-- End Faq Page Section -->
	
	<!-- Faq Form Section -->
    @include('frontend.partials.faq-form-section')
	<!-- End Faq Form Section -->
@endsection
