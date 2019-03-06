<!DOCTYPE html>
<html>
<head>
<title>企业信息-搜索结果</title>
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

	<!-- <div class="top2"><p>企业信息</p></div> -->
	<form class="serach" action="/company/search" method="">
		<input class="text" type="text" name="comName" value="{{$name}}" placeholder="请输入关键字进行搜索" />
		<input class="sub" type="submit" value="搜索" name="" />
		<div style="clear: both;"></div>
	</form>
	<div class="lists">
		@foreach ($companys as $company)
		<dl>
			<dt>{{$company->comName}}</dt>
			<dd>
				<a href="/check/show/{{$company->id}}">初查</a>
				<a href="qiyefucha.html">复查</a>
			</dd>
		</dl>
		@endforeach

	</div>

</body>
</html>