<?php

class Member_module extends App_model
{
    public function check_login()
    {

        $this -> db -> select('*');

        $this -> db -> from('membermaster');

        $this -> db -> where('username', ''.$_POST['username'].'');

        $this -> db -> where('password', ''.$_POST['password'].'');

        $this -> db -> where('status !=', 'Delete');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }


    public function get_member_by_id($id = '')
    {

        $this -> db -> select('*');

        $this -> db -> from('membermaster');

        $this -> db -> where('usercode', ''.$id.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content[0];

    }


    public function check_admin($eid)
    {

        $this -> db -> select('*');

        $this -> db -> from('admin');

        $this -> db -> where('usercode', ''.$eid.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        $val	=	(isset($the_content[0])) ? true : false;

        return $val;
    }

    public function check_adm_member($eid)
    {

        $this -> db -> select('*');

        $this -> db -> from('member_adm');

        $this -> db -> where('usercode', ''.$eid.'');

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        $val	=	(isset($the_content[0])) ? true : false;

        return $val;

    }




    public function left_right_set($eid)
    {

        $this -> db -> select('usercode');

        $this -> db -> from('downline_free');

        $this -> db -> where('usercode NOT IN (SELECT usercode FROM downline_right_left_user)');

        $this -> db -> where('usercode !=', '1');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }





    public function check_under_get_list()
    {
        $this -> db -> select('membermaster.*');

        $this -> db -> select('CONCAT(user2.fname," ",user2.lname) as ref_nm,user2.usercode as usercode2, user2.username as username2');

        $this -> db -> from('membermaster');

        $this -> db -> join('membermaster user2', 'user2.usercode=membermaster.referralid', 'left');

        $this -> db -> where('membermaster.status !=', 'Delete');

        $this -> db -> where('membermaster.usercode NOT IN (select usercode from downline_free)');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;
    }

    public function check_under_review_member($eid)
    {

        $this -> db -> select('*');

        $this -> db -> from('membermaster');

        $this -> db -> where('status !=', 'Delete');

        $this -> db -> where('usercode NOT IN (select usercode from downline_free)');

        $this -> db -> where('usercode', ''.$eid.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_downline_free($eid = '')
    {
        $this -> db -> select('*');

        $this -> db -> from('downline_free');

        $this -> db -> where('upling', ''.$eid.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_count_downline_free($eid = '')
    {

        $this -> db -> select('count(*) as tot');

        $this -> db -> from('downline_free');

        $this -> db -> where('upling', ''.$eid.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;
    }

    public function get_member_payment_gateway($eid)
    {

        $this -> db -> select('payment_option.name as payment_name,payment_option.img');

        $this -> db -> select('payment_option_detail.*');

        $this -> db -> from('payment_option_detail');

        $this -> db -> join('payment_option', 'payment_option.id = payment_option_detail.option_code', 'left');

        $this -> db -> where('payment_option_detail.status', 'Active');

        $this -> db -> where('payment_option_detail.usercode', ''.$eid.'');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_payment_gateway_list()
    {

        $this -> db -> select('*');

        $this -> db -> from('payment_option');

        $this -> db -> where('status !=', 'Delete');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_adm_member()
    {

        $this -> db -> select('member_adm.*');

        $this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username');

        $this -> db -> from('member_adm');

        $this -> db -> join('membermaster', 'membermaster.usercode = member_adm.usercode', 'left');

        $this -> db -> where('member_adm.status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;
    }

}
