<script type="text/javascript">
//防止回车提交表单
$(function() {
	document.onkeydown = function(e){ 
		var ev = document.all ? window.event : e;
		if (ev.keyCode==13) {
			$("#mark").val("1"); // 标识不能提交表单
		}
	}
});
function dr_form_check() {
	if ($("#mark").val() == 0) { 
		return true;
	} else {
		return false;
	}
}


$(function(){

    $('#accountReceivable').bind('input propertychange', function() {
        var a = $('#accountReceivable').val();
        var b = $('#vipdiscount').val();
        var sum= a * b;

        $('#dr_debtMoney').val(sum);
    });

})

$("input#dr_bucketnum").change(function(){
    var price = ($("select#price option:selected").text()).split('￥');
    $("input#dr_debtMoney").val(price[1] * $("input#dr_bucketnum").val());
});


$(function(){

  $("input#dr_cname").blur(function(){
    $.getJSON("/admin.php?c=customer&m=getprice",{cname: $(this).val()}, function(j){
      var options = '';
      for (var i = 0; i < j.length; i++) {

        options += '<option value="' + j[i].id + '">' + j[i].unit+'：￥'+j[i].price + '</option>';
      }

      $("select#price").html(options);

    })

  })

})

function getPriceList(){    

    var cname = $("input#dr_cname").val(); 

    $("select[name=modelId]").empty();      //清空

    $.ajax({url:'/admin.php?c=customer&m=billdetailadd',

        type:"get",

        data:{

            cname : cname

        },

        cache: false,

        error:function(){

        }, 

        success:function(data){

            var modelList = data.modelList;

            if(modelList && modelList.length != 0){

                for(var i=0; i<modelList.length; i++){

                    var option="<option value=\""+modelList[i].modelId+"\"";

                    if(_LastModelId && _LastModelId==modelList[i].modelId){

                        option += " selected=\"selected\" "; //默认选中

                        _LastModelId=null;

                    }

                    option += ">"+modelList[i].modelName+"</option>";  //动态添加数据

                    $("select[name=modelId]").append(option);

                }

        }

        }

    });

}
</script>
<form style="width:450px;" class="form-horizontal" action="" method="post" id="myform" name="myform" onsubmit="return dr_form_check()">
<input name="mark" id="mark" type="hidden" value="0">
<div class="form-body">
    <input class="form-control" type="hidden" name="data[billId]" value="<?php echo $billId; ?>" >

    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('姓名'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" id="dr_cname"  name="data[cname]" id="txt_ide" list="customer" />
            <datalist id="customer">
                <?php if (is_array($customer)) { $count=count($customer);foreach ($customer as $t) { ?>
                <option value="<?php echo $t['cname']; ?>" />
                <?php } } ?>
            </datalist>

        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('价格'); ?>：</label>
        <div class="col-md-7">
            <select name="data[priceId]" id="price"></select>

        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('桶装水数量'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[bucketNum]" id="dr_bucketnum" value="<?php echo $data['bucketNum']; ?>"  >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('瓶装水数量'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[bottleNum]" id="dr_bottlenum" value="<?php echo $data['bottleNum']; ?>"  >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('回桶'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[backBucketNum]" id="dr_backBucketNum" value="<?php echo $data['backBucketNum']; ?>" >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('结款'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[knot]" id="dr_debtMoney" value="<?php echo $data['knot']; ?>" readonly >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('欠款'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[debt]" id="dr_debt" value="<?php echo $data['debt']; ?>" >
        </div>
    </div>

    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('欠桶'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[debtBucket]" id="dr_debtBucket" value="<?php echo $data['address']; ?>" >
        </div>
    </div>

    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('押桶'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[depositBucket]" id="dr_depositBucket" value="<?php echo $data['address']; ?>" >
        </div>
    </div>

    <div class="form-group dr_all">
        <label class="col-md-3 control-label"><?php echo fc_lang('备注'); ?>：</label>
        <div class="col-md-9">
            <textarea class="form-control" style="width:260px;height:150px" name="info" /><?php echo $info; ?></textarea>
        </div>
    </div>

</div>
</form>