<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
