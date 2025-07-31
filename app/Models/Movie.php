<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'duration',
        'url_720',
        'url_1080',
        'url_4k',

    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function categories() : BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function ratings() : HasMany {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute(): float {
        return $this->ratings()->avg('rating');
    }

    public function getStreamingUrl(string $planResolution): string {
        return match ($planResolution) {
            '720p' => $this->url_720,
            '1080p' => $this->url_1080,
            '4k' => $this->url_4k,
            default => $this->url_720,
        };
    }
    public function getFormattedDurationAttribute() {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        $formatted = '';
        if ($hours > 0) {
            $formatted .= $hours . 'h';
        }
        if ($minutes > 0) {
            $formatted .= $minutes . 'min';
        }
        if ($formatted === '') {
            return 'N/A';
        } else {
            return trim($formatted);
        }
    }
}
