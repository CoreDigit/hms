@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('users.labEmployees') }}
@endsection

@section('card-handle')
    <a href="{{ route('labEmployees.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>
@endsection

@section('card-body')
    @include('cruds.labEmployees.partials.index-table')
@endsection
