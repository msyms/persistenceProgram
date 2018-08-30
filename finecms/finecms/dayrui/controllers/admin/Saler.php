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

        // 重置页数和统计
        IS_POST && $_GET['page'] = $_GET['total'] = 0;
	
		// 根据参数筛选结果
        $param = $this->input->get(NULL, TRUE);
        unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);
		
		// 数据库中分页查询
		list($data, $param) = $this->saler_model->limit_page($param, max((int)$_GET['page'], 1), (int)$_GET['total']);

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
			'pages'	=> $this->get_pagination(dr_url('saler/index', $param), $param['total']),
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

	/**
	 * 首页
	 */
	public function bill() {



		// 重置页数和统计
		IS_POST && $_GET['page'] = $_GET['total'] = 0;

		// 根据参数筛选结果
		$param = $this->input->get(NULL, TRUE);
		unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

		$salerId = $_GET['salerId'];
		// 数据库中分页查询
		list($data, $param) = $this->saler_model->bill_limit_page($salerId, max((int)$_GET['page'], 1), (int)$_GET['total']);



		$field = $this->get_cache('member', 'field');
		$field = array(
				'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
				'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
				'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
				'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
			) + ($field ? $field : array());
		$url = "admin/saler/billadd/salerId/{$salerId}";
		// 存储当前页URL
		$this->_set_back_url('saler/bill/billId/'.$salerId, $param);
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/index', 'reply'),
			fc_lang('添加') => array($url, 'plus')

		)));
		$this->template->assign(array(
			'list' => $data,
			'field' => $field,
			'param'	=> $param,
			'pages'	=> $this->get_pagination(dr_qxurl('saler/bill/salerId/'.$salerId, $param), $param['total']),
		));
		$this->template->display('salerbill_index.html');
	}

	/**
	 * 添加
	 */
	public function billadd() {
		$id = $_GET['salerId'];
		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );

			// 单个添加
			$uid = $this->saler_model->addSalerBill( [
				'salerId'   => $data['salerId'],
				'salerName'   => $data['salerName'],
				'bucketNum'  => $data['bucketNum'],
				'bottleNum'  => $data['bottleNum'],
				'checker' => $data['checker'],
				'saleTime' => $data['saleTime']?:date('Y-m-d'),
				'remark' => $info?:'',
			] );

			$this->admin_msg(
				fc_lang('操作成功，正在刷新...'),
				$this->_get_back_url('saler/bill', array('id' =>$id)),
				1,
				1
			);
		}
		$url = 'admin/saler/bill/salerId/'.$id;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply')
		)));
		$data = $this->saler_model->get_saler();
		$this->template->assign('salerId', $id);
		$this->template->assign('time', time());
		$this->template->display('salerbill_add.html');
	}

	/**
	 * 修改
	 */
	public function billedit() {

		$id = (int)$this->input->get('id');
		$cid = (int)$this->input->get('catid');
		$data = $this->content_model->get($id);
		$catid = $cid ? $cid : $data['catid'];
		$error = $myflag = array();
		unset($cid);

		// 数据判断
		!$data && $this->admin_msg(fc_lang('对不起，数据被删除或者查询不存在'));


		// 栏目缓存
		$category = $this->get_cache('category-'.SITE_ID);


		if (IS_POST) {
			$cid = (int)$this->input->post('catid');
			$catid = $cid;
			unset($cid);
			// 设置uid便于校验处理
			$uid = $this->input->post('data[author]') ? get_member_id($this->input->post('data[author]')) : 0;
			$_POST['data']['id'] = $id;
			$_POST['data']['uid'] = $uid;
			// 获取字段
			$myfield = array_merge($this->_get_field(), $this->sysfield);
			$post = $this->validate_filter($myfield, $data);
			if (isset($post['error'])) {
				$error = $post;
			} elseif (!$catid) {
				$error = array('error' => 'catid', 'msg' => fc_lang('还没有选择栏目'));
			} else {
				$post[1]['uid'] = $uid;
				$post[1]['catid'] = $catid;
				$post[1]['updatetime'] = $this->input->post('no_time') ? $data['updatetime'] : $post[1]['updatetime'];

				// 正常保存
				$this->content_model->edit($data, $post);
				// 执行提交后的脚本
				$this->validate_table($id, $myfield, $post);
				// 操作成功处理附件
				$this->attachment_handle($post[1]['uid'], $this->content_model->prefix.'-'.$id, $myfield, $data);

				$this->system_log('修改 站点【#'.SITE_ID.'】模型 内容【#'.$id.'】'); // 记录日志

				//exit;
				$this->admin_msg(
					fc_lang('操作成功，正在刷新...'),
					$this->_get_back_url('content/index', array('mid' => $this->mid)),
					1,
					1
				);
			}
			$data = $this->input->post('data', TRUE);
		} else {

		}


		// 可用字段
		$myfield = $this->_get_field($catid);

		$data['updatetime'] = SYS_TIME;
		$this->template->assign(array(
			'data' => $data,
			'menu' => $this->get_menu_v3(array(
				fc_lang('返回') => array('admin/content/index/mid/'.$this->mid, 'reply'),
				fc_lang('发布') => array('/admin/content/add/mid/'.$this->mid, 'plus')
			)),
			'catid' => $catid,
			'error' => $error,
			'select' => $this->select_category($category, $catid, 'id=\'dr_catid\' name=\'catid\' onChange="show_category_field(this.value)"', '', 1, 1),
			'myfield' => $this->new_field_input($myfield, $data, TRUE),
			'sysfield' => $this->new_field_input($this->sysfield, $data, TRUE, '', '<div class="form-group" id="dr_row_{name}"><label class="col-sm-12">{text}</label><div class="col-sm-12">{value}</div></div>'),

		));
		$this->template->display('content_add.html');
	}

	/**
	 * 首页
	 */
	public function billdetail() {


		$billId = $_GET['billId'];
		// 重置页数和统计
		IS_POST && $_GET['page'] = $_GET['total'] = 0;

		// 根据参数筛选结果
		$param = $this->input->get(NULL, TRUE);
		unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

		$billId = $_GET['billId'];
		// 数据库中分页查询
		list($data, $param) = $this->saler_model->get_bill_detail($billId);

		$field = $this->get_cache('member', 'field');
		$field = array(
				'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
				'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
				'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
				'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
			) + ($field ? $field : array());

		// 存储当前页URL
		$this->_set_back_url('member/index', $param);
		$url = 'admin/saler/billdetailadd/billId/'.$billId;
		// 存储当前页URL
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/index', 'reply'),
			fc_lang('添加') => array($url.'_js', 'plus')

		)));

		$this->template->assign(array(
			'list' => $data,
			'field' => $field,
			'param'	=> $param,
			'pages'	=> $this->get_pagination(dr_url('member/index', $param), $param['total']),
		));
		$this->template->display('billdetail_index.html');
	}


	public function billdetailadd() {
		$id = $_GET['billId'];


		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );

			// 单个添加
			$uid = $this->saler_model->addSalerBill( [
				'salerId'   => $data['salerId'],
				'salerName'   => $data['salerName'],
				'bucketNum'  => $data['bucketNum'],
				'bottleNum'  => $data['bottleNum'],
				'checker' => $data['checker'],
				'saleTime' => $data['saleTime']?:date('Y-m-d'),
				'remark' => $info?:'',
			] );

			$this->admin_msg(
				fc_lang('操作成功，正在刷新...'),
				$this->_get_back_url('saler/bill', array('id' =>$id)),
				1,
				1
			);
		}
		$url = 'admin/saler/billdetail/billId/'.$id;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply')
		)));
		$customer = $this->customer_model->get_all_customer();
		$this->template->assign('customer',$customer);
		$data = $this->saler_model->get_saler();
		$this->template->assign('billId', $id);
		$this->template->assign('time', time());
		$this->template->display('billdetail_add.html');
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