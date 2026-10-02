@extends(auth()->guard('accountant')->check() ? 'users.accountant.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Hospital Expense Register</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addExpenseModal"><i class="fa fa-plus"></i> Log Expense</button>
        <button class="btn btn-dark" data-toggle="modal" data-target="#addCatModal"><i class="fa fa-folder-plus"></i> Add Category</button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card bg-danger text-white p-3 text-center">
            <h5>Total Expense for {{ $date }}</h5>
            <h2>₹{{ number_format($totalExpenseToday, 2) }}</h2>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header pb-0">
        <form method="GET" action="{{ auth()->guard('accountant')->check() ? route('accountant.expenses.index') : route('expenses.index') }}" class="row">
            <div class="col-md-4">
                <label>Filter Date</label>
                <input type="date" name="date" class="form-control" value="{{ $date }}">
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
                        <th>Date</th>
                        <th>Title / Description</th>
                        <th>Category</th>
                        <th>Vendor / Payee</th>
                        <th>Payment Mode</th>
                        <th>Ref #</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $exp)
                        <tr>
                            <td>{{ $exp->expense_date }}</td>
                            <td><b>{{ $exp->title }}</b><br><small class="text-muted">{{ $exp->description }}</small></td>
                            <td><span class="badge badge-info">{{ $exp->category->name ?? 'General' }}</span></td>
                            <td>{{ $exp->vendor_name ?? '-' }}</td>
                            <td><span class="badge badge-dark">{{ strtoupper($exp->payment_mode) }}</span></td>
                            <td>{{ $exp->reference_no ?? '-' }}</td>
                            <td><b class="text-danger tx-16">₹{{ number_format($exp->amount, 2) }}</b></td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No expense records found for {{ $date }}.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $expenses->links() }}
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ auth()->guard('accountant')->check() ? route('accountant.expenses.store') : route('expenses.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Log Hospital Expense</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Expense Category <span class="text-danger">*</span></label>
                    <select name="expense_category_id" class="form-control" required>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Title / Particulars <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required placeholder="e.g. Oxygen Cylinder Refill Bill">
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Amount (₹) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="amount" class="form-control" required placeholder="1500.00">
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Date <span class="text-danger">*</span></label>
                        <input type="date" name="expense_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Vendor / Payee</label>
                        <input type="text" name="vendor_name" class="form-control" placeholder="Vendor Company">
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Payment Mode</label>
                        <select name="payment_mode" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer / NEFT</option>
                            <option value="cheque">Cheque</option>
                            <option value="upi">UPI / Online</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label>Bill / Voucher Reference #</label>
                    <input type="text" name="reference_no" class="form-control" placeholder="VOUCHER-109">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Expense</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCatModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="{{ auth()->guard('accountant')->check() ? route('accountant.expenses.category.store') : route('expenses.category.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">New Expense Category</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Electricity Bill">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark btn-block">Save Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
