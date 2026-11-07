<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumible_id')->constrained('consumibles')->onDelete('cascade')->nullable();
            $table->foreignId('activo_id')->constrained('activos')->onDelete('cascade')->nullable();
            $table->foreignId('departamento_origen_id')->constrained('departamentos')->onDelete('cascade')->nullable();
            $table->foreignId('empleado_origen_id')->constrained('empleados')->onDelete('cascade')->nullable();
            $table->foreignId('departamento_destino_id')->constrained('departamentos')->onDelete('cascade')->nullable();
            $table->foreignId('empleado_destino_id')->constrained('empleados')->onDelete('cascade')->nullable();
            $table->enum('tipo_movimiento', ['Entrada', 'Salida', 'Traslado', 'Mantenimiento', 'Baja'])->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
