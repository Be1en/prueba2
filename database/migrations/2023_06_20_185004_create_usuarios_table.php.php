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
            Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 30)->unique();
            $table->string('password', 100);
            $table->string('token', 40)->nullable();
            $table->string('token_password', 100)->nullable();
            $table->integer('password_request')->default(0);
            $table->unsignedBigInteger('id_cliente');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
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
