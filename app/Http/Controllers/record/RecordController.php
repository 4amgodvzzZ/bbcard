<?php

namespace App\Http\Controllers\record;

use App\Http\Controllers\Controller;
use App\Http\Models\Card;
use App\Http\Models\Cardtype;
use App\Http\Models\Denomination;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RecordController extends Controller
{
    public function index($type=1,Request $request){
        $userphone = Cookie::get('phone');
        $user = User::where('phone',$userphone)->first();
        $cardnum = $request->cardnum;//卡号
        $salesatus = $request->salesatus;//卡状态
        $cardtypeid = $request->cardtypeid;//卡种
        $saledate = $request->saledate;//交易时间

        //获取当前卡种
        $cardtype = Cardtype::where('type',$type)->get();
        $cardtypeids = Cardtype::where('type',$type)->pluck('id')->toarray();
        //筛选操作
        if (strlen($cardnum)>0){
            $cards = Card::leftjoin('bb_t_cardtype','bb_t_cardtype.id','=','cardtype_id')->leftjoin('bb_t_denomination','bb_t_denomination.id','=','denomination_id')
                ->where('user_id',$user->id)->where('bb_t_card.cardnum',$cardnum)->paginate(6);
            //设置page分页带上筛选参数
            $cards->setPath('/record?cardnum='.$cardnum);
        }elseif ($salesatus!='' ||$cardtypeid!='' ||$saledate!=''){
            $cards = Card::leftjoin('bb_t_cardtype','bb_t_cardtype.id','=','cardtype_id')->leftjoin('bb_t_denomination','bb_t_denomination.id','=','denomination_id')
                ->where('user_id',$user->id)
                ->when($cardtypeid,function ($query) use ($cardtypeid){
                return $query->where('bb_t_card.cardtype_id',$cardtypeid);
                })->when($salesatus,function ($query) use ($salesatus){
                    return $query->where('salesatus',$salesatus);
                })->when($saledate,function ($query) use ($saledate){
                    return $query->where('saletime',$saledate);
                })->paginate(6);
            $cards->setPath('/record?cardtypeid='.$cardtypeid.'&salesatus='.$salesatus.'&saledate='.$saledate);
        }else{
            //当前用户下所有交易记录
            $cards = Card::leftjoin('bb_t_cardtype','bb_t_cardtype.id','=','cardtype_id')->leftjoin('bb_t_denomination','bb_t_denomination.id','=','denomination_id')
                ->whereIn('bb_t_card.cardtype_id',$cardtypeids)->where('user_id',$user->id)->paginate(6);
        }

        return view('record.index',compact('cardtype','cards'));
    }

}
