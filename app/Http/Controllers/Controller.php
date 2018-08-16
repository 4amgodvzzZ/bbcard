<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function error($msg='', $data=[])
    {
        return response()->json(['status'=> 0, 'msg'=> $msg, 'data'=> $data] );
    }

    public static function success($msg, $data=[])
    {
        return response()->json(['status'=> 1, 'msg'=> $msg, 'data'=> $data] );
    }
}
