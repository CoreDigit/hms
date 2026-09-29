<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\InvoiceRequest;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Cruds\FundAccount;
use App\Models\Cruds\Invoice;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Service;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = [
            'invoices' => Invoice::latest()->get(),
            'patients' =>  Patient::select('id', 'name')->get(),
            'doctors' =>  Doctor::select('id', 'name')->get(),
            'servicesWhereSingle' =>  Service::where('status', true)->where('type', 'single')->get(),
            'servicesWhereMulti' =>  Service::where('status', true)->where('type', 'multi')->get(),
        ];
        return view('cruds.invoices.index', $data);
    }

    public function store(InvoiceRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $invoice = Invoice::create($data);

            ########## Patient & Fund Accounts ##########

            PatientAccount::create([
                'patient_id' => $invoice->patient_id,
                'amount' => $invoice->service->price,
                'case' => $invoice->case === 'paid' ? 'credit' : 'debit',
                'transaction_type' => 'invoice',
                'transaction_id' => $invoice->id,
            ]);

            FundAccount::create([
                'amount' => $invoice->service->price,
                'case' => $invoice->case === 'paid' ? 'debit' : 'credit',
                'transaction_type' => 'invoice',
                'transaction_id' => $invoice->id,
            ]);

            ########## ######################## #########

            DB::commit();
            return redirect()->route('invoices.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Invoice $invoice)
    {
        return view('cruds.invoices.show', compact('invoice'));
    }

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $invoice->update($data);

            ########## Patient & Fund Accounts ##########

            $patientAccount = PatientAccount::findByTransaction('invoice', $invoice->id);
            $patientAccount->update([
                'patient_id' => $invoice->patient_id,
                'amount' => $invoice->service->price,
                'case' => $invoice->case === 'paid' ? 'credit' : 'debit',
            ]);

            $fundAccount = FundAccount::findByTransaction('invoice', $invoice->id);
            $fundAccount->update([
                'amount' => $invoice->service->price,
                'case' => $invoice->case === 'paid' ? 'debit' : 'credit',
            ]);

            ########## ######################## #########

            DB::commit();
            return redirect()->route('invoices.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function authDestroy(AdminLoginRequest $request, Invoice $invoice)
    {
        $request->authenticate();
        $request->session()->regenerate();
        try {
            $invoice->delete();
            return redirect()->route('invoices.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }
}
