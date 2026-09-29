@extends('frontend.layouts.show')

@section('title1', __('cruds.services.multi'))

@section('title1-link', route('web.multi.services.index'))

@section('title2', $multiService->name)

@section('content+')
    <!--Sidebar Page Container-->
    @include('frontend.partials.shop-content-details')

    <!--Cart Section-->
    @include('frontend.partials.cart-section')
    <!--End Cart Section-->
@endsection
