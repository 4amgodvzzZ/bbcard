<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Models\Account;
use App\Http\Models\Card;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AccountController extends Controller
{
    public function index(){
        $userphone = Cookie::get('phone');
        $user = User::where('phone',$userphone)->first();
        //当前用户下所有供货的卡
        $cards = Card::leftjoin('bb_t_cardtype','bb_t_cardtype.id','=','cardtype_id')->leftjoin('bb_t_denomination','bb_t_denomination.id','=','denomination_id')->where('user_id',$user->id)->paginate(4);

        //用户账户状态
        $account = Account::where('user_id',$user->id)->first();

        $dcards = count(Card::where('user_id',$user->id)->where('salestatus',1)->get());//待售
        $ycards = count(Card::where('user_id',$user->id)->where('salestatus',2)->get());//已售出
        $mcards = count(Card::where('user_id',$user->id)->where('salestatus',3)->get());//面额不符
        $wcards = count(Card::where('user_id',$user->id)->where('salestatus',4)->get());//无效卡密

        $nowdate = date('Y-m-d');
        return view('account.index',compact('nowdate','cards','dcards','ycards','mcards','wcards','account'));
    }

    public function accountset(){
        return view('account.accountset');
    }

}
