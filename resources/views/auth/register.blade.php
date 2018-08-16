<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>八八收卡</title>
    <link rel="stylesheet" type="text/css" href="/css/auth/loginandreg.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div id="reg_frame">

    <p id="image_logo"><img src="/images/logo.png"></p>

    <form id="regform">
        <p><label class="label_input">手机号</label><input name="phone" type="text" id="phone" class="text_field"/></p>
        <p><label class="label_input">密码</label><input name="password" type="password" id="password" class="text_field"/></p>
        <p><label class="reg_label_input">验证码</label><input type="text" name="code" id="code" class="reg_text_field"/><span class="sign">验证</span></p>

        <div id="login_control">
            <button id="btn_reg">注册</button>
        </div>
    </form>
</div>

<script src="{{ asset('js/jquery/jquery-3.3.1.min.js') }}"></script>
<script>
    /**
     * Created by wang on 2018/8/8.
     */
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $(function () {// 初始化内容
        $('#btn_reg').click(function () {
            var phone = document.getElementById("phone");
            var pass = document.getElementById("password");
            var url = '/registerin';
            if (phone.value == "") {
                alert("请输入手机号");
            } else if (pass.value == "") {
                alert("请输入密码");
            }else {
                $.ajax({
                    type:'POST',
                    url:url,
                    async: true,
                    dataType:"json",
                    data:$('#regform').serialize(),
                    success:function(data){
                        if(data.status==1){
                            alert(data.msg);
                            window.location.href="{{ url('/login') }}";
                        }
                    },
                    error:function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                         //              alert(XMLHttpRequest.readyState);
                        //                alert(textStatus);
                    }
                });
            }

        })
    });
</script>


</body>
</html>

