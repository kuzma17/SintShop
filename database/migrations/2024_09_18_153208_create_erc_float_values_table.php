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
        Schema::create('erc_float_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attribute_id')->index();
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->float('erc_value')->index();
            $table->unsignedBigInteger('value_id')->index();
            $table->foreign('value_id')->references('id')->on('value_attributes');
            $table->unsignedBigInteger('filter_value_id')->index()->nullable();
            $table->foreign('filter_value_id')->references('id')->on('value_attributes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erc_float_values');
    }
};
