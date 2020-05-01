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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',array('as' => 'register','uses' => 'api\AuthController@register'));
Route::post('login',array('as' => 'login','uses' => 'api\AuthController@login'));

Route::post('course',array('as' => 'saveCourse','uses' => 'api\CourseController@saveCourse'));
Route::get('course',array('as' => 'courseList','uses' => 'api\CourseController@list'));
Route::post('lesson',array('as' => 'saveCourse','uses' => 'api\CourseController@saveLesson'));
// Route::post('course',array('as' => 'user.order-list','uses' => 'api\CourseController@saveCourse'));
// ->middleware('auth_user_api');
Route::post('question',array('as' => 'saveLesson','uses' => 'api\LessonController@saveQuestion'));
