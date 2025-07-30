<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'rating'];

    public function movie(): BelongsTo {
        return $this->belongsTo(Movie::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
