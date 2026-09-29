@extends('users.admin.layouts.master')

@extends('cruds.layouts.create')

@section('title1')
    {{ __('users.doctors') }}
@endsection

@section('title2')
    {{ __('handle.create') }}
@endsection

@section('card-body')
    @include('cruds.doctors.partials.create-form')
@endsection
