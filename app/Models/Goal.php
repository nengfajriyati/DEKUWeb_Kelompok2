<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'target_amount',
        'current_amount',
        'deadline',
    ];

    // hitung progress (%)
    public function progress()
    {
        if ($this->target_amount == 0) return 0;
        return round(($this->current_amount / $this->target_amount) * 100);
    }
}

