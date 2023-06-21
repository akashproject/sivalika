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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id');
            $table->integer('user_id')->nullable();
            $table->string('guest_name',50)->nullable();
            $table->string('guest_mobile',20)->nullable();
            $table->integer('total_guest')->nullable();
            $table->text('rooms')->nullable();
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
            $table->string('order_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->enum('payment', ['success', 'pending', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
