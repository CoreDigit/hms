<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\MedicineCategory;
use App\Models\Cruds\Medicine;
use App\Models\Cruds\PharmacyInvoice;
use App\Models\Cruds\PharmacyInvoiceItem;
use App\Models\Cruds\MedicineReturn;
use App\Models\Users\Patient;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PharmacyController extends Controller
{
    public function medicinesIndex(Request $request)
    {
        $search = $request->get('search');
        $categoryId = $request->get('category_id');

        $medicines = Medicine::with('category')
            ->when($search, function ($q) use ($search) {
                return $q->where('name', 'like', "%{$search}%")->orWhere('generic_name', 'like', "%{$search}%");
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                return $q->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->paginate(20);

        $categories = MedicineCategory::all();

        return view('cruds.pharmacy.medicines', compact('medicines', 'categories', 'search', 'categoryId'));
    }

    public function storeMedicine(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:medicine_categories,id',
            'unit_price' => 'required|numeric|min:0',
            'purchase_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'reorder_level' => 'nullable|integer|min:0',
        ]);

        Medicine::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'generic_name' => $request->generic_name,
            'batch_number' => $request->batch_number,
            'manufacturer' => $request->manufacturer,
            'unit_price' => $request->unit_price,
            'purchase_price' => $request->purchase_price ?? $request->unit_price,
            'stock_quantity' => $request->stock_quantity,
            'reorder_level' => $request->reorder_level ?? 10,
            'expiry_date' => $request->expiry_date,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Medicine added to stock successfully!');
    }

    public function pos()
    {
        $medicines = Medicine::where('is_active', true)->where('stock_quantity', '>', 0)->get();
        $patients = Patient::select('id', 'name', 'phone', 'uhid')->get();

        return view('cruds.pharmacy.pos', compact('medicines', 'patients'));
    }

    public function storeInvoice(Request $request)
    {
        $request->validate([
            'patient_id' => 'nullable|exists:patients,id',
            'customer_name' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_mode' => 'required|in:cash,card,upi,insurance,other',
        ]);

        DB::beginTransaction();
        try {
            $invoiceNumber = 'PH-INV-' . date('Ymd') . '-' . rand(1000, 9999);
            $totalAmount = 0;

            $invoice = PharmacyInvoice::create([
                'invoice_number' => $invoiceNumber,
                'patient_id' => $request->patient_id,
                'customer_name' => $request->customer_name ?? ($request->patient_id ? Patient::find($request->patient_id)->name : 'Walk-in Customer'),
                'customer_phone' => $request->customer_phone,
                'total_amount' => 0,
                'discount_amount' => $request->discount_amount ?? 0,
                'tax_amount' => $request->tax_amount ?? 0,
                'net_amount' => 0,
                'paid_amount' => 0,
                'payment_status' => 'paid',
                'payment_mode' => $request->payment_mode,
                'sold_by' => Auth::id() ?? 1,
            ]);

            foreach ($request->items as $itemData) {
                $med = Medicine::findOrFail($itemData['medicine_id']);

                if ($med->stock_quantity < $itemData['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->withErrors(["Medicine {$med->name} does not have sufficient stock."]);
                }

                $unitPrice = $med->unit_price;
                $lineTotal = $unitPrice * $itemData['quantity'];
                $totalAmount += $lineTotal;

                PharmacyInvoiceItem::create([
                    'pharmacy_invoice_id' => $invoice->id,
                    'medicine_id' => $med->id,
                    'medicine_name' => $med->name,
                    'unit_price' => $unitPrice,
                    'quantity' => $itemData['quantity'],
                    'total_price' => $lineTotal,
                ]);

                // Reduce stock
                $med->decrement('stock_quantity', $itemData['quantity']);
            }

            $discount = $request->discount_amount ?? 0;
            $tax = $request->tax_amount ?? 0;
            $netAmount = ($totalAmount - $discount) + $tax;

            $invoice->total_amount = $totalAmount;
            $invoice->net_amount = $netAmount;
            $invoice->paid_amount = $netAmount;
            $invoice->save();

            AuditLog::create([
                'user_type' => 'user',
                'user_id' => Auth::id() ?? 1,
                'action' => 'created',
                'module' => 'pharmacy_invoice',
                'record_id' => $invoice->id,
                'description' => "Pharmacy Invoice #{$invoice->invoice_number} generated for Net Amount {$invoice->net_amount}",
                'ip_address' => $request->ip(),
            ]);

            DB::commit();

            $printRoute = auth()->guard('pharmacist')->check() ? 'pharmacist.invoices.print' : 'pharmacy.invoices.print';
            return redirect()->route($printRoute, $invoice->id)
                ->with('success', 'Pharmacy Sale completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Pharmacy sale error: ' . $e->getMessage()]);
        }
    }

    public function invoicesIndex()
    {
        $invoices = PharmacyInvoice::with(['patient', 'seller', 'items'])->latest()->paginate(15);
        return view('cruds.pharmacy.invoices', compact('invoices'));
    }

    public function printInvoice($id)
    {
        $invoice = PharmacyInvoice::with(['patient', 'seller', 'items.medicine'])->findOrFail($id);
        return view('cruds.pharmacy.print_invoice', compact('invoice'));
    }
}
