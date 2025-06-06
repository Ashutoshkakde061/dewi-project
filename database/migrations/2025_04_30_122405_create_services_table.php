<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**   
     *
     * @return void
     */
   public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('services_id');
            $table-> string('image');
            $table-> string('title');
             $table-> string('description');


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
        Schema::dropIfExists('services');
    }
};

