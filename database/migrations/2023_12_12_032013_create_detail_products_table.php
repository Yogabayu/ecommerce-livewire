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
        Schema::create('detail_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->uuid('user_uuid');
            $table->char('province_code');
            $table->char('city_code');
            $table->string('spec');
            $table->longText('long_desc');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->enum('type_sales', [1, 2])->comment('jenis penjualan. 1: lelang, 2: jual langsung');
            $table->integer('seeing_count');
            $table->string('no_pic')->comment('nomor whatsapp dari pic bank arthaya'); 
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_uuid')->references('uuid')->on('users');
            $table->foreign('province_code')->references('code')->on('indonesia_provinces');
            $table->foreign('city_code')->references('code')->on('indonesia_cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_products');
    }
};
