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
        Schema::create('access_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->boolean('hospital')->nullable();
            $table->boolean('school')->nullable();
            $table->boolean('bank')->nullable();
            $table->boolean('market')->nullable();
            $table->boolean('house_of_worship')->nullable();
            $table->boolean('cinema')->nullable();
            $table->boolean('halte')->nullable();
            $table->boolean('airport')->nullable();
            $table->boolean('toll')->nullable();
            $table->boolean('mall')->nullable();
            $table->boolean('park')->nullable();
            $table->boolean('pharmacy')->nullable();
            $table->boolean('restaurant')->nullable();
            $table->boolean('station')->nullable();
            $table->boolean('gas_station')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_products');
    }
};
