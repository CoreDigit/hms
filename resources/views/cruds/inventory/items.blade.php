@extends('users.admin.layouts.master')

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <h4 class="content-title mb-0 my-auto">Hospital Non-Drug Inventory Items</h4>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addItemModal"><i class="fa fa-plus"></i> Add Inventory Item</button>
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
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Stock Qty</th>
                        <th>Unit</th>
                        <th>Rack / Storage</th>
                        <th>Stock Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td><b>{{ $item->item_code }}</b></td>
                            <td>{{ $item->item_name }}</td>
                            <td><span class="badge badge-info">{{ strtoupper($item->category) }}</span></td>
                            <td>{{ $item->supplier->company_name ?? ($item->supplier->name ?? '-') }}</td>
                            <td>
                                @if($item->quantity <= $item->min_reorder_level)
                                    <span class="badge badge-danger p-2">{{ $item->quantity }} (LOW)</span>
                                @else
                                    <span class="badge badge-success p-2">{{ $item->quantity }}</span>
                                @endif
                            </td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->location_rack ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#adjustModal{{ $item->id }}"><i class="fa fa-plus-minus"></i> Adjust Stock</button>
                            </td>
                        </tr>

                        <!-- Adjust Stock Modal -->
                        <div class="modal fade" id="adjustModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <form action="{{ route('inventory.items.stock', $item->id) }}" method="POST" class="modal-content text-left">
                                    @csrf
                                    <div class="modal-header"><h5 class="modal-title">Adjust Stock: {{ $item->item_name }}</h5></div>
                                    <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label>Adjustment Type</label>
                                            <select name="type" class="form-control">
                                                <option value="add">Add Units (+)</option>
                                                <option value="reduce">Deduct Units (-)</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" class="form-control" required min="1" value="1">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-block">Update Stock</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="8">No inventory items found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('inventory.items.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Create Inventory Item</h5></div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>Item Name <span class="text-danger">*</span></label>
                    <input type="text" name="item_name" class="form-control" required placeholder="e.g. Disposable Syringes 5ml">
                </div>
                <div class="form-group mb-2">
                    <label>Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-control" required>
                        <option value="equipment">Surgical & Medical Equipment</option>
                        <option value="disposable">Disposables & Consumables</option>
                        <option value="linen">Linen & Bedding</option>
                        <option value="cleaning">Sanitization & Cleaning</option>
                        <option value="office">Office & Admin Supplies</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Supplier</label>
                    <select name="supplier_id" class="form-control">
                        <option value="">-- Select Supplier --</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->company_name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 form-group mb-2">
                        <label>Initial Quantity</label>
                        <input type="number" name="quantity" class="form-control" required value="50">
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label>Unit (e.g. Boxes/Pcs)</label>
                        <input type="text" name="unit" class="form-control" required value="Boxes">
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label>Rack / Storage Location</label>
                    <input type="text" name="location_rack" class="form-control" placeholder="Rack A, Shelf 2">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Item</button>
            </div>
        </form>
    </div>
</div>
@endsection
