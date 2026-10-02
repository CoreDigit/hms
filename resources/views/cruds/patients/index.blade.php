@extends('users.' . activeGuard() . '.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('users.patients') }}
@endsection

@section('card-handle')
    @if (auth()->guard('admin')->check() || auth()->guard('receptionist')->check())
        <a href="{{ auth()->guard('receptionist')->check() ? route('receptionist.patients.create') : route('patients.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>
    @endif
@endsection

@section('card-body')
    @include('cruds.patients.partials.index-table')
@endsection
