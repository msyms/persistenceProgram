<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include);  $_pages=$pages; ?>
<div class="page-bar">
	<ul class="page-breadcrumb mylink">
		<?php echo $menu['link']; ?>

	</ul>
	<ul class="page-breadcrumb myname">
		<?php echo $menu['name']; ?>
	</ul>
	<div class="page-toolbar">

	</div>
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
			<th class="<?php echo ns_sorting('name'); ?>" name="name" ><?php echo fc_lang('姓名'); ?></th>
			<th class="<?php echo ns_sorting('name'); ?>" name="name" ><?php echo fc_lang('车牌号'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="phone" ><?php echo fc_lang('电话'); ?></th>
			<th class="<?php echo ns_sorting('typename'); ?>" name="typename" ><?php echo fc_lang('公司'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="phone" ><?php echo fc_lang('结款'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="bucket" ><?php echo fc_lang('桶装水'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="bucket" ><?php echo fc_lang('饮料'); ?></th>
			<th class="<?php echo ns_sorting('phone'); ?>" name="bucket" ><?php echo fc_lang('瓶装水'); ?></th>

			<th class="dr_option"><?php echo fc_lang('操作'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($list)) { $count=count($list);foreach ($list as $t) { ?>
		<tr id="dr_row_<?php echo $t['uid']; ?>">
			<!-- <td><input name="ids[]" type="checkbox" class="dr_select toggle md-check" value="<?php echo $t['id']; ?>" /></td> -->
			<td><?php echo dr_keyword_highlight($t['name'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['carNo'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['phone'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['typename'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['allknot'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['allbucket'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['allbottleNum'], $param['keyword']); ?></td>
			<td><?php echo dr_keyword_highlight($t['alldrinkNum'], $param['keyword']); ?></td>
			<td class="dr_option">
				<a class="aedit" href="<?php echo dr_url('saler/bill',array('salerId'=>$t['id'])); ?>"> <i class="fa fa-navicon"></i> <?php echo fc_lang('详情'); ?></a>
				<a class="aedit" href="<?php echo dr_url('saler/fuel',array('salerId'=>$t['id'])); ?>"> <i class="fa fa-edit"></i> <?php echo fc_lang('加油信息'); ?></a>
				<a class="ago" href="<?php echo dr_url('saler/edit',array('salerId'=>$t['id'])); ?>"> <i class="fa fa-edit"></i> <?php echo fc_lang('修改'); ?></a>
				<a class="alist" href="<?php echo dr_url('customer/index',array('salerId'=>$t['id'])); ?>"> <i class="fa fa-user"></i> <?php echo fc_lang('客户'); ?></a>
			</td>
		</tr> 
		<?php } } ?>
<!-- 		<tr class="mtable_bottom">
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
<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>