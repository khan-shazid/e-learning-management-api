<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserRepository extends Controller
{
    public function save($data){
      $user['email'] = $data['email'];
      $user['name'] = $data['name'];
      $user['password'] = Hash::make($data['password']);
      $user['role'] = 'user';
      try{
        return User::insertGetId($user);
      }catch(\Exception $e){
        return 0;
      }
    }
    public function get($value,$key){
      return User::where($key,$value)->first();
    }
}
