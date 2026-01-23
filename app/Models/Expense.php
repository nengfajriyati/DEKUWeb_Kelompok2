<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'user_id',
        'wallet_id',
        'amount',
        'description',
        'created_at',
    ];

    // 🔥 INI KUNCINYA
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'date',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
