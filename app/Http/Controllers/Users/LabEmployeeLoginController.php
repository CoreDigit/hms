<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LabEmployeeLoginRequest;
use App\Models\Users\LabEmployee;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;

class LabEmployeeLoginController extends Controller
{
    public function index()
    {
        $labStatistics = $this->getLabStatistics(auth()->user());
        return view('users.labEmployee.dashboard', compact('labStatistics'));
    }

    public function getLabStatistics(LabEmployee $labEmployee)
    {
        return [
            'all' => $labEmployee->labs()->count(),
            'pending' => $labEmployee->labs()->where('status', 'pending')->count(),
            'completed' => $labEmployee->labs()->where('status', 'completed')->count(),
        ];
    }

    public function store(LabEmployeeLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME['labEmployee']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('labEmployee')->logout();

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

        $labEmployee = LabEmployee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => 1,
        ]);

        Auth::guard('labEmployee')->login($labEmployee);

        return redirect(RouteServiceProvider::HOME['labEmployee']);
    }
}
