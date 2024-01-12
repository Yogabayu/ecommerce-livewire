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
        Schema::create('facilities_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->boolean('furnished')->nullable();
            $table->boolean('swimming_pool')->nullable();
            $table->boolean('lift')->nullable();
            $table->boolean('gym')->nullable();
            $table->boolean('carport')->nullable();
            $table->boolean('telephone')->nullable();
            $table->boolean('security')->nullable();
            $table->boolean('garage')->nullable();
            $table->boolean('park')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_facilities_tables');
    }
};
