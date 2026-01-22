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
        'deadline'
    ];

    public function progress()
    {
        return min(100, round(($this->current_amount / $this->target_amount) * 100));
    }

    public function isNearDeadline()
    {
        return $this->deadline && now()->diffInDays($this->deadline, false) <= 3;
    }

}


