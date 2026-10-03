
@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.diagnostics') }}
@endsection

@section('card-handle')
@endsection

@section('card-body')
    @include('cruds.diagnostics.partials.index-table')
@endsection
