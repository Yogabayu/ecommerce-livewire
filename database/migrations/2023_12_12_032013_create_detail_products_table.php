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
            $table->longText('address');
            $table->longText('long_desc');
            $table->longText('gmaps')->nullable();
            $table->enum('type_sales', [1, 2])->comment('jenis penjualan. 1: lelang, 2: jual langsung');
            $table->integer('seeing_count')->nullable();
            $table->integer('share_count')->nullable();
            $table->string('after_sale')->nullable();
            $table->string('no_pic')->comment('nomor whatsapp dari pic bank arthaya');
            $table->string('sup_doc')->nullable()->comment('support document');
            $table->string('surface_area')->nullable();
            $table->string('building_area')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('floors')->nullable();
            $table->string('certificate')->nullable();
            $table->string('garage')->nullable();
            $table->string('electrical_power')->nullable();
            $table->string('building_year')->nullable();

            $table->string('chassis_number')->nullable();
            $table->string('machine_number')->nullable();
            $table->string('brand')->nullable();
            $table->string('series')->nullable();
            $table->string('kilometers')->nullable();
            $table->string('cc')->nullable();
            $table->string('type')->nullable();
            $table->string('color')->nullable();
            $table->string('transmission')->nullable();
            $table->string('vehicle_year')->nullable();
            $table->string('date_stnk')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
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
