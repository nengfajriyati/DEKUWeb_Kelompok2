<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'amount',
        'date',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
