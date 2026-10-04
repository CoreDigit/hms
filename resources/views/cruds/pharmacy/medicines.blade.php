@extends(auth()->guard('pharmacist')->check() ? 'users.pharmacist.layouts.master' : 'users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Pharmacy Medicine Stock Master</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addMedModal"><i class="fa fa-plus"></i> Add New Medicine</button>
        <a href="{{ auth()->guard('pharmacist')->check() ? route('pharmacist.pos') : route('pharmacy.pos') }}" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Open Pharmacy POS</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header pb-0">
        <form method="GET" action="{{ auth()->guard('pharmacist')->check() ? route('pharmacist.medicines.index') : route('pharmacy.medicines.index') }}" class="row">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Search medicine name or generic name..." value="{{ $search }}">
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $categoryId == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary btn-block">Search Stock</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Generic Name</th>
                        <th>Category</th>
                        <th>Batch #</th>
                        <th>Unit Price</th>
                        <th>Stock Qty</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicines as $med)
                        <tr>
                            <td><b>{{ $med->name }}</b></td>
                            <td>{{ $med->generic_name ?? '-' }}</td>
                            <td>{{ $med->category->name ?? '-' }}</td>
                            <td>{{ $med->batch_number ?? '-' }}</td>
                            <td>₹{{ number_format($med->unit_price, 2) }}</td>
                            <td>
                                <span class="badge {{ $med->stock_quantity <= 10 ? 'badge-danger' : 'badge-success' }} tx-14 p-2">{{ $med->stock_quantity }}</span>
                            </td>
                            <td>{{ $med->expiry_date ?? 'N/A' }}</td>
                            <td><span class="badge badge-success">ACTIVE</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="8">No medicines found in stock.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $medicines->links() }}
        </div>
    </div>
</div>

<!-- Add Medicine Modal -->
<div class="modal fade" id="addMedModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ auth()- onsubmit="const btn = this.querySelector('button.btn-main-primary, button[type=submit]'); if(btn) { btn.disabled = true; btn.innerHTML = '<i class=\'fas fa-spinner fa-spin mr-1\'></i> Processing...'; }">guard('pharmacist')->check() ? route('pharmacist.medicines.store') : route('pharmacy.medicines.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Add Medicine to Inventory</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Medicine Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Paracetamol 500mg">
                </div>
                <div class="form-group mb-2">
                    <label>Generic Name</label>
                    <input type="text" name="generic_name" class="form-control" placeholder="e.g. Acetaminophen">
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Category</label>
                        <select name="medicine_category_id" class="form-control">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Batch Number</label>
                        <input type="text" name="batch_number" class="form-control" placeholder="BATCH-2026-X">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 form-group mb-2">
                        <label>Unit Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="unit_price" class="form-control" required value="15.00">
                    </div>
                    <div class="col-4 form-group mb-2">
                        <label>Stock Qty <span class="text-danger">*</span></label>
                        <input type="number" name="stock_quantity" class="form-control" required value="100">
                    </div>
                    <div class="col-4 form-group mb-2">
                        <label>Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Stock</button>
            </div>
        </form>
    </div>
</div>
@endsection
