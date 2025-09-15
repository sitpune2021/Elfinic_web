<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');

        // Relationship with categories
        $table->string('category_id')->nullable();
        $table->string('sku')->unique();
        $table->string('barcode')->nullable();
        $table->string('image')->nullable(); // single main image
        $table->json('product_options')->nullable(); // flexible options like size/color

        $table->text('description')->nullable();
        $table->string('price', 20); // varchar(20)
        $table->string('discount_price', 20)->nullable();
        $table->integer('quantity')->default(0);
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
        $table->softDeletes();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

