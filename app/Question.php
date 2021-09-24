<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answeers(){
        return $this->hasMany(Answeer::class,'question_id');
    }
}
