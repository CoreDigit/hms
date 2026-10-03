<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
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

    public function showAll(Request $request)
    {
        return view('cruds.fund-accounts.show-all');
    }

}
