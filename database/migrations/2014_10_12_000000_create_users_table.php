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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default(0)->index();
            $table->string('name');
            $table->string('login')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('delivery_id')->index();
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->unsignedBigInteger('payment_id')->index();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->string('delivery_address', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
