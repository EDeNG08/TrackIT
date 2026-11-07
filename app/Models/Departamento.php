<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo_area',
        'responsable_area',
        'estado_area',
    ];

    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class, 'departamento_id');
    }
}
