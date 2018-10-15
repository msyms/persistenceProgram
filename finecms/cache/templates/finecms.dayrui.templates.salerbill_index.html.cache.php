<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include);  $_pages=$pages; ?>
<div class="page-bar">
	<ul class="page-breadcrumb mylink">
		<?php echo $menubill['link']; ?>

	</ul>
	<ul class="page-breadcrumb myname">
		<?php echo $menubill['name']; ?>
	</ul>
	<div class="page-toolbar">

	</div>
</div>

<div class="mytopsearch">
	<form method="post" action="" name="searchform" id="searchform">
		<label><?php echo fc_lang('开始'); ?> ：</label>
		<label style="margin-right: 10px;"><?php echo dr_field_input('time', 'Date', array('option'=>array('format'=>'Y-m-d','width'=>120)), (int)$time); ?></label>
		<label><?php echo fc_lang('结束'); ?> ：</label>
		<label style="margin-right: 10px;"><?php echo dr_field_input('time1', 'Date', array('option'=>array('format'=>'Y-m-d','width'=>120)), (int)$time1); ?></label>
		<label style="margin-right: 10px;"><button type="submit" class="btn green btn-sm" name="submit" > <i class="fa fa-search"></i> <?php echo fc_lang('搜索'); ?></button></label>
	</form>
</div>

<form action="" method="post" name="myform" id="myform">
	<input name="action" id="action" type="hidden" value="del" />
	<div class="portlet mylistbody">
		<div class="portlet-body">
			<div class="table-scrollable">

				<table class="mytable table table-striped table-bordered table-hover table-checkable dataTable">

		<thead>
		<tr>
			<!-- <th width="10"></th> -->
			<th class="<?php echo ns_sorting('name'); ?>" name="salerName" ><?php echo fc_lang('销售人员'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="bucketNum" ><?php echo fc_lang('桶装水'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="bucketNum" ><?php echo fc_lang('回款'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="bucketNum" ><?php echo fc_lang('回桶'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="bottleNum" ><?php echo fc_lang('瓶装水'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="checker" ><?php echo fc_lang('检核人'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="saleTime" ><?php echo fc_lang('剩余桶装水'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="saleTime" ><?php echo fc_lang('剩余瓶装水'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="saleTime" ><?php echo fc_lang('时间'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="remark" ><?php echo fc_lang('备注'); ?></th>
			<th class="dr_option"><?php echo fc_lang('操作'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($list)) { $count=count($list);foreach ($list as $t) { ?>
		<tr id="dr_row_<?php echo $t['uid']; ?>">
			<!-- <td><input name="ids[]" type="checkbox" class="dr_select toggle md-check" value="<?php echo $t['id']; ?>" /></td> -->
			<td><?php echo dr_keyword_highlight($t['salerName'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['bucketNum'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['knotTotal'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['backNumTotal'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['bottleNum'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['checker'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['bucketNum'] - $t['bucketTotal'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['bottleNum'] - $t['bottleTotal'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['saleTime'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['remark'], $param['keyword']); ?></td>
			<td class="dr_option">
				<?php if ($this->ci->is_auth('member/admin/home/edit')) { ?><a class="aedit" href="<?php echo dr_url('saler/billdetail',array('billId'=>$t['id'],'salerId'=>$salerId)); ?>"> <i class="fa fa-edit"></i> <?php echo fc_lang('详情'); ?></a><?php }  if ($this->ci->is_auth('member/admin/home/edit')) { ?><a class="aedit" href="<?php echo dr_url('saler/billedit',array('billId'=>$t['id'],'salerId'=>$salerId)); ?>" > <i class="fa fa-edit"></i> <?php echo fc_lang('修改'); ?></a><?php } ?>
			</td>
		</tr> 
		<?php } } ?>
		<!-- <tr class="mtable_bottom">
        	<th width="20"  ><input name="dr_select" class="toggle md-check" id="dr_select" type="checkbox" onClick="dr_selected()" /></th>
			<td colspan="10"  >
            <?php if ($this->ci->is_auth('member/admin/home/del')) { ?>
				<label><button type="button" class="btn red btn-sm" name="option" onClick="$('#action').val('del');dr_confirm_set_all('<?php echo fc_lang('您确定要这样操作吗？'); ?>')"><i class="fa fa-trash"></i> <?php echo fc_lang('删除'); ?></button></label>
            <?php } ?>

			</td>
		</tr> -->
		</tbody>
		</table>
		</div>
	</div>
</div>
</form>
<div id="pages"><a><?php echo fc_lang('共%s条', $param['total']); ?></a><?php echo $_pages; ?></div>
<label><a href="<?php echo dr_url('saler/exportBill',array('salerId'=>$salerId)); ?>"><button type="submit" class="btn green btn-sm" > <i class="fa fa-search"></i> <?php echo fc_lang('导出'); ?></button></a></label>
<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>