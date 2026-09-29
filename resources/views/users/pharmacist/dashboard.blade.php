@extends('users.pharmacist.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Pharmacist Dashboard</h4>
        </div>
    </div>
</div>

<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">TODAY'S PHARMACY SALES</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">₹{{ number_format($todaySales ?? 0, 2) }}</h4>
                            <span class="text-white-50 tx-11">{{ $todayInvoicesCount ?? 0 }} Invoices Sold</span>
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
                    <h6 class="mb-3 tx-12 text-white">LOW STOCK MEDICINE ALERTS</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $lowStockCount ?? 0 }}</h4>
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
            <label class="main-content-label text-primary">Pharmacy Quick Actions</label>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <a href="{{ route('pharmacist.pos') }}" class="btn btn-primary m-1"><i class="fa fa-cash-register mr-1"></i> Open Pharmacy POS Billing</a>
                <a href="{{ route('pharmacist.medicines.index') }}" class="btn btn-info m-1"><i class="fa fa-boxes mr-1"></i> Manage Medicine Stock</a>
            </div>
        </div>
    </div>
</div>
@endsection
