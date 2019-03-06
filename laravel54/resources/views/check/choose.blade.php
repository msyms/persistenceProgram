<!DOCTYPE html>
<html>
<head>
<title>检查类型</title>
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

	<!-- <div class="top2"><p>检查类型</p></div> -->
	<div class="inspect">
		<div class="jc">
			<dl>
				<dt><img src="/images/jcgl.png" alt="" /></dt>
				<dd>
					<h3>基础管理类</h3>
					<p>制度检查</p>
				</dd>
			</dl>
			<a href="/check/show/{{$id}}">开始检查</a>
			<img class="sy" style="display: block;" src="/images/sy.png" alt="" />
		</div>
		<div class="jc jcr">
			<dl>
				<dt><img src="/images/jcgl.png" alt="" /></dt>
				<dd>
					<h3>生产现场类</h3>
					<p>设备设施检查</p>
				</dd>
			</dl>
			<a href="/check/show/{{$id}}">开始检查</a>
			<img class="sy" style="display: none;" src="/images/sy.png" alt="" />
		</div>
		<div style="clear: both;"></div>
	</div>
	<a class="generate" href="">检查完成，生成报告</a>

</body>
</html>