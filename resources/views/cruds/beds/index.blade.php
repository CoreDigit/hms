@extends(auth()->guard('receptionist')->check() ? 'users.receptionist.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Ward & Bed Management</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addWardModal"><i class="fa fa-plus"></i> Add Ward</button>
        <button class="btn btn-success" data-toggle="modal" data-target="#addBedModal"><i class="fa fa-bed"></i> Add Bed</button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row row-sm mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card bg-info text-white p-3 text-center">
            <h5>Total Beds</h5>
            <h3>{{ $stats['total'] }}</h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card bg-success text-white p-3 text-center">
            <h5>Available</h5>
            <h3>{{ $stats['available'] }}</h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card bg-danger text-white p-3 text-center">
            <h5>Occupied</h5>
            <h3>{{ $stats['occupied'] }}</h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card bg-warning text-white p-3 text-center">
            <h5>Cleaning / Maintenance</h5>
            <h3>{{ $stats['cleaning'] + $stats['maintenance'] }}</h3>
        </div>
    </div>
</div>

@foreach($wards as $ward)
    <div class="card mb-4">
        <div class="card-header bg-gray-200 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $ward->name }} ({{ strtoupper($ward->ward_type) }}) - ₹{{ number_format($ward->daily_charge, 2) }}/day</h5>
            <span class="badge badge-dark">Floor: {{ $ward->floor_number ?? '1' }}</span>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($ward->beds as $bed)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card border p-3 text-center 
                            @if($bed->status == 'available') border-success bg-success-transparent
                            @elseif($bed->status == 'occupied') border-danger bg-danger-transparent
                            @elseif($bed->status == 'cleaning') border-warning bg-warning-transparent
                            @else border-secondary @endif">
                            <h4 class="font-weight-bold">BED #{{ $bed->bed_number }}</h4>
                            <p class="mb-1 text-capitalize">Type: {{ $bed->bed_type }}</p>
                            
                            @if($bed->status == 'occupied' && $bed->admission)
                                <div class="badge badge-danger p-2 mb-2">Occupied: {{ $bed->admission->patient->name ?? 'Patient' }}</div>
                            @else
                                <span class="badge badge-pill 
                                    @if($bed->status == 'available') badge-success 
                                    @elseif($bed->status == 'cleaning') badge-warning 
                                    @else badge-secondary @endif p-2 mb-2">{{ strtoupper($bed->status) }}</span>
                            @endif

                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown">Status</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item update-bed-status" href="#" data-id="{{ $bed->id }}" data-status="available">Mark Available</a>
                                    <a class="dropdown-item update-bed-status" href="#" data-id="{{ $bed->id }}" data-status="cleaning">Mark Cleaning</a>
                                    <a class="dropdown-item update-bed-status" href="#" data-id="{{ $bed->id }}" data-status="maintenance">Mark Maintenance</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="text-muted">No beds created in this ward yet.</p></div>
                @endforelse
            </div>
        </div>
    </div>
@endforeach

<!-- Add Ward Modal -->
<div class="modal fade" id="addWardModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ auth()- onsubmit="const btn = this.querySelector('button.btn-main-primary, button[type=submit]'); if(btn) { btn.disabled = true; btn.innerHTML = '<i class=\'fas fa-spinner fa-spin mr-1\'></i> Processing...'; }">guard('receptionist')->check() ? route('receptionist.wards.store') : route('wards.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Create New Ward</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Ward Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. ICU Ward 2">
                </div>
                <div class="form-group mb-2">
                    <label>Ward Type</label>
                    <select name="ward_type" class="form-control">
                        <option value="general">General</option>
                        <option value="semi_private">Semi-Private</option>
                        <option value="private">Private</option>
                        <option value="icu">ICU</option>
                        <option value="ccu">CCU</option>
                        <option value="emergency">Emergency</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Daily Charge (₹)</label>
                    <input type="number" step="0.01" name="daily_charge" class="form-control" value="1000.00" required>
                </div>
                <div class="form-group mb-2">
                    <label>Floor Number</label>
                    <input type="text" name="floor_number" class="form-control" placeholder="Floor 1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Ward</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Bed Modal -->
<div class="modal fade" id="addBedModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ auth()- onsubmit="const btn = this.querySelector('button.btn-main-primary, button[type=submit]'); if(btn) { btn.disabled = true; btn.innerHTML = '<i class=\'fas fa-spinner fa-spin mr-1\'></i> Processing...'; }">guard('receptionist')->check() ? route('receptionist.beds.store') : route('beds.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Add Bed to Ward</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Select Ward</label>
                    <select name="ward_id" class="form-control" required>
                        @foreach($wards as $w)
                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Bed Number</label>
                    <input type="text" name="bed_number" class="form-control" required placeholder="e.g. B-101">
                </div>
                <div class="form-group mb-2">
                    <label>Bed Type</label>
                    <select name="bed_type" class="form-control">
                        <option value="standard">Standard</option>
                        <option value="icu_ventilator">ICU Ventilator</option>
                        <option value="electric">Electric Adjustable</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Daily Charge (₹)</label>
                    <input type="number" step="0.01" name="daily_charge" class="form-control" value="1000.00" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Bed</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.update-bed-status', function(e) {
        e.preventDefault();
        var bedId = $(this).data('id');
        var status = $(this).data('status');
        var statusUrl = '{{ auth()->guard("receptionist")->check() ? "/en/receptionist/beds/" : "/en/admin/beds/" }}' + bedId + '/status';
        $.ajax({
            url: statusUrl,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(res) {
                location.reload();
            }
        });
    });
</script>
@endsection
