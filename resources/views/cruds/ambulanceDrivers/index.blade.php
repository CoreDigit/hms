@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('users.ambulanceDrivers') }}
@endsection

@section('card-handle')
    <a href="{{ route('ambulanceDrivers.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>
@endsection

@section('card-body')
    @include('cruds.ambulanceDrivers.partials.index-table')
@endsection
