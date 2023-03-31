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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // $table->string('avatar')->default('avatar.png');
            $table->string('avatar')->nullable();

            $table->string('typeable_type')->nullable();
            // we will discuss it
            $table->integer('typeable_id')->unsigned()->nullable();
            // // this is using index
            // $table->index(['role_type', 'role_id']);
            // $table -> boolean('is_deleted')->default(false);
            $table->index(['typeable_type', 'typeable_id']);
        });
    }


};
