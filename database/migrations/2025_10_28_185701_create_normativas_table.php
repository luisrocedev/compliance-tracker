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
        Schema::create('normativas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->string('area', 50);
            $table->string('numero_documento');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->enum('estado', ['vigente', 'por_vencer', 'vencido', 'en_renovacion']);
            $table->string('entidad_emisora');
            $table->unsignedBigInteger('responsable_id');
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normativas');
    }
};
