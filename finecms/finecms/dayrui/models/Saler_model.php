<?php

class Saler_model extends M_Model {

	public function addSaler($data) {
		$this->db->insert('saler', $data);
		$uid = $this->db->insert_id();
		return $uid;
	}

	public function addSalerBill($data) {
		$this->db->insert('saler_bill', $data);
		$uid = $this->db->insert_id();
		return $uid;
	}

    public function addSalerFuel($data) {
        $this->db->insert('saler_fuel', $data);
        $uid = $this->db->insert_id();
        return $uid;
    }

	public function addBillDetail($data) {
        $customerId = $data['customerId'];//客户id
        $knot = $data['knot']?:0;//回款
        $debt = $data['debt']?:0;//欠款
        $depositBucket = $data['depositBucket']?:0;//押桶
        $debtBucket = $data['debtBucket']?:0;//欠桶
        $sql = "update fn_customer 
                set knot = knot + $knot,
                debtMoney = debtMoney + $debt,
                depositBucket = depositBucket + $depositBucket,
                debtBucket = debtBucket + $debtBucket
                where id = $customerId";
        $this->db->query($sql);
		$this->db->insert('saler_bill_detail', $data);
		$uid = $this->db->insert_id();
		return $uid;
	}

	public function delBillDetail($id,$edit) {
		$this->db->where('id',$id);
		$data = $this->db
			->limit(1)
			->select('customerId,knot,debt,depositBucket,debtBucket')
			->get('saler_bill_detail')
			->row_array();
		$customerId = $data['customerId'];
		$knot = $data['knot']?:0;//回款
		$debt = $data['debt']?:0;//欠款
		$depositBucket = $data['depositBucket']?:0;//押桶
		$debtBucket = $data['debtBucket']?:0;//欠桶
		$sql = "update fn_customer 
                set knot = knot - $knot,
                debtMoney = debtMoney - $debt,
                depositBucket = depositBucket - $depositBucket,
                debtBucket = debtBucket - $debtBucket
                where id = $customerId";
		$this->db->query($sql);
		$this->db->where('id', $id)->delete('saler_bill_detail');
	}

	public function editBillDetail($id,$customerId,$data) {
		$detail = $this->db->where('id', $id)->select("*")->get('saler_bill_detail')->row_array();
		$cust = $this->db->where('id',$customerId)->select("*")->get('customer')->row_array();
		$customer['knot'] = $cust['knot'] + $data['knot'] - $detail['knot'];
		$customer['debtBucket'] = $cust['debtBucket'] + $data['debtBucket'] - $detail['debtBucket'];
		$customer['debtMoney'] = $cust['debtMoney'] +$data['debt'] - $detail['debt'];
		$customer['depositBucket'] = $cust['depositBucket'] +$data['depositBucket'] - $detail['depositBucket'];
		$this->db->where('id', $id)->update('saler_bill_detail', $data);
		$this->db->where('id',$customerId)->update('customer',$customer);
		return 1;
	}


	/**
	 * 会员基本信息
	 */
	public function get_saler($key, $type = 0) {


		$this->db->where('id', (int)$key);

		$data = $this->db
			->limit(1)
			->select('id,name,phone,carNo,remark,type')
			->get('saler')
			->row_array();
		if (!$data) {
			return NULL;
		}
		return $data;
	}

	public function get_fuel_detail($fuelId) {
		$this->db->where('id', (int)$fuelId);

		$data = $this->db
			->limit(1)
			->select('id,rise,money,date,remark')
			->get('saler_fuel')
			->row_array();
		if (!$data) {
			return NULL;
		}
		return $data;
	}

	public function get_saler_bill($key) {
		$this->db->where('id', (int)$key);

		$data = $this->db
			->limit(1)
			->select('id,salerName,bucketNum,bottleNum,checker,saleTime,remark')
			->get('saler_bill')
			->row_array();
		if (!$data) {
			return NULL;
		}
		return $data;
	}

	public function get_bill_detail_info($detailId) {
		$sql = "select detail.*,customer.cname,price.unit,price.price from 
				fn_saler_bill_detail detail
				left join fn_customer customer on detail.customerId = customer.id 
				left join fn_customer_price price on detail.priceId = price.id 
				where detail.id = $detailId ";
		$result = $this->db->query($sql)->row_array();
        return $result;
	}




    public function get_saler_fuel($key, $page, $total, $search) {
        $countInfo = $this->db->where('salerId',$key)
            ->select('count(*) as total')->get('saler_fuel')->row_array();
        $total = $countInfo['total'];
        $select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
        $select->where('salerId',$key);
	    if(count($search)) {
		    $select->where('date >= ', $search['start']);
		    $select->where('date <= ', $search['end']);
	    }
        $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
        $data = $select->order_by($order)->get('saler_fuel')->result_array();
        $_param['total'] = $total;
        $_param['order'] = $order;
        return array($data, $_param);
    }

    //获取欠款人员
   	public function getdebtlist($salerId,$page = 1) 
	{
		$where = $this->db->where('salerId',$salerId)->where('debtMoney > 0 ');
		$total = $where->select('count(*) as total')->get('customer')->row_array();
		$data = $this->db->where('salerId',$salerId)->where('debtMoney > 0 ')
				->select("cname,phone,debtMoney")->get('customer')->result_array();
		$_param['total'] = $total['total'];
		$_param['page'] = $page;
		return array($data, $_param);
	}

    public function get_fuel_exp($salerId) {
        $sql = "select saler.name,saler.carNo,fuel.rise,fuel.money,fuel.date
                from fn_saler_fuel fuel 
                left join fn_saler saler on saler.id = fuel.salerId 
                where fuel.salerId = $salerId";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_saler_bill_exp($salerId) {
        $sql = "select salerName,bucketNum,bottleNum,checker,saleTime,remark 
                from fn_saler_bill where salerId = $salerId ";
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    public function get_all_saler() {
	    $data = $this->db->select('*')->get('saler')->result_array();
	    return $data;
    }

    /**
     * 条件查询
     */
    private function _where(&$select, $data) {


        // 存在POST提交时，重新生成缓存文件
        if (IS_POST) {
            $data = $this->input->post('data');
            foreach ($data as $i => $t) {
                if ($t == '') {
                    unset($data[$i]);
                }
            }
        }

        // 存在search参数时，读取缓存文件
        if ($data) {
            if (isset($data['keyword']) && $data['keyword'] != '' && $data['field']) {
                if ($data['field'] == 'uid') {
                    // 按id查询
                    $id = array();
                    $ids = explode(',', $data['keyword']);
                    foreach ($ids as $i) {
                        $id[] = (int)$i;
                    }
                    $select->where_in('uid', $id);
                } elseif ($data['field'] == 'ismobile') {
                    $select->where($data['field'], intval($data['keyword']));
                } elseif (in_array($data['field'], array('complete', 'is_auth'))) {
                    $select->where('uid IN (select uid from `'.$this->db->dbprefix('member_data').'` where `'.$data['field'].'` = '.intval($data['keyword']).')');
                } elseif (in_array($data['field'], array('phone', 'name', 'email', 'username'))) {
                    $select->like($data['field'], urldecode($data['keyword']));
                } else {
                    // 查询附表字段
                    $select->where('uid IN (select uid from `'.$this->db->dbprefix('member_data').'` where `'.$data['field'].'` LIKE "%'.urldecode($data['keyword']).'%")');
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
            $data = $select->get('saler')->row_array();
            unset($select);
            $total = (int) $data['total'];
            if (!$total) {
                $_param['total'] = 0;
                return array(array(), $_param);
            }
            $page = 1;
        }
		$date = date('Y-m-d',time());
        $sql = "select saler.*,
				case saler.type when 1 then '绿矿' when 2 then '今麦郎' else '绿矿' end as typename ,sum(detail.knot) as allknot,sum(detail.bucketNum) as allbucket,
				sum(detail.bottleNum) as allbottleNum,sum(detail.drinkNum) as alldrinkNum 
 				from fn_saler saler  
				left join fn_saler_bill bill on bill.salerId = saler.id and saleTime = '$date'
				left join fn_saler_bill_detail detail on detail.billId  = bill.id 
				group by saler.id ";
        $select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
        $_param = $this->_where($select, $param);
        $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
        $data = $this->db->query($sql)->result_array();
        $_param['total'] = $total;
        $_param['order'] = $order;
        return array($data, $_param);
    }

	public function get_bill_detail($key) {

		$sql = "select detail.*,customer.cname,price.unit,price.price,bill.saleTime  
                from fn_saler_bill_detail detail 
                left join fn_saler_bill bill on detail.billId = bill.id 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where detail.billId = $key order by detail.id desc ";
		$data = $this->db->query($sql)->result_array();
		if (!$data) {
			return NULL;
		}
		return $data;
	}

    public function bill_limit_page($key, $page, $total,$search) {
	    $countInfo = $this->db->where('salerId',$key)
		    ->select('count(*) as total')->get('saler_bill')->row_array();
	    $total = $countInfo['total'];
	    $select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
	    $select->where('salerId',$key);
	    $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
	    $data = $select->order_by($order)->get('saler_bill')->result_array();
	    $condition = '';
	    if(count($search)) {
		    $condition = " and bill.saleTime >= '{$search['start']}' and bill.saleTime <= '{$search['end']}' ";
	    }
	    $sql = "select bill.*,detail.bucketTotal,detail.knotTotal,detail.bottleTotal,detail.backNumTotal from fn_saler_bill bill
				left join (select billId,sum(knot) as knotTotal, sum(bucketNum) as bucketTotal,sum(bottleNum) as bottleTotal,
					  		sum(backBucketNum) as backNumTotal 
				 			from fn_saler_bill_detail GROUP BY billId ) detail 
				on bill.id = detail.billId
				where bill.salerId = $key {$condition} order by bill.id desc ";
	    $data = $this->db->query($sql)->result_array();
	    $_param['total'] = $total;
	    $_param['order'] = $order;
	    return array($data, $_param);
    }

	public function billdetail_limit_page($key, $page, $total) {
		$select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
		$select->where('billId',$key);
		$order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
		$data = $select->order_by($order)->get('saler_bill_detail')->result_array();
		$_param['total'] = $total;
		$_param['order'] = $order;
		return array($data, $_param);
	}



}
