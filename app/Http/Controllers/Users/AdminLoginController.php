<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Cruds\FundAccount;
use App\Models\Cruds\Invoice;
use App\Models\Cruds\MultiService;
use App\Models\Cruds\PatientAccount;
use App\Models\Cruds\Payment;
use App\Models\Cruds\Receipt;
use App\Models\Cruds\SingleService;
use App\Models\Users\AmbulanceDriver;
use App\Models\Users\Doctor;
use App\Models\Users\LabEmployee;
use App\Models\Users\Patient;
use App\Models\Users\RayEmployee;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;
use App\Models\Users\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['role' => 'admin']);
    }

    public function index()
    {
        $admin = auth()->user();
        $count = $this->getCounts();
        $statistics = $this->statistics();
        $statistics2 = $this->statistics2();

        return view('users.admin.dashboard', compact('admin', 'count', 'statistics', 'statistics2'));
    }

    public function getCounts()
    {
        return [
            'doctors' => Doctor::count(),
            'patients' => Patient::count(),
            'labEmployees' => LabEmployee::count(),
            'rayEmployees' => RayEmployee::count(),
            'ambulanceDrivers' => AmbulanceDriver::count(),
            'singleServices' => SingleService::count(),
            'multiServices' => MultiService::count(),
        ];
    }

    public function statistics()
    {
        return [
            'invoices' => [
                'all' => [
                    'count' => Invoice::count(),
                    'sum' => Invoice::sumInvoices(),
                ],
                'debit' => [
                    'count' => Invoice::where('case', 'pending')->count(),
                    'sum' => Invoice::sumInvoices('pending'),
                ],
                'credit' => [
                    'count' => Invoice::where('case', 'paid')->count(),
                    'sum' => Invoice::sumInvoices('paid'),
                ],
            ],
            'fund-accounts' => [
                'all' => [
                    'count' => FundAccount::count(),
                    'sum' => FundAccount::sum('amount'),
                ],
                'debit' => [
                    'count' => FundAccount::where('case', 'debit')->count(),
                    'sum' => FundAccount::where('case', 'debit')->sum('amount'),
                ],
                'credit' => [
                    'count' => FundAccount::where('case', 'credit')->count(),
                    'sum' => FundAccount::where('case', 'credit')->sum('amount'),
                ],
            ],
            'patient-accounts' => [
                'all' => [
                    'count' => PatientAccount::count(),
                    'sum' => PatientAccount::sum('amount'),
                ],
                'debit' => [
                    'count' => PatientAccount::where('case', 'debit')->count(),
                    'sum' => PatientAccount::where('case', 'debit')->sum('amount'),
                ],
                'credit' => [
                    'count' => PatientAccount::where('case', 'credit')->count(),
                    'sum' => PatientAccount::where('case', 'credit')->sum('amount'),
                ],
            ],
        ];
    }

    public function statistics2()
    {
        return [
            'payments' => [
                'count' => Payment::count(),
                'sum' => Payment::sum('amount'),
            ],
            'receipts' => [
                'count' => Receipt::count(),
                'sum' => Receipt::sum('amount'),
            ],
        ];
    }

    public function store(AdminLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $intended = session('url.intended');
        if ($intended && (str_contains($intended, 'login') || str_contains($intended, 'register'))) {
            session()->forget('url.intended');
        }

        return redirect()->intended(RouteServiceProvider::HOME['admin']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', new UniqueEmailAcrossUsers()],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect(RouteServiceProvider::HOME['admin']);
    }
}
