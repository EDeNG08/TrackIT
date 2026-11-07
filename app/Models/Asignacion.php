<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asignacion extends Model
{
    //
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'activo_id',
        'empleado_id',
        'fecha_asignacion',
        'fecha_devolucion',
        'motivo',
    ];

    public function activo(): BelongsTo
    {
        return $this->belongsTo(Activo::class, 'activo_id');
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
