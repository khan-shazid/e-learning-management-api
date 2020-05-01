<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Carbon\Carbon;
use App\Models\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createToken($id, $device_id = NULL)
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $token = str_random(15) . Carbon::parse($timestamp)->format('dmyHis') . str_random(15);
        try {
            $session = Session::insert([
                'user_id' => $id,
                'access_token' => $token,
                'created_at' => $timestamp
            ]);
        } catch (\Exception $e) {
            return 0;
        }
        return $token;
    }
}
