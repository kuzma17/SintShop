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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('code', 100)->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->index();
            $table->integer('min_order')->default(1);
            $table->string('slug', 255)->index()->unique();
            $table->string('title_ru', 255)->nullable();
            $table->string('title_ua', 255)->nullable();
            $table->string('description_ru', 255)->nullable();
            $table->string('description_ua', 255)->nullable();
            $table->integer('active')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
