<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Course;

class CourseRepository extends Controller
{
    public function save($data){
      $user['title'] = $data['title'];
      try{
        return Course::insertGetId($user);
      }catch(\Exception $e){
        return 0;
      }
    }
    public function get($value,$key){
      return Course::where($key,$value)->first();
    }
    public function list(){
      return Course::get();
    }
}
