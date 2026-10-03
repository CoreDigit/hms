
@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.labs') }}
@endsection

@section('card-handle')
@endsection

@section('card-body')
    @include('cruds.labs.partials.index-table')
@endsection
