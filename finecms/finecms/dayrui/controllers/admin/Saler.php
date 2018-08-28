<?php


/**
 * FineCMS 公益软件
 *
 * @策划人 李睿
 * @开发组自愿者  邢鹏程 刘毅 陈锦辉 孙华军
 */

class Saler extends M_Controller {

    private $userinfo;

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
		$this->template->assign('menu', $this->get_menu_v3(array(
			fc_lang('添加') => array('admin/saler/add_js', 'plus')
		)));

    }

    /**
     * 首页
     */
    public function index() {

		if (IS_POST && $this->input->post('action')) {

            // ID格式判断
			$ids = $this->input->post('ids');
            !$ids && exit(dr_json(0, fc_lang('您还没有选择呢')));
			
			if ($this->input->post('action') == 'del') {
                // 删除
                !$this->is_auth('member/admin/home/del') && exit(dr_json(0, fc_lang('您无权限操作')));
				$this->member_model->delete($ids);
                defined('UCSSO_API') && ucsso_delete($ids);
                $this->system_log('删除会员【#'.@implode(',', $ids).'】'); // 记录日志
				exit(dr_json(1, fc_lang('操作成功，正在刷新...')));
			} else {
                // 修改会员组
                !$this->is_auth('member/admin/home/edit') && exit(dr_json(0, fc_lang('您无权限操作')));
				$gid = (int)$this->input->post('groupid');
				$note = fc_lang('您的会员组由管理员%s改变成：%s', $this->member['username'], $this->get_cache('member', 'group', $gid, 'name'));
				$this->db->where_in('uid', $ids)->update('member', array('groupid' => $gid));

                foreach ($ids as $uid) {
                    // 会员组升级挂钩点
                    $this->hooks->call_hook('member_group_upgrade', array('uid' => $uid, 'groupid' => $gid));
                    // 表示审核会员
                    $this->member_model->update_admin_notice('member/admin/home/index/field/uid/keyword/'.$uid, 3);
                }
                $this->system_log('修改会员【#'.@implode(',', $ids).'】的会员组'); // 记录日志
				exit(dr_json(1, fc_lang('操作成功，正在刷新...')));
			}
		}

        // 重置页数和统计
        IS_POST && $_GET['page'] = $_GET['total'] = 0;
	
		// 根据参数筛选结果
        $param = $this->input->get(NULL, TRUE);
        unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);
		
		// 数据库中分页查询
		list($data, $param) = $this->saler_model->limit_page($param, max((int)$_GET['page'], 1), (int)$_GET['total']);

        var_dump($data);
        $field = $this->get_cache('member', 'field');
        $field = array(
            'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
            'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
            'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
            'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
        ) + ($field ? $field : array());

        // 存储当前页URL
        $this->_set_back_url('member/index', $param);

		$this->template->assign(array(
			'list' => $data,
            'field' => $field,
			'param'	=> $param,
			'pages'	=> $this->get_pagination(dr_url('member/index', $param), $param['total']),
		));
		$this->template->display('saler_index.html');
    }
	
	/**
     * 添加
     */
    public function add() {

		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );

			// 单个添加
			$uid = $this->saler_model->addSaler( [
				'name'   => $data['name'],
				'carNo'  => $data['carNo'],
				'phone'  => $data['phone'],
				'remark' => $info?:'',
			] );

			$this->system_log( '添加会员【#' . $uid . '】' . $data['name'] ); // 记录日志
			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );

		}


	    $this->template->display('saler_add.html');
    }
	
	/**
     * 修改
     */
    public function edit() {
	
		$uid = (int)$this->input->get('id');
		$page = (int)$this->input->get('page');
		$data = $this->saler_model->get_saler($uid);

        !$data && $this->admin_msg(fc_lang('对不起，数据被删除或者查询不存在'));

		$field = array();

		if (IS_POST) {
			$edit = $this->input->post('member');
			$page = (int)$this->input->post('page');
			$post = $this->validate_filter($field, $data);
			if (isset($post['error'])) {
				$error = $post['msg'];
			} else {
				$update = array(
					'name' => $edit['name'],
					'phone' => $edit['phone'],
					'carNo' => $edit['carNo'],
				);


				var_dump($update);
				$this->db->where('id', $uid)->update('saler', $update);

				$this->admin_msg(fc_lang('操作成功，正在刷新...'), dr_url('saler/edit', array('id' => $uid, 'page' => $page)), 1);
			}
			$this->admin_msg($error, dr_url('saler/edit', array('id' => $uid, 'page' => $page)));
		}
		
		$this->template->assign(array(
			'data' => $data,
			'page' => $page,
			'myfield' => $this->field_input($field, $data, TRUE),
		));
		$this->template->display('saler_edit.html');
    }

    public function ajax_email() {

        $uid = (int)$this->input->get('uid');
        $email = $this->input->get('email');

        if (!$email || !preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/', $email)) {
            exit(fc_lang('邮箱格式不正确'));
        } elseif ($this->db->where('email', $email)->where('uid<>', $uid)->count_all_results('member')) {
            exit(fc_lang('该邮箱【%s】已经被注册', $email));
        }

        exit(0);
    }


}