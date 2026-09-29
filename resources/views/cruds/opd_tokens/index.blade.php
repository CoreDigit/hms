@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">OPD Token Queue Management</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ route('opd_tokens.create') }}" class="btn btn-primary mr-2"><i class="fa fa-plus-circle"></i> Generate Token</a>
        <a href="{{ route('opd_tokens.queue') }}" target="_blank" class="btn btn-warning"><i class="fa fa-desktop"></i> Live Queue Board</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-0">
                <form method="GET" action="{{ route('opd_tokens.index') }}" class="row">
                    <div class="col-md-3">
                        <label>Filter Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $date }}">
                    </div>
                    <div class="col-md-3">
                        <label>Doctor</label>
                        <select name="doctor_id" class="form-control">
                            <option value="">All Doctors</option>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}" {{ $doctorId == $doc->id ? 'selected' : '' }}>Dr. {{ $doc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="waiting" {{ $status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                            <option value="in_consultation" {{ $status == 'in_consultation' ? 'selected' : '' }}>In Consultation</option>
                            <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Token #</th>
                                <th>Type</th>
                                <th>Patient Name</th>
                                <th>Doctor</th>
                                <th>Department</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tokens as $token)
                                <tr>
                                    <td><b class="tx-18 text-primary">#{{ $token->token_number }}</b></td>
                                    <td>
                                        @if($token->token_type == 'emergency')
                                            <span class="badge badge-danger">EMERGENCY</span>
                                        @elseif($token->token_type == 'vip')
                                            <span class="badge badge-warning">VIP</span>
                                        @else
                                            <span class="badge badge-info">Standard</span>
                                        @endif
                                    </td>
                                    <td>{{ $token->patient->name ?? 'N/A' }} ({{ $token->patient->phone ?? '' }})</td>
                                    <td>Dr. {{ $token->doctor->name ?? 'N/A' }}</td>
                                    <td>{{ $token->department->name ?? '-' }}</td>
                                    <td>₹{{ number_format($token->consultation_fee, 2) }}</td>
                                    <td>
                                        <select class="form-control form-control-sm token-status-select" data-id="{{ $token->id }}">
                                            <option value="waiting" {{ $token->status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                                            <option value="in_consultation" {{ $token->status == 'in_consultation' ? 'selected' : '' }}>In Consultation</option>
                                            <option value="completed" {{ $token->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $token->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('opd_tokens.print', $token->id) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-print"></i> Print Slip</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No OPD Tokens found for the selected filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $tokens->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('change', '.token-status-select', function() {
        var tokenId = $(this).data('id');
        var newStatus = $(this).val();
        $.ajax({
            url: '/admin/opd-tokens/' + tokenId + '/status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                alert(response.message);
            }
        });
    });
</script>
@endsection
