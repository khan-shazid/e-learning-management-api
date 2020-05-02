<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Session;

class ApiAuthenticateUser
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
        $token = isset($request->header()['authorization']) && is_array($request->header()['authorization']) ? $request->header()['authorization'][0] : '';
        $u_id = $this->checkToken($token);
        if($u_id!=false){
          $request->merge(['user_id' => $u_id]);
          return $next($request);
        }else{
          return response()->json(array('status'=>'error','auth_error'=>'Session not found!'),401);
        }
    }
    public function checkToken($token){
      $session = Session::where('access_token',$token)->first();
      if($session){
        return $session['user_id'];
      }else{
        return false;
      }
    }
}
