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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->string('id', 8)->primary()->unique();
            $table->string('name');
            $table->date('ad_start');
            $table->date('ad_end');
            $table->string('business_id', 8);
            $table->foreign('business_id')->references('id')->on('businesses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('product_id', 8);
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
