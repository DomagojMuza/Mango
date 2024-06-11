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
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->integer('site_id');
            $table->enum('parent_type', ['product', 'product_item']);
            $table->enum('type', ['title', 'small_description', 'long_description', 'seo_title', 'seo_description']);
            $table->string('language');
            $table->string('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary');
    }
};
