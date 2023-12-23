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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category_code')->unique()->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_trending')->default(0);
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
