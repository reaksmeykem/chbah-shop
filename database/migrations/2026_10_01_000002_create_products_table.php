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
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline');
            $table->text('description');
            $table->unsignedInteger('price_cents');
            $table->string('image');                       // svg under public/images/products
            $table->string('badge')->nullable();           // New | Bestseller
            $table->boolean('featured')->default(false);
            $table->string('version')->default('1.0');
            $table->string('requirements');                // e.g. "Windows 10/11 · 64-bit"
            $table->string('download_url')->nullable();    // installer/trial link
            $table->json('features');                      // feature bullets
            $table->string('key_prefix');                  // license key prefix, e.g. PCPD
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
