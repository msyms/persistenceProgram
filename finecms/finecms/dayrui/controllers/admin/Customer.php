<?php


/**
 * FineCMS 公益软件
 *
 * @策划人 李睿
 * @开发组自愿者  邢鹏程 刘毅 陈锦辉 孙华军
 */

class Customer extends M_Controller {

    private $userinfo;

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
		$this->template->assign('menu', $this->get_menu_v3(array(
			fc_lang('添加') => array('admin/customer/add_js', 'plus')
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
		list($data, $param) = $this->customer_model->limit_page($param, max((int)$_GET['page'], 1), (int)$_GET['total']);

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
			'pages'	=> $this->get_pagination(dr_url('customer/index', $param), $param['total']),
		));
		$this->template->display('customer_index.html');
    }
	
	/**
     * 添加
     */
    public function add() {

		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );
			// 单个添加
			$uid = $this->customer_model->addCustomer( [
				'cname'   => $data['cname'],
				'address'  => $data['address'],
				'phone'  => $data['phone'],
				'debtBucket'  => $data['debtBucket'],
				'debtMoney'  => $data['debtMoney'],
				'depositBucket'  => $data['depositBucket'],
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );

		}


	    $this->template->display('customer_add.html');
    }
	
	/**
     * 修改
     */
    public function edit() {
	
		$uid = (int)$this->input->get('uid');
		$page = (int)$this->input->get('page');
		$data = $this->customer_model->get_customer($uid);

        !$data && $this->admin_msg(fc_lang('对不起，数据被删除或者查询不存在'));

		$field = array();

		if (IS_POST) {
			$edit = $this->input->post('member');
			$page = (int)$this->input->post('page');
			if (isset($post['error'])) {
				$error = $post['msg'];
			} else {

				$update = array(
					'cname' => $edit['cname'],
					'phone' => $edit['phone'],
					'address' => $edit['address'],
					'remark' => $edit['remark'],
				);

				$this->db->where('id', $uid)->update('customer', $update);

                $this->system_log('修改会员【'.$data['username'].'】资料'); // 记录日志
				$this->admin_msg(fc_lang('操作成功，正在刷新...'), dr_url('customer/edit', array('uid' => $uid, 'page' => $page)), 1);
			}
			$this->admin_msg($error, dr_url('customer/edit', array('uid' => $uid, 'page' => $page)));
		}
		
		$this->template->assign(array(
			'data' => $data,
			'page' => $page,
			'myfield' => $this->field_input($field, $data, TRUE),
		));
		$this->template->display('customer_edit.html');
    }

    public function bill() {
	    $customerId = $_GET['customerId'];
	    // 重置页数和统计
	    IS_POST && $_GET['page'] = $_GET['total'] = 0;

	    // 根据参数筛选结果
	    $param = $this->input->get(NULL, TRUE);
	    unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

	    // 数据库中分页查询
	    list($data, $param) = $this->customer_model->get_customer_bill($customerId, max((int)$_GET['page'], 1), (int)$_GET['total']);



	    $field = $this->get_cache('member', 'field');
	    $field = array(
			    'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
			    'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
			    'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
			    'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
		    ) + ($field ? $field : array());
	    // 存储当前页URL
	    $this->template->assign('menubill', $this->get_menu_v3(array(
		    fc_lang('返回') => array('admin/customer/index', 'reply')

	    )));
	    $this->template->assign(array(
		    'list' => $data,
		    'field' => $field,
		    'param'	=> $param,
		    'pages'	=> $this->get_pagination(dr_qxurl('customer/bill/customer/'.$customerId, $param), $param['total']),
	    ));
	    $this->template->display('customerbill_index.html');
    }

	public function price() {


		$customerId = $_GET['customerId'];
		// 重置页数和统计
		IS_POST && $_GET['page'] = $_GET['total'] = 0;

		// 根据参数筛选结果
		$param = $this->input->get(NULL, TRUE);
		unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

		$billId = $_GET['billId'];
		// 数据库中分页查询
		$data = $this->customer_model->get_price($customerId);
		$customerInfo = $this->customer_model->get_customer($customerId);
		$field = $this->get_cache('member', 'field');
		$field = array(
				'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
				'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
				'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
				'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
			) + ($field ? $field : array());

		// 存储当前页URL
		$this->_set_back_url('member/index', $param);
		$url = 'admin/customer/priceadd/customerId/'.$customerId;
		// 存储当前页URL
		$this->template->assign('menu', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/customer/index', 'reply'),
			fc_lang('添加') => array($url.'_js', 'plus')

		)));
		$cname = $customerInfo['cname'];
		$this->template->assign(array(
			'cname' => $cname,
			'list' => $data,
			'field' => $field,
			'param'	=> $param,
			'pages'	=> $this->get_pagination(dr_url('member/index', $param), $param['total']),
		));
		$this->template->display('customerprice_index.html');
	}

	public function getprice()
	{
		$customer = $_GET['cname'];
		if(!$customer){
			return ;
		}
		$data = $this->customer_model->get_price_bycustomer($customer);
		echo json_encode($data);
		return ;
	}

	public function priceadd() {
		$customerId = $_GET['customerId'];


		if (IS_POST) {

			$data = $this->input->post( 'data' );

			// 单个添加
			$uid = $this->customer_model->addprice( [
				'customerId'   => $data['customerId'],
				'unit'   => $data['unit'],
				'price'  => $data['price'],
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );
		}
		$url = 'admin/customer/pirce/customerId/'.$customerId;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply')
		)));
		$customerInfo = $this->customer_model->get_customer($customerId);
		$cname = $customerInfo['cname'];
		$customer = $this->customer_model->get_all_customer();
		$this->template->assign('cname',$cname);
		$this->template->assign('customerId', $customerId);
		$this->template->display('customerprice_add.html');
	}



}