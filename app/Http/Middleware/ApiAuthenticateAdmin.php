<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;

class ApiAuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         $u_id = $request['user_id'];
         $user = User::find($u_id);
         if($user && $user['role']=='admin'){
           return $next($request);
         }else{
           return response()->json(array('status'=>'error','auth_error'=>'Access Denied!'),403);
         }
     }
}
