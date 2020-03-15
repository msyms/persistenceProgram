<!DOCTYPE html>
<html>
<head>
<title>首页</title>
<meta content="" name="keywords" />
<meta content="" name="description" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes">
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/style.css" />
</head>
<body style="background: #F2F2F2;">

    <div class="top">
        <p>隐患排查与治理系统</p>
        @if (Auth::guest())
            <a href="{{ route('login') }}">登录</a>
           
        @else
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            注销
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endif
    </div>
    <div class="indcon">
        <dl><a href="{{ route('company') }}">
            <dt><img src="/images/yhpc.jpg" alt="" /></dt>
            <dd>隐患排查</dd>
        </a></dl>
        <dl><a href="yhzl1.html">
            <dt><img src="/images/yhzl.jpg" alt="" /></dt>
            <dd>隐患治理</dd>
        </a></dl>
        <dl><a href="">
            <dt><img src="/images/yhtz.jpg" alt="" /></dt>
            <dd>隐患台账</dd>
        </a></dl>
    </div>
<!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>