@extends('users.admin.layouts.master')

@extends('users.layouts.dashboard')

@section('title')
    {{ __('general.dashboard.admin') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
                    {{ $admin->name }}, {{ __('general.words.welcome_back') }}
                </h2>
                <p class="mg-b-0">{{ $admin->email }}</p>
            </div>
        </div>
    </div>
@endsection

@section('statistics')
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.total.invoices') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    $ {{ $statistics['invoices']['all']['sum'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.debit.invoices') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    $ {{ $statistics['invoices']['debit']['sum'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.credit.invoices') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    $ {{ $statistics['invoices']['credit']['sum'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.total.accounts.fund') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    $ {{ $statistics['fund-accounts']['all']['sum'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.debit.accounts.fund') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    $ {{ $statistics['fund-accounts']['debit']['sum'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.credit.accounts.fund') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    $ {{ $statistics['fund-accounts']['credit']['sum'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.doctors') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['doctors'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.patients') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['patients'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.labEmployees') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['labEmployees'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.rayEmployees') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['rayEmployees'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.ambulanceDrivers') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['ambulanceDrivers'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.services.single') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['singleServices'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-dark-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-17 text-white">
                            {{ __('statistics.all.services.multi') }}
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-30 font-weight-bold mb-1 text-white">
                                    {{ $count['multiServices'] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="card card-dashboard-eight pb-2">
                <h6 class="card-title">
                    {{ __('statistics.financial') }}
                </h6>
                <span class="d-block mg-b-10 text-muted tx-12">
                    {{ __('general.note.financials') }}
                </span>
                <div class="list-group">
                    @foreach ($statistics2 as $name => $statistic)
                        <div class="list-group-item border-top-0">
                            <p>
                                {{ __("statistics.all.$name") }}
                            </p>
                            <span>{{ $statistic['count'] }}</span>
                        </div>
                        <div class="list-group-item border-top-0">
                            <p>
                                {{ __("statistics.total.$name") }}
                            </p>
                            <span class="text-warning">$ {{ $statistic['sum'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-8 col-xl-8">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">
                        {{ __('statistics.financial') }}
                    </h4>
                </div>
                <span class="tx-12 tx-muted mb-3 ">
                    {{ __('general.note.financials') }}
                </span>
                <div class="table-responsive country-table">
                    <table
                        class="table text-center table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th rowspan="2">{{ __('general.words.financial') }}</th>
                                <th colspan="2">{{ __('statistics.all.') }}</th>
                                <th colspan="2">{{ __('statistics.debit.') }}</th>
                                <th colspan="2">{{ __('statistics.credit.') }}</th>
                            </tr>
                            <tr>
                                <th>{{ __('general.words.count') }}</th>
                                <th>{{ __('general.words.money') }}</th>
                                <th>{{ __('general.words.count') }}</th>
                                <th>{{ __('general.words.money') }}</th>
                                <th>{{ __('general.words.count') }}</th>
                                <th>{{ __('general.words.money') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $translations = ['cruds.invoice.*', 'cruds.accounts.fund', 'cruds.accounts.patient'];
                            @endphp
                            @foreach ($statistics as $statistic)
                                <tr>
                                    <td>{{ __($translations[$loop->iteration - 1]) }}</td>
                                    <td>{{ $statistic['all']['count'] }}</td>
                                    <td class="text-info">$ {{ $statistic['all']['sum'] }}</td>
                                    <td>{{ $statistic['debit']['count'] }}</td>
                                    <td class="text-success">$ {{ $statistic['debit']['sum'] }}</td>
                                    <td>{{ $statistic['credit']['count'] }}</td>
                                    <td class="text-danger">$ {{ $statistic['credit']['sum'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
