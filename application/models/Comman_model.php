<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Comman_model extends App_model
{
		function active_ticket(){
			
			$uid = $this->session->userdata['smr_web_login']['usercode'];
			
			$this -> db -> select('support_master.*');
			
			$this -> db -> select('COUNT(support_detail.support_code) as rpy');
			
			$this -> db -> from('support_master');
			
			$this -> db -> join('support_detail','support_detail.support_code = support_master.support_code AND support_detail.type="A"','left');
			
			$this -> db -> where('support_master.usercode',''.$uid.'');
			
			$this -> db -> where('support_master.status','Active');
			
			$this -> db -> group_by('support_master.support_code');
			
			$this -> db -> order_by('support_master.support_code','DESC');
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;	
			
		}
		
		function close_ticket(){
			
			$uid = $this->session->userdata['smr_web_login']['usercode'];
			
			$this -> db -> select('support_master.*');
			
			$this -> db -> select('COUNT(support_detail.support_code) as rpy');
			
			$this -> db -> from('support_master');
			
			$this -> db -> join('support_detail','support_detail.support_code = support_master.support_code AND support_detail.type="A"','left');
			
			$this -> db -> where('support_master.usercode',''.$uid.'');
			
			$this -> db -> where('support_master.status','Close');
			
			$this -> db -> group_by('support_master.support_code');
			
			$this -> db -> order_by('support_master.support_code','DESC');
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;	
			
		}
		
		function active_ticket_by_code($eid){
			
			$uid = $this->session->userdata['smr_web_login']['usercode'];
			
			$this -> db -> select('support_master.*');
			
			$this -> db -> from('support_master');
			
			$this -> db -> where('support_master.usercode',''.$uid.'');
			
			$this -> db -> where('support_master.support_code',''.$eid.'');
			
			$this -> db -> where('support_master.status !=','Delete');
			
			$query 		=	 $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;	
			
		}
		
		function conversion_history($eid){
			
			$this -> db -> select('*');
			
			$this -> db -> from('support_detail');
			
			$this -> db -> where('support_code',''.$eid.'');
			
			$this -> db -> where('status','Active');
			
			$this -> db -> order_by('id','ASC');
			
			$query 		=	 $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;	
			
		}
		
		
		function testimonial_member($eid){
			
			
			$this -> db -> select('testimonial.*');
			
			
			$this -> db -> select('membermaster.fname, membermaster.lname');
			
		
			$this -> db -> from('testimonial');
			
			
			$this -> db -> join('membermaster','membermaster.usercode = testimonial.usercode','left');
			
			
			$this -> db -> where('testimonial.status','Active');
			
			if($eid!=''){
			
				$this -> db -> where('testimonial.id',''.$eid.'');
			
			}
			
	
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;	
		
	 }
	 
	 
	 
	 function get_page_list($section){
		 
			$this -> db -> select('page_title, id');
			
			$this -> db -> from('custom_cms_pages');
			
			$this -> db -> where('page_link',''.$section.'');
			
			$this -> db -> where('status','Active');
			
			$this -> db -> order_by('sort_order','ASC');
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;
	}
	
	
	function getCountryList(){
	
		$this -> db -> select('*');
		
		$this -> db -> from('web_countries');
		
		$this -> db -> where('status','Active');
		
		$this -> db -> order_by('name','ASC');
		
		$query = $this -> db -> get();
		
		$the_content = $query->result_array();
		
		return $the_content;	
	
	}
	
	function getCountryById($id){
	
		$this -> db -> select('*');
		
		$this -> db -> from('web_countries');
		
		$this -> db -> where('id',$id);
		
		$query = $this -> db -> get();
		
		$the_content = $query->result_array();
		
		return $the_content;	
	
	}


	function loginTryInvalidPassword($id){
	
		$this -> db -> select('*');
		
		$this -> db -> from('web_login_info');
		
		$this -> db -> where('usercode',$id);
		
		$this -> db -> where('invaild_password_clear','0');
		
		$this -> db -> order_by('login_code','DESC');
		
		$this -> db -> limit(6);
		
		$query = $this -> db -> get();
		
		$the_content = $query->result_array();
		
		$fail = 0;
		
		for($i = 0; $i < count($the_content); $i++){
			
			if($the_content[$i]['status']=='0'){
				
				$fail++;	
				
			}
			
		}
		
		return $fail;	
	
	}
	
	
	
	function loginTryInvalid(){
	
		$this -> db -> select('*');
		
		$this -> db -> from('web_login_info');
		
		$this -> db -> where('ip',get_user_ip());
		
		$this -> db -> where('invaild_login_clear','0');
		
		$this -> db -> order_by('login_code','DESC');
		
		$this -> db -> limit(11);
		
		$query = $this -> db -> get();
		
		$the_content = $query->result_array();
		
		$fail = 0;
		
		for($i = 0; $i < count($the_content); $i++){
			
			if($the_content[$i]['status']=='0'){
				
				$fail++;	
				
			}
			
		}
		
		return $fail;	
	
	}
	
	
	
	
	
	
	
	

	
	
	
	
}
?>
