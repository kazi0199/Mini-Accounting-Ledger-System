<?php

namespace App\Services;

use App\Models\{Account, Transaction};

class LedgerService
{

    public function updateBalance(Transaction $transaction)
    {
        $account = $transaction->account;

        if ($transaction->type === 'debit') 
        {
            $account->balance += $transaction->amount;
        } 
        elseif ($transaction->type === 'credit')
        {
            $account->balance -= $transaction->amount;
        }

        $account->save();
    }


    public function storeTransitionWeb($accountId, $type, $amount, $note)
    {
        $transition = Transaction::create([
            'account_id' => $accountId,
            'type' => $type,
            'amount' => $amount,
            'note' => $note,
        ]);

        $this->updateBalance($transition);

        return $transition;

    }

}









