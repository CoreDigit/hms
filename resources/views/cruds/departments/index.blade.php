@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.departments') }}
@endsection

@section('card-handle')
    <a href="" data-toggle="modal" data-target="#departments-create"
        class="btn btn-primary">{{ __('handle.create') }}</a>
    @include('cruds.departments.partials.create-modal')

    <button type="button" class="btn btn-danger" id="btn_delete_all">{{ __('handle.delete.') }}</button>
    @include('cruds.departments.partials.delete-group-modal')
@endsection

@section('card-body')
    @include('cruds.departments.partials.index-table')
@endsection
