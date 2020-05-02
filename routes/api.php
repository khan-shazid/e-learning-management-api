<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',array('as' => 'register','uses' => 'api\AuthController@register'));
Route::post('login',array('as' => 'login','uses' => 'api\AuthController@login'));

Route::middleware(['auth_user_api'])->group(function () {
  Route::post('course',array('as' => 'saveCourse','uses' => 'api\CourseController@saveCourse'))->middleware('auth_admin_api');
  Route::get('course',array('as' => 'courseList','uses' => 'api\CourseController@list'));
  Route::post('lesson',array('as' => 'saveLesson','uses' => 'api\LessonController@saveLesson'))->middleware('auth_admin_api');
  Route::get('lesson',array('as' => 'lessonList','uses' => 'api\LessonController@list'));
  Route::get('lesson-by-course/{id}',array('as' => 'getCourseLessons','uses' => 'api\LessonController@getCourseLessons'));
  Route::get('lesson-details/{id}',array('as' => 'getLessonDetails','uses' => 'api\LessonController@getLessonDetails'))->middleware('auth_admin_api');

  Route::get('lesson-details-exam/{id}',array('as' => 'getLessonDetailsForExam','uses' => 'api\LessonController@getLessonDetailsForExam'));

  Route::post('question',array('as' => 'saveLesson','uses' => 'api\LessonController@saveQuestion'))->middleware('auth_admin_api');
});
