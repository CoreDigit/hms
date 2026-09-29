@extends('users.' . auth()->guard()->name . '.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.services.single') }}
@endsection

@section('card-handle')
    @if (auth()->guard('admin')->check())
        <a href="" data-toggle="modal" data-target="#single-services-create"
            class="btn btn-primary">{{ __('handle.create') }}</a>
        @include('cruds.single-services.partials.create-modal')

        <button type="button" class="btn btn-danger" id="btn_delete_all">{{ __('handle.delete.') }}</button>
        @include('cruds.single-services.partials.delete-group-modal')
    @endif
@endsection

@section('card-body')
    @include('cruds.single-services.partials.index-table')
@endsection
