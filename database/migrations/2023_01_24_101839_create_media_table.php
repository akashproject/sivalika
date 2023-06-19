<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type",20);
            $table->string("filename");
            $table->string("alternative");
            $table->string("caption");
            $table->text("description");
            $table->string("extension",50);
            $table->string("size",50);
            $table->string("dimension",50);
            $table->text("path");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
};
