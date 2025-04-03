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

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
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

    // Add these relationships to the Receita model

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'receita_id');
    }

    // Método para obter a avaliação média
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'receita_id', 'user_id')->withTimestamps();
    }



    // Method to check if user has favorited this recipe
    public function isFavoritedByUser($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    // Method to get user's rating for this recipe
    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }
}