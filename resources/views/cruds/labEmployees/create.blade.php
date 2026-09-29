@extends('users.admin.layouts.master')

@extends('cruds.layouts.create')

@section('title1')
    {{ __('users.labEmployees') }}
@endsection

@section('title2')
    {{ __('handle.create') }}
@endsection

@section('card-body')
    @include('cruds.labEmployees.partials.create-form')
@endsection
