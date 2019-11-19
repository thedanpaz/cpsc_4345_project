<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function sections()
    {
        return $this->hasMany('App\CourseSection', 'course_id', 'id');
    }
}
