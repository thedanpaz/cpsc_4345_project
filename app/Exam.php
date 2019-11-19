<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function questions()
    {
        return $this->hasMany('App\Question', 'exam_id', 'id');
    }

    public function section()
    {
        return $this->hasOne('App\Question', 'id', 'course_section_id');
    }
}
