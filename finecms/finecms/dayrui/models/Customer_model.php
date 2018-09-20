<?php

class Customer_model extends M_Model {

	public function addCustomer($data) {
		$this->db->insert('customer', $data);
		$uid = $this->db->insert_id();
		return $uid;
	}

	public function addprice($data) {
		$this->db->insert('customer_price', $data);
		$uid = $this->db->insert_id();
		return $uid;
	}

    /**
     * 会员修改信息
     */
    public function edit($main, $data) {

        if (isset($main['check']) && $main['check']) {
            $main['ismobile'] = 1;
            $main['randcode'] = '';
            unset($main['check'], $main['phone']);
        }

        if (isset($main['check'])) {
            unset($main['check']);
        }

        $this->db->where('uid', $this->uid)->update('customer', $main);

        $data['uid'] = $this->uid;
        $data['complete'] = 1;

        $this->db->replace('member_data', $data);

        return TRUE;
    }

    public function get_all_customer()
    {
	    $sql = "select customer.cname,customer.phone,customer.address,saler.name,customer.debtBucket,
	    customer.debtMoney,customer.depositBucket from fn_customer customer 
	    left join fn_saler saler on customer.salerId = saler.id ";
	    $data = $this->db
		    ->select('cname,phone,address,debtBucket,debtMoney,depositBucket')
		    ->get('customer')
		    ->result_array();
	    $data = $this->db->query($sql)->result_array();
	    if (!$data) {
		    return NULL;
	    }
	    return $data;
    }

	/**
	 * 会员基本信息
	 */
	public function get_customer($key, $type = 0) {

		$this->db->where('id', (int)$key);

		$data = $this->db
			->limit(1)
			->select('id,cname,phone,address,debtTime,meetTime,salerId,remark')
			->get('customer')
			->row_array();
		if (!$data) {
			return NULL;
		}
		return $data;
	}

	public function get_customer_name($customer) {
		$this->db->where('cname', $customer);
		$customer = $this->db->select('id')->get('customer')->row_array();
		return $customer['id'];
	}

    public function get_price_bycustomer($customer)
    {
        $this->db->where('cname', $customer);
        $customer = $this->db->select('id')->get('customer')->row_array();
        $this->db->where('customerId',$customer['id']);
        $data = $this->db
            ->select('id,unit,price')
            ->get('customer_price')
            ->result_array();
        if (!$data) {
            return NULL;
        }
        return $data;
    }

	public function get_price($key, $type = 0) {
		$this->db->where('customerId', (int)$key);
		$data = $this->db
			->select('id,unit,price')
			->get('customer_price')
			->result_array();
		if (!$data) {
			return NULL;
		}
		return $data;
	}

    /**
     * 会员基本信息
     */
    public function get_customer_detail($key, $type = 0) {


        $this->db->where('id', (int)$key);

        $data = $this->db
            ->select('id,cname,phone,address,remark')
            ->get('customer')
            ->row_array();
        if (!$data) {
            return NULL;
        }
        return $data;
    }

    /**
     * 会员基本信息
     */
    public function get_customer_price($key, $type = 0) {

        $this->db->where('customerId', (int)$key);

        $data = $this->db
                     ->select('unit,price')
                     ->get('customer_price')
                     ->row_array();
        if (!$data) {
            return NULL;
        }

        return $data;
    }

    public function get_customer_bill($customerId,$page) {
	    $countInfo = $this->db->where('customerId',$customerId)
		    ->select('count(*) as total')->get('saler_bill_detail')->row_array();
	    $total = $countInfo['total'];
	    $pagenow = SITE_ADMIN_PAGESIZE * ($page - 1);
	    $sql = "select detail.*,customer.cname,price.unit,price.price,bill.saleTime 
                from fn_saler_bill_detail detail 
                left join fn_saler_bill bill on detail.billId = bill.id 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id = $customerId limit $pagenow,".SITE_ADMIN_PAGESIZE;
	    $data = $this->db->query($sql)->result_array();
	    $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');

	    $_param['total'] = $total;
	    $_param['order'] = $order;
	    return array($data, $_param);
    }

    public function get_customer_bill_exp($customerId) {
        $sql = "select customer.cname,detail.bucketNum,detail.bottleNum,detail.drinkNum,
                CONCAT(price.unit,price.price) as unitpirce,detail.backBucketNum,detail.knot,
                detail.debt,detail.debtBucket,detail.depositBucket,
                bill.saleTime,detail.remark 
                from fn_saler_bill_detail detail 
                left join fn_saler_bill bill on detail.billId = bill.id 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id = $customerId ";
        $data = $this->db->query($sql)->result_array();
        
        return $data;
    }

    public function get_markrule($uid) {
        return 0;
    }

	/**
	 * @return mixed
	 * 获取用户欠款到访时间
	 */
    public function getCustomerTime() {
	    $sql = "select customer.*,detailG.saleTime,detailG.alldebt,saler.name  from fn_customer customer
				left join (
					SELECT detail.customerId,max(bill.saleTime) as saleTime ,sum(detail.debt) as alldebt
					from fn_saler_bill_detail detail 
					left join fn_saler_bill bill on detail.billId = bill.id
					group by detail.customerId) detailG on detailG.customerId = customer.id
				left join fn_saler saler on customer.salerId = saler.id 
				";
	    $data = $this->db->query($sql)->result_array();
	    return $data;
    }

    public function getCustomerDebt() {
	    $sql = "select customer.*,detailG.saleTime,detailG.alldebt,saler.name from fn_customer customer
				left join (
					SELECT detail.customerId,max(bill.saleTime) as saleTime ,sum(detail.debt) as alldebt
					from fn_saler_bill_detail detail 
					left join fn_saler_bill bill on detail.billId = bill.id 
					where detail.debt != 0 
					group by detail.customerId) detailG on detailG.customerId = customer.id
					left join fn_saler saler on customer.salerId = saler.id 
				";
	    $data = $this->db->query($sql)->result_array();
	    return $data;
    }








    /**
     * 条件查询
     */
    private function _where(&$select, $data) {


        
        // 存在search参数时，读取缓存文件
        if ($data) {
            $search = $data['search'];
            if($search) {
                if($search == 'debtBucket') {
                    //欠桶
                    $select->where('debtBucket > 0 ');
                }
                if($search == 'debtMoney') {
                    $select->where('debtMoney > 0 ');
                }
            }
            
        }


        return $data;
    }

    /**
     * 数据分页显示
     */
    public function limit_page($param, $page, $total) {

        if (!$total || IS_POST) {
            $select = $this->db->select('count(*) as total');
            $_param = $this->_where($select, $param);
            $data = $select->get('customer')->row_array();
            unset($select);
            $total = (int) $data['total'];
            if (!$total) {
                $_param['total'] = 0;
                return array(array(), $_param);
            }
            $page = 1;
        }

        $select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
        $_param = $this->_where($select, $param);
        $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
        $data = $select->order_by($order)->get('customer')->result_array();
        $_param['total'] = $total;
        $_param['order'] = $order;
	    $search = $param['search'];
	    $condition = 'where 1 = 1';
	    if($search) {
		    if($search == 'debtBucket') {
			    //欠桶
			    $condition .= ' and customer.debtBucket > 0 ';
		    }
		    if($search == 'debtMoney') {
			    $condition .= ' and customer.debtMoney > 0 ';
		    }
	    }
	    $salerId = $param['salerId'];
	    if($salerId) {
		    $condition .= " and customer.salerId = $salerId ";
	    }
	    $pagenow = SITE_ADMIN_PAGESIZE * ($page - 1);
	    $sql = "select customer.*,saler.name from fn_customer customer 
				left join fn_saler saler on customer.salerId = saler.id " .$condition
	            ." limit $pagenow, " . SITE_ADMIN_PAGESIZE ;
	    $data = $this->db->query($sql)->result_array();

        return array($data, $_param);
    }


    /**
     * 会员删除
     */
    public function delete($uids) {

        if (!$uids || !is_array($uids)) {
            return NULL;
        }

        $this->load->model('attachment_model');

        foreach ($uids as $uid) {
            if ($uid == 1) {
                continue;
            }
            $tableid = (int)substr((string)$uid, -1, 1);
            // 删除会员表
            $this->db->where('uid', $uid)->delete('member');
            // 删除会员附表
            $this->db->where('uid', $uid)->delete('member_data');
            // 删除管理员表
            $this->db->where('uid', $uid)->delete('admin');
            // 删除附件
            $this->attachment_model->delete_for_uid($uid);
            // 删除会员附件
            $this->load->helper('file');
            delete_files(SYS_UPLOAD_PATH.'/member/'.$uid.'/');
        }
    }



}
