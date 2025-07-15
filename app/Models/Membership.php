<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'active',
        'start_date',
        'end_date'
    ];

    public function plan():BelongsTo {
        return $this->belongsTo(Membership::class);
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
