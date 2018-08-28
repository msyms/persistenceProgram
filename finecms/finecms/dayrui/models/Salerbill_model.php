<?php

class Salerbill_model extends M_Model {

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
     * 会员基本信息
     */
    public function get_bill_detail($key, $type = 0) {

        $sql = "select detail.*,customer.cname,price.unit,price.price 
                from fn_saler_bill_detail detail 
                left join fn_customer customer on detail.customerId = customer.id
                left join fn_customer_price price on customer.id = price.customerId 
                where detail.billId = $key";
        $data = $this->db->query($sql)->result_array();
        if (!$data) {
            return NULL;
        }
        return $data;
    }



    /**
     * 会员信息
     */
    public function get_member($uid) {

        $uid = intval($uid);
        if (!$uid) {
            return NULL;
        }

        // 查询会员信息
        $db = $this->db
                     ->from($this->db->dbprefix('member').' AS m2')
                     ->join($this->db->dbprefix('member_data').' AS a', 'a.uid=m2.uid', 'left')
                     ->where('m2.uid', $uid)
                     ->limit(1)
                     ->get();
        if (!$db) {
            return NULL;
        }
        $data  = $db->row_array();
        if (!$data) {
            return NULL;
        }

        $data['uid'] = $uid;
        $data['avatar_url'] = '';
        if (defined('UCSSO_API')) {
            $data['avatar_url'] =  ucsso_get_avatar($uid);
        } else {
            foreach (array('png', 'jpg', 'gif', 'jpeg') as $ext) {
                if (is_file(SYS_UPLOAD_PATH.'/member/'.$uid.'/45x45.'.$ext)) {
                    $data['avatar_url'] = SYS_ATTACHMENT_URL.'member/'.$uid.'/45x45.'.$ext;
                    break;
                }
            }
            $data['avatar_url'] = $data['avatar_url'] ? $data['avatar_url'] : THEME_PATH.'admin/images/avatar_45.png';
        }



        return $data;
    }

    /**
     * 通过会员id取会员名称
     */
    function get_username($uid) {

        if (!$uid) {
            return NULL;
        }

        $data = $this->db->select('username')->where('uid', (int)$uid)->limit(1)->get('member')->row_array();

        return $data['username'];
    }

    public function upgrade($uid, $groupid, $limit, $time = 0) {

    }

    /**
     * 后台管理员验证登录
     */
    public function admin_login($username, $password) {

        $password = trim($password);
        // 查询用户信息
        $data = $this->db
                     ->select('`password`, `salt`, `adminid`,`uid`')
                     ->where('username', $username)
                     ->limit(1)
                     ->get('member')
                     ->row_array();
        // 判断用户状态
        if (!$data) {
            return -1;
        } elseif (md5(md5($password).$data['salt'].md5($password)) != $data['password']) {
            return -2;
        } elseif ($data['adminid'] == 0) {
            return -3;
        }

        // 保存会话
        $this->session->set_userdata('uid', $data['uid']);
        $this->session->set_userdata('admin', $data['uid']);
        $this->input->set_cookie('member_uid', $data['uid'], 86400);
        $this->input->set_cookie('member_cookie', substr(md5(SYS_KEY . $data['password']), 5, 20), 86400);

        return $data['uid'];
    }

    /**
     * 管理员用户信息
     */
    public function get_admin_member($uid, $verify = 0) {

        // 查询用户信息
        $data = $this->db
                     ->select('m.uid,m.email,m.username,m.adminid,m.groupid,a.realname,a.usermenu,a.color')
                     ->from($this->db->dbprefix('member').' AS m')
                     ->join($this->db->dbprefix('admin').' AS a', 'a.uid=m.uid', 'left')
                     ->where('m.uid', $uid)
                     ->limit(1)
                     ->get()
                     ->row_array();
        if (!$data) {
            return 0;
        } elseif ($verify) {
            // 判断用户状态
            if ($data['adminid'] == 0) {
                return -3;
            }
        }

        $role = $this->dcache->get('role');
        $data['role'] = $role[$data['adminid']];
        $data['usermenu'] = dr_string2array($data['usermenu']);

        return $data;
    }



    /**
     * 管理人员
     */
    public function get_admin_all($roleid = 0, $keyword = NULL) {

        $select = $this->db
                       ->from($this->db->dbprefix('admin').' AS a')
                       ->join($this->db->dbprefix('member').' AS b', 'a.uid=b.uid', 'left');
        $keyword && $select->like('b.username', $keyword);

        return $select->get()->result_array();
    }

    /**
     * 添加管理人员
     */
    public function insert_admin($insert, $update, $uid) {
        $this->db->where('uid', $uid)->update('member', $update);
        $this->db->replace('admin', $insert);
    }

    /**
     * 修改管理人员
     */
    public function update_admin($insert, $update, $uid) {
        $this->db->where('uid', $uid)->update('member', $update);
        $this->db->where('uid', $uid)->update('admin', $insert);
    }

    /**
     * 移除管理人员
     */
    public function del_admin($uid) {

        if ($uid == 1) {
            return NULL;
        }

        $this->db->where('uid', $uid)->delete('admin');
        $this->db->where('uid', $uid)->update('member', array('adminid' => 0));
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

        $select = $this->db->limit(SITE_ADMIN_PAGESIZE, SITE_ADMIN_PAGESIZE * ($page - 1));
        $_param = $this->_where($select, $param);
        $order = dr_get_order_string(isset($_GET['order']) && strpos($_GET['order'], "undefined") !== 0 ? $this->input->get('order', TRUE) : 'id desc', 'id desc');
        $data = $select->order_by($order)->get('saler')->result_array();
        $_param['total'] = $total;
        $_param['order'] = $order;
        return array($data, $_param);
    }

    /**
     * 更新分数
     */
    public function update_score($type, $uid, $val, $mark, $note = '', $count = 0) {

        if (!$uid || !$val) {
            return NULL;
        }

        $table = $this->db->dbprefix('member_scorelog');
        if ($count && $this->db->where('type', (int)$type)->where('mark', $mark)->count_all_results($table) >= $count) {
            return NULL;
        }

        $data = $this->db->select('score,experience')->where('uid', $uid)->get('member')->row_array();
        $score = $type ? (int)$data['score'] : (int)$data['experience'];
        $value = $score + $val;
        $value = $value > 0 ? $value : 0; // 不允许积分或虚拟币小于0
        unset($data);

        // 更新
        $type ? $this->db->where('uid', (int)$uid)->update('member', array('score' => $value)) : $this->db->where('uid', (int)$uid)->update('member', array('experience' => $value));

        unset($value);

        $this->db->insert($table, array(
            'uid' => $uid,
            'type' => $type,
            'mark' => $mark,
            'note' => $note,
            'value' => $val,
            'inputtime' => SYS_TIME,
        ));

        return $this->db->insert_id();
    }

    /**
     * 会员初始化处理
     */
    public function init_member() {

    }

    /**
     * 邮件发送
     */
    public function sendmail($tomail, $subject, $message) {

        if (!$tomail || !$subject || !$message) {
            return FALSE;
        }

        $cache = $this->ci->get_cache('email');
        if (!$cache) {
            return NULL;
        }

        $this->load->library('Dmail');
        foreach ($cache as $data) {
            $this->dmail->set(array(
                'host' => $data['host'],
                'user' => $data['user'],
                'pass' => $data['pass'],
                'port' => $data['port'],
                'from' => $data['user'],
            ));
            if ($this->dmail->send($tomail, $subject, $message)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * 短信发送
     */
    public function sendsms($mobile, $content) {

        if (!$mobile || !$content) {
            return FALSE;
        }

        $file = WEBPATH.'config/sms.php';
        if (!is_file($file)) {
            return FALSE;
        }

        $config = require_once $file;
        if ($config['third']) {
            $this->load->helper('sms');
            if (function_exists('my_sms_send')) {
                $result = my_sms_send($mobile, $content, $config);
            } else {
                return FALSE;
            }
        } else {
            $result = dr_catcher_data('http://sms.dayrui.com/index.php?uid='.$config['uid'].'&key='.$config['key'].'&mobile='.$mobile.'&content='.$content.'【'.$config['note'].'】&domain='.trim(str_replace('http://', '', SITE_URL), '/').'&sitename='.SITE_NAME);
            if (!$result) {
                return FALSE;
            }
            $result = dr_object2array(json_decode($result));
        }

        @file_put_contents(WEBPATH.'cache/sms_error.log', date('Y-m-d H:i:s').' ['.$mobile.'] ['.$result['msg'].'] （'.str_replace(array(chr(13), chr(10)), '', $content).'）'.PHP_EOL, FILE_APPEND);

        return $result;
    }

    /**
     * 验证码加密
     */
    public function get_encode($uid) {
        $randcode = rand(1000, 999999);
        $this->encrypt->set_cipher(MCRYPT_BLOWFISH);
        $this->db->where('uid', $uid)->update('member', array('randcode' => $randcode));
        return $this->encrypt->encode(SYS_TIME.','.$uid.','.$randcode);
    }

    /**
     * 验证码解码
     */
    public function get_decode($code) {
        $code = str_replace(' ', '+', $code);
        $this->encrypt->set_cipher(MCRYPT_BLOWFISH);
        return $this->encrypt->decode($code);
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

    public function add_notice($uid, $type, $note) {

    }


}
