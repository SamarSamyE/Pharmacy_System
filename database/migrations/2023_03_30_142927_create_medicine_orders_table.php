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
        Schema::create('medicine_orders', function (Blueprint $table) {
            $table->integer('quantity');
            $table->integer('order_id');
            $table->integer('medicine_id');
            $table->primary(['order_id', 'medicine_id']);
            $table->timestamps();

        });
    }


};
