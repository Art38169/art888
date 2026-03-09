<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserPageController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();

        $transactions = $user->transactions()
            ->with('game')
            ->latest()
            ->paginate(20);

        $stats = [
            'dice_played' => $user->diceGames()->count(),
            'dice_won' => $user->diceGames()->where('won', true)->count(),
            'coin_played' => $user->coinGames()->count(),
            'coin_won' => $user->coinGames()->where('won', true)->count(),
            'total_wagered' => $user->transactions()->where('type', 'wager')->sum('amount') * -1,
            'total_won' => $user->transactions()->where('type', 'payout')->sum('amount'),
        ];

        return view('user.profile', compact('user', 'transactions', 'stats'));
    }
}
