<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activo extends Model
{
    use HasFactory;

    protected $table = 'activos';

    protected $fillable = [
        'equipo_id',
        'lote_id',
        'numero_serie',
        'placa_inventario',
        'estado',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }

    public function lote(): BelongsTo
    {
        return $this->belongsTo(Lote::class, 'lote_id');
    }

    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class, 'activo_id');
    }

    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class, 'activo_id');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class, 'activo_id');
    }
}
