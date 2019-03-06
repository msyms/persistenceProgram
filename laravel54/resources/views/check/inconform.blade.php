<!DOCTYPE html>
<html>
<head>
<title>基础管理类-不符合项汇总</title>
<meta content="" name="keywords" />
<meta content="" name="description" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes">
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/style.css" />
<script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
</head>
<body style="background: #F2F2F2;">
	<?php $i = 1 ?>
	@foreach($infos as $info)
	<ul class="noaccord">
		<li>
			<span>{{$i}} {{$info->entry}}</span>
			<a class="red" href="">删除</a>
		</li>

	</ul>
	<?php $i++; ?>
	@endforeach
	<div class="qm">
		<h2>排查人签字</h2>
		<a href="javascript:void(0);">点击上传签名</a>
	</div>

	<a class="qrtj" href="inspect.html">确认提交</a>


	<!-- 弹窗 -->
	<div id="goodcover2"></div>
	<div id="code22">
		<div class="close1"><a href="javascript:void(0)" id="closebt2"><img src="images/close.gif"></a></div>
	    <form action="" method="" class="goodtxt">
	    	<textarea style="margin: 10px 0 20px 0">1 安全风险管理、隐患排査治理</textarea>
			<input type="submit" name="" value="提交" />
	    </form>
	</div>


	<script>
		$(function() {
		    //alert($(window).height());
		    $('#ClickMe2').click(function() {
		        $('#code22').center();
		        $('#goodcover2').show();
		        $('#code22').fadeIn();
		    });
		    $('#closebt2').click(function() {
		        $('#code22').hide();
		        $('#goodcover2').hide();
		    });
			$('#goodcover2').click(function() {
		        $('#code22').hide();
		        $('#goodcover2').hide();
		    });
		    /*var val=$(window).height();
			var codeheight=$("#code").height();
		    var topheight=(val-codeheight)/2;
			$('#code').css('top',topheight);*/
		    jQuery.fn.center = function(loaded) {
		        var obj = this;
		        body_width = parseInt($(window).width());
		        body_height = parseInt($(window).height());
		        block_width = parseInt(obj.width());
		        block_height = parseInt(obj.height());

		        left_position = parseInt((body_width / 2) - (block_width / 2) + $(window).scrollLeft());
		        if (body_width < block_width) {
		            left_position = 0 + $(window).scrollLeft();
		        };

		        top_position = parseInt((body_height / 2) - (block_height / 2) + $(window).scrollTop());
		        if (body_height < block_height) {
		            top_position = 0 + $(window).scrollTop();
		        };

		        if (!loaded) {

		            obj.css({
		                'position': 'absolute'
		            });
		            obj.css({
		                'top': ($(window).height() - $('#code22').height()) * 0.5,
		                'left': left_position
		            });
		            $(window).bind('resize', function() {
		                obj.center(!loaded);
		            });
		            $(window).bind('scroll', function() {
		                obj.center(!loaded);
		            });

		        } else {
		            obj.stop();
		            obj.css({
		                'position': 'absolute'
		            });
		            obj.animate({
		                'top': top_position
		            }, 200, 'linear');
		        }
		    }

		})
	</script>
</body>
</html>