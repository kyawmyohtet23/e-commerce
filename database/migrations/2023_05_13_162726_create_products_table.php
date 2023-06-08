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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('image');
            $table->integer('discount_price');
            $table->integer('buy_price');
            $table->integer('sale_price');
            $table->integer('total_quantity');
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->longText('description');
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
