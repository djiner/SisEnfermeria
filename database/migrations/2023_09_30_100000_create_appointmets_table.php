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

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            // fk specialty
            $table->unsignedBigInteger('specialties_id');
            $table->foreign('specialties_id')->references('id')->on('specialties');

            // fk nurses
            $table->unsignedBigInteger('nurses_id');
            $table->foreign('nurses_id')->references('id')->on('users');

            // fk patient
            $table->unsignedBigInteger('patients_id');
            $table->foreign('patients_id')->references('id')->on('users');

            $table->date('horario_date');
            $table->time('horario_time');

            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
