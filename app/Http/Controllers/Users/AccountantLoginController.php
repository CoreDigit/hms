<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Accountant;
use App\Models\Cruds\Expense;
use App\Models\Cruds\DailyCashClosing;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;

class AccountantLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['role' => 'accountant']);
    }

    public function index()
    {
        $todayExpenses = Expense::whereDate('expense_date', today())->sum('amount');
        $lastClosing = DailyCashClosing::latest('closing_date')->first();

        return view('users.accountant.dashboard', compact('todayExpenses', 'lastClosing'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('accountant')->attempt($credentials)) {
            $request->session()->regenerate();
            $intended = session('url.intended');
            if ($intended && (str_contains($intended, 'login') || str_contains($intended, 'register'))) {
                session()->forget('url.intended');
            }
            return redirect()->intended(RouteServiceProvider::HOME['accountant'] ?? 'accountant/dashboard');
        }

        return back()->withErrors(['email' => trans('auth.failed')]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', new UniqueEmailAcrossUsers()],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $accountant = Accountant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => true,
        ]);

        Auth::guard('accountant')->login($accountant);

        return redirect('accountant/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('accountant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
