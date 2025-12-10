<?php

namespace App\Observers;

use App\Models\Income;
use App\Models\Wallet;

class IncomeObserver
{
    /**
     * Handle the Income "created" event.
     */
    public function created(Income $income): void
    {
        $wallet = $income->wallet;
        if ($wallet) {
            $wallet->balance += $income->amount;
            $wallet->save();
        }
    }

    /**
     * Handle the Income "updated" event.
     */
    public function updated(Income $income): void
    {
        // Dapatkan nilai original sebelum update
        $originalAmount = $income->getOriginal('amount');
        $originalWalletId = $income->getOriginal('wallet_id');

        // Jika dompet tidak berubah, hanya sesuaikan selisihnya
        if ($originalWalletId == $income->wallet_id) {
            $wallet = $income->wallet;
            $difference = $income->amount - $originalAmount;
            $wallet->balance += $difference;
            $wallet->save();
        } else {
            // Jika dompet berubah, kembalikan saldo dompet lama
            $originalWallet = Wallet::find($originalWalletId);
            if ($originalWallet) {
                $originalWallet->balance -= $originalAmount;
                $originalWallet->save();
            }

            // Tambahkan saldo ke dompet baru
            $newWallet = $income->wallet;
            $newWallet->balance += $income->amount;
            $newWallet->save();
        }
    }

    /**
     * Handle the Income "deleted" event.
     */
    public function deleted(Income $income): void
    {
        $wallet = $income->wallet;
        if ($wallet) {
            $wallet->balance -= $income->amount;
            $wallet->save();
        }
    }
}