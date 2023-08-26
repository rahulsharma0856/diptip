<?php
Class Page_module extends App_model
{
	
	
	function get_created_page_list($usercode){
		
		$this -> db -> select('page_name');
		
		$this -> db -> from('sm_user_pages');
		
		$this -> db -> where('usercode',$usercode);
		
		$this -> db -> where('status','Active');
		
		$this -> db -> order_by('id','DESC');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function isPageAdmin($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_page_group_member');
		
		$this -> db -> where('endcode',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('is_admin','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	
	function isPagelike($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_page_group_member');
		
		$this -> db -> where('endcode',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('status','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	
	function getPagelikesMember($id){
	
		$this -> db -> select('t1.endcode, t1.usercode');
		
		$this -> db -> select('t2.*');
		
		$this -> db -> from('sm_page_group_member t1');
		
		$this -> db -> join('sm_page_group t2','t2.id =  t1.usercode AND t2.type = "member"','inner');
		
		$this -> db -> where('t1.endcode',$id);
		
		$this -> db -> where('t1.status','1');
	
		$this -> db -> order_by('t1.id');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
	
	}
	
	
	function getMyPages(){
	
		$this -> db -> select('t1.is_admin');
		
		$this -> db -> select('t2.*');
		
		$this -> db -> select('t3.cat_name');
		
		$this -> db -> from('sm_page_group_member t1');
		
		$this -> db -> join('sm_page_group t2','t2.id =  t1.endcode AND t2.type = "page"','inner');
		
		$this -> db -> join('sm_page_category t3','t3.id =  t2.category','left');
		
		$this -> db -> where('t1.is_admin','1');
	
		$this -> db -> where('t1.usercode',user_session('usercode'));
		
		$this -> db -> order_by('t1.endcode');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function getMyLikedPages(){
	
		$this -> db -> select('t1.is_admin');
		
		$this -> db -> select('t2.*');
		
		$this -> db -> select('t3.cat_name');
		
		$this -> db -> from('sm_page_group_member t1');
		
		$this -> db -> join('sm_page_group t2','t2.id =  t1.endcode AND t2.type = "page"','inner');
		
		$this -> db -> join('sm_page_category t3','t3.id =  t2.category','left');
		
		$this -> db -> where('t1.status','1');
	
		$this -> db -> where('t1.usercode',user_session('usercode'));
		
		$this -> db -> order_by('t1.endcode');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function getPageSuggestion(){
	
		$this -> db -> select('t1.*');
		
		$this -> db -> select('t2.cat_name');
		
		$this -> db -> select('t3.endcode');
		
		$this -> db -> from('sm_page_group t1');
		
		$this -> db -> join('sm_page_category t2','t2.id =  t1.category','left');
		
		$this -> db -> join('sm_page_group_member t3','t3.endcode =  t1.id AND t3.usercode = "'.user_session('usercode').'"','left');
		
		$this -> db -> where('t3.endcode IS NULL');
	
		$this -> db -> where('t1.type','page');
		
		$this->db->order_by('rand()');
		
		$this->db->limit(7);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
	
	}
	
	
	function getPageById($id){
		
		$this -> db -> select('sm_page_group.*');
		
		$this -> db -> select('t3.cat_name');
		
		$this -> db -> from('sm_page_group');
		
		$this -> db -> join('sm_page_category t3','t3.id =  sm_page_group.category','left');
		
		$this -> db -> where('sm_page_group.id',$id);
		
		$this -> db -> where('sm_page_group.type','page');
		
		$this -> db -> where('sm_page_group.status','Active');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function getPagePost($endcode){
		
		$this -> db -> select('m.post_category, m.video_upload, m.video_share');
		
		$this -> db -> select('d.post_id, d.post_category, d.post_type, d.usercode, d.post_text, d.time_dt, d.endcode');
		
		$this -> db -> select('u.name as name, u.type as post_by_type');
		
		$this -> db -> from('sm_post_detail d');
		
		$this -> db -> join('sm_post_master m','m.id=d.post_id','inner');
		
		$this -> db -> join('sm_page_group u','m.endcode = u.id','left');
		
		$this -> db -> where('d.status','Active');
		
		$this -> db -> where('d.endcode',$endcode);
		
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
	
	function get_created_page_data($usercode){
		
		$this -> db -> select('*');
		$this -> db -> from('sm_user_pages');
		$this -> db -> where('usercode',$usercode);
		$this -> db -> where('status!=','Delete');
		$this -> db -> order_by('id','DESC');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	function get_page_details($pageid,$usercode)
	{
		$this -> db -> select('*');
		$this -> db -> from('sm_user_pages');
		$this -> db -> where('id',$pageid);
		$this -> db -> where('usercode',$usercode);
		$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
		
	}
	
	
}
?>
