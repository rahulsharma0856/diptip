<?php
Class Groups_module extends App_model
{
	
	
	function group_list($usercode){
		
		$this -> db -> select('*');
		
		
		$this -> db -> from('sm_groups');
		$this -> db -> where('usercode',$usercode);
		
		$this -> db -> where('status','Active');
		
		$this -> db -> order_by('id','DESC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_group_details($groupid,$usercode)
	{
		$this -> db -> select('*');
		$this -> db -> from('sm_groups');
		$this -> db -> where('id',$groupid);
		$this -> db -> where('usercode',$usercode);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
	
	
	function getGroupPost($endcode){
		
		$this -> db -> select('m.post_category, m.video_upload, m.video_share');
		
		$this -> db -> select('d.post_id, d.post_category, d.post_type, d.usercode, d.post_text, d.time_dt, d.endcode');
		
		$this -> db -> select('u.name as name, u.type as post_by_type');
		
		$this -> db -> from('sm_post_detail d');
		
		$this -> db -> join('sm_post_master m','m.id=d.post_id AND m.post_category="group"','inner');
		
		$this -> db -> join('sm_page_group u','m.endcode = u.id','left');
		
		$this -> db -> where('d.status','Active');
		
		$this -> db -> where('d.group_id',$endcode);
		
		$this -> db -> order_by('d.time_dt','desc');
		
		$this -> db -> limit(60);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
		for($i=0;$i<count($the_content);$i++){
			
			$the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_id']);
			
		}
		
    	return $the_content;
		
	}
	
	
	
	function getPostImage($post_id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_post_images');
		
		$this -> db -> where('post_id',$post_id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
	}
	
	
	function isGroupAdmin($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_page_group_member');
		
		$this -> db -> where('endcode',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('is_admin','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	
	function getMyGroups(){
	
		$this -> db -> select('t1.is_admin');
		
		$this -> db -> select('t2.*');
		
		$this -> db -> from('sm_page_group_member t1');
		
		$this -> db -> join('sm_page_group t2','t2.id =  t1.endcode AND t2.type = "group"','inner');
		
		$this -> db -> where('t1.is_admin','1');
	
		$this -> db -> where('t1.usercode',user_session('usercode'));
		
		$this -> db -> order_by('t1.endcode');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function getMyJoidedGroups(){
	
		$this -> db -> select('t1.is_admin');
		
		$this -> db -> select('t2.*');
		
		$this -> db -> from('sm_page_group_member t1');
		
		$this -> db -> join('sm_page_group t2','t2.id =  t1.endcode AND t2.type = "group"','inner');
		
		$this -> db -> where('t1.status','1');
	
		$this -> db -> where('t1.usercode',user_session('usercode'));
		
		$this -> db -> order_by('t1.endcode');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function getGroupById($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_page_group');
		
		$this -> db -> where('id',$id);
		
		$this -> db -> where('type','group');
		
		$this -> db -> where('status','Active');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function getGroupMemberRecord($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_page_group_member');
		
		$this -> db -> where('endcode',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function isMemberJoinGroup($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_page_group_member');
		
		$this -> db -> where('endcode',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('status','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
			
	}
	
	function isMemberPostInGroup($id){
		
	
		$group = $this->getGroupById($id);
		
		if(isset($group[0])){
			
			
			if($this->isGroupAdmin($id)){
			
				return true;
				
			}
			
			if($this->isMemberJoinGroup($id) == true && $group[0]['group_privacy']=="Any"){
				
				return true;
				
			}
		}
		
    	return false;
	
	}
	
	
	
}
?>
