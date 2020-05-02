<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
  public function questions(){
    return $this->hasMany('App\Models\Question','lesson_id','id');
  }
}
