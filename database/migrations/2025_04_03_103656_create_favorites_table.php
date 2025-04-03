<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('receita_id')->constrained('receitas')->onDelete('cascade');
            $table->timestamps();

            // Ensure a user can only favorite a recipe once
            $table->unique(['user_id', 'receita_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
