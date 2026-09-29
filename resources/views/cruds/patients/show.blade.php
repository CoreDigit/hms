@extends('users.' . auth()->guard()->name . '.layouts.master')

@extends('cruds.layouts.show')

@section('title1')
    {{ __('users.patients') }}
@endsection

@section('title2')
    {{ $patient->name }}
@endsection

@section('profile-overview')
    <div class="main-img-user profile-user">
        <img alt="" src="{{ asset('backend/images/' . $patient->image->path) }}">
    </div>
    <div class="d-flex justify-content-between mg-b-20">
        <div>
            <h5 class="main-profile-name">{{ $patient->name }}</h5>
        </div>
    </div>
    <h6>{{ __('field.address') }}</h6>
    <div class="main-profile-bio">{{ $patient->address }}</div>
    <div class="row d-flex justify-content-between text-center">
        <div>
            <h5>{{ $patient->labs()->count() }}</h5>
            <h6 class="text-small text-muted mb-0">{{ __('cruds.labs') }}</h6>
        </div>
        <div>
            <h5>{{ $patient->appointments()->count() }}</h5>
            <h6 class="text-small text-muted mb-0">{{ __('cruds.appointments') }}</h6>
        </div>
        <div>
            <h5>{{ $patient->rays()->count() }}</h5>
            <h6 class="text-small text-muted mb-0">{{ __('cruds.rays') }}</h6>
        </div>
    </div>
@endsection

@section('profile-details')
    <div class="tabs-menu ">
        <!-- Tabs -->
        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span>
                    <span class="hidden-xs">{{ __('field.about_me') }}</span>
                </a>
            </li>

            @if (auth()->guard('admin')->check() ||
                    auth()->guard('patient')->check())
                <li class="">
                    <a href="#profile" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="las la-images tx-15 mr-1"></i></span>
                        <span class="hidden-xs">{{ __('handle.edit') }}</span>
                    </a>
                </li>

                <li class="">
                    <a href="#settings" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span>
                        <span class="hidden-xs">{{ __('auth.') }}</span>
                    </a>
                </li>

                <li class="">
                    <a href="#account" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="las la-comment-dollar"></i></span>
                        <span class="hidden-xs">{{ __('cruds.account.') }}</span>
                    </a>
                </li>
            @endif

            <li class="">
                <a href="#medical" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="las la-notes-medical"></i></span>
                    <span class="hidden-xs">{{ __('general.words.medical') }}</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
        <div class="tab-pane active" id="home">
            @include('cruds.patients.partials.show-table')
        </div>

        @if (auth()->guard('admin')->check() ||
                auth()->guard('patient')->check())
            <div class="tab-pane" id="profile">
                @include('cruds.patients.partials.edit-form')
            </div>

            <div class="tab-pane" id="settings">
                @include('cruds.patients.partials.password-form')

                <hr>

                @include('cruds.patients.partials.delete-account-card')
            </div>

            <div class="tab-pane" id="account">
                <div class="panel panel-primary tabs-style-1">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav panel-tabs main-nav-line">
                                <li class="nav-item">
                                    <a href="#invoices" class="nav-link" data-toggle="tab">
                                        <i class="las la-money-check"></i>
                                        {{ __('cruds.invoice.*') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#payments" class="nav-link" data-toggle="tab">
                                        <i class="las la-money-bill"></i>
                                        {{ __('cruds.payment.*') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#receipts" class="nav-link" data-toggle="tab">
                                        <i class="las la-money-bill"></i>
                                        {{ __('cruds.receipt.*') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#totals" class="nav-link active" data-toggle="tab">
                                        <i class="las la-balance-scale"></i>
                                        {{ __('statistics.total.*') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                        <div class="tab-content">
                            <div class="tab-pane" id="invoices">
                                @include('cruds.patients.partials.invoices-table')
                            </div>

                            <div class="tab-pane" id="payments">
                                @include('cruds.patients.partials.payments-table')
                            </div>

                            <div class="tab-pane" id="receipts">
                                @include('cruds.patients.partials.receipts-table')
                            </div>

                            <div class="tab-pane active" id="totals">
                                @include('cruds.patients.partials.totals-table')
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                @include('cruds.patients.partials.patient-account-card')
            </div>
        @endif

        <div class="tab-pane" id="medical">
            <div class="panel panel-primary tabs-style-1">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1">
                        <ul class="nav panel-tabs main-nav-line">
                            <li class="nav-item">
                                <a href="#labs" class="nav-link active" data-toggle="tab">
                                    <i class="las la-vial"></i>
                                    {{ __('cruds.labs') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#rays" class="nav-link" data-toggle="tab">
                                    <i class="las la-x-ray"></i>
                                    {{ __('cruds.rays') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                    <div class="tab-content">
                        <div class="tab-pane active" id="labs">
                            @include('cruds.patients.partials.labs-table')
                        </div>

                        <div class="tab-pane" id="rays">
                            @include('cruds.patients.partials.rays-table')
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            @include('cruds.patients.partials.records-card')
        </div>
    </div>
@endsection
