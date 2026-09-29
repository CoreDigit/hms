@extends('users.nurse.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Nurse Dashboard</h4>
        </div>
    </div>
</div>

<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">TODAY'S PATIENT VITALS LOGGED</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $todayVitals ?? 0 }}</h4>
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
                    <h6 class="mb-3 tx-12 text-white">CURRENT OCCUPIED BEDS</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $occupiedBeds ?? 0 }}</h4>
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
            <label class="main-content-label text-primary">Quick Nursing Tools</label>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <a href="{{ route('nurse.vitals.index') }}" class="btn btn-primary m-1"><i class="fa fa-heartbeat mr-1"></i> Record Vitals & Care Notes</a>
                <a href="{{ route('nurse.beds.index') }}" class="btn btn-info m-1"><i class="fa fa-bed mr-1"></i> Ward & Bed Grid</a>
            </div>
        </div>
    </div>
</div>
@endsection
