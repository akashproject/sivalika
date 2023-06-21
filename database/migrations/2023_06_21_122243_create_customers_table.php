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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('email',50)->nullable();
            $table->string('mobile',50);
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'undisclosed'])->default('undisclosed');
            $table->enum('marital_status', ['married', 'unmarried', 'undisclosed'])->default('undisclosed');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
