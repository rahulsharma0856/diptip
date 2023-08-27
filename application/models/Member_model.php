<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Member_model extends App_model
{
    public function is_paid($uid)
    {

        return true;

    }

    public function check_paid($uid = null)
    {

        return true;

    }

    public function check_login()
    {

        $this->db->select('*');

        $this->db->from('membermaster');

        $this->db->where('username like binary', $this->input->post('username', true));

        //$this -> db -> where('password like binary',$this->input->post('password'),TRUE);

        $this->db->where('status !=', 'Delete');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_member_by_id($id = '')
    {

        $this->db->select('*');

        $this->db->from('membermaster');

        $this->db->where('usercode', '' . $id . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function get_member_by_username($id = '')
    {

        $this->db->select('*');

        $this->db->from('membermaster');

        $this->db->where('username', '' . $id . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function check_admin($eid)
    {

        $this->db->select('*');

        $this->db->from('admin');

        $this->db->where('usercode', '' . $eid . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        $val = (isset($the_content[0])) ? true : false;

        return $val;
    }

    public function FriendStatusIcon($id)
    {

        $id = $this->db->escape($id);

        $sQuery = 'SELECT * FROM `social_friends`

		WHERE (`user_1` = "' . user_session('usercode') . '" AND `user_2` = ' . $id . ') OR (`user_2` = "' . user_session('usercode') . '" AND `user_1` = ' . $id . ')';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        if ( ! isset($the_content[0])) {

            $html = '<div class="btn btn-control bg-primary more reqicon" id="request_send" value=' . $id . ' title="Send Friend Request"><a href="#"><i class="fa fa-user-plus"></i></a></div>';

            $status = 'No Friend';

        } else {

            if ($the_content[0]['status'] == '1') {

                $html = '<div class="btn btn-control bg-green more reqicon" id="delete_friend" value=' . $id . ' title="Unfriend"><a href="#"><i class="fa fa-user"></i></a></div>';

                $status = 'Friend';

            }

            if ($the_content[0]['status'] == '0' && $the_content[0]['user_1'] == user_session('usercode')) {

                $html = '<div class="btn btn-control bg-purple more reqicon" id="request_delete" value=' . $id . ' title="Request Pending"><a href="#"><i class="fa fa-user-times"></i></a></div>';

                $status = 'Request Pending';

            }

            if ($the_content[0]['status'] == '0' && $the_content[0]['user_2'] == user_session('usercode')) {

                $html = '<div class="btn btn-control bg-blue reqicon more">

					<i class="fa fa-user-times"></i>

					<ul class="more-dropdown more-with-triangle triangle-bottom-right">

					<li> <a href="#" id="request_accept" value=' . $id . '>Accept Request</a> </li>

					<li> <a href="#" id="request_delete" value=' . $id . '>Delete Request</a> </li>

				</ul>

				<div class="ripple-container"></div>

				</div>';

                $status = 'Request Pending';

            }

        }

        return [

            'status' => $status,

            'html'   => $html,

        ];

    }

    public function Checkfriendstatus($id)
    {

        $id = $this->db->escape($id);

        $sQuery = 'SELECT * FROM `social_friends`

		WHERE (`user_1` = "' . user_session('usercode') . '" AND `user_2` = ' . $id . ') OR (`user_2` = "' . user_session('usercode') . '" AND `user_1` = ' . $id . ')';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content;

    }

    public function mutual_friends2($u1, $u2)
    {

        $sQuery = 'SELECT fid FROM ( SELECT (CASE WHEN user_1 = ' . $this->db->escape($u1) . ' THEN user_2 ELSE user_1 END) AS fid FROM social_friends WHERE (user_1 = ' . $this->db->escape($u1) . ' OR user_2 = ' . $this->db->escape($u1) . ') AND status = "1"

		UNION ALL

		SELECT (CASE WHEN user_1 = ' . $this->db->escape($u2) . ' THEN user_2 ELSE user_1 END) AS fid FROM social_friends WHERE (user_1 = ' . $this->db->escape($u2) . ' OR user_2 = ' . $this->db->escape($u2) . ') AND status = "1" ) FLIST GROUP BY fid HAVING COUNT(*) = 2';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content;

    }

    public function mutual_friends($uid = 0)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT a.friendID

		FROM

		(SELECT
			CASE WHEN user_1 = ' . $uid . '
			THEN user_2
			ELSE user_1
			END
			AS friendID
			FROM social_friends
			WHERE (user_1 = ' . $uid . ' OR user_2 = ' . $uid . ') AND status = "1"
		) a

		JOIN

		( SELECT
			CASE WHEN user_1 = "' . user_session('usercode') . '"
			THEN user_2
			ELSE user_1
			END
			AS friendID
			FROM social_friends
			WHERE (user_1 = "' . user_session('usercode') . '" OR user_2 = "' . user_session('usercode') . '") AND status = "1"
		) b

		ON b.friendID = a.friendID';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content;

    }

    public function friend_request_send($uid)
    {

        $data = [

            'user_1'         => user_session('usercode'),

            'user_2'         => $uid,

            'status'         => '0',

            'action_user_id' => user_session('usercode'),

            'time_dt'        => time(),

        ];

        $this->comman_fun->addItem($data, 'social_friends');

    }

    public function friend_request_delete($id, $usercode)
    {

        $this->comman_fun->delete('social_friends', ['id' => $id]);

        $this->comman_fun->delete('social_friends_detail', ['usercode' => user_session('usercode'), 'friend' => $usercode]);

        $this->comman_fun->delete('social_friends_detail', ['usercode' => $usercode, 'friend' => user_session('usercode')]);

    }

    public function GetPendingfriendRequestForAccept($id)
    {

        $id = $this->db->escape($id);

        $sQuery = 'SELECT * FROM `social_friends`

		WHERE (`user_1` = ' . $id . ' AND `user_2` = "' . user_session('usercode') . '" AND status = "0")';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getMemberFriendRequest($uid, $limit = 50)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT social_friends.*, CONCAT(m.fname," ",m.lname) as name, m.username

		FROM `social_friends`

		LEFT JOIN membermaster as m ON m.usercode =  social_friends.user_1

		WHERE (social_friends.user_2 = ' . $uid . ' AND social_friends.status = "0")

		GROUP BY social_friends.action_user_id

		ORDER BY social_friends.time_dt ASC LIMIT ' . $limit . '';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        for ($i = 0; $i < count($the_content); $i++) {

            $the_content[$i]['profile_img'] = ($the_content[$i]['profile_img'] != '') ? $the_content[$i]['profile_img'] : "profile.png";

        }

        return $the_content;

    }

    public function isMyFriend($id)
    {

        $id = $this->db->escape($id);

        $sQuery = 'SELECT * FROM `social_friends`

		WHERE (`user_1` = "' . user_session('usercode') . '" AND `user_2` = ' . $id . ') OR (`user_2` = "' . user_session('usercode') . '" AND `user_1` = ' . $id . ') AND status="1"';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return (isset($the_content[0])) ? true : false;

    }

    public function friend_request_accept($id)
    {

        $data = [

            'status' => '1',

        ];

        $this->comman_fun->update($data, 'social_friends', [

            'user_1' => $id,

            'user_2' => user_session('usercode'),

            'status' => '0',

        ]);

        $data = [

            'usercode' => user_session('usercode'),

            'friend'   => $id,

            'status'   => 1,

            'time_dt'  => time(),
        ];

        $this->comman_fun->addItem($data, 'social_friends_detail');

        $data = [

            'usercode' => $id,

            'friend'   => user_session('usercode'),

            'status'   => 1,

            'time_dt'  => time(),

        ];

        $this->comman_fun->addItem($data, 'social_friends_detail');

        //firend request notification

        $notification = [

            'type'      => 'friend_request_accept',

            'usercode'  => $id,

            'usercode2' => user_session('usercode'),

        ];

        $this->Notification_model->add_notification($notification);

    }

    public function getMemberFriend($uid)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT social_friends_detail.*,

		CONCAT(m.fname," ",m.lname) as name, m.username as username, m.profile_img as profile_img

		FROM `social_friends_detail`

		LEFT JOIN membermaster as m ON m.usercode = social_friends_detail.friend

		WHERE social_friends_detail.usercode = ' . $uid . '  AND social_friends_detail.status = "1"';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $this->arrangeMemberFriend($the_content, $uid);

    }

    public function getMemberFilterFriend($uid = null, $start = 0, $filter = null, $limit = 10)
    {

        $where = "";

        $filter = $this->db->escape_like_str($filter);

        $uid = $this->db->escape($uid);

        if ($filter != null) {

            $where = ' AND (m.fname LIKE "%' . $filter . '%" OR m.lname LIKE "%' . $filter . '%") ';

        }

        $sQuery = 'SELECT social_friends_detail.*,

		CONCAT(m.fname," ",m.lname) as name, m.username as username, m.profile_img as profile_img

		FROM `social_friends_detail`

		INNER JOIN membermaster as m ON m.usercode = social_friends_detail.friend AND m.status = "Active"

		WHERE social_friends_detail.usercode = ' . $uid . '  AND social_friends_detail.status = "1"

		' . $where . '

		ORDER BY m.fname ASC

		LIMIT ' . $start . ', ' . $limit . '

		';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $this->arrangeMemberFriend($the_content, $uid);

    }

    public function getCountMemberFriend($uid)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT COUNT(*) as tot FROM `social_friends`

		WHERE ( `user_1` = ' . $uid . ' OR `user_2` = ' . $uid . ' ) AND status = "1"';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return (int) $the_content[0]['tot'];

    }

    public function getCountMemberFriendRequest($uid)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT COUNT(*) as tot FROM `social_friends`

		WHERE `user_2` = ' . $uid . '  AND status = "0" GROUP BY `action_user_id`';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return count($the_content);

    }

    public function getTotalFriendsRequest($uid)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT COUNT(*) as tot FROM `social_friends`

		WHERE user_2` = ' . $uid . '  AND status = "0"';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return (int) $the_content[0]['tot'];

    }

    public function arrangeMemberFriend($result, $current_user_id)
    {

        $return = [];

        for ($i = 0; $i < count($result); $i++) {

            $result[$i]['profile_img'] = ($result[$i]['profile_img'] != '') ? $result[$i]['profile_img'] : "profile.png";

        }

        return $result;

    }

    public function find_member()
    {

        $filter = preg_replace('/\s\s+/', ' ', $_GET['q']);

        $filter = explode(" ", $filter);

        $sWhere .= ' WHERE status="Active"';

        if (isset($filter[1])) {

            $sWhere .= '(fname=' . $this->db->escape($filter[0]) . ' AND lname  LIKE "%' . $this->db->escape_like_str($filter[1]) . '%")';

        } else {

            $sWhere .= ' AND (fname=' . $this->db->escape($filter[0]) . ' OR lname  LIKE "%' . $this->db->escape_like_str($filter[0]) . '%" OR username  LIKE "%' . $this->db->escape_like_str($filter[0]) . '%" )';

        }

        $sQuery = 'SELECT CONCAT(fname," ",lname) as name, username, usercode, profile_img

		FROM membermaster

		' . $sWhere . '

		LIMIT 7

		';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_member_work($eid)
    {

        $this->db->select('*');

        $this->db->from('work_experience');

        $this->db->where('usercode', '' . $eid . '');

        $this->db->where('status !=', 'Delete');

        $this->db->order_by('id', 'Desc');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_last_recent_friends_pic($uid)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT social_friends_detail.*, m.fname,CONCAT(m.fname," ",m.lname) as name, m.username,m.profile_img

		FROM `social_friends_detail`

		LEFT JOIN membermaster as m ON m.usercode =  social_friends_detail.friend

		WHERE (social_friends_detail.usercode = ' . $uid . ' AND social_friends_detail.status = "1")

		ORDER By social_friends_detail.id DESC LIMIT 8';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        for ($i = 0; $i < count($the_content); $i++) {

            $the_content[$i]['profile_img'] = ($the_content[$i]['profile_img'] != '') ? $the_content[$i]['profile_img'] : "profile.png";

        }

        return $the_content;
    }

    public function Suggested_friends($uid)
    {

        $uid = $this->db->escape($uid);

        $sQuery = 'SELECT social_friends_detail.*,

			CONCAT(m.fname," ",m.lname) as name, m.username as username, m.profile_img as profile_img

			FROM social_friends_detail

			LEFT JOIN membermaster as m ON m.usercode = social_friends_detail.friend

			WHERE

			social_friends_detail.usercode IN (SELECT friend FROM social_friends_detail WHERE usercode = ' . $uid . ')

			AND social_friends_detail.friend NOT IN (SELECT friend FROM social_friends_detail WHERE usercode = ' . $uid . ')

			AND social_friends_detail.friend !=' . $uid . ' group by social_friends_detail.friend

			ORDER BY RAND() LIMIT 5 ';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        for ($i = 0; $i < count($the_content); $i++) {

            $mutual_friends = $this->mutual_friends($the_content[$i]['friend']);

            $the_content[$i]['mutual_friends'] = count($mutual_friends);

        }

        return $the_content;

    }

    public function find_member_by_id($id)
    {

        $this->db->select('CONCAT(fname," ",lname) as name, username, usercode, profile_img');

        $this->db->from('membermaster');

        $this->db->where('usercode', '' . $id . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        for ($i = 0; $i < count($the_content); $i++) {

            $friend = $this->Checkfriendstatus($the_content[$i]['usercode']);

            $mutual_friends = $this->mutual_friends($the_content[$i]['usercode']);

            $the_content[$i]['mutual_friends'] = count($mutual_friends);

            $the_content[$i]['friend'] = $friend[0];

        }

        return $the_content[0];

    }

    public function setLastActive()
    {

        $data = [

            'last_active' => time(),

        ];

        $this->comman_fun->update($data, 'membermaster', ['usercode' => user_session('usercode')]);

    }

    public function payment_summery_by_wallet($uid = null, $wallet = null)
    {

    }

    public function get_total_income_by_wallet($uid = null, $wallet = null)
    {

        $this->db->select('COALESCE(SUM(amount),0) as total');

        $this->db->from('m_income');

        $this->db->where('m_income.usercode', '' . $uid . '');

        $this->db->where('m_income.wallet', '' . $wallet . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0]['total'];

    }

    public function get_total_withdrawal_by_wallet($uid = null, $wallet = null)
    {

        $this->db->select('COALESCE(SUM(amount),0) as total');

        $this->db->from('m_withdrawal');

        $this->db->where('m_withdrawal.usercode', '' . $uid . '');

        $this->db->where('m_withdrawal.wallet', '' . $wallet . '');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content[0]['total'];

    }

    public function getCountryList()
    {

        $this->db->select('*');

        $this->db->from('web_countries');

        $this->db->where('status', 'Active');

        $this->db->order_by('name', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getMemberAds()
    {

        $this->db->select('*');

        $this->db->from('social_ads_create');

        $this->db->where('status', 'Active');

        $this->db->where('usercode', user_session('usercode'));

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function new_member_joining()
    {

        $this->db->select('*');

        $this->db->from('membermaster');

        $this->db->order_by('usercode', 'DESC');

        $this->db->limit(10);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

}
