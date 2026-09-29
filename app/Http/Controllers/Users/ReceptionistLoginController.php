<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Patient;
use App\Models\Cruds\OpdToken;
use App\Models\Cruds\Appointment;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;
use App\Models\Users\Receptionist;

class ReceptionistLoginController extends Controller
{
    public function index()
    {
        $todayPatients = Patient::whereDate('created_at', today())->count();
        $todayTokens = OpdToken::whereDate('created_at', today())->count();
        $waitingTokens = OpdToken::where('status', 'waiting')->count();
        $todayAppointments = Appointment::whereDate('created_at', today())->count();

        return view('users.receptionist.dashboard', compact('todayPatients', 'todayTokens', 'waitingTokens', 'todayAppointments'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('receptionist')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME['receptionist'] ?? 'receptionist/dashboard');
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

        $receptionist = Receptionist::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => true,
        ]);

        Auth::guard('receptionist')->login($receptionist);

        return redirect('receptionist/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('receptionist')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
