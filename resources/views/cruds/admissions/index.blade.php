@extends(auth()->guard('receptionist')->check() ? 'users.receptionist.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">IPD Patient Admissions</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ auth()->guard('receptionist')->check() ? route('receptionist.admissions.create') : route('admissions.create') }}" class="btn btn-primary"><i class="fa fa-bed"></i> New IPD Admission</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Admission ID</th>
                        <th>Patient</th>
                        <th>Attending Doctor</th>
                        <th>Ward & Bed</th>
                        <th>Admission Date</th>
                        <th>Advance Deposit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admissions as $adm)
                        <tr>
                            <td><b>#IPD-{{ $adm->id }}</b></td>
                            <td>{{ $adm->patient->name ?? 'N/A' }} ({{ $adm->patient->phone ?? '' }})</td>
                            <td>Dr. {{ $adm->doctor->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-info">{{ $adm->ward->name ?? 'Ward' }}</span> - Bed #{{ $adm->bed->bed_number ?? 'N/A' }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($adm->admission_date)->format('d M Y h:i A') }}</td>
                            <td>₹{{ number_format($adm->advance_amount, 2) }}</td>
                            <td>
                                @if($adm->status == 'admitted')
                                    <span class="badge badge-success">ADMITTED</span>
                                @else
                                    <span class="badge badge-secondary">DISCHARGED</span>
                                @endif
                            </td>
                            <td>
                                @if($adm->status == 'admitted')
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#transferModal{{ $adm->id }}"><i class="fa fa-exchange-alt"></i> Transfer Bed</button>
                                    @if(auth()->guard('admin')->check() || auth()->guard('doctor')->check())
                                        <a href="{{ route('discharge_summaries.create', ['admission_id' => $adm->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-door-open"></i> Discharge</a>
                                    @endif
                                @endif
                            </td>
                        </tr>

                        <!-- Transfer Modal -->
                        <div class="modal fade" id="transferModal{{ $adm->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ auth()- onsubmit="const btn = this.querySelector('button.btn-main-primary, button[type=submit]'); if(btn) { btn.disabled = true; btn.innerHTML = '<i class=\'fas fa-spinner fa-spin mr-1\'></i> Processing...'; }">guard('receptionist')->check() ? route('receptionist.admissions.transfer', $adm->id) : route('admissions.transfer', $adm->id) }}" method="POST" class="modal-content">
                                    @csrf
                                    <div class="modal-header"><h5 class="modal-title">Transfer Patient Bed</h5></div>
                                    <div class="modal-body text-left">
                                        <p>Current Bed: <b>Bed #{{ $adm->bed->bed_number ?? '-' }}</b> ({{ $adm->ward->name ?? '' }})</p>
                                        <div class="form-group">
                                            <label>Select New Available Bed</label>
                                            <select name="new_bed_id" class="form-control" required>
                                                <option value="">-- Choose Bed --</option>
                                                @foreach(App\Models\Cruds\Bed::with('ward')->where('status', 'available')->get() as $b)
                                                    <option value="{{ $b->id }}">{{ $b->ward->name ?? 'Ward' }} - Bed #{{ $b->bed_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Reason for Transfer</label>
                                            <input type="text" name="reason" class="form-control" placeholder="e.g. Shifted to ICU for close monitoring">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Confirm Transfer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8">No IPD admissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $admissions->links() }}
        </div>
    </div>
</div>
@endsection
