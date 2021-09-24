<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=['id','mcq_time','exam_status','essay_time'];
}
