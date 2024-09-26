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
            $table->string('id', 8)->primary()->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('nik')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('isActive')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verified_by', 8)->nullable();
            $table->foreign('verified_by')->references('id')->on('admins')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};