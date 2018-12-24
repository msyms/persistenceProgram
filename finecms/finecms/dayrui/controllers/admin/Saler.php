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
        foreach ($data as $k => $v) {
        	$sum['allknot'] += $v['allknot'];
        	$sum['allbucket'] += $v['allbucket'];
        	$sum['allbottleNum'] += $v['allbottleNum'];
        	$sum['alldrinkNum'] += $v['alldrinkNum'];
        }
        $this->template->assign('sum',$sum);
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
				'type'   => $data['type'],
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );

		}


		$this->template->display('saler_add.html');
	}




	/**
	 * 修改
	 */
	public function edit() {

		$salerId = (int)$this->input->get('salerId');
		$page = (int)$this->input->get('page');
		$data = $this->saler_model->get_saler($salerId);
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
					'type' => $edit['type'],
				);


				$this->db->where('id', $salerId)->update('saler', $update);

				$this->admin_msg(fc_lang('操作成功，正在刷新...'), dr_url('saler/index', array( 'page' => $page)), 1);
			}
			$this->admin_msg($error, dr_url('saler/index', array( 'page' => $page)));
		}

		$this->template->assign(array(
			'data' => $data,
			'page' => $page,
			'myfield' => $this->field_input($field, $data, TRUE),
		));
		$this->template->display('saler_edit.html');
	}


	public function fuel() {
		$search = [];
		$salerId = $_GET['salerId'];
		$time  =  isset($_POST['data']['time']) && $_POST['data']['time'] ? (int)$_POST['data']['time'] : (int)$this->input->get('time');
		if($time) {
			$search['start'] = date('Y-m-d',$_POST['data']['time']);
			$search['end'] = date('Y-m-d',$_POST['data']['time1'] );
			$time1 = strtotime($search['end']);
		}
		$time =  $time ? $time : SYS_TIME;
		if(!$time1) {
			$time1 = $time;
		}
	    // 重置页数和统计
	    IS_POST && $_GET['page'] = $_GET['total'] = 0;

	    // 根据参数筛选结果
	    $param = $this->input->get(NULL, TRUE);
	    unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

	    // 数据库中分页查询
	    list($data, $param) = $this->saler_model->get_saler_fuel($salerId, max((int)$_GET['page'], 1), (int)$_GET['total'], $search);

	    $field = $this->get_cache('member', 'field');
	    $field = array(
			    'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
			    'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
			    'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
			    'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
		    ) + ($field ? $field : array());
	    // 存储当前页URL
		$url = 'admin/saler/fueladd/salerId/'.$salerId;
	    $this->template->assign('menubill', $this->get_menu_v3(array(
		    fc_lang('返回') => array('admin/saler/index', 'reply'),
			fc_lang('添加') => array($url, 'plus')

	    )));
	    $salerInfo = $this->saler_model->get_saler($salerId);
	    $this->template->assign('salerId',$salerId);
	    $this->template->assign('salerInfo',$salerInfo);
	    $this->template->assign(array(
		    'time' => $time,
		    'time1' => $time1,
		    'list' => $data,
		    'field' => $field,
		    'param'	=> $param,
		    'pages'	=> $this->get_pagination(dr_qxurl('saler/fuel/salerId/'.$salerId, $param), $param['total']),
	    ));
	    $this->template->display('salerfuel_index.html');
	}

	public function fueladd() {
		$salerId = $_GET['salerId'];
		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );
			$id = $data['salerId'];
			// 单个添加
			$uid = $this->saler_model->addSalerFuel( [
				'salerId'   => $data['salerId'],
				'rise'   => $data['rise'],
				'money'  => $data['money'],
				'date'  => date('Y-m-d',$data['time'])
			] );

			$this->admin_msg(
				fc_lang('操作成功，正在刷新...'),
				$this->_get_back_url('saler/fuel', array('salerId' =>$id)),
				1,
				1
			);
		}

		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply'),
		)));
		$data = $this->saler_model->get_saler($salerId);
		$this->template->assign('salerId', $salerId);
		$this->template->assign('data', $data);
		$this->template->assign('time', time());
		$this->template->display('salerfuel_add.html');
	}

	public function fueledit() {
		$salerId = (int)$this->input->get('salerId');
		$salerInfo = $this->saler_model->get_saler($salerId);
		$fuelId = (int)$this->input->get('fuelId');
		$data = $this->saler_model->get_fuel_detail($fuelId);
		!$data && $this->admin_msg(fc_lang('对不起，数据被删除或者查询不存在'));

		$field = array();

		if (IS_POST) {
			$edit = $this->input->post('data');
			if (isset($post['error'])) {
				$error = $post['msg'];
			} else {
				$update = array(
					'rise' => $edit['rise'],
					'money' => $edit['money'],
					'date' => date('Y-m-d',$edit['time']),
					'remark' => $edit['remark'],
				);

				$this->db->where('id', $fuelId)->update('saler_fuel', $update);

				$this->admin_msg(fc_lang('操作成功，正在刷新...'), dr_url('saler/fuel', array('salerId' => $salerId, 'page' => $page)), 1);
			}
		}

		$this->template->assign(array(
			'data' => $data,
			'time' => strtotime($data['date']),
			'salerInfo' => $salerInfo,
			'page' => $page,
			'myfield' => $this->field_input($field, $data, TRUE),
		));
		$this->template->display('salerfuel_add.html');
	}
	/**
	 * 首页
	 */
	public function bill() {

		// 重置页数和统计
		IS_POST && $_GET['page'] = $_GET['total'] = 0;
		$time  =  isset($_POST['data']['time']) && $_POST['data']['time'] ? (int)$_POST['data']['time'] : (int)$this->input->get('time');
		if($time) {
			$search['start'] = date('Y-m-d',$_POST['data']['time']);
			$search['end'] = date('Y-m-d',$_POST['data']['time1'] );
			$time1 = strtotime($search['end']);
		}
		$time =  $time ? $time : SYS_TIME;
		if(!$time1) {
			$time1 = $time;
		}
		// 根据参数筛选结果
		$param = $this->input->get(NULL, TRUE);
		unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

		$salerId = $_GET['salerId'];
		// 数据库中分页查询
		list($data, $param) = $this->saler_model->bill_limit_page($salerId, max((int)$_GET['page'], 1), (int)$_GET['total'], $search);



		$field = $this->get_cache('member', 'field');
		$field = array(
				'username' => array('fieldname' => 'username','name' => fc_lang('会员名称')),
				'name' => array('fieldname' => 'name','name' => fc_lang('姓名')),
				'email' => array('fieldname' => 'email','name' => fc_lang('会员邮箱')),
				'phone' => array('fieldname' => 'phone','name' => fc_lang('手机号码')),
				''
			) + ($field ? $field : array());
		$url = "admin/saler/billadd/salerId/{$salerId}";
		$this->template->assign('salerId',$salerId);
		// 存储当前页URL
		$this->_set_back_url('saler/bill/billId/'.$salerId, $param);
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/index', 'reply'),
			fc_lang('添加') => array($url, 'plus')

		)));
		$this->template->assign(array(
			'time' => $time,
			'time1' => $time1,
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
				'drinkNum'   => $data['drinkNum'],
				'checker' => $data['checker'],
				'saleTime' => $data['saleTime']?:date('Y-m-d'),
				'remark' => $info?:'',
			] );

			$this->admin_msg(
				fc_lang('操作成功，正在刷新...'),
				$this->_get_back_url('saler/bill', array('salerId' =>$id)),
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

		$billId = (int)$this->input->get('billId');
		$salerId = (int)$this->input->get('salerId');
		$data = $this->saler_model->get_saler_bill($billId);

		!$data && $this->admin_msg(fc_lang('对不起，数据被删除或者查询不存在'));

		$field = array();

		if (IS_POST) {
			$edit = $this->input->post('data');
			$update = array(
				'salerName' => $edit['salerName'],
				'bucketNum' => $edit['bucketNum'],
				'bottleNum' => $edit['bottleNum'],
				'checker' => $edit['checker'],
				'saleTime' => date('Y-m-d',$edit['time']),
				'remark' => $edit['remark'],
			);
			$this->db->where('id', $billId)->update('saler_bill', $update);
			$this->admin_msg(
				fc_lang('操作成功，正在刷新...'),
				$this->_get_back_url('saler/bill', array('salerId' =>$salerId)),
				1,
				1
			);

		}
		$url = 'admin/saler/billdetailadd/billId/'.$billId;
		// 存储当前页URL
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/bill/salerId/'.$salerId, 'reply'),

		)));
		$this->template->assign(array(
			'time' => strtotime($data['saleTime']) ,
			'data' => $data,
			'myfield' => $this->field_input($field, $data, TRUE),
		));
		$this->template->display('salerbill_add.html');
	}

	/**
	 * 首页
	 */
	public function billdetail() {


		$billId = $_GET['billId'];
		$salerId = $_GET['salerId'];

		// 重置页数和统计
		IS_POST && $_GET['page'] = $_GET['total'] = 0;

		// 根据参数筛选结果
		$param = $this->input->get(NULL, TRUE);
		unset($param['s'], $param['c'], $param['m'], $param['d'], $param['page']);

		// 数据库中分页查询
		$data = $this->saler_model->get_bill_detail($billId);

		$url = 'admin/saler/billdetailadd/billId/'.$billId;
		// 存储当前页URL
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/bill/salerId/'.$salerId, 'reply'),
			fc_lang('添加') => array($url.'_js', 'plus')

		)));

		$this->template->assign(array(
			'salerId' => $salerId,
			'billId' => $billId,
			'list' => $data,
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
			$customerId = $this->customer_model->get_customer_name($data['cname']);
			// 单个添加
			$uid = $this->saler_model->addBillDetail( [
				'billId'   => $data['billId'],
				'customerId'   => $customerId,
				'priceId'   => $data['priceId'],
				'bucketNum'  => $data['bucketNum'],
				'bottleNum'  => $data['bottleNum'],
				'drinkNum'  => $data['drinkNum'],
				'backBucketNum'  => $data['backBucketNum'],
				'knot'  => $data['knot'],
				'debt'  => $data['debt'],
				'depositBucket'  => $data['depositBucket'],
				'debtBucket' => $data['debtBucket'],
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );
//			$this->admin_msg(
//				fc_lang('操作成功，正在刷新...'),
//				$this->_get_back_url('saler/bill', array('id' =>$id)),
//				1,
//				1
//			);
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

	public function detaildel() {
		$detailId = $_GET['detailId'];
		$billId = $_GET['billId'];
		$salerId = $_GET['salerId'];
		$id = $this->saler_model->delBillDetail($detailId);
		$this->admin_msg(
				fc_lang('操作成功，正在刷新...'),
				$this->_get_back_url('saler/billdetail', array('billId' =>$billId,'salerId'=>$salerId)),
				1,
				1
			);


	}


	public function billdetailedit() {
		$detailId = $_GET['detailId'];
		$data = $this->saler_model->get_bill_detail_info($detailId);
		$customerId = $data['customerId'];
		$priceInfo = $this->customer_model->get_customer_price($customerId);
		if (IS_POST) {

			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );
			$customerId = $this->customer_model->get_customer_name($data['cname']);
			// 单个添加
			$uid = $this->saler_model->editBillDetail($detailId,$customerId, [
				'customerId'   => $customerId,
				'priceId'   => $data['priceId'],
				'bucketNum'  => $data['bucketNum'],
				'bottleNum'  => $data['bottleNum'],
				'backBucketNum'  => $data['backBucketNum'],
				'knot'  => $data['knot'],
				'debt'  => $data['debt'],
				'depositBucket'  => $data['depositBucket'],
				'debtBucket' => $data['debtBucket'],
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );
//			$this->admin_msg(
//				fc_lang('操作成功，正在刷新...'),
//				$this->_get_back_url('saler/bill', array('id' =>$id)),
//				1,
//				1
//			);
		}
		$url = 'admin/saler/billdetail/billId/'.$id;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply')
		)));
		$customer = $this->customer_model->get_all_customer();
		$this->template->assign('customer',$customer);
		$this->template->assign('data',$data);
		$this->template->assign('priceInfo',$priceInfo);
		$data = $this->saler_model->get_saler();
		$this->template->assign('billId', $id);
		$this->template->assign('time', time());
		$this->template->display('billdetail_add.html');
	}

	//欠款列表
	public function debtlist() {
		$salerId = $_GET['salerId'];
		list($data, $param)  = $this->saler_model->getdebtlist($salerId);
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/index', 'reply')
		)));
		$this->template->assign(array(
			'list' => $data,
            'field' => $field,
			'param'	=> $param,
		));
		$this->template->display('saler_debtlist.html');

	}

	//陈列
	public function displayadd(){
		$salerId = $_GET['salerId'];
		if (IS_POST) {
			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );
			$customerId = $this->customer_model->get_customer_name($data['cname']);
			// 单个添加
			$uid = $this->saler_model->adddisplayDetail( [
				'salerId'      => $salerId,
				'customerId'   => $customerId,
				'bucketNum'  => $data['bucketNum'],
				'bottleNum'  => $data['bottleNum'],
				'drinkNum'  => $data['drinkNum'],
				'created'   => date('Y-m-d H:i:s',$data['time']),
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );
//			$this->admin_msg(
//				fc_lang('操作成功，正在刷新...'),
//				$this->_get_back_url('saler/bill', array('id' =>$id)),
//				1,
//				1
//			);
		}
		$url = 'admin/saler/displaywater/salerId/'.$salerId;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply')
		)));
		$customer = $this->customer_model->get_all_customer();
		$this->template->assign('customer',$customer);
		$saler = $this->saler_model->get_saler($salerId);
		$this->template->assign('saler',$saler);
		$this->template->assign('time', time());
		$this->template->display('display_add.html');
	}

	//陈列
	public function displayedit(){
		$id = $_GET['id'];
		$data = $this->saler_model->get_display_info($id);
		if (IS_POST) {
			$data = $this->input->post( 'data' );
			$info = $this->input->post( 'info' );
			$customerId = $this->customer_model->get_customer_name($data['cname']);
			// 单个添加
			$uid = $this->saler_model->editdisplayDetail($id, [
				'customerId'   => $customerId,
				'bucketNum'  => $data['bucketNum'],
				'bottleNum'  => $data['bottleNum'],
				'drinkNum'  => $data['drinkNum'],
				'created'   => date('Y-m-d H:i:s',$data['time']),
				'remark' => $info?:'',
			] );

			exit( dr_json( 1, fc_lang( '操作成功，正在刷新...' ) ) );
//			$this->admin_msg(
//				fc_lang('操作成功，正在刷新...'),
//				$this->_get_back_url('saler/bill', array('id' =>$id)),
//				1,
//				1
//			);
		}
		$url = 'admin/saler/displaywater/salerId/'.$salerId;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array($url, 'reply')
		)));
		$customer = $this->customer_model->get_all_customer();
		$this->template->assign('customer',$customer);
		$saler = $this->saler_model->get_saler($salerId);
		$this->template->assign('saler',$saler);
		$this->template->assign('data',$data);
		$this->template->assign('time', time());
		$this->template->display('display_add.html');
	}

	public function displaydel() {
		$id = $_GET['id'];
		$this->saler_model->deldisplay();
	}


	public function displaywater()  {
		$salerId = $_GET['salerId'];
		$data  = $this->saler_model->getdisplaylist($salerId);
		$saler = $this->saler_model->get_saler($salerId);
		
		$url = 'admin/saler/displayadd/salerId/'.$salerId;
		$this->template->assign('menubill', $this->get_menu_v3(array(
			fc_lang('返回') => array('admin/saler/index', 'reply'),
			fc_lang('添加') => array($url.'_js', 'plus')
		)));
		$this->template->assign(array(
			'list' => $data,
            'saler' => $saler,
			'param'	=> $param,
		));
		$this->template->display('display_index.html');
	}

	public function exportFuel() {
		$salerId = $_GET['salerId'];
    	$date = date('Y-m-d');
    	$filename = $date.'加油信息.xls';
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
            '销售人员',
            '车牌号',
            '加油量',
            '金额',
            '时间',
            '备注',
            
        );
        echo iconv('utf-8', 'gbk', implode("\t", $title)) . "\n";

        $list = $this->saler_model->get_fuel_exp($salerId);
        foreach ($list as $key => $value) {
            echo iconv('utf-8', 'gbk', implode("\t", $value)) . "\n";
        }
        return false;
	}

	public function exportBill() {
		$salerId = $_GET['salerId'];
    	$date = date('Y-m-d');
    	$filename = $date.'销售账单.xls';
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
            '销售人员',
            '桶装水',
            '回桶',
            '瓶装水',
            '检核人',
            '剩余桶装水',
            '剩余瓶装水',
            '回款',
            '时间',
            '备注'
        );
        echo iconv('utf-8', 'gbk', implode("\t", $title)) . "\n";
        $list = $this->saler_model->get_saler_bill_exp($salerId);
        foreach ($list as $key => $value) {
        	unset($value['id']);
        	unset($value['salerId']);
            echo iconv('utf-8', 'gbk', implode("\t", $value)) . "\n";
        }
        return false;
	}


}