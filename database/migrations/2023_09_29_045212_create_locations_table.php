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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100);
            $table->decimal('Latitud', 9, 6);
            $table->decimal('Longitud', 9, 6);
            $table->string('direccion', 200);
            $table->string('zona', 50);
            $table->char('numeroCasa', 10)->nullable();
            $table->string('calle', 50);
            $table->mediumInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
