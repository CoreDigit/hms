@extends('users.admin.layouts.master')

@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Hide the image -->
    <style>
        .hide {
            display: none;
        }
    </style>
@endsection

@section('title')
    {{ __('users.rayEmployees') }} | {{ __('handle.edit') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('users.rayEmployees') }}</h4>
                <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('handle.edit') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@include('cruds.partials.alerts')

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('cruds.rayEmployees.partials.edit-form')
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!--Internal  Select2 js -->
    <script src="{{ URL::asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Form-layouts js -->
    <script src="{{ URL::asset('backend/assets/js/form-layouts.js') }}"></script>
    <!-- Display the image -->
    <script>
        var loadFile = function(event) {
            var hiddenDiv = document.querySelector('.hide');
            var output = document.getElementById('output');

            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
            hiddenDiv.classList.remove('hide');
        };
    </script>
@endsection
