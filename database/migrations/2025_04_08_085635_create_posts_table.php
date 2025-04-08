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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->index()->unique();
            $table->string('name_ru', 255);
            $table->string('name_ua', 255);
            $table->string('title_ru', 255)->nullable();
            $table->string('title_ua', 255)->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_ua')->nullable();
            $table->string('keywords_ru', 255)->nullable();
            $table->string('keywords_ua', 255)->nullable();
            $table->text('content_ru');
            $table->text('content_ua');
            $table->string('image')->nullable();
            $table->integer('callback')->index();
            $table->integer('active')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
