<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Mail\LedgerMail;
use App\Models\{Account, Transaction};
use Illuminate\Support\Facades\Mail;

class LedgerController extends Controller
{
    public function addForm()
    {
        $accounts = Account::all();

        return view('ledger.add',compact('accounts'));
    }

    public function storeTransition(TransactionRequest $request)
    {
        app('ledger')->storeTransitionWeb(
            $request->account_id,
            $request->type,
            $request->amount,
            $request->note,
        );

        return redirect()->back()->with('success','Transaction added successfully');
    }

    public function transitionHistory($id)
    {
        $account = Account::with('transactions')->find($id);

        $transactions = $account->transactions()
        ->orderBy('created_at')
        ->get();

        return view('ledger.history',compact('account','transactions'));
    }

    public function sendLedgerEmail($accountId)
    {
        $account = Account::find($accountId);

        $transactions = Transaction::where('account_id',$accountId)
        ->orderBy('created_at','asc')
        ->get();

        Mail::to('mahmudmunna243@gmail.com')->send(new LedgerMail($account, $transactions));

        return back()->with('success','Report send successfully');
    }
}
