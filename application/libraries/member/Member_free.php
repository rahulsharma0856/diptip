<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member_free {

	function get_member_by_id($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('*');
		$CI -> db -> from('membermaster');
		$CI -> db -> where('usercode',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content[0];
	}
	
	function get_member_by_username($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('*');
		$CI -> db -> from('membermaster');
		$CI -> db -> where('username',''.$eid.'');
		$query = $CI -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	function get_tree_downline($eid){
		$CI =& get_instance();
		$CI -> db -> select('downline_free.usercode, membermaster.username');
		$CI -> db -> select('CONCAT (membermaster.fname," ",membermaster.lname) as name',FALSE);
		$CI -> db -> from('downline_free');
		$CI -> db -> join('membermaster','membermaster.usercode = downline_free.usercode','left');
		$CI -> db -> where('downline_free.upling',''.$eid.'');
		$CI -> db -> order_by('downline_free.side','ASC');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content;
	}
	
	function count_tree_downline_member($eid){
		$CI =& get_instance();
		$CI -> db -> select('count(downline_free.usercode) as tot');
		$CI -> db -> from('downline_free');
		$CI -> db -> join('membermaster','membermaster.usercode = downline_free.usercode','left');
		$CI -> db -> where('downline_free.upling',''.$eid.'');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content[0];
	}
	
	function get_free_member_by_code($eid){
		$CI =& get_instance();
		$CI -> db -> select('downline_free.usercode, downline_free.upling, membermaster.username,downline_free.side');
		$CI -> db -> select('CONCAT (membermaster.fname," ",membermaster.lname) as name',FALSE);
		$CI -> db -> from('downline_free');
		$CI -> db -> join('membermaster','membermaster.usercode = downline_free.usercode','left');
		$CI -> db -> where('downline_free.usercode',''.$eid.'');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content[0];
	}
	
	function upling_chain($eid){
		$arr    = array();
		$CI =& get_instance();
		$code=$eid;
		while(true){
			$result = $this->get_free_member_by_code($code);
			
			if(!is_array($result)){
				break;	
			}
			if($result['usercode']==$CI->session->userdata['gcc_web_login']['usercode']){
				$arr[]=$result;
				break;
			}
			
			$arr[]=$result;
			$code=$result['upling'];
		}
		
		$arr=array_reverse($arr);
		
		return $arr;
		
	}
	
	function upling_chain_full($eid){
		$arr    = array();
		$CI =& get_instance();
		$code=$eid;
		while(true){
			$result = $this->get_free_member_by_code($code);
			
			if(!is_array($result)){
				break;	
			}
			if($result['usercode']=='1'){
				$arr[]=$result;
				break;
			}
			
			$arr[]=$result;
			$code=$result['upling'];
		}
		
		$arr=array_reverse($arr);
		
		return $arr;
		
	}
	
 
	function get_referral_member($eid){
		$CI =& get_instance();
		$CI -> db -> select('CONCAT (membermaster.fname," ",membermaster.lname) as name',FALSE);
		$CI -> db -> select('membermaster.usercode,membermaster.username,membermaster.*');
		$CI -> db -> from('membermaster');
		$CI -> db -> where('membermaster.referralid',''.$eid.'');
		$CI -> db -> order_by('membermaster.usercode','ASC');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content;
	}
	
	function count_total_referral($eid){
		$CI =& get_instance();
		$CI -> db -> select('count(membermaster.usercode) as tot');
		$CI -> db -> from('membermaster');
		$CI -> db -> where('membermaster.referralid',''.$eid.'');
		$CI -> db -> order_by('membermaster.usercode','ASC');
		$query = $CI -> db -> get();
		$the_content = $query->result_array();
		return $the_content[0];
	}
	
	

	
	
	
	function get_payment_option($eid)
	{
		$CI =& get_instance();
		$CI -> db -> select('payment_option.name as payment_name,payment_option.img');
		$CI -> db -> select('payment_option_detail.*');
		$CI -> db -> from('payment_option_detail');
		$CI -> db -> join('payment_option','payment_option.id = payment_option_detail.option_code','left');
		$CI -> db -> where('payment_option_detail.status','Active');
		$CI -> db -> where('payment_option_detail.usercode',''.$eid.'');
    	$query = $CI -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
	}
	
	
	

	
	
}
