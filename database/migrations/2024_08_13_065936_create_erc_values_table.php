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
        Schema::create('erc_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('value_id')->index();
            $table->foreign('value_id')->references('id')->on('value_attributes');
            $table->integer('erc')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erc_values');
    }
};
