<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invite_friends extends App {

	function __construct()
 	{
   		parent::__construct(); 
		
		$this->load->model('Member_module');
		
		$this->load->model('user/Page_model','',TRUE);
		
		$this->load->model('user/Notification_module','',TRUE);
		
		date_default_timezone_set('Asia/Calcutta'); 	
   		
 	}
	
	//Cover Image Submit Event
	
	function invite($id = NULL){
		
		$data['result'] 			= 	$this->comman_fun->get_table_data('social_page_group',array('id'=>$id,'status'=>'Active'));
		
		if(isset($data['result'][0])){
			
			if($data['result'][0]['type']=='page'){
				
				$data['title'] = 'Invite your friends to like '.$data['result'][0]['title'];
				
			}else{
				$data['title'] = 'Invite your friends to join '.$data['result'][0]['title'];
			
			}
			$this->load->view('user/invite_friends',$data);	
			
		}
		
		
	
	}
	
	function load_member($pgcode = NULL, $view='view1'){
		
		$start_from = (isset($_GET['start_from'])) ? $_GET['start_from'] : '1'; 
		
		$filter = (isset($_GET['filter'])) ? $_GET['filter'] : NULL; 
		
		$result = $this->Notification_module->getMemberFilterFriendForPG(user_session('usercode'), $pgcode, $start_from, $filter);	
		//echo $this->db->last_query();exit;
		$data = "";
		
		if($view == 'view1'){
			
			$data = $this->HTMLMemberView1($result);
				
		}
		
		echo json_encode(array(
		
			'html' => $data
			
		));
		
		exit;
	}
	
	
	function HTMLMemberView1($result){
			
			$html = "";
			
			for($i=0;$i<count($result);$i++){
				
				$html .= $this->load->view('user/page/invite_friends_li',array('result'=>$result[$i]),true);
				
			}
				
		return $html;	
			
	}
	
	
	function page_invite(){
		
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$friendId = $_POST['friendId'];	
			
			for($i=0;$i<count($friendId);$i++){
				
				$this->Notification_module->add_invitation($friendId[$i], $_POST['eid']);
				
				
			}
			
		}
		
	}
	
	
}


