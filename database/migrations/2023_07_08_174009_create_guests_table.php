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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('mobile',20);
            $table->string('perpose');
            $table->string('identity_image');
            $table->string('identity_no');
            $table->text('address');
            $table->text('state_id');
            $table->text('city_id');
            $table->text('pincode');
            $table->text('nationality');
            $table->string('dob',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
