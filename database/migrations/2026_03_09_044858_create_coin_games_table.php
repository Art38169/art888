<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coin_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('pick', ['heads', 'tails']);
            $table->enum('outcome', ['heads', 'tails']);
            $table->boolean('won');
            $table->integer('wager');
            $table->integer('payout');
            $table->integer('credits_after');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coin_games');
    }
};
