@extends(auth()->guard('admin')->check() ? 'users.admin.layouts.master' : 'users.labEmployee.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.labs') }}
@endsection

@section('card-handle')
@endsection

@section('card-body')
    @include('cruds.labs.partials.index-table')
@endsection
