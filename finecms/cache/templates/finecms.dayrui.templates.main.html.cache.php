<?php if ($fn_include = $this->_include("nheader.html")) include($fn_include); ?>

<style>

    span{

        color: red;

    }

</style>
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo dr_url('home/main'); ?>"><?php echo fc_lang('网站后台'); ?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a class="blue"><?php echo fc_lang('总览'); ?></a>
        </li>
    </ul>
    <div class="page-toolbar">
    </div>
</div>
<!-- END PAGE BAR -->

<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">
    <small></small>
</h3>

<?php if ($admin['usermenu']) { ?>
<div class="row" style="margin-bottom: 20px">
    <div class="col-md-12">
        <div class="admin-usermenu">
            <?php if (is_array($admin['usermenu'])) { $count=count($admin['usermenu']);foreach ($admin['usermenu'] as $t) { ?>
            <a class="btn <?php if ($t['color'] && $t['color']!='default') {  echo $t['color'];  } else { ?>btn-default<?php } ?>" href="<?php echo $t['url']; ?>"> <?php echo $t['name']; ?> </a>
            <?php } } ?>
        </div>
    </div>
</div>
<?php } ?>


<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user  font-red-sunglo" style="font-size: 20px;"></i>
                    <span class="caption-subject font-red-sunglo"><?php echo fc_lang('长时间未访问客户'); ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <table class="table table-light mtable">
                        <?php if (is_array($customerInfo)) { $count=count($customerInfo);foreach ($customerInfo as $t) { ?>
                        <tr>
                            <td>&nbsp;<span color="red"><?php echo $t['cname']; ?></span>&nbsp;上次访问时间为
                                <span><?php echo $t['saleTime']; ?></span>，
                                已经超过设置的&nbsp;<span><?php echo $t['meetTime']; ?></span>&nbsp;天访问期限</td>
                        </tr>
                        <?php } } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-6 col-sm-6">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user font-red-sunglo" style="font-size: 20px;"></i>
                    <span class="caption-subject font-red-sunglo  "><?php echo fc_lang('长时间未结款客户'); ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <table class="table table-light mtable">
                        <?php if (is_array($debtInfo)) { $count=count($debtInfo);foreach ($debtInfo as $t) { ?>
                        <tr>
                            <td>&nbsp;<span color="red"><?php echo $t['cname']; ?></span>&nbsp;上次访问时间为
                                <span><?php echo $t['saleTime']; ?></span>，欠款为<span>￥<?php echo $t['allDebt']; ?></span>元
                                已经超过设置的&nbsp;<span><?php echo $t['meetTime']; ?></span>&nbsp;天欠款期限</td>
                        </tr>
                        <?php } } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    var countCustomer = <?php echo json_encode($customerInfo); ?>;
    var debtInfo = <?php echo json_encode($debtInfo); ?>;
    console.log(countCustomer);
    var text = "客户";
    $.each(countCustomer,function (index,value) {
        text += '-' +value.cname + '-';
    })

    text += "据上次访问时间已超过设置时间";
    alert(text);
    var debtText = "客户";
    $.each(debtInfo,function (index,value) {
        debtText += '-' +value.cname + '-';
    })

    debtText += "欠款已超过设置时间";
    alert(debtText);
</script>
<?php if ($fn_include = $this->_include("nfooter.html")) include($fn_include); ?>