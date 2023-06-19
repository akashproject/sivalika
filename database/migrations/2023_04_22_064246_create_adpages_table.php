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
        Schema::create('adpages', function (Blueprint $table) {
            $table->id();
            $table->integer('course_type_id')->nullable();
            $table->integer('center_id')->nullable();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('slug');
            $table->string('banner_image')->nullable();
            $table->text('description')->nullable();    
            $table->string('template',50)->default('default-template');    
            $table->boolean('enable_otp')->default('1');
            $table->text('meta_description')->nullable();
            $table->text('schema')->nullable();
            $table->string('robots',150)->default('index, follow');           
            $table->string('canonical')->nullable();           
            $table->string('utm_campaign',100)->default('Google-Organic');
            $table->string('utm_source',100)->default('SEO');
            $table->enum('status', ['0', '1'])->default('1');  
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
        Schema::dropIfExists('adpages');
    }
};
