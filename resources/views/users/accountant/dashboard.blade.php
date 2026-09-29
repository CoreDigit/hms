@extends('users.accountant.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Accountant Dashboard</h4>
        </div>
    </div>
</div>

<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">TODAY'S EXPENSES</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">₹{{ number_format($todayExpenses ?? 0, 2) }}</h4>
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
                    <h6 class="mb-3 tx-12 text-white">LAST REGISTER CLOSING BALANCE</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">₹{{ number_format($lastClosing->closing_balance ?? 0, 2) }}</h4>
                            <span class="text-white-50 tx-11">Date: {{ $lastClosing->closing_date ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label text-primary">Accounting Tools</label>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <a href="{{ route('accountant.expenses.index') }}" class="btn btn-primary m-1"><i class="fa fa-plus mr-1"></i> Log New Expense</a>
                <a href="{{ route('accountant.cash_closing.index') }}" class="btn btn-success m-1"><i class="fa fa-cash-register mr-1"></i> Daily Cash Register Closing</a>
            </div>
        </div>
    </div>
</div>
@endsection
