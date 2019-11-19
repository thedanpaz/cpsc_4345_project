<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('term', '18');
            $table->integer('midterm_exam_grade');
            $table->integer('final_exam_grade');
            $table->integer('final_course_grade');
            $table->integer('participation_grade');
            $table->integer('attendance_grade');
            $table->unsignedBigInteger('registrant_university_id');
            $table->unsignedBigInteger('course_section_id');
            $table->foreign('registrant_university_id')->references('university_id_number')->on('people');
            $table->foreign('course_section_id')->references('id')->on('course_sections');
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
        Schema::dropIfExists('course_registrations');
    }
}
