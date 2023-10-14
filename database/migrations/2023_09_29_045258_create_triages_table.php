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
        Schema::create('triages', function (Blueprint $table) {
            $table->id();
            $table->string('presionArterial', 15);
            $table->mediumInteger('temperatura');
            $table->string('frecuenciaRespiratoria', 15);
            $table->string('frecuenciaCardiaca', 15);
            $table->string('saturacion', 15);
            $table->mediumInteger('peso')->nullable();
            $table->mediumInteger('talla')->nullable();
            $table->double('imc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triages');
    }
};
