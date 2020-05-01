<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Repositories\CourseRepository;

class CourseController extends Controller
{
    public $courseRepo;
    function __construct(){
      $this->courseRepo = new CourseRepository();
    }
    public function saveCourse(Request $request){
      $id = $this->courseRepo->save($request->all());
      if($id){
        return response()->json([
          'success' => true,
          'message' => "Successfully created",
          'data' => $id
        ],200);
      }else{
        return response()->json([
          'success' => false,
          'message' => "Course save unsuccessful"
        ],400);
      }
    }
}
