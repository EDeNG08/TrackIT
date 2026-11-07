<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lote extends Model
{
    //
    use HasFactory;

    protected $table = 'lotes';

    protected $fillable = [
        'equipo_id',
        'proveedor_id',
        'codigo_lote',
        'fecha_entrada',
        'cantidad_inicial',
        'cantidad_actual',
        'costo_unitario',
        'observaciones',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function activos(): HasMany
    {
        return $this->hasMany(Activo::class, 'lote_id');
    }
}
