@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.receipt.*') }}
@endsection

@section('card-handle')
    <a href="" data-toggle="modal" data-target="#receipts-create"
        class="btn btn-primary">{{ __('handle.create') }}</a>
    @include('cruds.receipts.partials.create-modal')
@endsection

@section('card-body')
    @include('cruds.receipts.partials.index-table')
@endsection
