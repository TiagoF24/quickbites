<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verifique se a tabela já existe antes de tentar modificá-la
        if (Schema::hasTable('ratings')) {
            Schema::table('ratings', function (Blueprint $table) {
                // Adicione aqui apenas as novas colunas, não inclua 'id'
                // Por exemplo:
                // $table->text('additional_field')->nullable();
            });
        }
    }
    
    public function down(): void
    {
        // Se você adicionou novas colunas, remova-as aqui
        if (Schema::hasTable('ratings')) {
            Schema::table('ratings', function (Blueprint $table) {
                // $table->dropColumn('additional_field');
            });
        }
    }
    
};
