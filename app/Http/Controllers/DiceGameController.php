<?php

namespace App\Http\Controllers;

use App\Models\DiceGame;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiceGameController extends Controller
{
    public function play(Request $request): JsonResponse
    {
        $request->validate([
            'pick' => 'required|in:under,exact,over',
            'wager' => 'required|integer|min:1',
        ]);

        $user = $request->user();
        $wager = $request->integer('wager');

        if ($wager > $user->credits) {
            return response()->json(['error' => 'Insufficient credits'], 422);
        }

        $die1 = random_int(1, 6);
        $die2 = random_int(1, 6);
        $total = $die1 + $die2;

        if ($total < 7) {
            $outcome = 'under';
        } elseif ($total === 7) {
            $outcome = 'exact';
        } else {
            $outcome = 'over';
        }

        $pick = $request->string('pick');
        $won = $outcome === $pick->toString();
        $multiplier = $pick->toString() === 'exact' ? 5 : 2;
        $payout = $won ? $wager * $multiplier : 0;

        $user->credits += $payout - $wager;
        $user->save();

        $game = DiceGame::create([
            'user_id' => $user->id,
            'die_1' => $die1,
            'die_2' => $die2,
            'total' => $total,
            'pick' => $pick,
            'outcome' => $outcome,
            'won' => $won,
            'wager' => $wager,
            'payout' => $payout,
            'credits_after' => $user->credits,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'game_type' => DiceGame::class,
            'game_id' => $game->id,
            'type' => 'wager',
            'amount' => -$wager,
            'balance_after' => $user->credits + ($won ? -$payout + $wager : 0),
        ]);

        if ($won) {
            Transaction::create([
                'user_id' => $user->id,
                'game_type' => DiceGame::class,
                'game_id' => $game->id,
                'type' => 'payout',
                'amount' => $payout,
                'balance_after' => $user->credits,
            ]);
        }

        return response()->json([
            'die_1' => $die1,
            'die_2' => $die2,
            'total' => $total,
            'outcome' => $outcome,
            'won' => $won,
            'payout' => $payout,
            'wager' => $wager,
            'credits' => $user->credits,
        ]);
    }
}
