<?php

namespace App\Http\Controllers;

use App\Models\CoinGame;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoinGameController extends Controller
{
    public function play(Request $request): JsonResponse
    {
        $request->validate([
            'pick' => 'required|in:heads,tails',
            'wager' => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $wager = $request->integer('wager');

        if ($wager > $user->credits) {
            return response()->json(['error' => 'Insufficient credits'], 422);
        }

        $outcome = random_int(0, 1) === 0 ? 'heads' : 'tails';
        $pick = $request->string('pick')->toString();
        $won = $outcome === $pick;
        $payout = $won ? $wager * 2 : 0;

        $user->credits += $payout - $wager;
        $user->save();

        $game = CoinGame::create([
            'user_id' => $user->id,
            'pick' => $pick,
            'outcome' => $outcome,
            'won' => $won,
            'wager' => $wager,
            'payout' => $payout,
            'credits_after' => $user->credits,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'game_type' => CoinGame::class,
            'game_id' => $game->id,
            'type' => 'wager',
            'amount' => -$wager,
            'balance_after' => $user->credits + ($won ? -$payout + $wager : 0),
        ]);

        if ($won) {
            Transaction::create([
                'user_id' => $user->id,
                'game_type' => CoinGame::class,
                'game_id' => $game->id,
                'type' => 'payout',
                'amount' => $payout,
                'balance_after' => $user->credits,
            ]);
        }

        return response()->json([
            'outcome' => $outcome,
            'won' => $won,
            'payout' => $payout,
            'wager' => $wager,
            'credits' => $user->credits,
        ]);
    }
}
