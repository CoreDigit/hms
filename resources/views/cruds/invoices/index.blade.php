@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.invoice.*') }}
@endsection

@section('card-handle')
    <a href="" data-toggle="modal" data-target="#invoices-create"
        class="btn btn-primary">{{ __('handle.create') }}</a>
    @include('cruds.invoices.partials.create-modal')
@endsection

@section('card-body')
    @include('cruds.invoices.partials.index-table')
@endsection
