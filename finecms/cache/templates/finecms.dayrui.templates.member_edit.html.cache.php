<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>
<script type="text/javascript">
function test_email(value) {
    $.get('<?php echo dr_url("member/ajax_email"); ?>&uid=<?php echo $data['uid']; ?>&email='+value+'&rand='+Math.random(), function(data){
        if (data) {
            $("#dr_email_tips").html(data);
            $("#dr_email_tips").attr("class", "onError");
        } else {
            $("#dr_email_tips").html(" &nbsp;");
            $("#dr_email_tips").attr("class", "onCorrect");
        }
    });
}
</script>

<form class="form-horizontal" action="" method="post" id="myform" name="myform">
    <input name="page" id="page" type="hidden" value="<?php echo $page; ?>" />
    <div class="page-bar">
        <ul class="page-breadcrumb mylink">
            <?php echo $menu['link']; ?>

        </ul>
        <ul class="page-breadcrumb myname">
            <?php echo $menu['name']; ?>
        </ul>
        <div class="page-toolbar">
            <div class="btn-group pull-right">
                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-hover="dropdown"> <?php echo fc_lang('操作菜单'); ?>
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <?php if (is_array($menu['quick'])) { $count=count($menu['quick']);foreach ($menu['quick'] as $t) { ?>
                    <li>
                        <a href="<?php echo $t['url']; ?>"><?php echo $t['icon'];  echo $t['name']; ?></a>
                    </li>
                    <?php } } ?>
                    <li class="divider"> </li>
                    <li>
                        <a href="javascript:window.location.reload();">
                            <i class="icon-refresh"></i> <?php echo fc_lang('刷新页面'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <h3 class="page-title">
        <small></small>
    </h3>

    <div class="portlet light bordered myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="active">
                    <a href="#tab_0" data-toggle="tab"> <i class="fa fa-user"></i> <?php echo fc_lang('基本资料'); ?> </a>
                </li>
                <li class="">
                    <a href="#tab_1" data-toggle="tab"> <i class="fa fa-reorder"></i> <?php echo fc_lang('自定义字段'); ?> </a>
                </li>
                <li class="">
                    <a href="#tab_2" data-toggle="tab"> <i class="fa fa-weibo"></i> 第三方账号 </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">


                <div class="tab-pane active" id="tab_0">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('账号'); ?>：</label>
                            <div class="col-md-9">
                                <div class="form-control-static"><a onclick="dr_dialog_member('<?php echo $data['uid']; ?>')" href="javascript:;"><?php echo $data['username']; ?></a></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('邮箱'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" onblur="test_email(this.value)" type="text" name="member[email]" value="<?php echo $data['email']; ?>" ></label>
                                <span class="help-block" id="dr_email_tips"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('姓名'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="member[name]" value="<?php echo $data['name']; ?>" ></label>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('手机'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="member[phone]" value="<?php echo $data['phone']; ?>" ></label>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('密码'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="member[password]" id="dr_password" value="" ></label>
                                <span class="help-block"><?php echo fc_lang('留空表示不修改密码'); ?></span>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="tab-pane " id="tab_1">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('账号'); ?>：</label>
                            <div class="col-md-9">
                                <div class="form-control-static"><a onclick="dr_dialog_member('<?php echo $data['uid']; ?>')" href="javascript:;"><?php echo $data['username']; ?></a></div>
                            </div>
                        </div>
                        <?php echo $myfield; ?>

                    </div>
                </div>

                <div class="tab-pane " id="tab_2">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('账号'); ?>：</label>
                            <div class="col-md-9">
                                <div class="form-control-static"><a onclick="dr_dialog_member('<?php echo $data['uid']; ?>')" href="javascript:;"><?php echo $data['username']; ?></a></div>
                            </div>
                        </div>

                        <?php $i=1;  $rt = $this->list_tag("action=cache name=OAUTH"); if ($rt) extract($rt); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) {  $id=$t['id'];  if (isset($data['oauth'][$id])) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><img align="absmiddle" src="<?php echo THEME_PATH; ?>oauth/<?php echo $t['icon']; ?>.png"></label>
                            <div class="col-md-9">
                                <div class="form-control-static"><?php echo $data['oauth'][$id]['nickname']; ?></div>
                            </div>
                        </div>
                        <?php $i++;  }  } } ?>


                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="myfooter">
        <div class="row">
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn green"> <i class="fa fa-save"></i> <?php echo fc_lang('保存'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>