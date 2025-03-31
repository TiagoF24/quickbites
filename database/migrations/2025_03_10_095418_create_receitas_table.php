<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Remove the separate 'autor' column since we have a foreign key
            $table->unsignedBigInteger('autor_id')->nullable();
            $table->foreign('autor_id')->references('id')->on('users')->onDelete('set null');

            $table->string('receita_titulo');
            $table->text('receita_descricao');
            $table->string('receita_foto');
            $table->string('categoria');
            $table->string('receita_duracao');

            // Novas colunas para detalhes da receita
            $table->text('ingredientes')->nullable(); // Lista de ingredientes
            $table->text('modo_preparo')->nullable(); // Passos de preparação
            $table->integer('porcoes')->nullable(); // Número de porções
            $table->string('nivel_dificuldade', 50)->nullable(); // Nível de dificuldade (fácil, médio, difícil)
            $table->text('dicas')->nullable(); // Dicas adicionais
            $table->string('tempo_preparo', 50)->nullable(); // Tempo de preparação
            $table->string('tempo_cozimento', 50)->nullable(); // Tempo de cozimento
            $table->integer('calorias')->nullable(); // Calorias por porção
            $table->string('autor', 50);
            
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};
