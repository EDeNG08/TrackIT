<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre', 
        'descripcion',
        'prefijo',
        'tipo'
    ];

    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class, 'category_id');
    }

    public function consumibles(): HasMany
    {
        return $this->hasMany(Consumible::class, 'categoria_id');
    }
}
