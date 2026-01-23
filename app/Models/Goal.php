<?php

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

    protected $casts = [
        'deadline' => 'date',
    ];

    public function progress()
    {
        if ($this->target_amount == 0) return 0;
        return min(100, round(($this->current_amount / $this->target_amount) * 100));
    }
}
