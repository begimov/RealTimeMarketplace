<?php

namespace App\Http\Controllers\Webapi\Admin;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function update(Request $request)
    {
        $account = $request->user()->account;

        $account->amount += $request->amount;

        $account->save();

        return $account->amount;

    }
}
