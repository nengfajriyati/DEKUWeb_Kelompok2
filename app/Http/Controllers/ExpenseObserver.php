<?php

namespace App\Observers;

use App\Models\Expense;
use App\Models\Wallet;

class ExpenseObserver
{
    /**
     * Handle the Expense "created" event.
     */
    public function created(Expense $expense): void
    {
        $wallet = $expense->wallet;
        if ($wallet) {
            $wallet->balance -= $expense->amount;
            $wallet->save();
        }
    }

    /**
     * Handle the Expense "updated" event.
     */
    public function updated(Expense $expense): void
    {
        $originalAmount = $expense->getOriginal('amount');
        $originalWalletId = $expense->getOriginal('wallet_id');

        // Jika dompet tidak berubah
        if ($originalWalletId == $expense->wallet_id) {
            $wallet = $expense->wallet;
            $difference = $originalAmount - $expense->amount; // Kebalikan dari income
            $wallet->balance += $difference;
            $wallet->save();
        } else {
            // Jika dompet berubah, kembalikan saldo dompet lama
            $originalWallet = Wallet::find($originalWalletId);
            if ($originalWallet) {
                $originalWallet->balance += $originalAmount; // Tambah kembali
                $originalWallet->save();
            }

            // Kurangi saldo dari dompet baru
            $newWallet = $expense->wallet;
            $newWallet->balance -= $expense->amount;
            $newWallet->save();
        }
    }

    /**
     * Handle the Expense "deleted" event.
     */
    public function deleted(Expense $expense): void
    {
        $wallet = $expense->wallet;
        if ($wallet) {
            $wallet->balance += $expense->amount; // Tambah kembali
            $wallet->save();
        }
    }
}