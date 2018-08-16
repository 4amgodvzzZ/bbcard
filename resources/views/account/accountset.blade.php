@extends('public.admin')

<style type="text/css">
    .slidetounlock{
        font-size: 12px;
        background:-webkit-gradient(linear,left top,right top,color-stop(0,#4d4d4d),color-stop(.4,#4d4d4d),color-stop(.5,#fff),color-stop(.6,#4d4d4d),color-stop(1,#4d4d4d));
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        -webkit-animation:slidetounlock 3s infinite;
        -webkit-text-size-adjust:none
    }
    @-webkit-keyframes slidetounlock{0%{background-position:-200px 0} 100%{background-position:200px 0}}

</style>

@section('content')
    <div class="accountpanel">
        <div class="panelcontent">

            <div id="wrapper" style="position: relative;top: 300px;left:300px;">
                <div id="drag">
                    <div class="drag_bg"></div>
                    <div class="drag_text slidetounlock" onselectstart="return false;" unselectable="on">
                        请按住滑块，拖动到最右边
                    </div>
                    <div class="handler handler_bg"></div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $('#drag').drag();
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

