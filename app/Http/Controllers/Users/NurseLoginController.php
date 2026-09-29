<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Nurse;
use App\Models\Cruds\PatientVital;
use App\Models\Cruds\Admission;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;

class NurseLoginController extends Controller
{
    public function index()
    {
        $todayVitals = PatientVital::whereDate('created_at', today())->count();
        $occupiedBeds = Admission::where('status', 'admitted')->count();

        return view('users.nurse.dashboard', compact('todayVitals', 'occupiedBeds'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('nurse')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME['nurse'] ?? 'nurse/dashboard');
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

        $nurse = Nurse::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => true,
        ]);

        Auth::guard('nurse')->login($nurse);

        return redirect('nurse/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('nurse')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
