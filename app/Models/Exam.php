<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
  public function course(){
    return $this->hasOne('App\Models\Course','id','course_id');
  }
  public function lesson(){
    return $this->hasOne('App\Models\Lesson','id','lesson_id');
  }
}
