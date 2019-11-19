<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{

    public function exam()
    {
        return $this->hasOne('App\Exam', 'id', 'exam_id');
    }

}
