@extends(auth()->guard('accountant')->check() ? 'users.accountant.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Daily Cash Register Closing</h4>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white font-weight-bold">Today's Live Cash Register Summary ({{ $today }})</div>
            <div class="card-body">
                <form action="{{ auth()->guard('accountant')->check() ? route('accountant.cash_closing.store') : route('cash_closing.store') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Opening Cash Balance:</th>
                                <td>
                                    <input type="number" step="0.01" name="opening_balance" class="form-control text-right" value="0.00">
                                </td>
                            </tr>
                            <tr class="text-success">
                                <th>(+) OPD Token Collections:</th>
                                <td class="text-right font-weight-bold">₹{{ number_format($opdTotal, 2) }}</td>
                            </tr>
                            <tr class="text-success">
                                <th>(+) Pharmacy Sales Collections:</th>
                                <td class="text-right font-weight-bold">₹{{ number_format($pharmacyTotal, 2) }}</td>
                            </tr>
                            <tr class="text-success">
                                <th>(+) IPD & General Patient Payments:</th>
                                <td class="text-right font-weight-bold">₹{{ number_format($patientPayments, 2) }}</td>
                            </tr>
                            <tr class="bg-light font-weight-bold">
                                <th>TOTAL CASH INFLOW TODAY:</th>
                                <td class="text-right text-success tx-16">₹{{ number_format($totalCashIn, 2) }}</td>
                            </tr>
                            <tr class="text-danger">
                                <th>(-) Total Hospital Expenses Today:</th>
                                <td class="text-right font-weight-bold">₹{{ number_format($totalExpenses, 2) }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-group mb-3">
                        <label>Register Closing Notes / Discrepancy Remarks</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Cash physically counted and verified in safe..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fa fa-lock"></i> Close Cash Register & Save Final Balance</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white font-weight-bold">Past Daily Cash Register Closings</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Cash Inflow</th>
                                <th>Expenses</th>
                                <th>Closing Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($closings as $c)
                                <tr>
                                    <td><b>{{ $c->closing_date }}</b></td>
                                    <td class="text-success">₹{{ number_format($c->total_opd_collected + $c->total_pharmacy_collected + $c->total_ipd_collected, 2) }}</td>
                                    <td class="text-danger">₹{{ number_format($c->total_expenses, 2) }}</td>
                                    <td><b class="text-primary tx-16">₹{{ number_format($c->closing_balance, 2) }}</b></td>
                                </tr>
                            @empty
                                <tr><td colspan="4">No past register closings.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $closings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
