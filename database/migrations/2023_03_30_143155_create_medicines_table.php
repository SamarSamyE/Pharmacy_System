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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->double('price');
            $table->integer('quantity');
            $table->timestamps();
            $table -> boolean('is_deleted')->default(false);
        });
    }


};
