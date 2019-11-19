<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFinalCourseGradeCourseRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            $table->string('final_course_grade', 4)->change();
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
            $table->integer('final_course_grade')->change();
        });
    }
}
