<?php
Class Group_model extends CI_Model{
	
	
	function isAdmin($id = NULL){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group');
		
		$this -> db -> where('uid',user_session('usercode'));
		
		$this -> db -> where('id',$id);
		
		$this -> db -> where('type','group');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	
	
	function getMyGroup(){
	
		$this -> db -> select('pg.*');
	
		$this -> db -> from('social_page_group pg');
	
		$this -> db -> where('pg.uid',user_session('usercode'));
		
		$this -> db -> where('pg.type','group');
		
		$this -> db -> where('pg.status','Active');
		
		$this -> db -> order_by('pg.id');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function getGroupById($id){
	
		$this -> db -> select('pg.*');
	
		$this -> db -> select('pgm.pg_code, pgm.status as join_status');
			
		$this -> db -> from('social_page_group pg');
		
		$this -> db -> join('social_page_group_member pgm','pgm.pg_code =  pg.id AND pgm.usercode = "'.user_session('usercode').'"','left');
		
		$this -> db -> where('pg.id',$id);
		
		$this -> db -> where('pg.type','group');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function isRequestSend($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('pg_code',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	function isGroupJoined($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('pg_code',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('status','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	function isRequestPending($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('pg_code',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$this -> db -> where('status','0');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
		
	}
	
	function getMemberJoinedGroups($uid,$limit=NULL){
		
		$this -> db -> select('pgm.pg_code');
		
		$this -> db -> select('pg.*');
		
		$this -> db -> from('social_page_group_member pgm');
		
		$this -> db -> join('social_page_group pg','pgm.pg_code =  pg.id','inner');
		
		$this -> db -> where('pgm.usercode',$uid);
		
		$this -> db -> where('pgm.type','group');
		
		$this -> db -> where('pg.type','group');
		
		$this -> db -> order_by('pg.id');
		
		if($limit!='')
		{
			$this -> db -> limit($limit);
		}
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
	
	}
	
	function getJoinedGroupListForPost(){
	
		$this -> db -> select('m.*');
		
		$this -> db -> from('social_page_group_member pgm');
		
		$this -> db -> join('social_page_group m','pgm.pg_code =  m.id','inner');
		
		$this -> db -> where('m.type','group');
		
		$this -> db -> where('m.group_posts','Any');
		
		$this -> db -> where('pgm.status','1');
		
		$this -> db -> where('pgm.usercode',user_session('usercode'));
		
		$this -> db -> where('m.uid !=',user_session('usercode'));
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
		
	
	
	}
	
	function countTotalGroupJoined($page_code){
	
		$this -> db -> select('COUNT(*) as tot');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('pg_code',$page_code);
		
		$this -> db -> where('status','1');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (int)$the_content[0]['tot'];
	
	}
	
	function getGroupJoinRequest($id){
		
		$this -> db -> select('pgm.*');
		
		$this -> db -> select('CONCAT(m.fname," ",m.lname) as name, m.username, m.profile_img');
		
		$this -> db -> from('social_page_group_member pgm');
		
		$this -> db -> join('membermaster m','pgm.usercode =  m.usercode','inner');
		
		$this -> db -> where('pgm.pg_code',$id);
		
		$this -> db -> where('pgm.status','0');
		
		$this -> db -> order_by('m.fname','ASC');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
			
	}
	
	
	function getGroupJoinedMemberList($id){
		
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
	
	function getJoinRequestById($id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_page_group_member');
		
		$this -> db -> where('id',$id);
		
		$this -> db -> where('type','group');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	function send_join_request($id){
		
		$result = $this->getGroupById($id);
		
		$data = array(
		
			'type' => 'group',
			
			'pg_code' => $id,
			
			'usercode' => user_session('usercode'),
			
			'timedt' => time(),
			
			'status' => '0'
		
		);
		
		if($result[0]['group_privacy']=='Public'){
			
			$data['status'] = '1';
			
		}
		
		$this->comman_fun->addItem($data,'social_page_group_member');
		
		
		//Notification Send 
		
		if($result[0]['uid']!=user_session('usercode')){
		
			$info = array(
			
				'type' => ($result[0]['group_privacy']=='Public') ? 'group_join' : "group_join_request",
				
				'pgCode' => $id,
				
				'usercode' => $result[0]['uid'],
				
				'usercode2' => user_session('usercode')
			
			);
			
			$this->Notification_module->add_notification($info);
		
		}
		
		
		
	}
	
	
	function leave_group($id){
	
		$this->comman_fun->delete('social_page_group_member',array('pg_code'=>$id,'usercode'=>user_session('usercode'),'type'=>'group'));
	
	}
	
	function join_request_accept($request){
		
		$data = array(
		
			'timedt' => time(),
			
			'status' => '1'
		
		);
		
		$this->comman_fun->update($data,'social_page_group_member',array('id'=>$request[0]['id']));
		
		
		//Notification Send 
		
		$result = $this->getGroupById($request[0]['pg_code']); 
		
		$info = array(
		
			'type' =>  "group_join_accept",
			
			'pgCode' => $request[0]['pg_code'],
			
			'usercode' => $request[0]['usercode'],
			
			'usercode2' => user_session('usercode')
		
		);
		
		$this->Notification_module->add_notification($info);
		
		
	}
	
	
	function isGroupInvitation($id)
	{
		$this -> db -> select('*');
		
		$this -> db -> from('social_invite');
		
		$this -> db -> where('pg_id',$id);
		
		$this -> db -> where('usercode',user_session('usercode'));
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return (isset($the_content[0])) ? true : false;
	}
	
	
	
	
}
?>
