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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->index()->unique();
            $table->string('name_ru', 255);
            $table->string('name_ua', 255);
            $table->string('title_ru', 255)->nullable();
            $table->string('title_ua', 255)->nullable();
            $table->text('content_ru');
            $table->text('content_ua');
            $table->string('description_ru', 255)->nullable();
            $table->string('description_ua', 255)->nullable();
            $table->string('keywords_ru', 255)->nullable();
            $table->string('keywords_ua', 255)->nullable();
            $table->integer('active')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
