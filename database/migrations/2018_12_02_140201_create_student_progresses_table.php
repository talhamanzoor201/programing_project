<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->string('month');
            $table->string('quiz_marks');
            $table->string('assignment_marks');
            $table->text('comment');
            $table->integer('parent_child_id')->nullable();
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
        Schema::dropIfExists('student_progresses');
    }
}
