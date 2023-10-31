<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Subcategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 80);
            $table->string('article', 80);
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('brand', 80)->nullable();
            $table->text('tags')->nullable();
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Subcategory::class);
            $table->string('TNVED', 80)->nullable();
            $table->string('color', 80)->nullable();
            $table->json('extra_fileds')->nullable();
            $table->json('bardoc')->nullable();
            $table->json('sizes')->nullable();
            $table->json('docs')->nullable();
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
