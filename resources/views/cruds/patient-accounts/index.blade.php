@extends('users.' . auth()->guard()->name . '.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.accounts.patient') }}
@endsection

@section('card-body')
    @include('cruds.patient-accounts.partials.index-table')
@endsection
