<?php
Class Page_model extends CI_Model{
	
	
	function isAdmin($page_code = NULL){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group');
		
		$this -> db -> where('uid',user_session('usercode'));
		
		$this -> db -> where('id',$page_code);
		
		$this -> db -> where('type','page');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	
	
	function getMyPages(){
	
		$this -> db -> select('pg.*');
		
		$this -> db -> select('c.cat_name');
		
		$this -> db -> from('social_page_group pg');
		
		$this -> db -> join('sm_page_category c','c.id =  pg.category','left');
		
		$this -> db -> where('pg.uid',user_session('usercode'));
		
		$this -> db -> where('pg.type','page');
		
		$this -> db -> order_by('pg.id');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function getPageById($id){
	
		$this -> db -> select('pg.*');
		
		$this -> db -> select('c.cat_name');
		
		$this -> db -> select('pgm.pg_code');
		
		$this -> db -> from('social_page_group pg');
		
		$this -> db -> join('sm_page_category c','c.id =  pg.category','left');
		
		$this -> db -> join('social_page_group_member pgm','pgm.pg_code =  pg.id AND pgm.usercode = "'.user_session('usercode').'"','left');
		
		$this -> db -> where('pg.id',$id);
		
		$this -> db -> where('pg.type','page');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function isPageliked($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('pg_code',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('status','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	
	function getMemberLikedPages($uid,$limit=NULL){
		
		$this -> db -> select('pgm.pg_code');
		
		$this -> db -> select('pg.*');
		
		$this -> db -> select('c.cat_name');
		
		$this -> db -> from('social_page_group_member pgm');
		
		$this -> db -> join('social_page_group pg','pgm.pg_code =  pg.id','inner');
		
		$this -> db -> join('sm_page_category c','c.id =  pg.category','left');
		
		$this -> db -> where('pgm.usercode',$uid);
		
		$this -> db -> where('pgm.type','page');
		
		$this -> db -> order_by('pg.id');
		
		if($limit!='')
		{
			$this -> db -> limit($limit);
		}
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
	
	}
	
	
	function countTotalPageLikes($page_code){
	
		$this -> db -> select('COUNT(*) as tot');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('pg_code',$page_code);
		
		$this -> db -> where('status','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (int)$the_content[0]['tot'];
	
	}
	
	function pageLikedMemberList($id){
		
		$this -> db -> select('pgm.*');
		
		$this -> db -> select('CONCAT(m.fname," ",m.lname) as name, m.username, m.profile_img');
		
		$this -> db -> from('social_page_group_member pgm');
		
		$this -> db -> join('membermaster m','pgm.usercode =  m.usercode','inner');
		
		$this -> db -> where('pgm.pg_code',$id);
		
		$this -> db -> where('pgm.status','1');
		
		$this -> db -> order_by('m.fname','ASC');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
			
	}
	
	
	function getPageSuggestion($likedpage){
		
		if($likedpage=='No')
		{
			$this -> db -> select('t1.*');
		
			$this -> db -> select('t2.cat_name');
			
			$this -> db -> from('social_page_group t1');
			
			$this -> db -> join('sm_page_category t2','t2.id =  t1.category','left');
			
			$this -> db -> join('social_page_group_member t3','t3.pg_code =  t1.id AND t3.usercode = "'.user_session('usercode').'"','left');
			
			$this -> db -> where('t1.type','page');
			
			$this -> db -> where('t3.ID IS NULL');
			
			$this->db->order_by('rand()');
			
			$this->db->limit(3);
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;
		}
		else
		{
			$this -> db -> select('t1.*');
		
			$this -> db -> select('t2.cat_name');
			
			$this -> db -> from('social_page_group t1');
			
			$this -> db -> join('sm_page_category t2','t2.id =  t1.category','left');
			
			$this -> db -> join('social_page_group_member t3','t3.pg_code =  t1.id AND t3.usercode = "'.user_session('usercode').'"','left');
			
			$this -> db -> where('t1.type','page');
			//
			$this -> db -> where('t1.category IN (select t1.category from social_page_group t1 inner join social_page_group_member t2 on t2.pg_code=t1.id where t2.usercode='.user_session('usercode').' GROUP BY t1.category)');
			
			$this -> db -> where('t1.uid!='.user_session('usercode').'');
			
			//
			$this -> db -> where('t3.ID IS NULL');
			
			$this->db->order_by('rand()');
			
			$this->db->limit(3);
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;
		}
		
		
	
	}
	
	function do_like($page_id, $uid = NULL){
		
		$data = array(
		
			'pg_code' => $page_id,
			
			'type' => 'page',
			
			'usercode' => user_session('usercode'),
			
			'timedt' => time(),
			
			'status'=> 1
		
		);
		
		$this->comman_fun->addItem($data,'social_page_group_member');
		
		if($uid != user_session('usercode'))
		{
			
			$data = array(
		
			'type' => 'page_like',
			
			'pgCode' => $page_id,
			
			'usercode' => $uid,
			
			'usercode2' => user_session('usercode')
		
			);
		
			$this->Notification_module->add_notification($data);
			
		}
		
		
		
		
	}
	
	function do_unlike($page_id){
		
		$this->comman_fun->delete('social_page_group_member',array('pg_code'=>$page_id,'type'=>'page','usercode'=>user_session('usercode')));
		
		$this->comman_fun->delete('social_notification',array('pgCode'=>$page_id,'usercode2'=>user_session('usercode'),'type'=>'page_like'));
		
	}
	
	
	
	// ads banner
	
	function get_ads_banners($ad_position)
	{
		$this -> db -> select('adi.*');
		
		$this -> db -> select('adp.ad_position');
		
		$this -> db -> from('social_ads_images adi');
		
		$this -> db -> join('social_ads_position adp','adp.id = adi.ad_position_id','left');
		
		$this -> db -> where('adi.status!=','Delete');
		
		$this -> db -> where('adp.ad_position=',$ad_position);
		
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		$the_content = $query->result_array();
		
		if(isset($the_content[0]))
		{
			$base_path 		= str_replace('sm/','',base_url()); 
			
			$ads_path  		= $base_path.'upload/social_media/ads_img/';
			
			$the_content[0]['ad_img_path'] 	= $ads_path.$the_content[0]['img_path'];
		}
		
		
		return $the_content[0];		
	}
	
	 
	
	
}
?>
