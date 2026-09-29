<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\PaymentRequest;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Cruds\FundAccount;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Payment;
use App\Models\Users\Patient;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $data = [
            'payments' => Payment::orderBy('updated_at', 'desc')->get(),
            'patients' =>  Patient::select('id', 'name')->get(),
        ];
        return view('cruds.payments.index', $data);
    }

    public function store(PaymentRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $payment = Payment::create($data);

            ########## Patient & Fund Accounts ##########

            PatientAccount::create([
                'patient_id' => $payment->patient_id,
                'amount' => $payment->amount,
                'case' => 'debit',
                'transaction_type' => 'payment',
                'transaction_id' => $payment->id,
            ]);

            FundAccount::create([
                'amount' => $payment->amount,
                'case' => 'credit',
                'transaction_type' => 'payment',
                'transaction_id' => $payment->id,
            ]);

            ########## ######################## #########

            DB::commit();
            return redirect()->route('payments.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Payment $payment)
    {
        return view('cruds.payments.show', compact('payment'));
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $payment->update($data);

            ########## Patient & Fund Accounts ##########

            $patientAccount = PatientAccount::findByTransaction('payment', $payment->id);
            $patientAccount->update([
                'patient_id' => $payment->patient_id,
                'amount' => $payment->amount,
            ]);

            $fundAccount = FundAccount::findByTransaction('payment', $payment->id);
            $fundAccount->update([
                'amount' => $payment->amount,
            ]);

            ########## ######################## #########

            DB::commit();
            return redirect()->route('payments.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function authDestroy(AdminLoginRequest $request, Payment $payment)
    {
        $request->authenticate();
        $request->session()->regenerate();
        try {
            $payment->delete();
            return redirect()->route('payments.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }
}
