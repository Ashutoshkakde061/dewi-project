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
        Schema::table('newcoursedetails', function (Blueprint $table) {
            // $table->string('days')->after('newcourse_id')->nullable();
            $table->string('price')->after('days')->nullable();
            // $table->foreignId('newcourse_id')->constrained('newcourse', 'newcourse_id')->onDelete('cascade');
            // $table->string('days');
            // $table->string('price');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newcoursedetails', function (Blueprint $table) {
            //
        });
    }
};
