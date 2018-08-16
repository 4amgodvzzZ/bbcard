<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>八八收卡</title>
    <link rel="stylesheet" type="text/css" href="/css/auth/loginandreg.css"/>
</head>

<body>
<div id="login_frame">

    <p id="image_logo"><img src="/images/logo.png"></p>

    <form id="loginform">
        <p><label class="label_input">手机号</label><input type="text" name='phone' id="phone" class="text_field"/></p>
        <p><label class="label_input">密码</label><input type="password" name="password" id="password" class="text_field"/></p>

        <div id="login_control">
            <button type="button" id="btn_login">登陆</button>
            <a id="forget_pwd" href="/register">点击注册</a>
        </div>
    </form>
</div>


<script src="/js/jquery/jquery-3.3.1.min.js"></script>

<script>
    /**
     * Created by wang on 2018/8/8.
     */

    $(function () {// 初始化内容
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });


        $('#btn_login').click(function () {
            var phone = document.getElementById("phone");
            var pass = document.getElementById("password");
            var url = '/loginin';
            if (phone.value == "") {
                alert("请输入用户名");
            } else if (pass.value == "") {
                alert("请输入密码");
            }else {
                $.ajax({
                    type:'POST',
                    url:url,
                    async: true,
                    data:$('#loginform').serialize(),
                    success:function(data){
                        if(data.status==1){
                            window.location.href="{{ url('/sale')}}";
                        }else {
                            alert(data.msg);
                        }
                    }
                });
            }

        })
    });
</script>


</body>
</html>

