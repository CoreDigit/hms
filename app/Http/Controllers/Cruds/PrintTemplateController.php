<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Users\Patient;
use App\Models\Cruds\OpdToken;
use App\Models\Cruds\Prescription;
use App\Models\Cruds\PharmacyInvoice;
use App\Models\Cruds\DischargeSummary;
use App\Models\Cruds\Payment;
use Illuminate\Http\Request;

class PrintTemplateController extends Controller
{
    public function patientIdCard($id)
    {
        $patient = Patient::findOrFail($id);
        return view('cruds.print_templates.patient_card', compact('patient'));
    }

    public function opdTokenSlip($id)
    {
        $token = OpdToken::with(['patient', 'doctor', 'department'])->findOrFail($id);
        return view('cruds.print_templates.opd_slip', compact('token'));
    }

    public function prescriptionSlip($id)
    {
        $prescription = Prescription::with(['patient', 'doctor', 'items.medicine'])->findOrFail($id);
        return view('cruds.print_templates.prescription_slip', compact('prescription'));
    }

    public function pharmacyReceipt($id)
    {
        $invoice = PharmacyInvoice::with(['patient', 'seller', 'items.medicine'])->findOrFail($id);
        return view('cruds.print_templates.pharmacy_receipt', compact('invoice'));
    }

    public function dischargeSummaryDoc($id)
    {
        $summary = DischargeSummary::with(['admission.patient', 'doctor', 'patient'])->findOrFail($id);
        return view('cruds.print_templates.discharge_summary', compact('summary'));
    }

    public function paymentReceiptDoc($id)
    {
        $payment = Payment::with(['patient', 'accountant', 'invoice'])->findOrFail($id);
        return view('cruds.print_templates.payment_receipt', compact('payment'));
    }
}
