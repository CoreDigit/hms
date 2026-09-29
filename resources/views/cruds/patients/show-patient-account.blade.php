@extends('users.admin.layouts.master')

@extends('cruds.layouts.print')

@section('title1')
    {{ __('cruds.accounts.patient') }}
@endsection

@section('invoice-title')
    {{ __('cruds.accounts.patient') }}
@endsection

@php
    $admin = App\Models\Users\Admin::first();
    $patientAccounts = $patient->accounts()->get();
@endphp

@section('billed-from')
    <h6>{{ __('general.project.name') }}</h6>
    <p>{{ $admin->name }}<br>{{ $admin->email }}<br>
        {{ __('general.project.support_number') }}: 01026264486
    </p>
@endsection

@section('billed-to')
    <label class="tx-gray-600">{{ __('general.words.billed_to') }}</label>
    <div class="billed-to">
        <h6>{{ $patient->name }}</h6>
        <p>{{ $patient->address }}<br>{{ $patient->email }}</p>
    </div>
@endsection

@section('invoice-info')
@endsection

@section('invoice-table')
    @foreach ($patientAccounts as $patientAccount)
        @include('cruds.patient-accounts.partials.patient-account-table')
        <br>
    @endforeach
@endsection
