<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseRegistrationMakeFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            $table->integer('midterm_exam_grade')->nullable()->change();
            $table->integer('final_exam_grade')->nullable()->change();
            $table->integer('final_course_grade')->nullable()->change();
            $table->integer('participation_grade')->nullable()->change();
            $table->integer('attendance_grade')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            $table->integer('midterm_exam_grade')->change();
            $table->integer('final_exam_grade')->change();
            $table->integer('final_course_grade')->change();
            $table->integer('participation_grade')->change();
            $table->integer('attendance_grade')->change();
        });
    }
}
