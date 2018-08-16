<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>八八收卡</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/topmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/account.css') }}">
</head>
<body>


        <!--头部菜单-->
        <div class="content-wrapper">
            <!-- load sub menu here -->
            @section('topmenu')
            @include('public.topmenu')
            @show
        </div>

        {{--内容--}}
        <div class="content-wrapper">
            @section('content')
            <!-- load sub menu here -->
            @show
        </div>

        <!--js文件-->  
        <script src="{{ asset('js/jquery/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>
        <script src="{{ asset('js/layer/layer.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/admin/index.js') }}"></script>
        <script src="{{ asset('js/admin/account.js') }}"></script>

        @section('script')

        @show
        <div style="position: absolute;bottom: 0;">Copyright  &copy;  2018 - 2018 八八收卡 All Rights Reserved</div>
</body>
</html>