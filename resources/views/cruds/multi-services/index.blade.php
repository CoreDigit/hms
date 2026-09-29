@extends('users.' . auth()->guard()->name . '.layouts.master')

@extends('cruds.layouts.index')

@section('title')
    {{ __('cruds.services.multi') }}
@endsection

@section('card-handle')
    @if (auth()->guard('admin')->check())
        <a href="{{ route('multi-services.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>

        <button type="button" class="btn btn-danger" id="btn_delete_all">{{ __('handle.delete.') }}</button>
        @include('cruds.multi-services.partials.delete-group-modal')
    @endif
@endsection

@section('card-body')
    @include('cruds.multi-services.partials.index-table')
@endsection
