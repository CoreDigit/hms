@extends('users.' . activeGuard() . '.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.rays') }}
@endsection

@section('card-handle')
@endsection

@section('card-body')
    @include('cruds.rays.partials.index-table')
@endsection
