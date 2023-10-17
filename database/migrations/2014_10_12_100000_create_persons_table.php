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
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('imagen');
            $table->string('nombres', 50);
            $table->string('primer_Apellido', 80)->required();
            $table->string('segundo_Apellido', 80)->required();
            $table->string('ci', 15);
            $table->date('fecha_Nacimiento');
            $table->char('sexo', 1);
            $table->string('direccion', 100);
            $table->string('celular', 12);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
