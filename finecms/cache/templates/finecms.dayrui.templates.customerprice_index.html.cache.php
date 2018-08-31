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
			<th class="<?php echo ns_sorting('name'); ?>" name="salerName" ><?php echo fc_lang('客户名'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="bucketNum" ><?php echo fc_lang('单位'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="bottleNum" ><?php echo fc_lang('价格'); ?></th>
		</tr>
		</thead>
					<tbody>
					<?php if (is_array($list)) { $count=count($list);foreach ($list as $t) { ?>
					<tr id="dr_row_<?php echo $t['uid']; ?>">
						<td><input name="ids[]" type="checkbox" class="dr_select toggle md-check" value="<?php echo $t['id']; ?>" /></td>
						<td><?php echo dr_keyword_highlight($cname, $param['keyword']); ?></td>
						<td><?php echo dr_keyword_highlight($t['unit'], $param['keyword']); ?></td>
						<td><?php echo dr_keyword_highlight($t['price'], $param['keyword']); ?></td>
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