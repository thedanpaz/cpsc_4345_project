<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnonymousIdNumber extends Model
{
    public function universityPerson()
    {
        return $this->hasOne('App\Person', 'university_id_number', 'uin');
    }
}
