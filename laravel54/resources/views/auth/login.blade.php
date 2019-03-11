<!DOCTYPE html>
<html>
<head>
<title>登录页</title>
<meta content="" name="keywords" />
<meta content="" name="description" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes">
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/style.css" />
</head>
<body>

    <div class="login">
        <img src="/images/logo.png" alt="" />
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <input class="text1" type="text" name="name" value="" placeholder="请输入用户名" />
            <input class="text2" type="password" name="password" placeholder="请输入密码" />
            <input class="sub" type="submit" name="" />
        </form>
    </div>

</body>
</html>