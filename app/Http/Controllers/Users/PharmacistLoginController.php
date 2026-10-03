<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Pharmacist;
use App\Models\Cruds\Medicine;
use App\Models\Cruds\PharmacyInvoice;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;

class PharmacistLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['role' => 'pharmacist']);
    }

    public function index()
    {
        $todayInvoicesCount = PharmacyInvoice::whereDate('created_at', today())->count();
        $todaySales = PharmacyInvoice::whereDate('created_at', today())->sum('net_amount');
        $lowStockCount = Medicine::whereRaw('stock_quantity <= reorder_level')->count();

        return view('users.pharmacist.dashboard', compact('todayInvoicesCount', 'todaySales', 'lowStockCount'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('pharmacist')->attempt($credentials)) {
            $request->session()->regenerate();
            $intended = session('url.intended');
            if ($intended && (str_contains($intended, 'login') || str_contains($intended, 'register'))) {
                session()->forget('url.intended');
            }
            return redirect()->intended(RouteServiceProvider::HOME['pharmacist'] ?? 'pharmacist/dashboard');
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

        $pharmacist = Pharmacist::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => true,
        ]);

        Auth::guard('pharmacist')->login($pharmacist);

        return redirect('pharmacist/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('pharmacist')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
