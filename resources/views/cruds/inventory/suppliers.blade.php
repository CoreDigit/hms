@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Inventory Suppliers</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSupplierModal"><i class="fa fa-plus"></i> Add Supplier</button>
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
                        <th>Supplier Name</th>
                        <th>Company Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>GSTIN</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $sup)
                        <tr>
                            <td><b>{{ $sup->name }}</b></td>
                            <td>{{ $sup->company_name ?? '-' }}</td>
                            <td>{{ $sup->phone ?? '-' }}</td>
                            <td>{{ $sup->email ?? '-' }}</td>
                            <td>{{ $sup->gstin ?? '-' }}</td>
                            <td>{{ $sup->address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No suppliers registered.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $suppliers->links() }}
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('inventory.suppliers.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Register Supplier</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Contact Person Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label>Company / Agency Name</label>
                    <input type="text" name="company_name" class="form-control">
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label>GSTIN / Tax ID</label>
                    <input type="text" name="gstin" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label>Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Supplier</button>
            </div>
        </form>
    </div>
</div>
@endsection
