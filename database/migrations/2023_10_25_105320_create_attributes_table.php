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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('slug')->index();
            $table->unsignedBigInteger('type_id')->index();
            $table->foreign('type_id')->references('id')->on('type_attributes');
            $table->integer('filter');
            $table->string('name_ru');
            $table->string('name_ua');
            $table->string('format');
            $table->integer('active')->default(1);
            $table->integer('erc')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
