<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>基础管理类</title>
<link rel="stylesheet" href="/css/style.css">
<script src="/js/jquery-2.1.4.min.js"></script>
</head>
<body style="background-color: rgb(242,242,242);">

	<!-- 内容开始 -->
	<h1 class="mb">目标</h1>
	<div class="jcglbt">
		规章制度<br/>
		企业应建立健全安全生产和职业卫生规章制度，并征求工会及从业人员意见和建议，规范安全生产和职业卫生管理工作。<br/>
		企业应确保从业人员及时获取制度文本。<br/>
		企业安全生产和职业卫生规章制度包括但不限于下列内容：
	</div>
	<form method="post" action='/check/create' >
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$id}}">
		<input type="hidden" name="groupId" value="{{$groupId}}">
		<?php $i=1; ?>
	<div class="jcglcon">
			@foreach ($entrys as $entry)

		    <li>
				<h3>{{$i}} {{$entry->entry}}</h3>
				<div class="annl">
						<input type="hidden" name="entryId[{{$i}}]" value="{{$entry->id}}">
					<span><input type="radio" checked="checked"  name="status[{{$i}}]" value="1" > 正常</span>
					<span class="wg"><input type="radio" name="status[{{$i}}]" value="2"> 违规</span>
					<img src="/images/paizhao.png" alt="" />
					<img src="/images/yiju.png" alt="" />
				</div>
				<p class="weigner" id="ClickMe2">此处填写违规内容</p>
				<input class="chrye" type="text" name="content[{{$i}}]"  placeholder="请输入文字描述" />
				<!-- <p><img src="/images/tyah.jpg" alt="" /></p> -->
			</li>
			<?php $i++; ?>
			@endforeach
		
		


	</div>

	<!-- 底部按钮 -->
	<input class="qrtj" href="jichuguanli2.html" value="保存" type="submit">
	</form>
	<!-- 弹窗 -->
	<div id="goodcover2"></div>
	<div id="code22">
	    <form action="" method="" class="goodtxt muc">
	    	<p class="act">违规相关内容1</p>
	    	<p>违规相关内容2违规相关内容2</p>
	    	<p>违规相关内容3违规相关内容3违规相关内容3</p>
	    	<input type="submit" text="" />
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