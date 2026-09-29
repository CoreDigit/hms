@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Pharmacy Medicine Stock Master</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addMedModal"><i class="fa fa-plus"></i> Add New Medicine</button>
        <a href="{{ route('pharmacy.pos') }}" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Open Pharmacy POS</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header pb-0">
        <form method="GET" action="{{ route('pharmacy.medicines.index') }}" class="row">
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
                                @if($med->stock_quantity <= $med->reorder_level)
                                    <span class="badge badge-danger p-2">{{ $med->stock_quantity }} (LOW STOCK)</span>
                                @else
                                    <span class="badge badge-success p-2">{{ $med->stock_quantity }}</span>
                                @endif
                            </td>
                            <td>{{ $med->expiry_date ?? '-' }}</td>
                            <td>
                                @if($med->is_active)
                                    <span class="badge badge-primary">Active</span>
                                @else
                                    <span class="badge badge-secondary">Disabled</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8">No medicines found.</td></tr>
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
        <form action="{{ route('pharmacy.medicines.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Add Medicine to Pharmacy Stock</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Medicine Brand Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Paracetamol 650mg">
                </div>
                <div class="form-group mb-2">
                    <label>Generic Chemical Name</label>
                    <input type="text" name="generic_name" class="form-control" placeholder="e.g. Acetaminophen">
                </div>
                <div class="form-group mb-2">
                    <label>Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Unit Selling Price (₹)</label>
                        <input type="number" step="0.01" name="unit_price" class="form-control" required placeholder="10.00">
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Initial Stock Qty</label>
                        <input type="number" name="stock_quantity" class="form-control" required placeholder="100">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Batch Number</label>
                        <input type="text" name="batch_number" class="form-control" placeholder="B-2026-01">
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Medicine</button>
            </div>
        </form>
    </div>
</div>
@endsection
