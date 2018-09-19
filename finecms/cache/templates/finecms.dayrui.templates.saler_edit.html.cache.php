<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>


<form class="form-horizontal" action="" method="post" id="myform" name="myform">
    <input name="page" id="page" type="hidden" value="<?php echo $page; ?>" />
    <div class="page-bar">
        <ul class="page-breadcrumb mylink">
            <?php echo $menu['link']; ?>

        </ul>
        <ul class="page-breadcrumb myname">
            <?php echo $menu['name']; ?>
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
                            <label class="col-md-2 control-label"><?php echo fc_lang('车牌号'); ?>：</label>
                            <div class="col-md-9">
                                <label><input class="form-control"  type="text" name="member[carNo]" value="<?php echo $data['carNo']; ?>" ></label>
                                <span class="help-block" id="dr_email_tips"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo fc_lang('所属公司'); ?>：</label>
                            <div class="col-md-7">

                                <label>
                                    <select name="member[type]" class="form-control" >
                                        <option value="1">绿矿</option>
                                        <option value="2" <?php if ($data['type'] == 2) { ?> selected <?php } ?>>今麦郎</option>
                                    </select>
                                </label>
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