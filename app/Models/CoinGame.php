<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CoinGame extends Model
{
    protected $fillable = [
        'user_id',
        'pick',
        'outcome',
        'won',
        'wager',
        'payout',
        'credits_after',
    ];

    protected function casts(): array
    {
        return [
            'won' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'game');
    }
}
