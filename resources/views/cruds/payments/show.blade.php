@extends('users.admin.layouts.master')

@extends('cruds.layouts.print')

@section('title1')
    {{ __('cruds.payment.*') }}
@endsection

@section('invoice-title')
    {{ __('cruds.payment.') }}
@endsection

@php
    $admin = App\Models\Users\Admin::first();
    $patient = $payment->patient;
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
    <label class="tx-gray-600">{{ __('cruds.invoice.info') }}</label>
    <p class="invoice-info-row">
        <span>{{ __('cruds.invoice.number') }}</span><span>{{ $payment->id }}</span>
    </p>
    <p class="invoice-info-row">
        <span>{{ __('general.words.patient_id') }}</span><span>{{ $patient->id }}</span>
    </p>
    <p class="invoice-info-row">
        <span>{{ __('field.date.issue') }}</span><span>{{ $payment->created_at->format('F j, Y - h:i A') }}</span>
    </p>
    <p class="invoice-info-row">
        <span>{{ __('field.date.due') }}</span><span>{{ date('F j, Y - h:i A') }}</span>
    </p>
@endsection

@section('invoice-table')
    @include('cruds.payments.partials.payment-table')
@endsection
