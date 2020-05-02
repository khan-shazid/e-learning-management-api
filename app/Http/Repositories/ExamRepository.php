<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\Exam;
use App\Models\ExamDetail;

class ExamRepository extends Controller
{
    public function saveExamDetails($data){
      try{
        $exam['course_id'] = $data['course_id'];
        $exam['lesson_id'] = $data['lesson_id'];
        $exam['user_id'] = $data['user_id'];
        $examId = Exam::insertGetId($exam);
        foreach($data['data'] as $qId=>$oId){
          $examDetails['exam_id'] = $examId;
          $examDetails['question_id'] = $qId;
          $examDetails['answer'] = $oId;
          ExamDetail::insert($examDetails);
        }
        return $examId;
      }catch(\Exception $e){
        return false;
      }
    }

    public function calculateTotalNumber($data,$examId){
      $lessonAnswers = Question::where('lesson_id',$data['lesson_id'])->pluck('answer_ids','id')->toArray();
      $total = 0;
      foreach($data['data'] as $qId => $oId){
        if($lessonAnswers[$qId]==$oId){
          $total++;
        }
      }
      Exam::where('id', $examId)->update(['mark_obtained' => $total]);
      return $total;
    }

    public function getPreviousExams($userId){
      return Exam::where('user_id',$userId)->with('course','lesson')->get();
    }
}
