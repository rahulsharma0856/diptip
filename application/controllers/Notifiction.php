<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifiction extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		

		
		$this->load->model('user/Page_model','',TRUE);
		
		$this->load->model('user/Post_model','',TRUE);
		
		$this->load->model('user/Notification_module');
		
		$this->load->model('Member_module');
		
		$this->load->model('user/Chat_model');
		
		$this->load->model('user/Comment_model');
		
 	}
	
	
	function get_gen_notification(){
		
		check_ajax_request();
		
		$result = $this->Notification_module->getNotificationList(user_session('usercode'));
		
		//echo $this->db->last_query();
		
		$this->Notification_module->updateNotificationStatus();
		
		if(count($result)==0){
			
			$output = "No notification";
			
		}
		
		for($i=0; $i < count($result); $i++){
		
			$output .= $this->load->view('user/notification_li',array('result'=>$result[$i]),true);
				
		}
	
		echo $output ;  
	}
	
	
	function ajax_friend_request(){
		
		check_ajax_request();
		
		$result = $this->Member_module->getMemberFriendRequest(user_session('usercode'), 4);
		
		$$html= '';
		
		if(count($result) < 1) { 
		
			echo '<h6 style="text-align: center;padding: 20px;">No Friend Request</h6s>';
			
			exit;
			
		}
		$html = '<ul class="notification-list friend-requests html_top_friend_request_list">';
		
		
		for($i=0;$i<count($result);$i++){
		
			$html .= $this->load->view('user/load/friend_Request_li',array('member'=>$result[$i]),true);	
			
		}
		$html .= '</ul><a href="'.file_path('profile/friends_request/').'" class="view-all bg-purple" style="bottom : -34px;background-color: #00547b;">Check All Friends Request</a>';
		
		echo  $html;
	
	}
	
	
	function getNewLikesPost(){
	
		$result 	 =   $this->Notification_module->getNewLikesPost();	
		
		return $result;
	
	}
	
	function getNewComment(){
	
		$result 	 		=   $this->Notification_module->getNewCommentPostID();	
		
		$newComment 		= 	$result['newComment'];
		
		$newCommentList 	= 	array();
		
		for($i=0;$i<count($newComment); $i++){
			
			$newCommentList[] = array(
			
				'id' 	=> $newComment[$i]['id'],
				
				'post'  => $newComment[$i]['post_id'],
				
				'html'  => $this->load->view('user/post/view_single_comment',array('result' => $newComment[$i]),TRUE)
				
			);	
			
		}
		

		$result['newComment'] =  $newCommentList;
		
		return $result;
	
	}
	
	function ajaxGetAllSummery(){
			
		$total_friend_request			=	$this->Member_module->getCountMemberFriendRequest(user_session('usercode'));
		
		
		$total_notifiction 				=   $this->Notification_module->getTotalNotification(user_session('usercode'));
		
		
		$this->Member_module->setLastActive();
		
		
		if($total_friend_request > 0){
			
			
			$data['html_top_total_friend_request'] =  '<div class="label-avatar bg-primary">'.$total_friend_request.'</div>';
			
			
		}else{
			
		
			$data['html_top_total_friend_request'] =  '';
			
		
		}
		
		if($total_notifiction > 0){
			
			
			$data['html_top_gen_notifiction'] =  '<div class="label-avatar bg-primary">'.$total_notifiction.'</div>';
			
			
		}else{
		
		
			$data['html_top_gen_notifiction'] =  '';
			
		
		}
		
		
		$data['quick'] = $this->getQuickNotificationList();
		
		
		$online = $this->Online_Friend();
		
		
		$data['right_bar_online_friend_short'] =  $online['short'];
		
		
		if($_GET['u_search']!=""){
			
			
			$data['right_bar_online_friend_full']  =  $this->RightBarMemberSearch();
			
			
		}else{
			
			
			$data['right_bar_online_friend_full']  =  $online['full'];
			
			
		}
		
		
		$data['NewLikesPost'] = $this->getNewLikesPost();
		
		$getNewComment = $this->getNewComment();
		
		$data['NewCommentPost'] = $getNewComment['count'];
		
		$data['NewCommentList'] = $getNewComment['newComment'];
		
		
		
		
		echo json_encode($data);
		
		exit;
	
	}
	
	
	private function getQuickNotificationList(){
	
		$result		=	$this->Notification_module->getQuickNotificationList(user_session('usercode'));
		
		$this->Notification_module->updateQuickNotificationStatus();
		
		$html  = array();
		
		for($i=0; $i < count($result); $i++){
		
			$html[] = $this->load->view('user/notification_quick',array('result'=>$result[$i]),true);
		
		}
		
		return $html;
	
	}
	
	function getQuickNotificationList2(){
	
		$result		=	$this->Member_module->Checkfriendstatus(80);
		
		echo $this->db->last_query();
		

		echo '<pre>';
		print_r($result);
		echo '</pre>';
	
	}
	
	
	
	function live_chat_search(){
		
		$html = $this -> RightBarMemberSearch();
		
		
		echo  json_encode(
		
			array(
			
			'html' => $html
			
			)
		
		);
		
		exit;
		
	}
	
	function RightBarMemberSearch(){
	
		$friend = $this->Chat_model->RightBarMemberSearch();
		
		for($i=0;$i<count($friend);$i++){
			
			$profile_img = ($friend[$i]['profile_img']=='') ? 'profile.png' : $friend[$i]['profile_img'];
			
			$last = time() - 60;
			
			if($friend[$i]['last_active'] > $last){
				
				$status = 'ONLINE';
				
				$icon 	= 'online';
				
			}else{
				
				$status = 'OFFLINE';
				
				$icon = 'disconected';
			}
			
			$html .='<li class="inline-items">
			
			<div class="author-thumb">
			
			<img alt="author" src="'.thumb($profile_img,100,100).'" class="avatar online_f_img">
			
			<span class="icon-status '.$icon.'"></span>
			
			</div>
			
			<div class="author-status">
			
			<a href="#" class="h6 author-name" id="rightbar_online_mem" memcode="'.$friend[$i]['usercode'].'">'.$friend[$i]['name'].'</a>
			
			<span class="status">'.$status.'</span>
			
			</div>
			
			</li>';
		
		}
		
		return $html;
		
		
	
	}
	
	function Online_Friend(){
	
		$friend = $this->Chat_model->getOnlineFriend();
		
		$html1 = '';
		
		$html2 = '';
		
		for($i=0;$i<count($friend);$i++){
			
			$profile_img = ($friend[$i]['profile_img']=='') ? 'profile.png' : $friend[$i]['profile_img'];
			
			$html1 .='<li class="inline-items" title="'.$friend[$i]['name'].'">
			
			<a href="#" class="h6 author-name" id="rightbar_online_mem" memcode = "'.$friend[$i]['usercode'].'"">
			
			<div class="author-thumb">
			
			<img alt="author" src="'.thumb($profile_img,100,100).'" class="avatar online_f_img">
			
			<span class="icon-status online"></span>
			
			</div>
			
			</a>
			
			</li>';
			
			
			$html2 .='<li class="inline-items">
			
			<div class="author-thumb">
			
			<img alt="author" src="'.thumb($profile_img,100,100).'" class="avatar online_f_img">
			
			<span class="icon-status online"></span>
			
			</div>
			
			<div class="author-status">
			
			<a href="#" class="h6 author-name" id="rightbar_online_mem" memcode = "'.$friend[$i]['usercode'].'"">'.$friend[$i]['name'].'</a>
			
			<span class="status">ONLINE</span>
			
			</div>
			
			</li>';
		
		}
		
		return array(
		
			'short' => 	$html1,
			
			'full' => $html2
			
		);
		
		
	}
	
}


