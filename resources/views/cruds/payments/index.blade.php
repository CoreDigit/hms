@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.payment.*') }}
@endsection

@section('card-handle')
    <a href="" data-toggle="modal" data-target="#payments-create"
        class="btn btn-primary">{{ __('handle.create') }}</a>
    @include('cruds.payments.partials.create-modal')
@endsection

@section('card-body')
    @include('cruds.payments.partials.index-table')
@endsection
