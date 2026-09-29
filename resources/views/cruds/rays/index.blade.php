@extends(auth()->guard('admin')->check() ? 'users.admin.layouts.master' : 'users.rayEmployee.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.rays') }}
@endsection

@section('card-handle')
@endsection

@section('card-body')
    @include('cruds.rays.partials.index-table')
@endsection
