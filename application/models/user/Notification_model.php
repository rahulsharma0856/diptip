<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Notification_model extends CI_Model
{
	
	
	function add_invitation($uid = NULL , $pg_id = NULL){
		
		if($uid != NULL && $pg_id != NULL){
			
			$data = array(
				
				'pg_id' => $pg_id,
				
				'usercode' => $uid,
				
				'invite_by' => user_session('usercode'),
				
				'time_dt' => time()
				
			);
			
			$id = $this->comman_fun->addItem($data,'social_invite');
					
			
			$array = array(
			
				'type' => 'Invite',
				
				'usercode' => $uid ,
				
				'usercode2' => user_session('usercode'),
				
				'pgCode' => $pg_id 
			
			);
			
			$this->add_notification($array);
			
		}
		
	}
	
	
	function add_notification($arr = array()){
		
		if(!empty($arr)){
		
			$data = array(
				
				'type' 		=> 	(isset($arr['type'])) ? $arr['type'] : '',
				
				'usercode'  => (isset($arr['usercode'])) ? $arr['usercode'] : '0',
				
				'usercode2' => (isset($arr['usercode2'])) ? $arr['usercode2'] : '0',
				
				'pgCode' 	=> (isset($arr['pgCode'])) ? $arr['pgCode'] : '0',
				
				'post_id' 	=> (isset($arr['post_id'])) ? $arr['post_id'] : '0',
				
				'comment_id'=> (isset($arr['comment_id'])) ? $arr['comment_id'] : '0',
				
				'status' 	=> 0,
				
				'timedt' 	=> time()
			
			);
			
			$id = $this->comman_fun->addItem($data,'social_notification');
		
		}
		
	}
	
	
	
	
	function getMemberFilterFriendForPG($uid = NULL, $pg_id = NULL ,$start = 0, $filter = NULL, $limit = 10){
			
			$where = "";
			
			if($filter!=NULL){
				
				$where = ' AND (m.fname LIKE "%'.$this->db->escape_like_str($filter).'%" OR m.lname LIKE "%'.$this->db->escape_like_str($filter).'%") ';
				
			}
			
			$sQuery ='SELECT social_friends_detail.*,
			
			CONCAT(m.fname," ",m.lname) as name, m.username as username, m.profile_img as profile_img,
			
			social_invite.id as join_request, pgm.id as join_pg
			
			FROM `social_friends_detail`
			
			INNER JOIN membermaster as m ON m.usercode = social_friends_detail.friend AND m.status = "Active"
			
			LEFT JOIN social_invite ON social_invite.usercode = social_friends_detail.friend AND social_invite.pg_id = '.$this->db->escape($pg_id).'
			
			LEFT JOIN social_page_group_member as pgm ON pgm.usercode = social_invite.usercode AND pgm.pg_code  = '.$this->db->escape($pg_id).'
			
			WHERE social_friends_detail.usercode = '.$this->db->escape($uid).'  AND social_friends_detail.status = "1"
			
			'.$where.'
			
			GROUP BY social_friends_detail.friend
			
			ORDER BY m.fname ASC
			
			LIMIT '.$start.', '.$limit.'
			
			';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			return $the_content;
		
	}
	
	
	function getTotalNotification($uid = NULL){
		
		$sQuery =' SELECT COUNT(id) as tot FROM social_notification WHERE usercode = '.$this->db->escape($uid).' AND status = "0"';
			
		$query = $this->db->query($sQuery);
			
		$the_content = $query->result_array();
			
		return (int)$the_content[0]['tot'];
		
	}
	
	
	function getQuickNotificationList($uid = NULL){
		
		$sQuery ='
		
		SELECT social_notification.*, 
		
		CONCAT(m.fname," ",m.lname) as member_name,m.username,m.profile_img,
		
		sm.title as pg_name, sm.type as pg_type, post.post_type,  post.post_category
		
		FROM social_notification 
		
		LEFT JOIN membermaster as m 	  ON  m.usercode = social_notification.usercode2
		
		LEFT JOIN social_page_group as sm ON  sm.id  =  social_notification.pgCode
		
		LEFT JOIN social_post_master as post ON  post.post_id  =  social_notification.post_id
		
		WHERE social_notification.usercode = '.$this->db->escape($uid).'  AND social_notification.status = "0" AND social_notification.quick_view = "0"
		
		ORDER BY social_notification.timedt DESC';
			
		$query = $this->db->query($sQuery);
			
		$the_content = $query->result_array();
			
		return $the_content;
		
	}


	function getNotificationList($uid = NULL){
		
		$sQuery ='
		
		SELECT social_notification.*, 
		
		CONCAT(m.fname," ",m.lname) as member_name,m.username,m.profile_img,
		
		sm.title as pg_name, sm.type as pg_type, post.post_type,  post.post_category
		
		FROM social_notification 
		
		LEFT JOIN membermaster as m 	  ON  m.usercode = social_notification.usercode2
		
		LEFT JOIN social_page_group as sm ON  sm.id  =  social_notification.pgCode
		
		LEFT JOIN social_post_master as post ON  post.post_id  =  social_notification.post_id
		
		WHERE social_notification.usercode = '.$this->db->escape($uid).'
		
		ORDER BY social_notification.timedt DESC';
			
		$query = $this->db->query($sQuery);
			
		$the_content = $query->result_array();
			
		return $the_content;
		
	}
	
	function updateNotificationStatus(){
	
		$data = array(
			
			'status' => 1
			
		);
		
		$this->comman_fun->update($data,'social_notification',array('usercode'=> user_session('usercode'),'status'=>0));	
	
	}
	
	function updateQuickNotificationStatus(){
		
		$data = array(
			
			'quick_view' => '1'
			
		);
		
		$this->comman_fun->update($data,'social_notification',array('usercode'=> user_session('usercode'),'quick_view'=>'0'));
		
	}
	
	
	function getNewLikesPost(){
		
		$time = time() - 10;
		
		$sQuery = 'SELECT social_likes.post_id
		
		FROM `social_likes` 
	
		INNER JOIN social_post_master p ON p.post_id = social_likes.`post_id`
		
		WHERE social_likes.`time_dt` > '.$time.' AND p.added_by = "'.user_session('usercode').'"
		
		GROUP BY social_likes.post_id';
		
		$query = $this->db->query($sQuery);
			
		$the_content1 = $query->result_array();
		
		
		$sQuery = 'SELECT social_likes.post_id
		
		FROM `social_likes` 
	
		INNER JOIN social_post_master p ON p.post_id = social_likes.`post_id`
		
		INNER JOIN social_friends_detail fd ON fd.friend = p.added_by AND fd.usercode = "'.user_session('usercode').'"
	
		WHERE social_likes.`time_dt` > '.$time.'
		
		GROUP BY social_likes.post_id';
		
		$query = $this->db->query($sQuery);
			
		$the_content2 = $query->result_array();
		
		$the_content = array_merge($the_content1,$the_content2);
		
		
		$arr = array();
		
		$count = array();
		

		for($i=0;$i<count($the_content);$i++){
		
			$arr[] = $the_content[$i]['post_id'];
		
		}
		
		if(count($arr) > 0){
			
			$count = $this->getCountNewLikesOnPost($arr);
			
		}
		
		
		return $count;
		
	}
	
	
	function getCountNewLikesOnPost($arr){
	
		$sQuery = 'SELECT social_likes.post_id,COUNT(social_likes.post_id) as tot
		
		FROM `social_likes` 
	
		WHERE social_likes.post_id IN ('.implode(", ",$arr).')
		
		GROUP BY social_likes.post_id';
		
		$query = $this->db->query($sQuery);
			
		$the_content = $query->result_array();	
		
		return $the_content;
		
	}
	
	
	function getNewCommentPostID(){
		
		$time = time() - 10;
		
		$sQuery = 'SELECT social_comments.post_id
		
		FROM `social_comments` 
	
		INNER JOIN social_post_master p ON p.post_id = social_comments.`post_id`
		
		WHERE social_comments.`time_dt` > '.$time.' AND p.added_by = "'.user_session('usercode').'"
		
		GROUP BY social_comments.post_id';
		
		$query = $this->db->query($sQuery);
			
		$the_content1 = $query->result_array();
		
		
		$sQuery = 'SELECT social_comments.post_id
		
		FROM `social_comments` 
	
		INNER JOIN social_post_master p ON p.post_id = social_comments.`post_id`
		
		INNER JOIN social_friends_detail fd ON fd.friend = p.added_by AND fd.usercode = "'.user_session('usercode').'"
	
		WHERE social_comments.`time_dt` > '.$time.'
		
		GROUP BY social_comments.post_id';
		
		$query = $this->db->query($sQuery);
			
		$the_content2 = $query->result_array();
	
		$the_content = array_merge($the_content1, $the_content2);
		
		$arr = array();
		
		$count = array();
		
		$newComemt = array();
		
		for($i=0;$i<count($the_content);$i++){
		
			$arr[] = $the_content[$i]['post_id'];
		
		}
		
		if(count($arr) > 0){
			
			$count = $this->getCountNewCommentOnPost($arr);
			
			$newComemt = $this->getNewCommentPostList($arr);
			
			
			
		}
		
		
		return array(
		
			'count' => $count,
			
			'newComment' => $newComemt
		
		);
		
		
	}
	
	
	function getCountNewCommentOnPost($arr){
	
		$sQuery = 'SELECT social_comments.post_id,COUNT(social_comments.post_id) as tot
		
		FROM `social_comments` 
	
		WHERE social_comments.post_id IN ('.implode(", ",$arr).')
		
		GROUP BY social_comments.post_id';
		
		$query = $this->db->query($sQuery);
			
		$the_content = $query->result_array();	
		
		return $the_content;
	
	}
	
	
	function getNewCommentPostList($arr){
		
		$time = time() - 10;
		
		$this -> db -> select('c.*');
		
		$this -> db -> select('CONCAT(u.fname," ",u.lname) as member_name, u.username as member_username, u.profile_img as member_profile_img');
		
		$this -> db -> from('social_comments c');
		
		$this -> db -> join('membermaster u','c.usercode = u.usercode','left');
		
		$this -> db -> where('c.post_id IN ('.implode(", ",$arr).')');
		
		$this -> db -> where('c.time_dt >', $time);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
		
	}
	
	
}
?>
