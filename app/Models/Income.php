<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',   // penting!
        'amount',
        'description',
    ];

    /**
     * Relasi ke Wallet
     * Income dimiliki oleh satu wallet
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
