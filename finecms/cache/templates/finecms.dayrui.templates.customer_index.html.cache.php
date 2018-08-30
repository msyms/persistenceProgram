<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include);  $_pages=$pages; ?>
<div class="page-bar">
	<ul class="page-breadcrumb mylink">
		<?php echo $menu['link']; ?>

	</ul>
	<ul class="page-breadcrumb myname">
		<?php echo $menu['name']; ?>
	</ul>

</div>




<form action="" method="post" name="myform" id="myform">
	<input name="action" id="action" type="hidden" value="del" />
	<div class="portlet mylistbody">
		<div class="portlet-body">
			<div class="table-scrollable">

				<table class="mytable table table-striped table-bordered table-hover table-checkable dataTable">

		<thead>
		<tr>
			<th width="10"></th>
			<th class="<?php echo ns_sorting('cname'); ?>" name="cname" ><?php echo fc_lang('姓名'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="phone" ><?php echo fc_lang('电话'); ?></th>
			<th class="<?php echo ns_sorting('address'); ?>" name="address" ><?php echo fc_lang('地址'); ?></th>
			<th class="<?php echo ns_sorting('debtBucket'); ?>" name="address" ><?php echo fc_lang('欠桶'); ?></th>
			<th class="<?php echo ns_sorting('debtMoney'); ?>" name="address" ><?php echo fc_lang('欠款'); ?></th>
			<th class="<?php echo ns_sorting('address'); ?>" name="address" ><?php echo fc_lang('押桶'); ?></th>

			<th class="<?php echo ns_sorting('remark'); ?>" name="remark" ><?php echo fc_lang('备注'); ?></th>
			<th class="dr_option"><?php echo fc_lang('操作'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($list)) { $count=count($list);foreach ($list as $t) { ?>
		<tr id="dr_row_<?php echo $t['uid']; ?>">
			<td><input name="ids[]" type="checkbox" class="dr_select toggle md-check" value="<?php echo $t['uid']; ?>" /></td>
			<td><?php echo dr_keyword_highlight($t['cname'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['phone'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['address'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['debtBucket'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['debtMoney'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['depositBucket'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['remark'], $param['keyword']); ?></td>

			<td class="dr_option">
				<a class="aedit" href="<?php echo dr_url('customer/edit',array('uid'=>$t['id'])); ?>"> <i class="fa fa-edit"></i> <?php echo fc_lang('修改'); ?></a>
				<a class="aedit" href="<?php echo dr_url('customer/detail',array('uid'=>$t['id'])); ?>"> <i class="fa fa-edit"></i> <?php echo fc_lang('明细'); ?></a>
				<a class="aedit" href="<?php echo dr_url('customer/price',array('customerId'=>$t['id'])); ?>"> <i class="fa fa-edit"></i> <?php echo fc_lang('价格'); ?></a>
			</td>
		</tr> 
		<?php } } ?>
		<tr class="mtable_bottom">
        	<th width="20"  ><input name="dr_select" class="toggle md-check" id="dr_select" type="checkbox" onClick="dr_selected()" /></th>
			<td colspan="10"  >
            <?php if ($this->ci->is_auth('member/admin/home/del')) { ?>
				<label><button type="button" class="btn red btn-sm" name="option" onClick="$('#action').val('del');dr_confirm_set_all('<?php echo fc_lang('您确定要这样操作吗？'); ?>')"><i class="fa fa-trash"></i> <?php echo fc_lang('删除'); ?></button></label>
            <?php } ?>

			</td>
		</tr>
		</tbody>
		</table>
		</div>
	</div>
</div>
</form>
<div id="pages"><a><?php echo fc_lang('共%s条', $param['total']); ?></a><?php echo $_pages; ?></div>
<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>