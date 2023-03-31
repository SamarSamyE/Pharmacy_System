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
        Schema::create('patient_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('area_id');
            $table->string('street_name');
            $table->integer('build_number');
            $table->integer('floor_number');
            $table->integer('flat_number');
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });
    }


};
