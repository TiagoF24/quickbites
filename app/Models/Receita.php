<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    /** @use HasFactory<\Database\Factories\ReceitaFactory> */
    use HasFactory;

    // No modelo Receita.php
    protected $fillable = [
        'receita_titulo',
        'receita_descricao',
        'receita_foto',
        'receita_duracao',
        'porcoes',
        'nivel_dificuldade',
        'calorias',
        'categoria',
        'ingredientes',
        'modo_preparo',
        'dicas',
        'autor',
    ];
}
