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
        Schema::create('pharmacies', function (Blueprint $table) {
                $table->id();
                $table->string('national_id')->unique();
                $table->integer('area_id');
                $table->integer('priority');
                $table -> boolean('deleted_at')->default(false);
                $table->timestamps();
        });
    }


};
