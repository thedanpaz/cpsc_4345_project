<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function anonymousIdNumbers()
    {
        return $this->hasMany('App\AnonymousIdNumber', 'uin', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function registrations()
    {
        return $this->hasMany('App\CourseRegistration', 'registrant_university_id', 'university_id_number');
    }

    public function sections()
    {
        return $this->hasMany('App\CourseSection', 'faculty', 'university_id_number');
    }

    public function midtermAnonymousId()
    {
        return $this->hasOne('App\AnonymousIdNumber', 'uin', 'university_id_number')
            ->where('exam_type', 'midterm');
    }

    public function finalAnonymousId()
    {
        return $this->hasOne('App\AnonymousIdNumber', 'uin', 'university_id_number')
            ->where('exam_type', 'final');
    }

}
