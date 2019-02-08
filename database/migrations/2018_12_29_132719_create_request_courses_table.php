<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hire_request_id')->unsigned();
            $table->integer('course_id')->unsigned();

            $table->foreign('hire_request_id')->references('id')->on('hire_requests')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('sub_courses')->onDelete('cascade');
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
        Schema::dropIfExists('request_courses');
    }
}
