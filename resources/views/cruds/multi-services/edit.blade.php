@extends('users.admin.layouts.master')

@extends('cruds.layouts.create')

@section('title1')
    {{ __('cruds.services.multi') }}
@endsection

@section('title2')
    {{ __('handle.edit') }}
@endsection

@section('card-body')
    @livewire('cruds.multi-services.update-multi-service', ['id' => Route::current()->parameter('id')])
@endsection
