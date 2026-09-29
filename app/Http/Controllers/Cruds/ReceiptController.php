<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\ReceiptRequest;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Cruds\FundAccount;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Receipt;
use App\Models\Users\Patient;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index()
    {
        $data = [
            'receipts' => Receipt::orderBy('updated_at', 'desc')->get(),
            'patients' =>  Patient::select('id', 'name')->get(),
        ];
        return view('cruds.receipts.index', $data);
    }

    public function store(ReceiptRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $receipt = Receipt::create($data);

            ########## Patient & Fund Accounts ##########

            PatientAccount::create([
                'patient_id' => $receipt->patient_id,
                'amount' => $receipt->amount,
                'case' => 'credit',
                'transaction_type' => 'receipt',
                'transaction_id' => $receipt->id,
            ]);

            FundAccount::create([
                'amount' => $receipt->amount,
                'case' => 'debit',
                'transaction_type' => 'receipt',
                'transaction_id' => $receipt->id,
            ]);

            ########## ######################## #########

            DB::commit();
            return redirect()->route('receipts.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Receipt $receipt)
    {
        return view('cruds.receipts.show', compact('receipt'));
    }

    public function update(ReceiptRequest $request, Receipt $receipt)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $receipt->update($data);

            ########## Patient & Fund Accounts ##########

            $patientAccount = PatientAccount::findByTransaction('receipt', $receipt->id);
            $patientAccount->update([
                'patient_id' => $receipt->patient_id,
                'amount' => $receipt->amount,
            ]);

            $fundAccount = FundAccount::findByTransaction('receipt', $receipt->id);
            $fundAccount->update([
                'amount' => $receipt->amount,
            ]);

            ########## ######################## #########

            DB::commit();
            return redirect()->route('receipts.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function authDestroy(AdminLoginRequest $request, Receipt $receipt)
    {
        $request->authenticate();
        $request->session()->regenerate();
        try {
            $receipt->delete();
            return redirect()->route('receipts.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }
}
