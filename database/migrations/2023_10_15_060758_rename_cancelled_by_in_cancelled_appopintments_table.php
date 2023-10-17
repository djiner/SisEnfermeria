<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cancelled_appointments', function (Blueprint $table) {
            $table->renameColumn('cancelled_by', 'cancelled_by_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cancelled_appointments', function (Blueprint $table) {
            $table->renameColumn('cancelled_by_id', 'cancelled_by');
        });
    }
};
