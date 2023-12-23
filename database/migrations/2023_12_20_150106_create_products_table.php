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
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subcategory_id')->constrained('sub_categories');
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('unit_id')->constrained('units');
            $table->longText('description')->nullable();
            $table->string("image")->nullable();
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('min_quantity')->nullable();
            $table->string('warranty')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_trending')->default(0);
            $table->tinyInteger('is_discounted')->default(0);
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
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
