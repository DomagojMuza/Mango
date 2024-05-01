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
        Schema::create('pricelist_item', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_in', total: 15, places: 2)->nullable();
            $table->decimal('price', total: 15, places: 2)->nullable();
            $table->integer('precent')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('status', ['request','buy'])->nullable();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_item_id')->constrained();
            $table->foreignId('pricelist_item_type')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricelist_item');
    }
};
