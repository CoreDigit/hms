@extends('users.admin.layouts.master')

@extends('cruds.layouts.create')

@section('title1')
    {{ __('cruds.services.multi') }}
@endsection

@section('title2')
    {{ __('handle.create') }}
@endsection

@section('card-body')
    {{ $slot }}
    {{-- the same as: @livewire('cruds.multi-services.create-multi-service') --}}
@endsection
