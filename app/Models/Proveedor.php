<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'rif',
        'nombre_empresa',
        'nombre_contacto',
        'telefono',
        'email',
        'direccion',
        'estado',
    ];

    public function lotes(): HasMany
    {
        return $this->hasMany(Lote::class, 'proveedor_id');
    }
}
