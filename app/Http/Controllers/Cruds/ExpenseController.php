<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\ExpenseCategory;
use App\Models\Cruds\Expense;
use App\Models\Cruds\DailyCashClosing;
use App\Models\Cruds\OpdToken;
use App\Models\Cruds\PharmacyInvoice;
use App\Models\Cruds\Payment;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());
        $expenses = Expense::with(['category', 'recorder'])
            ->whereDate('expense_date', $date)
            ->latest()
            ->paginate(15);

        $categories = ExpenseCategory::all();

        $totalExpenseToday = Expense::whereDate('expense_date', $date)->sum('amount');

        return view('cruds.expenses.index', compact('expenses', 'categories', 'date', 'totalExpenseToday'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ExpenseCategory::create(['name' => $request->name, 'description' => $request->description]);
        return redirect()->back()->with('success', 'Expense Category created!');
    }

    public function storeExpense(Request $request)
    {
        $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'title' => 'required|string|max:255',
        ]);

        $expense = Expense::create([
            'expense_category_id' => $request->expense_category_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'payment_mode' => $request->payment_mode ?? 'cash',
            'vendor_name' => $request->vendor_name,
            'reference_no' => $request->reference_no,
            'description' => $request->description,
            'recorded_by' => Auth::id() ?? 1,
        ]);

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'expense',
            'record_id' => $expense->id,
            'description' => "Expense logged: {$expense->title} (Amount: {$expense->amount})",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Expense recorded successfully!');
    }

    public function cashClosingIndex()
    {
        $closings = DailyCashClosing::with('closedBy')->latest('closing_date')->paginate(15);

        $today = Carbon::today()->toDateString();
        $opdTotal = OpdToken::whereDate('token_date', $today)->where('payment_status', 'paid')->sum('consultation_fee');
        $pharmacyTotal = PharmacyInvoice::whereDate('created_at', $today)->where('payment_status', 'paid')->sum('net_amount');
        $patientPayments = Payment::whereDate('created_at', $today)->sum('amount');
        $totalExpenses = Expense::whereDate('expense_date', $today)->sum('amount');

        $totalCashIn = $opdTotal + $pharmacyTotal + $patientPayments;

        return view('cruds.expenses.cash_closing', compact('closings', 'today', 'opdTotal', 'pharmacyTotal', 'patientPayments', 'totalCashIn', 'totalExpenses'));
    }

    public function storeCashClosing(Request $request)
    {
        $today = Carbon::today()->toDateString();
        if (DailyCashClosing::whereDate('closing_date', $today)->exists()) {
            return redirect()->back()->withErrors(['closing_date' => 'Cash register for today has already been closed.']);
        }

        $opdTotal = OpdToken::whereDate('token_date', $today)->where('payment_status', 'paid')->sum('consultation_fee');
        $pharmacyTotal = PharmacyInvoice::whereDate('created_at', $today)->where('payment_status', 'paid')->sum('net_amount');
        $ipdTotal = Payment::whereDate('created_at', $today)->sum('amount');
        $totalExpenses = Expense::whereDate('expense_date', $today)->sum('amount');

        $openingBalance = $request->opening_balance ?? 0;
        $totalCollected = $opdTotal + $pharmacyTotal + $ipdTotal;
        $closingBalance = ($openingBalance + $totalCollected) - $totalExpenses;

        $closing = DailyCashClosing::create([
            'closing_date' => $today,
            'opening_balance' => $openingBalance,
            'total_opd_collected' => $opdTotal,
            'total_pharmacy_collected' => $pharmacyTotal,
            'total_ipd_collected' => $ipdTotal,
            'total_expenses' => $totalExpenses,
            'closing_balance' => $closingBalance,
            'notes' => $request->notes,
            'closed_by' => Auth::id() ?? 1,
        ]);

        AuditLog::create([
            'user_type' => 'user',
            'user_id' => Auth::id() ?? 1,
            'action' => 'created',
            'module' => 'cash_closing',
            'record_id' => $closing->id,
            'description' => "Daily Cash Closing for {$today} completed. Closing balance: {$closingBalance}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', "Daily Cash Register closed! Final Closing Balance: {$closingBalance}");
    }
}
