@extends('users.admin.layouts.master')

@extends('cruds.layouts.print')

@section('title1')
    {{ __('cruds.accounts.fund') }}
@endsection

@section('invoice-title')
    {{ __('cruds.accounts.fund') }}
@endsection

@php
    $admin = App\Models\Users\Admin::first();
    $fundAccounts = App\Models\Cruds\FundAccount::all();
@endphp

@section('billed-from')
    <h6>{{ __('general.project.name') }}</h6>
    <p>{{ $admin->name }}<br>{{ $admin->email }}<br>
        {{ __('general.project.support_number') }}: 01026264486
    </p>
@endsection

@section('invoice-table')
    @foreach ($fundAccounts as $fundAccount)
        @include('cruds.fund-accounts.partials.fund-account-table')
        <br>
    @endforeach
@endsection
