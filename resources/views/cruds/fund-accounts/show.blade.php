@extends('users.admin.layouts.master')

@extends('cruds.layouts.print')

@section('title1')
    {{ __('cruds.accounts.fund') }}
@endsection

@section('invoice-title')
    {{ __('cruds.account.fund') }}
@endsection

@php
    $admin = App\Models\Users\Admin::first();
@endphp

@section('billed-from')
    <h6>{{ __('general.project.name') }}</h6>
    <p>{{ $admin->name }}<br>{{ $admin->email }}<br>
        {{ __('general.project.support_number') }}: 01026264486
    </p>
@endsection

@section('invoice-info')
    <label class="tx-gray-600">{{ __('cruds.invoice.info') }}</label>
    <p class="invoice-info-row">
        <span>{{ __('cruds.invoice.number') }}</span><span>{{ $fundAccount->id }}</span>
    </p>
    <p class="invoice-info-row">
        <span>{{ __('field.date.issue') }}</span><span>{{ $fundAccount->created_at->format('F j, Y - h:i A') }}</span>
    </p>
    <p class="invoice-info-row">
        <span>{{ __('field.date.due') }}</span><span>{{ date('F j, Y - h:i A') }}</span>
    </p>
@endsection

@section('invoice-table')
    @include('cruds.fund-accounts.partials.fund-account-table')
@endsection
