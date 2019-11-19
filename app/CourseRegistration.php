<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    public function section()
    {
        return $this->hasOne('App\CourseSection', 'id', 'course_section_id');
    }

    public function person()
    {
        return $this->hasOne('App\Person', 'university_id_number', 'registrant_university_id');
    }
}
