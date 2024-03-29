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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_insured')->default(false);
            $table->string('status');
            $table->enum('creator_type',['admin','patient','doctor','pharmacy']);
            $table->integer('pharmacy_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('patient_id');
            $table->integer('patient_address_id');
            $table->double('price');
            $table->integer('area_id')->nullable();
            $table->timestamps();
        });
    }


};
