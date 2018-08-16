@extends('public.admin')

@section('content')
    <div class="panel">
        <div class="panelcontent">
            <a href="javascript:void(0);" onclick="cardmethod(1)"
               class="button button-glow button-border button-rounded button-primary">加油卡</a>
            <a href="javascript:void(0);" onclick="cardmethod(2)"
               class="button button-glow button-border button-rounded button-primary">话费卡</a>

            <p style="color: #ff782e;padding-top: 30px">请仔细确认加油卡信息，再填写！ 因填写错误而导致失败或造成的损失，请自行承担。</p>

            <div class="cardtype" id="oilcard">
                <div class="salebtn">
                    <b>卡种:</b>
                    @foreach($cardtype as $v)
                        <a href="#" class="cardname" data-id="{{$v->id}}">{{$v->name}}</a>
                    @endforeach
                </div>
                <div class="denombtn">
                    <b>面额:</b>
                    @foreach($denomination as $v)
                        <a href="#" class="denom" data-denomid="{{$v->id}}">{{$v->costprice}}/{{$v->rulingprice}}
                            (收卡价)</a>
                    @endforeach
                </div>
                <div class="salebtn">
                    <b>数量:</b>
                    <a href="#">单张</a>
                    <a href="#">批量</a>
                </div>

                <div class="cardtypefoot">
                    <form id="cardform">
                        <input type="hidden" name="cardtype_id">
                        <input type="hidden" name="denomination_id">
                        <div class="cardform">
                            <b>{{$type==1?'加油卡卡号':'话费卡卡号'}}:&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            <input type="text" name="cardnum"><br>
                        </div>
                        <div class="cardform">
                            <b>{{$type==1?'加油卡密码':'话费卡密码'}}:&nbsp;&nbsp;&nbsp;&nbsp;</b>
                            <input type="text" name="cardpassword"><br>
                        </div>
                        <div class="cardform"><a href="#" class="button button-glow button-border button-rounded button-primary">确认提交</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        //切换加油卡或者是话费卡
        function cardmethod(id) {
            var url = '/sale/' + id;
            $.get(url, function (result) {
                window.location.href = url;
            });
        }

        //点击卡种显示当前卡种的现价跟收卡价
        $('.cardname').click(function () {
            var id = $(this).attr('data-id');
            var url = '/sale/getdenom/' + id;
            $.post(url, {'cardid': id, '_token': "{{ csrf_token() }}"}, function (result) {
                var str = '';
                $(result.data).each(function (i, t) {
                    var costprice = t['costprice'];
                    var rulingprice = t['rulingprice'];
                    var data_denomid = t['id'];
                    str += '<a href="#" class="denom" data-denomid=' + data_denomid + '>' + costprice + '/' + rulingprice + '(收卡价)</a>'
                });
                $('.denom').remove();
                $('.denombtn').append(str);
            });
        })

        //点击面额将面额的id放入表单

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

