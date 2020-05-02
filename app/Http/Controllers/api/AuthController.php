<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\RegistrationRequestBody;
use App\Http\Requests\LoginRequestBody;

use App\Http\Repositories\UserRepository;

class AuthController extends Controller
{
    public $userRepo;
    function __construct(){
      $this->userRepo = new UserRepository();
    }

    public function register(RegistrationRequestBody $request){
      // return $request->all();
      $userId = $this->userRepo->save($request->all());
      if($userId){
        $token = $this->createToken($userId);
        if($token){
          return response()->json([
            'success' => true,
            'message' => "Successfully Registered",
            'data' => $token,
            'role' => 'user',
            'name' => $request['name']
          ],200);
        }else{
          return response()->json([
            'success' => false,
            'message' => "Token generation failed!"
          ],401);
        }
      }else{
        return response()->json([
          'success' => false,
          'message' => "User creation error!"
        ],401);
      }
    }

    public function login(LoginRequestBody $request){
      $user = $this->userRepo->get($request['email'],'email');
      if (Hash::check($request['password'] , $user['password'])){
        $token = $this->createToken($user['id']);
        if($token){
          return response()->json([
            'success' => true,
            'message' => "Successfully logged in.",
            'data' => $token,
            'role' => $user['role'],
            'name' => $user['name']
          ],200);
        }else{
          return response()->json([
            'success' => false,
            'message' => "Token generation failed!"
          ],401);
        }
      }else{
        return response()->json([
          'success' => false,
          'message' => "Email or Password incorrect."
        ],401);
      }
    }
}
