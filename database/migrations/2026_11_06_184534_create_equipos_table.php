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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('codigo');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->text('especificaciones')->nullable();
            $table->string('codigo_barras')->nullable();
            $table->integer('garantia_dias')->default(0);
            $table->boolean('maneja_serial')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
