
@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.appointments') }}
@endsection

@section('card-handle')
@endsection

@section('card-body')
    @include('cruds.appointments.partials.index-table')
@endsection
