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
		$search = $_POST['search'];
        $sname = $_POST['sname'];
	    $param['saler'] = $_GET['salerId'];
		// 根据参数筛选结果
        $param = $this->input->get(NULL, TRUE);
        unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);
		$param['search'] = $search;
        $param['sname'] = $sname;
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
        $this->template->assign('search',$search);
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

	    $saler = $this->db->select('*')->get('saler')->result_array();
		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );
			// 单个添加
			$uid = $this->customer_model->addCustomer( [
				'cname'   => $data['cname'],
				'address'  => $data['address'],
				'phone'  => $data['phone'],
				'salerId' => $data['salerId'],
				'debtTime' => $data['debtTime'],
				'meetTime' => $data['meetTime'],
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );

		}

		$this->template->assign('saler',$saler);
	    $this->template->display('customer_add.html');
    }

    public function exportCustomer() {
    	ob_end_clean();
		ob_start();
    	$date = date('Y-m-d');
    	$filename = $date.'客户信息.xls';
    	header('content-type:application/vnd.ms-excel;charset=UTF-8');
        header('content-disposition:attachment;filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Pragma:no-cache');
        header('Expires:0');
        header("Pragma: public");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");

        $title = array(
            '姓名',
            '电话',
            '地址',
	        '销售人员',
            '欠桶',
            '欠款',
            '押桶',
            '备注'
        );
        echo iconv('utf-8', 'gbk', implode("\t", $title)) . "\n";

        $list = $this->customer_model->get_all_customer();

        foreach ($list as $key => $value) {
            echo iconv('utf-8', 'gbk', implode("\t", $value)) . "\n";
        }
    }

    public function exportCustomerBill() {
    	$customerId = $_GET['customerId'];
    	$date = date('Y-m-d');
    	$filename = $date.'客户账单.xls';
    	header('content-type:application/vnd.ms-excel;charset=UTF-8');
        header('content-disposition:attachment;filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Pragma:no-cache');
        header('Expires:0');
        header("Pragma: public");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");

        $title = array(
            '姓名',
            '桶装水',
            '瓶装水',
	        '饮料',
            '价格',
            '回桶',
            '结款',
            '欠款',
            '欠桶',
            '押桶',
            '时间',
            '备注'
        );
        echo iconv('utf-8', 'gbk', implode("\t", $title)) . "\n";

        $list = $this->customer_model->get_customer_bill_exp($customerId);
        foreach ($list as $key => $value) {
            echo iconv('utf-8', 'gbk', implode("\t", $value)) . "\n";
        }
        return false;
    }
	
	/**
     * 修改
     */
    public function edit() {
	
		$customerId = (int)$this->input->get('customerId');
		$page = (int)$this->input->get('page');
		$data = $this->customer_model->get_customer($customerId);
	    $saler = $this->saler_model->get_all_saler();
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
					'salerId' => $edit['salerId'],
					'debtTime' => $edit['debtTime'],
					'meetTime' => $edit['meetTime'],
					'remark' => $edit['remark'],
				);
				$this->db->where('id', $customerId)->update('customer', $update);
				$this->admin_msg(fc_lang('操作成功，正在刷新...'), dr_url('customer/index', array( 'page' => $page)), 1);
			}
		}
		
		$this->template->assign(array(
			'data' => $data,
			'salerId' => $data['salerId'],
			'saler' => $saler,
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
	    $this->template->assign('customerId',$customerId);
	    $this->template->assign(array(
		    'list' => $data,
		    'field' => $field,
		    'param'	=> $param,
		    'pages'	=> $this->get_pagination(dr_qxurl('customer/bill/customer/'.$customerId, $param), $param['total']),
	    ));
	    $this->template->display('customerbill_index.html');
    }

    public function billDel() {
	    $billId = $this->_GET['billId'];
	    $this->customer_model->deletebill($billId);
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

	public function meet() {
		$data = $this->customer_model->getCustomerTime();
		$date = time();
		$debtInfo = [];
		foreach ( $data as $k => $v) {
			if($v['saleTime'] || $v['alldebt'] > 0) {
				$meet = ($date - strtotime($v['saleTime']))/(24*60*60);
				if($meet > $v['debtTime']) {
					$debtInfo[] = $v;
				}
			}

		}
		$this->template->assign('list',$debtInfo);
		$this->template->display('customer_meet.html');
	}

	public function debt() {
		$data = $this->customer_model->getCustomerDebt();
		$date = time();
		$debtInfo = [];
		foreach ( $data as $k => $v) {
			if($v['saleTime'] || $v['alldebt'] > 0) {
				$meet = ($date - strtotime($v['saleTime']))/(24*60*60);
				if($meet > $v['debtTime']) {
					$debtInfo[] = $v;
				}
			}

		}
		$this->template->assign('list',$debtInfo);
		$this->template->display('customer_debt.html');
	}



}