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
        Schema::create('patients', function (Blueprint $table) {

            $table->id();
            $table->string('national_id')->unique();
            $table->string('avatar')->nullable();
            $table->string('gender');
            $table->date('birth_date');
            $table->string('mobile');
            $table -> boolean('is_deleted')->default(false);
            $table->timestamps();

        });
    }


};
