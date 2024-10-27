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
        Schema::create('good_value_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('good_id');
            $table->unsignedBigInteger('value_attribute_id');
            $table->foreign('good_id')->references('id')->on('goods')->onDelete('cascade');
            $table->foreign('value_attribute_id')->references('id')->on('value_attributes')->onDelete('cascade');
            $table->primary(['good_id','value_attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_value_attribute');
    }
};
