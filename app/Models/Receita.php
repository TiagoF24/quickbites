<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    /** @use HasFactory<\Database\Factories\ReceitaFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'video',
        'categoria',
        'tempo',
        'ingredientes',
    ];
}
