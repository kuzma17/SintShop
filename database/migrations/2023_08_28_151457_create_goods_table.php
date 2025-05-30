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
            $table->unsignedBigInteger('vendor_id')->index();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->string('code', 100)->nullable()->index();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->index()->default(0);
            $table->string('slug', 255)->index()->unique();
            $table->string('title_ru', 255)->nullable();
            $table->string('title_ua', 255)->nullable();
            $table->text('description_ru', 255)->nullable();
            $table->text('description_ua', 255)->nullable();
            $table->integer('action')->default(0)->index();
            $table->boolean('sale')->default(0)->index();
            $table->integer('active')->index();
            $table->integer('erc')->index();
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
