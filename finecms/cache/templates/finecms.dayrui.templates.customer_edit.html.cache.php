<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>


<form class="form-horizontal" action="" method="post" id="myform" name="myform">
    <input name="page" id="page" type="hidden" value="<?php echo $page; ?>" />
    <!--<div class="page-bar">-->
        <!--<ul class="page-breadcrumb mylink">-->
            <!--<?php echo $menu['link']; ?>-->

        <!--</ul>-->
        <!--<ul class="page-breadcrumb myname">-->
            <!--<?php echo $menu['name']; ?>-->
        <!--</ul>-->

    <!--</div>-->
    <h3 class="page-title">
        <small></small>
    </h3>

    <div class="portlet light bordered myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="active">
                    <a href="#tab_0" data-toggle="tab"> <i class="fa fa-user"></i> <?php echo fc_lang('基本资料'); ?> </a>
                </li>

            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">


                <div class="tab-pane active" id="tab_0">
                    <div class="form-body">


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('姓名'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="member[cname]" value="<?php echo $data['cname']; ?>" ></label>
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
                            <label class="col-md-2 control-label"><?php echo fc_lang('地址'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="member[address]" value="<?php echo $data['address']; ?>" ></label>
                                <span class="help-block" id="dr_"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('欠款提醒'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="member[debtTime]" value="<?php echo $data['debtTime']; ?>" ></label>
                                <span class="help-block" id="dr_email_meet"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('到访提醒'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="member[meetTime]" value="<?php echo $data['meetTime']; ?>" ></label>
                                <span class="help-block" id="dr_email_tips"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('销售人员'); ?>：</label>
                            <div class="col-md-7">

                                <label>
                                    <select name="member[salerId]" class="form-control" >
                                        <?php if (is_array($saler)) { $count=count($saler);foreach ($saler as $t) { ?>

                                        <option value="<?php echo $t['id']; ?>" <?php if ($t['id'] == $salerId) { ?> selected <?php } ?>><?php echo $t['name']; ?></option>
                                        <?php } } ?>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="form-group dr_all">
                            <label class="col-md-3 control-label"><?php echo fc_lang('备注'); ?>：</label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="width:260px;height:150px" name="info" /><?php echo $info; ?></textarea>
                            </div>
                        </div>


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