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
</script>
<form style="width:450px;" class="form-horizontal" action="" method="post" id="myform" name="myform" onsubmit="return dr_form_check()">
<input name="mark" id="mark" type="hidden" value="0">
<div class="form-body">


    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('姓名'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[name]" id="dr_username" value="<?php echo $data['username']; ?>" >
        </div>
    </div>

    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('车牌号'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[carNo]" id="dr_email" value="<?php echo $data['email']; ?>" >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('电话'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[phone]" id="dr_phone" value="<?php echo $data['phone']; ?>" >
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