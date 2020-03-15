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
	<form class="check" method="post" action='/check/create' >
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$id}}">
		<input type="hidden" name="groupId" value="{{$groupId}}">
		<?php $i=0; ?>
		<div class="jcglcon">
			@foreach ($entrys as $entry)
		    <li>
				<h3> {{$entry->entry}}</h3>
				<div class="annl">
					<input type="hidden" name="entryId[{{$i}}]" value="{{$entry->id}}" class="inputIDs">
					<span><input type="radio" checked="checked"  name="status[{{$i}}]" value="1" > 符合</span>
					<span class="wg"><input type="radio" name="status[{{$i}}]" value="2"> 不符合</span>
					<!-- <img src="/images/paizhao.png" alt="" /> -->
					<img class="yiju" src="/images/yiju.png" alt="" />
				</div>
				<h1 class="weigner">选择违规内容</h1>
				<input class="chrye" type="text" name="content[{{$i}}]"  placeholder="请输入文字描述" />
				<input type="file" name="file" accept="image/*" multiple >
			</li>
			<?php $i++; ?>
			@endforeach
		</div>
		<input class="qrtj" type="submit" value="保存">
	</form>
	
	<!-- 违规内容弹窗 -->
	<div id="goodcover2"></div>
	<div id="code22">
	    <form id="form1" onsubmit="return false" action="##" method="get" class="goodtxt muc">
	    	<div class="pItem">
				<p></p>
				<p></p>
				<p></p>
			</div>
	    	<input onclick="sel()" type="submit" text=""  />
	    </form>
	</div>
	<script type="text/javascript">
        function sel() {
			// 提交
			var arr = [];
			for (var i=0;i<$("#form1 .pItem p").length;i++){
				if($("#form1 .pItem p").eq(i).attr("class") == "act"){
					var ids = $("#form1 .pItem p").eq(i).attr("data-id")
					if(!check) {
						var check = $("#form1 .pItem p").eq(i).attr("data-check")
					}
					arr.push(ids)
				}
			}
			$(".check .jcglcon").append("<input name='negative["+check+"]' value ='"+arr.join(',')+",'  type='hidden' >");
			$('#code22').hide();
	        $('#goodcover2').hide();
				// ajax 提交数据
        }
        function play() {
        	console.log();
        	var cont=document.getElementById("ClickMe2");
  			console.log('innerHtml cont= '+ cont.innerHTML);
        }
    </script>
	<script>
	$(function() {
		$("#form1 .pItem").on("click","p",function(){
			if($(this).attr("class") == "act"){
				$(this).removeClass("act")
			}else{
				$(this).addClass("act")
			}
		});
	    //alert($(window).height());
	    $('.weigner').click(function() {
	    	var checkid = $(this).parents("li").children('div').children('input').val();
			$.ajax({

				type: "GET",//方法类型weigner
				dataType: "json",//预期服务器返回的数据类型
				url: "/check/getChecknegative/"+checkid ,//url
				data: $('#form1').serialize(),
				success: function (result) {
					$('#code22').center();
					$('#goodcover2').show();
					$('#code22').fadeIn();
					$("#form1 .pItem").find('p').remove()
					for(var i=0;i<result.length;i++){
						if(i==0){
							$("#form1 .pItem").append("<p class='act' data-check='"+checkid+"' data-id='"+result[i].id+"'>"+result[i].content+"</p>")
						}else{
							$("#form1 .pItem").append("<p data-check='"+checkid+"' data-id='"+result[i].id+"'>"+result[i].content+"</p>")
						}
					}
				},
				error : function() {
					alert("数据读取异常！");
				}
			});

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

	<!-- 法律法规内容弹窗 -->
	<div id="goodcover3"></div>
	<div id="code3">
	    <form id="form3" onsubmit="return false" action="##" method="get" class="goodtxt muc">
	    	<div class="divItem">
				<h2>责任事项及依据</h2>
				<h3>1 《安全生产法》第四条</h3>
				<p>生产经营单位必须遵守本法和其他有关安全生产的法律、法规，加强安全生产管理，建立、健全安全生产责任制和安全生产规章制度，改善安全生产条件，推进安全生产标准化建设，提高安全生产水平，确保安全生产。</p>
				<h3>2 《山东省生产经营单位安全生产主体责任规定》第七条</h3>
				<p>生产经营单位应当依据法律、法规、规章和国家、行业或者地方标准，制定涵盖本单位生产经营全过程和全体从业人员的安全生产管理制度和安全操作规程</p>
				<h2>追责依据及情形</h2>
				<h3>1 《安全生产法》第九十一条</h3>
				<p>生产经营单位必须遵守本法和其他有关安全生产的法律、法规，加强安全生产管理，建立、健全安全生产责任制和安全生产规章制度，改善安全生产条件，推进安全生产标准化建设，提高安全生产水平，确保安全生产。</p>
				<h3>2 《山东省生产经营单位安全生产主体责任规定》第七条</h3>
				<p>生产经营单位应当依据法律、法规、规章和国家、行业或者地方标准，制定涵盖本单位生产经营全过程和全体从业人员的安全生产管理制度和安全操作规程</p>
			</div>
	    </form>
	</div>
	<script>
	$(function() {
	    //alert($(window).height());
	    $('.yiju').click(function() {
			$.ajax({

				type: "GET",//方法类型weigner
				dataType: "json",//预期服务器返回的数据类型
				url: "/check/getCheckaccord/"+$(this).parents("li").children('div').children('input').val(),//url
				data: $('#form3').serialize(),
				success: function (result) {
					$('#code3').center();
					$('#goodcover3').show();
					$('#code3').fadeIn();
					$("#form3 .divItem").find('div').remove()
					for(var i=0;i<result.length;i++){
						if(i==0){
							$("#form3 .divItem").append("<div class='act' data-id='"+result[i].id+"'>"+result[i].content+"</div>")
						}else{
							$("#form3 .divItem").append("<div data-id='"+result[i].id+"'>"+result[i].content+"</div>")
						}
					}
				},
				error : function() {
					alert("数据读取异常！");
				}
			});

	    });
	    $('#closebt2').click(function() {
	        $('#code3').hide();
	        $('#goodcover3').hide();
	    });
		$('#goodcover3').click(function() {
	        $('#code3').hide();
	        $('#goodcover3').hide();
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
	                'top': ($(window).height() - $('#code3').height()) * 0.5,
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