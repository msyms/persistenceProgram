<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>企业信息</title>
<link rel="stylesheet" href="/css/style.css">
<script src="js/laydate.js"></script>
</head>
<body style="background: #F2F2F2;">

	<!-- <div class="top2"><p>企业信息</p></div> -->
	
	<form class="serach" action="/api/upload/uploadimg" method="post" enctype="multipart/form-data">
		<input type="hidden" name="api_token" value="hN5INSmLqCDyMvChDBfEdUDmtL122si48GltUIqKo0aeyIOtsyjDYGoHdvL7">
		{{ csrf_field() }}
		<input type="file" name="fileImg">
		<input class="sub" type="submit" value="搜索" name="" />
		<div style="clear: both;"></div>
	</form>

	<!--中部+版心开始-->
	<form class="serach" action="/company/search" method="post">
		<!-- <input type="hidden" name="api_token" value="FrbIGV3a3druyOBUiu2Qug2chAmEnN7jL9RMzvVsMSwHKmb3ZNGb2U6EeKqJ"> -->
		{{ csrf_field() }}
		<input class="text" type="text" name="name" placeholder="请输入关键字进行搜索" />
		<input class="sub" type="submit" value="搜索" name="" />
		<div style="clear: both;"></div>
	</form>
	<form action="/api/company/create" method="post" enctype="multipart/form-data">
		<input type="hidden" name="api_token" value="FrbIGV3a3druyOBUiu2Qug2chAmEnN7jL9RMzvVsMSwHKmb3ZNGb2U6EeKqJ">
		{{ csrf_field() }}
	<div class="bx zitidaxiao">		
		<ul class="ybzl">
			<li><p>企业名称</p><input type="text" value="" name="company[comName]" placeholder="请填写企业名称" /></li>
			<li><p>主要负责人</p><input type="text" value="" name="company[leader]" placeholder="请填写主要负责人" /></li>
			<li><p>负责人电话</p><input type="text" value="" name="company[leaderPhone]" placeholder="请填写负责人电话" /></li>
			<li><p>企业地址</p><input type="text" value="" name="company[address]" placeholder="请填写企业地址" /></li>
			<li><p>行业类别</p>
				<select name="company[category]">
	  				<option value ="1">建筑行业</option>
				</select>
			</li>
			<li><p>企业性质</p>
				<select name="company[property]">
	  				<option value ="1">企业性质选择</option>
	 				<option value ="2">国有企业</option>
	  				<option value="3">集体企业</option>
	  				<option value="4">股份合作制企业</option>
				</select>
			</li>
			<li><p>占地面积㎡</p><input type="text" value="" name="company[space]" placeholder="请填写占地面积" /></li>
			<li><p>职工人数</p><input type="text" value="" name="company[workersNum]" placeholder="请填写职工人数" /></li>		
		</ul>
		<h2 style="text-align: center; font-size: 16px">安全管理人员</h2>
		<ul class="ybzl" style="margin-bottom: 20px;">
			<li><p>姓名</p><input type="text" value="" name="safe[name]" placeholder="请填写姓名" /></li>
			<li><p>联系方式</p><input type="text" value="" name="safe[phone]" placeholder="请填写联系方式" /></li>
			<li><p>部门</p><input type="text" value="" name="safe[department]" placeholder="请填写部门" /></li>
			<li><p>职业类别</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="safe[position]" value="1">
	    			<span class="demo--radioInput"></span>专职
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="safe[position]" value="2">
	    			<span class="demo--radioInput"></span>兼职
				</label>
			</li>
			<li><p>证书</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="safe[certificate]" value="1">
	    			<span class="demo--radioInput"></span>有
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="safe[certificate]" value="2">
	    			<span class="demo--radioInput"></span>无
				</label>
			</li>
		</ul>
		<div class="adds">+添加安全管理人员</div>
		<h2 style="text-align: center; font-size: 16px">职业卫生管理人员</h2>
		<ul class="ybzl" style="margin-bottom: 20px;">
			<li><p>姓名</p><input type="text" value="" name="health[name]" placeholder="请填写姓名" /></li>
			<li><p>联系方式</p><input type="text" value="" name="health[phone]" placeholder="请填写联系方式" /></li>
			<li><p>部门</p><input type="text" value="" name="health[department]" placeholder="请填写部门" /></li>
			<li><p>职业类别</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="health[position]" value="1">
	    			<span class="demo--radioInput"></span>专职
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="health[position]" value="2">
	    			<span class="demo--radioInput"></span>兼职
				</label>
			</li>
			<li><p>证书</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="health[certificate]" value="1">
	    			<span class="demo--radioInput"></span>有
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="health[certificate]" value="2">
	    			<span class="demo--radioInput"></span>无
				</label>
			</li>
		</ul>
		<div class="adds">+添加职业卫生管理人员</div>
		<h2 style="text-align: center; font-size: 16px">特种作业人员</h2>
		<div class="adds">+添加特种作业人员</div>
		<h2 style="text-align: center; font-size: 16px">特种设备操作人员</h2>
		<div class="adds">+添加特种设备操作人员</div>
		<ul class="ybzl" style="margin-bottom: 20px;">
			<li><p>宿舍</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" value="1" name="company[dorm]">
	    			<span class="demo--radioInput"></span>有
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" value="2" name="company[dorm]">
	    			<span class="demo--radioInput"></span>无
				</label>
			</li>
			<li><p>厨房</p>
				<select name="company[kitchen]">
	  				<option value ="1">请选择厨房燃气设施类型</option>
	 				<option value ="2">燃气设施类型</option>
	  				<option value="3">燃气设施类型</option>
	  				<option value="4">燃气设施类型</option>
				</select>
			</li>
			<li><p>涉及危险化学品</p>
				<select name="company[chemicals]">
	  				<option value ="1">点击添加涉及危险化学品</option>
	 				<option value ="2">危险化学品</option>
	  				<option value="3">危险化学品</option>
	  				<option value="4">危险化学品</option>
				</select>
			</li>
			<li><p>应急预案</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[immediate]">
	    			<span class="demo--radioInput"></span>无
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[immediate]">
	    			<span class="demo--radioInput"></span>有但未备案
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[immediate]">
	    			<span class="demo--radioInput"></span>有且已备案
				</label>
			</li>
			<li><p>安全生产标准化</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[standard]">
	    			<span class="demo--radioInput"></span>未建设
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[standard]">
	    			<span class="demo--radioInput"></span>正在建设
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[standard]">
	    			<span class="demo--radioInput"></span>已发证
				</label>
			</li>
			<li><p>创建类型</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[size]">
	    			<span class="demo--radioInput"></span>小微
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[size]">
	    			<span class="demo--radioInput"></span>三级（规模）
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[size]">
	    			<span class="demo--radioInput"></span>危化
				</label>
			</li>
			<li><p>安全生产许可证</p>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[permit]">
	    			<span class="demo--radioInput"></span>无
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[permit]">
	    			<span class="demo--radioInput"></span>不涉及
				</label>
				<label class="demo--label">
	    			<input class="demo--radio" type="radio" name="company[permit]">
	    			<span class="demo--radioInput"></span>有
				</label>
			</li>
			<li><p>营业执照等</p><input type="file" name="photo" id="photo" /><div class="container"></div></li>
		</ul>
		<!--<img style="width: 100%;box-shadow: 0px 0px 17px rgba(0,0,0,0.25);" src="images/4-1-f.jpg"/>-->
	</div>
	
	<!--底部按钮开始-->
	<input type="submit" class="qrtj" value="提交">


</form>



<script>
	;!function(){
	laydate({
	   elem: '#demo'
	})
	}();
	</script>
	<script>
	document.getElementById("photo").addEventListener("change",function(e){
      var files =this.files;
      var img = new Image();
      var reader =new FileReader();
      reader.readAsDataURL(files[0]);
      reader.onload =function(e){
        var dx =(e.total/1024)/1024;
        if(dx>=2){
          alert("文件大小大于2M");
          return;
        }
        img.src =this.result;
        img.style.width ="100%";
        img.style.height ="90%";
        document.querySelector('.container').appendChild(img);
      }
    })
	</script>
</body>
</html>