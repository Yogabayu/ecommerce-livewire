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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name_app');
            $table->string('address');
            $table->string('email');
            $table->string('logo');
            $table->string('main_tlp');
            $table->string('ig')->comment('berbentuk link');
            $table->string('fb')->comment('berbentuk link');
            $table->string('wa');
            $table->string('version');
            $table->string('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
