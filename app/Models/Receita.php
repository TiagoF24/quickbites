<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $receita_titulo
 * @property string $receita_descricao
 * @property string|null $receita_foto
 * @property int $receita_duracao
 * @property int $porcoes
 * @property string $nivel_dificuldade
 * @property int|null $calorias
 * @property string $categoria
 * @property string $ingredientes
 * @property string $modo_preparo
 * @property string|null $dicas
 * @property string $autor
 * @property int $autor_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read User $autorRelation
 */
class Receita extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
        'autor_id',
    ];

    /**
     * Get the author associated with the recipe.
     */
    public function autorRelation()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    /**
     * Getter for author name.
     *
     * @return string|null
     */
    public function getAutorAttribute(): ?string
    {
        return $this->attributes['autor'] ?? null;
    }

    /**
     * Setter for author name.
     *
     * @param string $value
     * @return void
     */
    public function setAutorAttribute(?string $value): void
    {
        $this->attributes['autor'] = $value;
    }
}
