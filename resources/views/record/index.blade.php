@extends('public.admin')

@section('content')
    <div class="recordpanel">
        <div class="panelcontent">
            {{--交易记录信息--}}
            <div class="recordinfo">
                <div class="infotop">
                    <div class="infoleft"><a href="javascript:void(0);" onclick="cardmethod(1)"
                                             class="button button-glow button-border button-rounded button-primary">加油卡</a></div>
                    <div class="infoleft"><a href="javascript:void(0);" onclick="cardmethod(2)"
                                             class="button button-glow button-border button-rounded button-primary">话费卡</a></div>
                    <div class="inforight"><input type="text" class="cardnum" placeholder="货单号/卡号" name="cardnum">&nbsp;&nbsp;<a href="#" class="button button-primary button-rounded button-small">搜索</a>
                    </div>
                </div>
                <div class="infobot">
                    <div>种类:</div>
                    <div class="rebtn">
                        @foreach($cardtype as $v)
                            <a href="#" class="cordtype" data-id="{{$v->id}}" data-type="{{$v->type}}">{{$v->name}}</a>
                        @endforeach
                    </div>
                    <div>交易状态:</div>
                    <div>
                        <select style="margin:-10px 0 0 0" class="selectpicker show-tick form-control">
                            <option>全部</option>
                            <option>待售中</option>
                            <option>交易成功</option>
                            <option>交易失败</option>
                            <option>卡密无效</option>
                        </select>
                    </div>
                    <div>交易时间:</div>
                    <div>
                        <select style="margin:-10px 0 0 0" class="selectpicker show-tick form-control">
                            <option>全部</option>
                            <option>今日交易记录</option>
                            <option>最近三天交易记录</option>
                            <option>最近一月交易记录</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="recordbot">
                <div>
                    <table class="table table-hover">
                        <tr style="font-weight: bold;color: #ff1f30">
                            <td>卡种类</td>
                            <td>卡号</td>
                            <td>面额</td>
                            <td>回收价</td>
                            <td>交易状态</td>
                            <td>到账金额</td>
                        </tr>
                        @forelse($cards as $card)
                            <tr>
                                <td>{{$card['name']}}</td>
                                <td>{{$card['cardnum']}}</td>
                                <td>{{$card['costprice']}}</td>
                                <td>{{$card['rulingprice']}}</td>
                                <td>
                                    @if($card['salestatus']==1)<span>待售</span>
                                    @elseif($card['salestatus']==2)<span style="color:#2d995b">已售出</span>
                                    @elseif($card['salestatus']==3)<span style="color:#dc3545">面额不符</span>
                                    @else<span style="color:#dc3545">卡密无效</span>@endif
                                </td>
                                <td>{{isset($card['rulingprice'])?$card["rulingprice"]:'-'}}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7">暂无数据</td></tr>
                        @endforelse
                    </table>
                    <div class="pagination-sm">
                        @include('public.pagination', ['page'=> $cards])
                    </div>
                </div>
            </div>


        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        //切换加油卡或者是话费卡
        function cardmethod(id) {
            var url = '/record/' + id;
            $.get(url, function (result) {
                window.location.href = url;
            });
        }
        //按卡号筛选
        $('.button-small').click(function() {
            var url = '/record';
            var cardnum = $('.cardnum').val();
            $.post(url,{cardnum:cardnum,'_token':'{{ csrf_token() }}'}, function (result) {
                $('body').html(result);
            });
        });
        //点击卡种筛选
        $('.cordtype').click(function () {
            var cardtypeid = $(this).attr('data-id');
            var cardtype = $(this).attr('data-type');
            var url = '/record/'+cardtype;
            $.post(url,{cardtypeid:cardtypeid,'_token':'{{ csrf_token() }}'}, function (result) {
                $('body').html(result);
            });
        })

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

