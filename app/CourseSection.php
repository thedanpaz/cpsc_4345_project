<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'course_id');
    }

    public function professor()
    {
        return $this->hasOne('App\Person', 'university_id_number', 'faculty');
    }

    public function midtermExam()
    {
        return $this->hasOne('App\Exam', 'course_section_id', 'id')
            ->where('exam_type','midterm');
    }

    public function finalExam()
    {
        return $this->hasOne('App\Exam', 'course_section_id', 'id')
            ->where('exam_type','final');
    }

    public function registrations()
    {
        return $this->hasMany('App\CourseRegistration', 'course_section_id', 'id');
    }
}
