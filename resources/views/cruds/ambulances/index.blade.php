@extends('users.admin.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.ambulances') }}
@endsection

@section('card-handle')
    <a href="" data-toggle="modal" data-target="#ambulances-create"
        class="btn btn-primary">{{ __('handle.create') }}</a>
    @include('cruds.ambulances.partials.create-modal')

    <button type="button" class="btn btn-danger" id="btn_delete_all">{{ __('handle.delete.') }}</button>
    @include('cruds.ambulances.partials.delete-group-modal')
@endsection

@section('card-body')
    @include('cruds.ambulances.partials.index-table')
@endsection
