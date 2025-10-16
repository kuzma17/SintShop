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
        Schema::create('seo_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seoable_id')->nullable();
            $table->string('seoable_type')->nullable();
            $table->string('route')->nullable();
            $table->string('meta_title_ru');
            $table->string('meta_title_ua');
            $table->string('meta_description_ru')->nullable();
            $table->string('meta_description_ua')->nullable();
            $table->string('meta_keywords_ru')->nullable();
            $table->string('meta_keywords_ua')->nullable();
            $table->string('og_title_ru')->nullable();
            $table->string('og_title_ua')->nullable();
            $table->string('og_description_ru')->nullable();
            $table->string('og_description_ua')->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('noindex')->default(false);
            $table->timestamps();

            $table->index(['seoable_id', 'seoable_type']);
            $table->unique(['seoable_id', 'seoable_type']);
            $table->unique(['route']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_meta');
    }
};
