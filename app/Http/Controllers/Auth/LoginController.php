<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\Account;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function loginin(Request $request){
        $user = User::where('phone',$request->phone)->first();

        if (!$user){
            return self::error('用户不存在，请先注册！');
        }elseif (decrypt($user->password)==$request->password){
            //将用户手机号缓存起来
            Cookie::queue('phone',$request->phone,3000000);

            return self::success('登陆成功！');
        }else{
            return self::error('登录失败！');
        }
    }


    public function registerin(Request $request){
        $user = User::where('phone',$request->phone)->first();

        if ($user){
            return self::success('您已经注册过！');
        }else{
            $reguserid = User::insertGetId(['phone'=>$request->phone,'password'=>encrypt($request->password),'creadtetime'=>date("Y-m-d H:m:s")]);

            $account = Account::insert(['user_id'=>$reguserid]);
            if ($reguserid){
                //将用户手机号缓存起来
                Cookie::queue('phone',$request->phone,3000000);
                return self::success('注册成功！');
            }
            return self::error('注册失败！');
        }
    }

    public function outloginin(){
        Cookie::queue(Cookie::forget('phone'));
        return view('auth.login');
    }

}
