@extends('frontend.layouts.index')

@section('title1', __('cruds.services.multi'))

@section('content+')
    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
           {{ $slot }}
        </div>
    </div>
    <!-- End Sierbar Container -->
@endsection
