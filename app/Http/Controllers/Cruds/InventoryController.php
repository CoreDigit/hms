<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\InventorySupplier;
use App\Models\Cruds\InventoryItem;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function suppliersIndex()
    {
        $suppliers = InventorySupplier::latest()->paginate(15);
        return view('cruds.inventory.suppliers', compact('suppliers'));
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        InventorySupplier::create($request->only(['name', 'company_name', 'phone', 'email', 'address', 'gstin']));

        return redirect()->back()->with('success', 'Supplier registered successfully!');
    }

    public function itemsIndex(Request $request)
    {
        $search = $request->get('search');
        $items = InventoryItem::with('supplier')
            ->when($search, function ($q) use ($search) {
                return $q->where('item_name', 'like', "%{$search}%")->orWhere('category', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15);

        $suppliers = InventorySupplier::all();

        return view('cruds.inventory.items', compact('items', 'suppliers', 'search'));
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string',
            'unit_price' => 'nullable|numeric|min:0',
        ]);

        InventoryItem::create([
            'supplier_id' => $request->supplier_id,
            'item_name' => $request->item_name,
            'item_code' => $request->item_code ?? ('INV-' . rand(1000, 9999)),
            'category' => $request->category,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'min_reorder_level' => $request->min_reorder_level ?? 5,
            'unit_price' => $request->unit_price ?? 0,
            'location_rack' => $request->location_rack,
        ]);

        return redirect()->back()->with('success', 'Inventory item created successfully!');
    }

    public function updateStock(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);
        $request->validate([
            'type' => 'required|in:add,reduce',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->type === 'add') {
            $item->increment('quantity', $request->quantity);
        } else {
            if ($item->quantity < $request->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Cannot deduct more than current stock quantity.']);
            }
            $item->decrement('quantity', $request->quantity);
        }

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'updated',
            'module' => 'inventory',
            'record_id' => $item->id,
            'description' => "Stock {$request->type} of {$request->quantity} units for {$item->item_name}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Inventory stock updated!');
    }
}
