<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('gift_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('amount_cents');
            $table->timestamps();

            $table->index('gift_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_items');
    }
};
