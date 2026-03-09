<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiceGame extends Model
{
    protected $fillable = [
        'user_id',
        'die_1',
        'die_2',
        'total',
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
