<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinalCourseGradesCompleteAndLockGradeCourseSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->boolean('final_course_grade_complete')->after('course_id')->default(false)->nullable();
            $table->boolean('lock_final_course_grade')->after('final_course_grade_complete')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_sections', function (Blueprint $table) {
            $table->drop(['final_course_grade_complete', 'lock_final_course_grade']);
        });
    }
}
