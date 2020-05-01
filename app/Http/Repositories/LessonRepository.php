<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\Option;

class LessonRepository extends Controller
{
    public function save($data){
      $lesson['title'] = $data['title'];
      $lesson['course_id'] = $data['course_id'];
      try{
        return Lesson::insertGetId($lesson);
      }catch(\Exception $e){
        return 0;
      }
    }

    public function saveLessonQuestion($data){
      // echo '<pre>';
      // print_r($data);exit;
      $question['lesson_id'] = $data['lesson_id'];
      $question['text'] = $data['data']['question_text'];
      $qId = Question::insertGetId($question);
      foreach($data['data']['options'] as $key=>$value){
        $option['text'] = $value;
        $option['question_id'] = $qId;
        $oId = Option::insertGetId($option);
        if($key==$data['data']['answer']){
          Question::where('id', $qId)->update(['answer_ids' => $oId]);
        }
      }
      return $qId;
      // $question['answer_ids'] = $data['data']['questionText'];
    }

    public function get($value,$key){
      return Course::where($key,$value)->first();
    }
    public function list(){
      return Course::get();
    }
}
