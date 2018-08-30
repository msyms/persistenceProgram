<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>


<form class="form-horizontal" action="" method="post" id="myform" name="myform">
    <input name="page" id="page" type="hidden" value="<?php echo $page; ?>" />
    <div class="page-bar">
        <ul class="page-breadcrumb mylink">
            <?php echo $menubill['link']; ?>

        </ul>
        <ul class="page-breadcrumb myname">
            <?php echo $menubill['name']; ?>
        </ul>

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

            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">


                <div class="tab-pane active" id="tab_0">
                    <div class="form-body">
                        <input class="form-control" type="hidden" name="data[salerId]" value="<?php echo $salerId; ?>" >

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('姓名'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[salerName]" value="<?php echo $data['salerName']; ?>" ></label>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('桶装水'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[bucketNum]" value="<?php echo $data['bucketNum']; ?>" ></label>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('瓶装水'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="data[bottleNum]" value="<?php echo $data['bottleNum']; ?>" ></label>
                                <span class="help-block" id="dr_email_tips"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('检核人'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="data[checker]" value="<?php echo $data['checker']; ?>" ></label>
                                <span class="help-block" id="remark"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('时间'); ?>：</label>
                            <div class="col-md-9">
                                <div class="col-md-9">
                                    <label style="margin-right: 10px;"><?php echo dr_field_input('time', 'Date', array('option'=>array('format'=>'Y-m-d','width'=>120)), (int)$time); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('备注'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="data[remark]" value="<?php echo $data['remark']; ?>" ></label>
                                <span class="help-block" id="remark"></span>
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
                                <button type="submit" class="btn green" onclick="$('#dr_action').val('back')"> <i class="fa fa-save"></i> <?php echo fc_lang('保存并返回'); ?></button>
                                <?php if (!$data['id']) { ?>
                                <button type="submit" class="btn default" onclick="$('#dr_action').val('continue')"> <i class="fa fa-save"></i> <?php echo fc_lang('保存并继续'); ?></button>
                                <?php } ?>
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