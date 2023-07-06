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
        Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombres', 80);
        $table->string('apellidos', 80);
        $table->string('email', 50)->unique();;
        $table->string('telefono', 20);
        $table->string('dni', 20);
        $table->tinyInteger('estatus')->default(0);
        $table->datetime('fecha_alta')->nullable();;
        $table->datetime('fecha_modificada')->nullable();
        $table->datetime('fecha_baja')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
