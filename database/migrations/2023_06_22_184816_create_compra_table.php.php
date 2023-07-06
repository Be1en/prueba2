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
            Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaccion', 20);
            $table->datetime('fecha');
            $table->string('status', 20);
            $table->string('email', 50);
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
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
