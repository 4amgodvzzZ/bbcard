@extends('public.admin')

@section('content')
    <div class="accountpanel">
        <div class="panelcontent">
            {{--账户信息--}}
            <div class="accountinfo">
                <div class="accountleft">
                    <span style="color: #3c3c3c;font-size: 16px">账号余额:</span><br>
                    <span style="color: #FF0000;font-size: 30px;font-weight: bold">{{$account['balance']}}元</span><br>
                    <a href="#" class="button button-primary button-rounded button-small">提现</a>
                    <span>提现记录</span>
                </div>
                <div class="accountright">
                    <span style="color: #3c3c3c;font-size: 16px">账号状态</span><br>
                    <span style="color: rgb(0, 204, 174);font-size: 30px;font-weight: bold">{{$account['status']==1?'正常':'失效'}}</span>
                </div>
            </div>

            <div class="linkinfo">
                <a href="/sale" class="button button-action button-pill">我要供货</a><br>
                <a href="#" style="font-size: 12px" class="showlink">更高折扣，联系我们</a>
            </div>

            <div class="cardinfo">
                <div class="cardinfotop">
                <span>今日货单状态 |</span><span>{{$nowdate}}</span>
                <a href="#" style="float: right;text-decoration: none">所有货单☟</a>
                </div>

                <div class="salestatus">
                    待售中<br>
                    <span>{{$dcards}}张</span><br>
                    所有待售中{{$dcards}}张
                </div>
                <div class="salestatus">
                    已售出<br>
                    <span>{{$ycards}}张</span><br>
                    总共售出{{$ycards}}张
                </div>
                <div class="salestatus">
                    面额不符<br>
                    <span>{{$mcards}}张</span><br>
                    总共面额不符{{$mcards}}张
                </div>
                <div class="salestatus">
                    无效卡密<br>
                    <span>{{$wcards}}张</span><br>
                    总共无效卡密{{$wcards}}张
                </div>
            </div>

            <div class="saleinfo">
                <div class="cardinfotop">
                    <span>交易记录</span>
                    <a href="/record" style="float: right;text-decoration: none">更多交易记录☞☞</a>
                </div>

                <div>
                    <table>
                        <tr style="font-weight: bold;color: #ff1f30">
                            <td>卡种类</td>
                            <td>卡号</td>
                            <td>面额</td>
                            <td>回收价</td>
                            <td>交易状态</td>
                            <td>到账金额</td>
                            <td>操作</td>
                        </tr>
                        @forelse($cards as $card)
                        <tr>
                            <td>{{$card['name']}}</td>
                            <td>{{$card['cardnum']}}</td>
                            <td>{{$card['costprice']}}</td>
                            <td>{{$card['rulingprice']}}</td>
                            <td>
                                @if($card['salestatus']==1)待售
                                @elseif($card['salestatus']==2)已售出
                                @elseif($card['salestatus']==3)面额不符
                                @else卡密无效@endif
                            </td>
                            <td>{{isset($card['rulingprice'])?$card["rulingprice"]:'-'}}</td>
                            <td><a href="#" class="button button-tiny">详情</a></td>
                        </tr>
                        @empty
                        <tr><td colspan="7">暂无数据</td></tr>
                        @endforelse
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        //右上角  联系我们
        $('.showlink').click(function () {
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //样式类名
                closeBtn: 0, //不显示关闭按钮
                anim: 2,
                area: ['500px', '350px'],
                shadeClose: true, //开启遮罩关闭
                content: '<div style="padding:100px 0 0 100px;">联系我们:<b>17673098929</b><br>(24小时在线)</div>'
            });
        })
    </script>
@stop

