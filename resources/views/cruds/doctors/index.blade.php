@extends('users.' . auth()->guard()->name . '.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('users.doctors') }}
@endsection

@section('card-handle')
    @if (auth()->guard('admin')->check())
        <a href="{{ route('doctors.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>
    @endif
@endsection

@section('card-body')
    @include('cruds.doctors.partials.index-table')
@endsection
