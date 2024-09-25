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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 8)->primary()->unique();
            $table->string('name');
            $table->string('business_id', 8);
            $table->foreign('business_id')->references('id')->on('businesses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_type_id')->constrained('product_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
