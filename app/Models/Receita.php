<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    /** @use HasFactory<\Database\Factories\ReceitaFactory> */
    use HasFactory;

    protected $fillable = [
        'receita_titulo',
        'receita_descricao',
        'receita_foto',
        'categoria',
        'receita_duracao',
    ];
}
