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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id')->unique(); // Agrega una columna para la clave foránea
            $table->string('especialidad', 80)->require();
            $table->string('curriculoVitae', 200)->nullable();
            $table->string('carga_Horaria', 255);
            $table->timestamps();
            $table->softDeletes(); // Agregar eliminación lógica

            // Definición de la clave foránea
        $table->foreign('persona_id')->references('id')->on('persons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};
