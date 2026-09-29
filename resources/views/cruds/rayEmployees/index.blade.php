@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('users.rayEmployees') }}
@endsection

@section('card-handle')
    <a href="{{ route('rayEmployees.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>
@endsection

@section('card-body')
    @include('cruds.rayEmployees.partials.index-table')
@endsection
