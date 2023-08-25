<?php
Class Chat_model extends CI_Model{
	
	
	function getOnlineFriend(){
		
		$last = time() - 60;
		
		$this -> db -> select('c.id');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as name, u.username, u.usercode ,u.profile_img');
		
		$this -> db -> from('social_friends_detail c');
		
		$this -> db -> join('membermaster u','c.friend = u.usercode AND u.last_active > '.$last.'','INNER');
		
		$this -> db -> where('c.usercode',user_session('usercode'));
		
		$this -> db -> limit(30);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
	
	}
	
	function RightBarMemberSearch(){
	
		$this -> db -> select('c.id');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as name, u.username, u.usercode ,u.profile_img,u.last_active');
		
		$this -> db -> from('social_friends_detail c');
		
		$this -> db -> join('membermaster u','c.friend = u.usercode','INNER');
		
		$this -> db -> where('u.fullname LIKE "%'.$_GET['u_search'].'%"');
		
		$this -> db -> where('c.usercode',user_session('usercode'));
		
		$this -> db -> limit(30);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
		
	}
	
	function get_msg_on_load($uid = NULL){
		
		$this -> db -> select('*');
	
		$this -> db -> from('social_post_chat');
		
		$this -> db -> where('((user_1 = "'.user_session('usercode').'" AND user_2 = "'.$uid.'") OR (user_2 = "'.user_session('usercode').'" AND user_1 = "'.$uid.'"))');
		
		$this -> db -> where('(delete_u1 != "'.user_session('usercode').'" AND delete_u2 != "'.user_session('usercode').'")');
		
		$this -> db -> limit(10);
		
		$this -> db -> order_by('id','DESC');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return array_reverse($the_content);
	}
	
	function getOldChat($uid = NULL, $last_msg = NULL){
		
		$this -> db -> select('c.*');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as name, u.username, u.usercode ,u.profile_img');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> join('membermaster u','c.user_1 = u.usercode','INNER');
		
		$this -> db -> where('((c.user_1 = "'.user_session('usercode').'" AND c.user_2 = "'.$uid.'") OR (c.user_2 = "'.user_session('usercode').'" AND c.user_1 = "'.$uid.'"))');
		
		$this -> db -> where('(c.delete_u1 != "'.user_session('usercode').'" AND c.delete_u2 != "'.user_session('usercode').'")');
		
		$this -> db -> where('c.id <',$last_msg);
		
		$this -> db -> limit(10);
		
		$this -> db -> order_by('c.id','DESC');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return array_reverse($the_content);
	}
	
	function get_msg_by_id($id = NULL){
		
		$this -> db -> select('c.*');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as name, u.username, u.usercode ,u.profile_img');
	
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> join('membermaster u','c.user_1 = u.usercode','INNER');
		
		$this -> db -> where('((c.user_1 = "'.user_session('usercode').'" ) OR (c.user_2 = "'.user_session('usercode').'"))');
		
		$this -> db -> where('c.id',$id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
	}
	
	function getAllMessageBYMember($uid = NULL){
	
		$this -> db -> select('c.*');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> where('((c.user_1 = "'.user_session('usercode').'" AND c.user_2 = "'.$uid.'") OR (c.user_2 = "'.user_session('usercode').'" AND c.user_1 = "'.$uid.'"))');
		
		$this -> db -> where('(c.delete_u1 != "'.user_session('usercode').'" AND c.delete_u2 != "'.user_session('usercode').'")');
	
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
	
	}
	
	
	function isValidMember($uid){
	
		$this -> db -> select('*');
	
		$this -> db -> from('membermaster');
		
		$this -> db -> where('usercode',$uid);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content[0];		
	
	}
	
	function add_message($arr = array()){
		
		$data = array(
			
			'user_1' => $arr['user_1'],
			
			'user_2' => $arr['user_2'],
			
			'type' => $arr['type'],
			
			'msg'  => (isset($arr['msg'])) ? $arr['msg'] : "",
			
			'img_path'  => (isset($arr['img_path'])) ? $arr['img_path'] : "",
			
			'time_dt' => time(),
			
			'status' => '0',
			
		);
		
		//$data = filter_text($data);
		
		$id = $this->comman_fun->addItem($data,'social_post_chat');	
		
		return $id;
		
	}
	
	
	function checkNewMessage($friend = 0){
		
		$time = time() - 8;
		
		if($friend == 0){
			
			return array();
			
		}
		
		$this -> db -> select('c.*');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as name, u.username ,u.profile_img');
		
		$this -> db -> select('CONCAT(u2.fname," ",u2.lname) as name2, u2.username as username2 ,u2.profile_img as profile_img2');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> join('membermaster u','c.user_1 = u.usercode','INNER');
		
		$this -> db -> join('membermaster u2','c.user_2 = u2.usercode','INNER');
		
		$this -> db -> where('((c.user_1 = "'.user_session('usercode').'" AND c.user_2 IN ('.$friend.')) OR (c.user_2 = "'.user_session('usercode').'" AND c.user_1 IN ('.$friend.')))');
		
		$this -> db -> where('(c.delete_u1 != "'.user_session('usercode').'" AND c.delete_u2 != "'.user_session('usercode').'")');
		
		$this -> db -> where('c.time_dt >',$time);
		
		$this -> db -> order_by('c.id','DESC');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
		for($i=0 ; $i<count($the_content) ; $i++){
			
			
			$the_content[$i]['window'] = ($the_content[$i]['user_1']==user_session('usercode')) ? $the_content[$i]['user_2'] : $the_content[$i]['user_1'] ;
			
			
		}
		
    	return array_reverse($the_content);
		
	}
	
	
	function count_receive_unread_msg(){
	
		$this -> db -> select('COUNT(c.id) as tot');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> where('c.user_2',user_session('usercode'));
		
		$this -> db -> where('c.status','0');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();	
		
		return (int)$the_content[0]['tot'];
	
	}
	
	function UnreadCurrentMessage(){
		
		$time = time() - 8;
		
		$this -> db -> select('c.user_1 as id');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> where('c.user_2',user_session('usercode'));
		
		$this -> db -> where('c.status','0');
		
		$this -> db -> where('c.time_dt >',$time);
		
		$this -> db -> group_by('c.user_1');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();	
		
		return $the_content;
		
	}
	
	
	function get_receive_unread_msg(){
	
		$this -> db -> select('c.*');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as name, u.username ,u.profile_img');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> join('membermaster u','c.user_1 = u.usercode','INNER');
		
		$this -> db -> where('c.user_2',user_session('usercode'));
		
		$this -> db -> where('c.status','0');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();	
		
		return $the_content;
	
	}
	
	
	function update_chat_status($id = NULL){
		
		$data = array(
			
			'status' => '1',
			
		);
		
		$id = $this->comman_fun->update($data,'social_post_chat',array('id'=>$id));	
		
	}
	
	function all_message_read(){
		
		$data = array(
			
			'status' => '1',
			
		);
		
		$this->comman_fun->update($data,'social_post_chat',array('user_2'=>user_session('usercode'),'status'=>'0'));	
	}
	
	
	function readParticularMemberMessage($id = NULL){
		
		$data = array(
			
			'status' => '1',
			
		);
		
		$this->comman_fun->update($data,'social_post_chat',array('user_2'=>user_session('usercode'),'user_1'=>$id,'status'=>'0'));
		
	}
	
	function get_last_message(){
	
		$sQuery = "
		
		SELECT least(user_1, user_2) as user_1, 
		
		greatest(user_1, user_2) as user_2, 
		
		max(id) as last_id, 
		
		max(time_dt) as last_timestamp 
		
		From social_post_chat 
		
		WHERE (user_1 = '".user_session('usercode')."' OR user_2 = '".user_session('usercode')."')
		
		group by least(user_1, user_2), 
		
		greatest(user_1, user_2) 
		
		ORDER BY last_id DESC LIMIT 6";
		
		
		$query = $this->db->query($sQuery);
		
		$the_content = $query->result_array();
		
		
		
		
		for($i=0;$i<count($the_content);$i++){
			
			$result   = $this->getchatUserDetail($the_content[$i]['last_id']);
			
			$the_content[$i]['msg'] 			= $result['msg'];
			
			if($result['user_1'] != user_session('usercode')){
				
				$the_content[$i]['name'] 			= 	$result['member_name_u1'];
				
				$the_content[$i]['username'] 		= 	$result['member_username_u1'];
			
				$the_content[$i]['profile_img']		= 	$result['member_profile_img_u1']; 	
				
				$the_content[$i]['type']			= 	'r'; 	
				
				$the_content[$i]['uid']				= 	$result['user_1']; 	
				
				
				
			}
			else{
				
				$the_content[$i]['name'] 			= 	$result['member_name_u2'];
				
				$the_content[$i]['username'] 		= 	$result['member_username_u2'];
			
				$the_content[$i]['profile_img']		= 	$result['member_profile_img_u2'];
				
				$the_content[$i]['type']			= 	's'; 	
				
				$the_content[$i]['uid']				= 	$result['user_2']; 	
				
			}
			
			
			
		}
	
		return $the_content;
	
	}
	
	
	
	
	function getchatUserDetail($last_id){
		
		$this -> db -> select('c.*');
		
		$this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name_u1, u1.username as member_username_u1, u1.profile_img as member_profile_img_u1');
		
		$this -> db -> select('CONCAT(u2.fname," ",u2.lname) as member_name_u2, u2.username as member_username_u2, u2.profile_img as member_profile_img_u2');
		
		$this -> db -> from('social_post_chat c');
		
		$this -> db -> join('membermaster u1','c.user_1 = u1.usercode','left');
		
		$this -> db -> join('membermaster u2','c.user_2 = u2.usercode','left');
		
		$this -> db -> where('c.id',$last_id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
		
		
    	return $the_content[0];	
		
	}
	
		
	
}
?>
