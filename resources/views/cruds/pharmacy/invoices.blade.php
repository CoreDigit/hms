@extends(auth()->guard('pharmacist')->check() ? 'users.pharmacist.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Pharmacy Sales Invoices</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <a href="{{ auth()->guard('pharmacist')->check() ? route('pharmacist.pos') : route('pharmacy.pos') }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> New Pharmacy Sale</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Customer / Patient</th>
                        <th>Date</th>
                        <th>Payment Mode</th>
                        <th>Net Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $inv)
                        <tr>
                            <td><b>{{ $inv->invoice_number }}</b></td>
                            <td>{{ $inv->customer_name ?? ($inv->patient->name ?? 'Walk-in') }}</td>
                            <td>{{ Carbon\Carbon::parse($inv->created_at)->format('d M Y h:i A') }}</td>
                            <td><span class="badge badge-dark">{{ strtoupper($inv->payment_mode) }}</span></td>
                            <td><b class="text-success tx-16">₹{{ number_format($inv->net_amount, 2) }}</b></td>
                            <td><span class="badge badge-success">PAID</span></td>
                            <td>
                                <a href="{{ auth()->guard('pharmacist')->check() ? route('pharmacist.invoices.print', $inv->id) : route('pharmacy.invoices.print', $inv->id) }}" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print Invoice</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No pharmacy sales invoices recorded.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $invoices->links() }}
        </div>
    </div>
</div>
@endsection
