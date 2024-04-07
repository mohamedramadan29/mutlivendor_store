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
            $table->id();
            $table->foreignId('section_id');
            $table->foreignId('category_id');
            $table->foreignId('brand_id');
            $table->foreignId('admin_id');
            $table->foreignId('vendor_id');

            $table->string('admin_type');
            $table->string('name');
            $table->string('code')->nullable();
            $table->double('price');
            $table->double('discount')->nullable();
            $table->text('description');
            $table->double('weight')->nullable();
            $table->string('image');
            $table->string('video')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_feature',['1','0']);
            $table->tinyInteger('status');
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
