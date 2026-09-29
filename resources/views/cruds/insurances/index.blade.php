@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.insurances') }}
@endsection

@section('card-handle')
    <a href="" data-toggle="modal" data-target="#insurances-create"
        class="btn btn-primary">{{ __('handle.create') }}</a>
    @include('cruds.insurances.partials.create-modal')

    <button type="button" class="btn btn-danger" id="btn_delete_all">{{ __('handle.delete.') }}</button>
    @include('cruds.insurances.partials.delete-group-modal')
@endsection

@section('card-body')
    @include('cruds.insurances.partials.index-table')
@endsection
