<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->string('age');
            $table->string('experience');
            $table->text('description')->nullable();
            $table->boolean('allow_in_search')->default(true);
            $table->integer('min_pay')->nullable();
            $table->integer('max_pay')->nullable();
            $table->string('language')->default('Urdu');
            $table->string('phone_number');
            $table->string('institute')->nullable();
            $table->string('degree_title')->nullable();
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
        Schema::dropIfExists('tutors');
    }
}
