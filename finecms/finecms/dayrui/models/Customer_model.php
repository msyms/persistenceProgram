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
	    $data = $this->db
		    ->select('id,cname,phone,address,remark')
		    ->get('customer')
		    ->result_array();
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
			->select('id,cname,phone,address,remark')
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
	    $sql = "select detail.*,customer.cname,price.unit,price.price 
                from fn_saler_bill_detail detail 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on detail.priceId = price.id 
                where customer.id = $customerId limit $pagenow,".SITE_ADMIN_PAGESIZE;
	    $data = $this->db->query($sql)->result_array();
	    $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');

	    $_param['total'] = $total;
	    $_param['order'] = $order;
	    return array($data, $_param);
    }

    public function get_markrule($uid) {
        return 0;
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
