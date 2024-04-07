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
        Schema::create('vendor_business_details', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('store_name')->unique();
            $table->string('store_address');
            $table->string('store_city');
            $table->string('store_state');
            $table->string('store_country');
            $table->string('store_pincode');
            $table->string('store_mobile');
            $table->string('store_website')->unique();
            $table->string('store_email');
            $table->string('store_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_business_details');
    }
};
