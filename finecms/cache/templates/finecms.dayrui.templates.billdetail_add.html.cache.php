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
    <input class="form-control" type="hidden" name="data[salerId]" value="<?php echo $salerId; ?>" >

    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('姓名'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[cname]" id="dr_username"  name="data[customerId]" id="txt_ide" list="customer" />
            <datalist id="customer">
                <?php if (is_array($customer)) { $count=count($customer);foreach ($customer as $t) { ?>
                <option value="<?php echo $t['cname']; ?>" />
                <?php } } ?>
            </datalist>

        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('电话'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[phone]" id="dr_phone" value="<?php echo $data['phone']; ?>" >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('地址'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[address]" id="dr_address" value="<?php echo $data['address']; ?>" >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('欠桶'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[debtBucket]" id="dr_debtBucket" value="<?php echo $data['address']; ?>" >
        </div>
    </div>
    <div class="form-group dr_one">
        <label class="col-md-3 control-label"><?php echo fc_lang('欠款'); ?>：</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="data[debtMoney]" id="dr_debtMoney" value="<?php echo $data['address']; ?>" >
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