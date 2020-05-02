<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Repositories\LessonRepository;

class LessonController extends Controller
{
    public $lessonRepo;
    function __construct(){
      $this->lessonRepo = new LessonRepository();
    }

    public function saveLesson(Request $request){
      $data = $request->all();
      $lessonId = $this->lessonRepo->save($data);
      if($lessonId){
        return response()->json([
          'success' => true,
          'message' => "Successfully created",
          'data' => $lessonId
        ],200);
      }else{
        return response()->json([
          'success' => false,
          'message' => "Lesson save unsuccessful"
        ],400);
      }
    }

    public function saveQuestion(Request $request){
      $data = $request->all();
      $result = $this->lessonRepo->saveLessonQuestion($data);
      if($result){
        return response()->json([
          'success' => true,
          'message' => "Successfully created"
        ],200);
      }else{
        return response()->json([
          'success' => false,
          'message' => "Question save unsuccessful"
        ],400);
      }
    }

    public function list(){
      $list = $this->lessonRepo->list();
      return response()->json([
        'success' => true,
        'message' => "Successfully fetched",
        'data' => $list
      ],200);
    }

    public function getCourseLessons($id){
      $list = $this->lessonRepo->getCourseLessons($id);
      return response()->json([
        'success' => true,
        'message' => "Successfully fetched",
        'data' => $list
      ],200);
    }
    public function getCourseLessonsWithDetails($id){
      $list = $this->lessonRepo->getCourseLessonsWithDetails($id);
      return response()->json([
        'success' => true,
        'message' => "Successfully fetched",
        'data' => $list
      ],200);
    }

    public function getLessonDetails($id){
      $list = $this->lessonRepo->getLessonDetails($id);
      return response()->json([
        'success' => true,
        'message' => "Successfully fetched",
        'data' => $list
      ],200);
    }
}
