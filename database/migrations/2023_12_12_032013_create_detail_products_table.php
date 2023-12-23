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
            $table->char('province_code');
            $table->char('city_code');
            $table->longText('address');
            $table->longText('long_desc');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->longText('gmaps')->nullable();
            $table->string('surface_area')->nullable();
            $table->string('building_area')->nullable();
            $table->string('sup_doc')->nullable()->comment('support document');
            $table->enum('type_sales', [1, 2])->comment('jenis penjualan. 1: lelang, 2: jual langsung');
            $table->integer('seeing_count')->nullable();
            $table->integer('share_count')->nullable();
            $table->string('no_pic')->comment('nomor whatsapp dari pic bank arthaya');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
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
