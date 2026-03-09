<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dice_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('die_1');
            $table->unsignedTinyInteger('die_2');
            $table->unsignedTinyInteger('total');
            $table->enum('pick', ['under', 'exact', 'over']);
            $table->enum('outcome', ['under', 'exact', 'over']);
            $table->boolean('won');
            $table->integer('wager');
            $table->integer('payout');
            $table->integer('credits_after');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dice_games');
    }
};
