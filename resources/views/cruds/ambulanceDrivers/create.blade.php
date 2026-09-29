@extends('users.admin.layouts.master')

@extends('cruds.layouts.create')

@section('title1')
    {{ __('users.ambulanceDrivers') }}
@endsection

@section('title2')
    {{ __('handle.create') }}
@endsection

@section('card-body')
    @include('cruds.ambulanceDrivers.partials.create-form')
@endsection
