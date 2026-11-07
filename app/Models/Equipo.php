<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'codigo',
        'marca', 
        'modelo',
        'especificaciones',
        'codigo_barras',
        'garantia_dias',
        'maneja_serial',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class, 'equipo_id');
    }

    public function activos(): HasMany
    {
        return $this->hasMany(Activo::class, 'equipo_id');
    }
}
