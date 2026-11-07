<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consumible extends Model
{
    use HasFactory;

    protected $table = 'consumibles';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'codigo',
        'marca',
        'modelo',
        'codigo_barras',
        'descripcion',
        'stock_actual',
        'stock_minimo',
        'stock_maximo',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'consumible_id');
    }
}
