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
            $table->tinyInteger('seller_id')->nullable();
            $table->tinyInteger('category_id')->nullable();
            $table->string('title');
            $table->string('thumbnail_image')->nullable();
            $table->string('unit_type')->nullable();
            $table->integer('min_order_qty')->default(1);
            $table->string('serial_number')->unique();
            $table->text('short_descriptions')->nullable();
            $table->text('descriptions')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('average_review', 2, 1)->nullable();
            $table->enum('original_or_copy', ['original', 'copy']);
            $table->boolean('is_inhouse_product')->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('meta_title')->nullable();
            $table->text('meta_descriptions')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('tags')->nullable();
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
