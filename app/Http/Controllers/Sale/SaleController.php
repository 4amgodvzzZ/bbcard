<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Http\Models\Cardtype;
use App\Http\Models\Denomination;
use Illuminate\Http\Request;

class SaleController extends Controller
{
   public function index($type=1){
       //获取当前卡种
        $cardtype = Cardtype::where('type',$type)->get();
        //面额
        $denomination = Denomination::where('cardtype_id',$cardtype[0]->id)->get();

        return view('sale.index')->with(['cardtype'=>$cardtype,'denomination'=>$denomination,'type'=>$type]);

   }

   public function getdenom($cardtypeid){
       $denom = Denomination::where('cardtype_id',$cardtypeid)->get();
        return self::success('获取卡面额数据成功',$denom);
   }

   //保存用户的供货的卡信息
   public function savecard(Request $request){

   }

}
