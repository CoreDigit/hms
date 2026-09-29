<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AdminLoginRequest;
use App\Models\Cruds\FundAccount;
use Illuminate\Http\Request;

class FundAccountController extends Controller
{
    public function index()
    {
        $fundAccounts = FundAccount::all();
        return view('cruds.fund-accounts.index', compact('fundAccounts'));
    }

    public function show(FundAccount $fundAccount)
    {
        return view('cruds.fund-accounts.show', compact('fundAccount'));
    }

    public function showAll(AdminLoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return view('cruds.fund-accounts.show-all');
    }

}
