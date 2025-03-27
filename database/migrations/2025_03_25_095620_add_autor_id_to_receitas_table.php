<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the column doesn't already exist
        if (!Schema::hasColumn('receitas', 'autor_id')) {
            Schema::table('receitas', function (Blueprint $table) {
                $table->foreignId('autor_id')
                      ->nullable()
                      ->constrained('users')
                      ->onDelete('set null');
            });
        }

        // Only run update if the column exists and is nullable
        if (Schema::hasColumn('receitas', 'autor_id')) {
            try {
                DB::statement('
                    UPDATE receitas r
                    JOIN users u ON r.autor = u.name
                    SET r.autor_id = u.id
                    WHERE r.autor_id IS NULL
                ');
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                \Log::error('Failed to update autor_id: ' . $e->getMessage());
            }
        }
    }

    public function down(): void
    {
        Schema::table('receitas', function (Blueprint $table) {
            if (Schema::hasColumn('receitas', 'autor_id')) {
                $table->dropForeign(['autor_id']);
                $table->dropColumn('autor_id');
            }
        });
    }
};
