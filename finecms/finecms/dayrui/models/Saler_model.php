<?php

class Saler_model extends M_Model {

	public function addSaler($data) {
		$this->db->insert('saler', $data);
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

        $this->db->where('uid', $this->uid)->update('member', $main);

        $data['uid'] = $this->uid;
        $data['complete'] = 1;

        $this->db->replace('member_data', $data);

        return TRUE;
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
        $select->where('salerId', intval($data['keyword']));
        $select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
        $_param = $this->_where($select, $param);
        $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
        $data = $select->order_by($order)->get('saler')->result_array();
        $_param['total'] = $total;
        $_param['order'] = $order;
        return array($data, $_param);
    }

}
