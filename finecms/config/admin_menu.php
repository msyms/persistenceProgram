<?php

/**
 * FineCMS 公益软件
 *
 * @策划人 李睿
 * @开发组自愿者  邢鹏程 刘毅 陈锦辉 孙华军
 */

return array(

    array(
        'name' => '首页',
        'mark' => 'home',
        'icon' => 'fa fa-home',
        'menu' => array(
            array(
                'name' => '控制台',
                'mark' => 'home-home',
                'icon' => 'fa fa-home',
                'menu' => array(
                    array(
                        'name' => '后台首页',
                        'uri' => 'home/main',
                        'icon' => 'fa fa-home',
                    ),
                    /*array(
                        'name' => '资料修改',
                        'uri' => 'root/my',
                        'icon' => 'fa fa-user',
                    ),*/
                    array(
                        'name' => '销售人员',
                        'uri' => 'saler/index',
                        'icon' => 'fa fa-user',
                    ),
	                array(
		                'name' => '客户信息',
		                'uri' => 'customer/index',
		                'icon' => 'fa fa-calendar',
	                ),
                    array(
                        'name' => '库存信息',
                        'uri' => 'stock/index',
                        'icon' => 'fa fa-calendar',
                    ),
                    array(
                        'name' => '收入',
                        'uri' => 'money/income_index',
                        'icon' => 'fa fa-calendar',
                    ),
                    array(
                        'name' => '支出',
                        'uri' => 'money/pay_index',
                        'icon' => 'fa fa-calendar',
                    ),
                    array(
                        'name' => '超时访问客户',
                        'uri' => 'customer/meet',
                        'icon' => 'fa fa-bug',
                    ),
                    array(
                        'name' => '超时欠款客户',
                        'uri' => 'customer/debt',
                        'icon' => 'fa fa-bug',
                    ),
	                /*array(
						'name' => '客户信息',
						'uri' => 'system/index',
						'icon' => 'fa fa-calendar',
					),
					array(
						'name' => '升级版本',
						'uri' => 'upgrade/index',
						'icon' => 'fa fa-cloud',
					),*/
                )
            ),


        )
    ),

    /*array(
        'name' => '设置',
        'mark' => 'cog',
        'icon' => 'fa fa-cog',
        'menu' => array(
            array(
                'name' => '网站设置',
                'mark' => 'cog-sys',
                'icon' => 'fa fa-cog',
                'menu' => array(
                    array(
                        'name' => '后台设置',
                        'uri' => 'system/config',
                        'icon' => 'fa fa-cog',
                    ),
                    array(
                        'name' => '网站设置',
                        'uri' => 'site/config',
                        'icon' => 'fa fa-cog',
                    ),
                    array(
                        'name' => '网站管理',
                        'uri' => 'site/index',
                        'icon' => 'fa fa-globe',
                    ),
                    array(
                        'name' => '内容模型',
                        'uri' => 'module/index',
                        'icon' => 'fa fa-cogs',
                    ),
                    array(
                        'name' => '网站表单',
                        'uri' => 'form/index',
                        'icon' => 'fa fa-tasks',
                    ),
                    array(
                        'name' => '邮件设置',
                        'uri' => 'mail/index',
                        'icon' => 'fa fa-envelope',
                    ),
                    array(
                        'name' => '会员设置',
                        'uri' => 'member_setting/index',
                        'icon' => 'fa fa-cog',
                    ),
                    array(
                        'name' => '会员字段',
                        'uri' => 'admin/field/index/rname/member/rid/0',
                        'icon' => 'fa fa-code',
                    ),
                    array(
                        'name' => '管理员管理',
                        'uri' => 'root/index',
                        'icon' => 'fa fa-user',
                    ),
                )
            ),

        )
    ),

    array(
        'name' => '内容',
        'mark' => 'content',
        'icon' => 'fa fa-th-large',
        'menu' => array(
            array(
                'name' => '内容管理',
                'mark' => 'content-content',
                'icon' => 'fa fa-th-large',
                'menu' => array(
                    array(
                        'name' => '栏目管理',
                        'uri' => 'category/index',
                        'icon' => 'fa fa-list',
                    ),
                    array(
                        'name' => '关键词库',
                        'uri' => 'tag/index',
                        'icon' => 'fa fa-tag',
                    ),
                    array(
                        'name' => '附件管理',
                        'uri' => 'attachment/index',
                        'icon' => 'fa fa-folder',
                    ),
                    array(
                        'name' => '自定义内容',
                        'uri' => 'block/index',
                        'icon' => 'fa fa-th-large',
                    ),
                    array(
                        'name' => '会员管理',
                        'uri' => 'member/index',
                        'icon' => 'fa fa-user',
                    ),
                )
            ),

        )
    ),

    array(
        'name' => '微信',
        'mark' => 'weixin',
        'icon' => 'fa fa-weixin',
        'menu' => array(
            array(
                'name' => '微信管理',
                'mark' => 'weixin-weixin',
                'icon' => 'fa fa-weixin',
                'menu' => array(

                    array(
                        'name' => '账号接入',
                        'uri' => 'weixin/index',
                        'icon' => 'fa fa-cog',
                    ),
                    array(
                        'name' => '自定义菜单',
                        'uri' => 'wmenu/index',
                        'icon' => 'fa fa-table',
                    ),
                    array(
                        'name' => '微信粉丝',
                        'uri' => 'wuser/index',
                        'icon' => 'fa fa-user',
                    ),
                )
            ),

        )
    ),






    


    array(
        'name' => '插件',
        'mark' => 'myapp',
        'icon' => 'fa fa-puzzle-piece',
        'menu' => array(
            array(
                'name' => '插件管理',
                'mark' => 'app',
                'icon' => 'fa fa-puzzle-piece',
                'menu' => array(
                    array(
                        'name' => 'URL规则',
                        'uri' => 'urlrule/index',
                        'icon' => 'fa fa-magnet',
                    ),
                    array(
                        'name' => '联动菜单',
                        'uri' => 'linkage/index',
                        'icon' => 'fa fa-windows',
                    ),
                    array(
                        'name' => '数据结构',
                        'uri' => 'db/index',
                        'icon' => 'fa fa-database',
                    ),
                )
            ),

        )
    ),*/



);