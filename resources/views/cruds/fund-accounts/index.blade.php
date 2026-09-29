@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.accounts.fund') }}
@endsection

@section('card-body')
    @include('cruds.fund-accounts.partials.index-table')
@endsection
