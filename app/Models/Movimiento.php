<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    protected $fillable = [
        'consumible_id',
        'activo_id',
        'departamento_origen_id',
        'empleado_origen_id',
        'departamento_destino_id',
        'empleado_destino_id',
        'tipo_movimiento',
        'observaciones',
    ];

    public function consumible(): BelongsTo
    {
        return $this->belongsTo(Consumible::class, 'consumible_id');
    }

    public function activo(): BelongsTo
    {
        return $this->belongsTo(Activo::class, 'activo_id');
    }

    public function departamentoOrigen(): BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'departamento_origen_id');
    }

    public function empleadoOrigen(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_origen_id');
    }

    public function departamentoDestino(): BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'departamento_destino_id');
    }

    public function empleadoDestino(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_destino_id');
    }
}
