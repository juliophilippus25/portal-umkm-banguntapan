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
        Schema::create('businesses', function (Blueprint $table) {
            $table->string('id', 8);
            $table->string('user_id', 8);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('business_name');
            $table->string('business_description');
            $table->foreignId('business_type_id')->constrained('business_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sub_district_id')->constrained('sub_districts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('phone');
            $table->string('website');
            $table->string('no_pirt');
            $table->string('address');
            // $table->string('net_worth');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
