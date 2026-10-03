<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RayEmployeeLoginRequest;
use App\Models\Users\RayEmployee;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossUsers;

class RayEmployeeLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['role' => 'rayEmployee']);
    }

    public function index()
    {
        $rayStatistics = $this->getLabStatistics(auth()->user());
        return view('users.rayEmployee.dashboard', compact('rayStatistics'));
    }

    public function getLabStatistics(RayEmployee $rayEmployee)
    {
        return [
            'all' => $rayEmployee->rays()->count(),
            'pending' => $rayEmployee->rays()->where('status', 'pending')->count(),
            'completed' => $rayEmployee->rays()->where('status', 'completed')->count(),
        ];
    }

    public function store(RayEmployeeLoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME['rayEmployee']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('rayEmployee')->logout();

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

        $rayEmployee = RayEmployee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => 1,
        ]);

        Auth::guard('rayEmployee')->login($rayEmployee);

        return redirect(RouteServiceProvider::HOME['rayEmployee']);
    }
}
