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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('streetnr');
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
            $table->string('password');
            $table->string('approved')->default('0');
            // $table->unsignedBigInteger('course_id');
            // $table->unsignedBigInteger('campus_id');
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
        // Schema::table('students', function (Blueprint $table) {
        //     $table->dropForeign(['course_id']);
        //     $table->dropForeign(['campus_id']);
        // });
        Schema::dropIfExists('students');
    }
};