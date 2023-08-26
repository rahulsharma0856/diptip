<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends App {

	function __construct()
 	{
   		parent::__construct(); 
		

        
		
		$this->load->library('image_lib');
		
		$this->load->library('upload');
		
		$this->load->model('Member_module');
		
		$this->load->model('Comman_c_module');
		
		$this->load->model('user/social_media/post_module','',TRUE);
		
		$this->load->model('user/social_media/Page_module','',TRUE);
		
		$this->load->model('user/social_media/groups_module','',TRUE);
		
		$this->load->model('Album_photos_video_model','',TRUE);
		
		$this->load->model('user/Skill_model','',TRUE);
		
		$this->load->model('user/Page_model');
		
		$this->load->model('user/Post_model');
		
		$this->load->model('user/Group_model');
		
		$this->load->model('user/Comment_model');
		
		$this->load->model('user/Notification_module');

		date_default_timezone_set('Asia/Calcutta'); 	
		
		//$this -> Member_module -> check_paid(user_session('usercode'));
   		
 	}
	
	function index(){
		
		$this->timeline();
	}
	
	function view(){
		
		//$this -> Member_module -> check_paid(user_session('usercode'));
		
		$this->timeline();
	}
	
	public function is_valid_user($username){
		
		
		$member = $this->Member_module->get_member_by_username($username);
		
		if(!isset($member)){
			
			header('Location: '.file_path('dashboard/view'));
				
			exit;	
		}
		
		
	
	}
	
	public function timeline(){  
		
		//$this -> Member_module -> check_paid(user_session('usercode'));
		
		$limit = 3; //dashboard sidebar item limit
		
		$member_user 	 			= 	$this->uri->rsegment(3);
		
		$data['member']				=	$this->Member_module->get_member_by_username($member_user);
		
		$data['paid_sts']			=	$this->Member_module->is_paid(user_session('usercode'));
		
		if(isset($data['member']['usercode'])){
			
			$data['recent_frnds']		= 	$this->Member_module->get_last_recent_friends_pic($data['member']['usercode']);
			
			$data['MemberLikedPages'] 	= 	$this->Page_model->getMemberLikedPages(user_session('usercode'),$limit);
			
			$data['isMyFriend'] 		= 	$this->Member_module->isMyFriend($data['member']['usercode']);
			
			$data['myGroups'] 			= 	$this->Group_model->getMemberJoinedGroups(user_session('usercode'),$limit);
			
			$data['balance']			=	$this->Member_module->payment_summery_by_wallet(user_session('usercode'),'USD');
			
			$data['menu_active'] 		= 	'menu-timeline';
			
			$this->load->view('user/home/comman/topheader');	
			
			$this->load->view('user/home/comman/header');	
			
			$this->load->view('user/profile/timeline',$data);	
			
			$this->load->view('user/home/comman/footer');
		
				
		}else{
			
			$this->load->view('user/not_found');
			
		}
		
		
		
		
		
	}
	
	public function about(){  
		
		$member_user 	 		= 	$this->uri->rsegment(3);
		
		$data['member']			=	$this->Member_module->get_member_by_username($member_user);
		
		$data['menu_active'] 		= 	'menu-about';
		
		$this->load->view('user/home/comman/topheader');
			
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/about',$data);	
		
		$this->load->view('user/home/comman/footer');
		
	}
	
	
	public function friends(){  
		
		$member_user 	 			= 	$this->uri->rsegment(3);
		
		$data['member']				=	$this->Member_module->get_member_by_username($member_user);
				
		$data['TotalMemberFriend']	=	$this->Member_module->getCountMemberFriend($data['member']['usercode']);
		
		$data['profile_usercode']  	= 	$data['member']['usercode'];
		
		$data['login_usercode']  	= 	user_session('usercode');
		
		$data['menu_active'] 		= 	'menu-friends';
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/friends',$data);	
		
		$this->load->view('user/home/comman/footer');
		
		
	}
	
	
	/**
     * load_friends
     *
     * @param string $uid
     * @param string $start_from
	 *
     */
	
	function load_friends($uid='',$start_from = 0){
			
		$search = $this->input->get('search');
		
		$member					=	$this->Member_module->get_member_by_username($uid);
		
		$data['friend']			=	$this->Member_module->getMemberFriend($member['usercode'], $start_from, $search);	
		
		echo json_encode(
		
			array(
				
				'tot'  => count($data['friend']),
					
				'data' => $this->load->view('user/profile/friends_load',$data,true)
				
			)
			
		);
	
	}
	
	
	public function friends_request(){  
		
		$data['member']				=	$this->Member_module->get_member_by_username(user_session('username'));
		
		$data['friend']				=	$this->Member_module->getMemberFriendRequest(user_session('usercode'), 50);
		
		$data['TotalMemberFriend']	=	$this->Member_module->getCountMemberFriend($data['member']['usercode']);
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/friends_request',$data);	
		
		$this->load->view('user/home/comman/footer');
		
		
	}
	
	
	
	function edit_profile(){
		
		$data['result']	=	$this->Member_module->get_member_by_id(user_session('usercode'));
		
		$data['CountryList']	=	$this->Comman_c_module->getCountryList();
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/edit_profile',$data);	
		
		$this->load->view('user/home/comman/footer');
	
	}
	
	
	function edit_profile_submit(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('mobileno','mobileno', 'required|trim');
			
			$this->form_validation->set_rules('fname','First Name', 'required|trim');	
			
			$this->form_validation->set_rules('lname','Last Name', 'required|trim');	
			
			
			if ($this->form_validation->run() === FALSE){
				
				$this->edit_profile();
				
			}
			else{	
			
				$this->_edit_profile_submit();
				
				$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Update Successfully...'));
				
				header('Location: '.file_path('profile/edit_profile'));
				
				exit;
			}	
		}
	
	}
	
	
	private function _edit_profile_submit(){
		
		$smr_web_login 				= 	$this->session->userdata['smr_web_login'];
	
		$data=array();
		
		$data['fname']				=	filter_text($this->input->post('fname'));
		
		$data['lname']				=	filter_text($this->input->post('lname'));
		
		$data['fullname']			=	filter_text($this->input->post('fname').' '.$this->input->post('lname'));
		
		$data['gender']				=	filter_text($this->input->post('gender'));
		
		$data['dob']				=	(date('Y-m-d',strtotime($this->input->post('dob'))));
		
		$data['mobileno']			=	filter_text($this->input->post('mobileno'));
		
		$data['country']			=	filter_text($this->input->post('country'));
		
		$data['state']				=	filter_text($this->input->post('state'));
		
		$data['city']				=	filter_text($this->input->post('city'));
		
		$data['occupation']			=	filter_text($this->input->post('occupation'));
		
		$data['about_desc']			=	filter_text($this->input->post('about_desc'));
		
		$data['facebook_link']		=	filter_text($this->input->post('facebook_link'));
		
		$data['twitter_link']		=	filter_text($this->input->post('twitter_link'));
		
		$data['last_update']		=	date('Y-m-d h:i:s');
		
		
		//var_dump($data);exit;
		
		$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
		
		
		$smr_web_login['name']			=	$_POST['fname'].' '.$_POST['lname'];
		
		$this->session->set_userdata('smr_web_login', $smr_web_login);  
		
	}
	
	
	
	public function photos(){  
		
		$member_user 	 			= 	$this->uri->rsegment(3);
		
		$data['member']				=	$this->Member_module->get_member_by_username($member_user);
		
		$data['photos']				=	$this->Post_model->getUserPostPhotos($data['member']['usercode']);
		
		$data['tot_photos']			=	$this->Post_model->countTotUserphotos($data['member']['usercode']);
	
		$data['menu_active'] 		= 	'menu-photos';
		
		
		
		$this->load->view('user/home/comman/topheader');
			
		$this->load->view('user/home/comman/header');
			
		$this->load->view('user/profile/photos',$data);	
		
		$this->load->view('user/home/comman/footer');
		
	}
	
	function load_more_photos()
	{
		$member_user 		=  isset($_GET['m'])? $_GET['m'] : 0;
		
		$member				=	$this->Member_module->get_member_by_username($member_user);
		
		$tot_photos			=	$this->Post_model->countTotUserphotos($member['usercode']);
		
		
		$html = $this->get_more_photos($member);
		
		$data = array(
			
			'html' => $html,
			
			'id' => ($html=="") ? '0' : '1',
			
			'tot_img' => $tot_photos['tot_img']
			
		);
		
		echo json_encode($data);
		
		exit;
		
		
	}
	
	function get_more_photos($member)
	{
		$start_from			=  isset($_GET['s']) ? $_GET['s'] : 0;
		
		$photos				=	$this->Post_model->getUserPostPhotos($member['usercode'],$start_from);
		
		if(isset($photos[0]))
		{
			for($i=0;$i<count($photos);$i++)
			{
				
				$html .='<a href="'.file_path('dashboard').'post/'.$photos[$i]['post_id'].'">
						 <div class="photo-item col-4-width">
							<img src="'.upload_path().'post/'.$photos[$i]['image_path'].'" alt="photo">
							<div class="content">
								<a href="#" class="h6 title">'.$post_text.'</a>
								<time class="published" datetime="2017-03-24T18:18">'.time_ago($photos[$i]['time_dt']).'</time>
							</div>
						</div></a>';
				
				
			}
			
			
			return $html;
			
		}
					
		
	}
	
	
	public function videos(){  
		
		$member_user 	 			= 	$this->uri->rsegment(3);
		
		$data['member']				=	$this->Member_module->get_member_by_username($member_user);
		
		$data['menu_active'] 		= 	'menu-videos';
		
		$this->load->view('user/home/comman/topheader');
			
		$this->load->view('user/home/comman/header');
			
		$this->load->view('user/profile/videos',$data);	
		
		$this->load->view('user/home/comman/footer');
		
		
	}	
	
	
	function load_video(){
	
		$html = $this->ajax_timeline_video();
		
		$data = array(
			
			'html' => $html,
			
			'id' => ($html=="") ? '0' : '1'
			
		);
		
		echo json_encode($data);
		
		exit;
		
	}	
	
	
	function ajax_timeline_video(){
		
		
		$member = $this->Member_module->get_member_by_username($_GET['u']);
		
		$start_from  	=  isset($_GET['s']) ? $_GET['s'] : 0;
		
		$result     	=  $this->Post_model->getMembertimelineVideo($member['usercode'],$start_from);
		
		$html			= '';
		
		for($i=0;$i<count($result);$i++){
			
			$html .= $this->load->view('user/post/post_single',array('result'=>$result[$i]),true);	
			
		}
		
		return $html;	
	}
	
	
	public function change_profile_image(){  
		
		$data['member']			=	$this->Member_module->get_member_by_id(user_session('usercode'));
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/change_profile_image',$data);	
			
		$this->load->view('user/home/comman/footer');
		
		
	}
	
	function submit_profile_image(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$result	=	$this->Member_module->get_member_by_id(user_session('usercode'));
			
			$data = array();
			
			if(isset($_FILES['profile_img']['name'])){	
				
                if ($this->form_validation->run() === FALSE){
                
                    $data['text']   =  validation_errors();
                    
                    $data['status'] =  'false';
                    
                    echo json_encode($data);
                        
                    exit;	
                
                }
                
				if($this->handle_upload('profile_img','member_profile')){
                
                    // Validate Image Check..
                    if ($_POST['profile_img'] === '') {
                        $data['text']   =  validation_errors();
                        
                        $data['status'] =  'false';
                        
                        echo json_encode($data);
                            
                        exit;			
                    }
					
					if($_POST['profile_img']!=''){
						
						$data['profile_img'] = $_POST['profile_img'];
						
						$filename = './upload/post/'.$result['profile_img'];
						
						$smr_web_login 	 = 	$this->session->userdata['smr_web_login'];
						
						if($result['profile_img'] != 'profile.png'){
						
							unlink($filename);
						
						}
						
						$smr_web_login['profile_img']	=	$_POST['profile_img'];
						
						$this->session->set_userdata('smr_web_login', $smr_web_login);  
						
					}
				} else {
                    exit;
                }
			}
			
			if(isset($_FILES['cover_img']['name'])){
			
				if($this->handle_upload('cover_img','member_cover')){
					
					if($_POST['cover_img']!=''){
						
						$data['cover_img'] =$_POST['cover_img'];
						
						$filename = './upload/post/'.$result['cover_img'];
						
						unlink($filename);

					}	
				} else {
                    exit;
                }
			}
			
			$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
	
		}
		
		
		header('Location: '.file_path('profile/change_profile_image'));
				
		exit;
		

	
	}
	
	

	
	
	function change_password_insert(){
		
		$this->form_validation->set_rules('old_pass','Old Password', 'required|trim|callback_check_old_password');
		
		$this->form_validation->set_rules('new_pass','New Password', 'required|trim|min_length[5]');
		
		$this->form_validation->set_rules('confirm_pass','Confirm Password', 'required|trim|matches[new_pass]');
		
		if ($this->form_validation->run() === FALSE)
		{
				$this->change_password();
		}
		else
		{	
			$this->_change_password_insert();
			
			$this->session->set_flashdata('msg','Password Change Successfully.....');
			
			redirect('profile/change_password');
		
			exit;
		}
	}
	
	protected function _change_password_insert(){
		
		$data=array();
		
		$data['password']			=	($_POST['new_pass']);
		
		$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
		
	}
	
	function check_old_password(){
		
		if(!$this->comman_fun->check_record('membermaster',array('usercode'=>user_session('usercode'),'password'=>$_POST['old_pass'])))
   		{
      		$this->form_validation->set_message('check_old_password', 'Old Password Not Match');
      		return FALSE;
   		} 
		return TRUE;
	}
	
	function check_new_password(){
		
		if($this->comman_fun->check_record('membermaster',array('usercode'=>user_session('usercode'),'password'=>$_POST['new_pass']))){
			
      		$this->form_validation->set_message('check_new_password', 'Enter Same Password');
			
      		return FALSE;
			
   		} 
		return TRUE;
	}
	
	
	
	
	function handle_upload($file_id,$prefix=NULL){ 
		
		if (isset($_FILES[$file_id]) && !empty($_FILES[$file_id]['name'])){
			
			$config = array();
			
			$config['upload_path'] 				= 	'./upload/post';
			
			$config['allowed_types'] 			= 	'jpg|jpeg|gif|png';
			
			$config['max_size']      			= 	'1000';
            
            $config['max_width']                =   '2000';
            $config['max_height']               =   '600';
            
            $config['min_width']                =   '16';
            $config['min_height']               =   '16';
			
			$config['overwrite']     			= 	TRUE;
			
			$config['remove_spaces'] 			= 	TRUE;
			
			$_FILES['userfile']['name'] 		= 	$_FILES[$file_id]['name'];
			
			$_FILES['userfile']['type'] 		= 	$_FILES[$file_id]['type'];
			
			$_FILES['userfile']['tmp_name']		= 	$_FILES[$file_id]['tmp_name'];
			
			$_FILES['userfile']['error']		= 	$_FILES[$file_id]['error'];
			
			$_FILES['userfile']['size']			= 	$_FILES[$file_id]['size'];
			
            // Get temp rand name..
			$rand = md5(uniqid(rand(), true));
			$fileName							=	$prefix.'_'.$rand;
			$fileName 							= 	str_replace(" ","",$fileName);
			$config['file_name'] 				= 	$fileName;
			
            $this->upload->display_errors('', '');
            
			$this->upload->initialize($config);
			
            // Do upload
			if($this->upload->do_upload()){
                $fullPath = $this->upload->data('full_path');
                $filePath = $this->upload->data('file_path');
                $fileExt = $this->upload->data('file_ext');

                // Get the hash of the file
                $hashName = substr(hash_file('sha256', $fullPath), 64 - 34, 34);

                // Rename temp file with hash
                rename($fullPath , $filePath . $hashName . $fileExt);

                // Replace new filename and return upload data
                $upload_data = str_replace($fileName, $hashName,  $this->upload->data());
				
				$_POST[$file_id] =  $upload_data['file_name'];
				
				return true;
				
			} else {
            
                $_POST[$file_id] = '';
            
                $upload_data[$i]['notification'] = $this->upload->display_errors();
                                    
                $this->form_validation->add_to_error_array('uploadStatusImg', $this->upload->display_errors('Upload Error:  ', ' The file "' . $files['uploadStatusImg']['name'][$i] . '" is not valid.'));
            }	
		}
		
		return false;
		
	}
	
	
	
	function friend_request_button($usercode){
		
		if($usercode != user_session('usercode')){
			
			$data = $this->Member_module->FriendStatusIcon($usercode);
		
			echo json_encode($data);
			
		}

	}
	
	function friend_request_send($usercode, $view='view1'){
		
		$result  = $this->Member_module->Checkfriendstatus($usercode);
		
		if(!isset($result[0])){
		
			$this->Member_module->friend_request_send($usercode);	
			
		}
		
		if($view=='view1'){
			
			echo json_encode($this->ajaxJosnMemberHtml1($usercode));
			
			exit;
			
		}
		
		if($view=='view2'){
			
			echo json_encode($this->ajaxJosnMemberHtml2($usercode));
			
			exit;
			
		}
			
	}
	
	
	function ajaxJosnMemberHtml1($usercode){
		
		$data = $this->Member_module->FriendStatusIcon($usercode);
		
		return $data;
		
	}
	
	function ajaxJosnMemberHtml2($usercode){
		
		$result =  $this->Member_module->find_member_by_id($usercode);
		
		$data = array();
		
		$data['status'] = 'true';
		
		$data['html'] = $this->load->view('user/search/friend_html',array('result'=>$result,'only_inner'=>true),true);
		
		return $data;
		
	}
	
	function friend_request_delete($usercode, $view='view1'){
	
		$usercode = $this->db->escape($usercode);
		
		$this->db->where('(user_1 = '.user_session('usercode').' AND user_2 = '.$usercode.' )')->or_where('( user_1 = '.$usercode.' AND user_2 = '.user_session('usercode').' )')->delete('social_friends');
		
		$this->db->where('(usercode = '.user_session('usercode').' AND friend = '.$usercode.' )')->or_where('( usercode = '.$usercode.' AND friend = '.user_session('usercode').' )')->delete('social_friends_detail');
		
		if($view=='view1'){
			
			echo json_encode($this->ajaxJosnMemberHtml1($usercode));
			
			exit;
			
		}
		
		if($view=='view2'){
			
			echo json_encode($this->ajaxJosnMemberHtml2($usercode));
			
			exit;
			
		}
	
	}
	
	function friend_request_accept($usercode, $view='view1'){
	
		$result  = $this->Member_module->GetPendingfriendRequestForAccept($usercode);
		
		
		if(isset($result[0])){
		
			$this->Member_module->friend_request_accept($usercode);	
			
		}
		
		if($view=='view1'){
			
			echo json_encode($this->ajaxJosnMemberHtml1($usercode));
			
			exit;
			
		}
		
		if($view=='view2'){
			
			echo json_encode($this->ajaxJosnMemberHtml2($usercode));
			
			exit;
			
		}
		
	}
	
	function friend_delete($usercode){
	
		$usercode = $this->db->escape($usercode);
		
		$this->db->where('(user_1 = '.user_session('usercode').' AND user_2 = '.$usercode.' )')->or_where('( user_1 = '.$usercode.' AND user_2 = '.user_session('usercode').' )')->delete('social_friends');
		
		$this->db->where('(usercode = '.user_session('usercode').' AND friend = '.$usercode.' )')->or_where('( usercode = '.$usercode.' AND friend = '.user_session('usercode').' )')->delete('social_friends_detail');
		
		$data = $this->Member_module->FriendStatusIcon($usercode);
		
		echo json_encode($data);
		
	}
	
	
	function ajaxGetAllSummery(){
			
		$total_friend_request			=	$this->Member_module->getCountMemberFriendRequest(user_session('usercode'));
		
		$total_notifiction 	= $this->Notification_module->getTotalNotification(user_session('usercode'));
		
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
		
		echo json_encode($data);
	
	}
	
	
	
	
	
	
	function load_post(){
	
		$html = $this->ajax_member_timeline_post();
		
		$data = array(
			
			'html' => $html,
			
			'id' => ($html=="") ? '0' : '1'
			
		);
		
		echo json_encode($data);
		
		exit;
		
	} 
	
	
	
	function ajax_member_timeline_post(){
		
		$member = $this->Member_module->get_member_by_username($_GET['u']);
		
		$start_from  	=  isset($_GET['s']) ? $_GET['s'] : 0;
		
		$result     =  $this->Post_model->getMembertimelinePost($member['usercode'],$start_from);
		
		$html= '';
		
		for($i=0;$i<count($result);$i++){
			
			$html .= $this->load->view('user/post/post_single',array('result'=>$result[$i]),true);	
			
		}
		
		return $html;	
	}
	
	
	function checkNewMessages(){
		
		$data = array();
		
		if(isset($_GET['uid']) && isset($_GET['last'])){
			
			$last 	= $_GET['last'];
			
			$member = $this->Member_module->get_member_by_username($_GET['uid']);
			
			if($this->Post_model->checkMembertimelineNewMessages($member['usercode'], $last)){
				
				$result = $this->Post_model->getMembertimelineNewMessages($member['usercode'], $last);
				
				for($i=0;$i<count($result);$i++){
			
					$data['post'.$result[$i]['post_id']] = $this->load->view('user/post/post_single',array('result'=>$result[$i]),true);	
			
				}
				
			}
		
		}
		
		echo json_encode($data);
		
		exit;
	
	}
	
	
	public function work_experience(){  
		
		$usercode = user_session('usercode');
		
		$data['result']	=	$this->Member_module->get_member_work($usercode);
		
		$data['skills']	= $this->comman_fun->get_table_data('professional_skills',array('usercode'=>user_session('usercode'),'status'=>'Active'));
		
		
		$data['skillslist']	= $this->comman_fun->get_table_data('professional_skills_master',array('id>'=>'0'));
		
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/work_experience_view',$data);	
		
		$this->load->view('user/home/comman/footer');
		
		
	}
	
	
	function work_submit(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('company_name','Company Name', 'required|trim');
			
			$this->form_validation->set_rules('position','Position', 'required|trim');	
			
			$this->form_validation->set_rules('city_town','City/Town', 'required|trim');	
			
			$this->form_validation->set_rules('work_start_date','Start Date', 'required|trim');	
			
			
			if ($this->form_validation->run() === FALSE){
				
				$this->work_experience();
				
			}
			else{	
			
				$this->_work_submit();
				
				$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Update Successfully...'));
				
				header('Location: '.file_path('profile/work_experience'));
				
				exit;
			}	
		}
	
	}
	
	
	private function _work_submit(){
		
		$data=array();
		
		$data['usercode']			=	user_session('usercode');
		
		$data['company_name']		=	filter_text($this->input->post('company_name'));
		
		$data['position']			=	filter_text($this->input->post('position'));
		
		$data['city_town']			=	filter_text($this->input->post('city_town'));
		
		$data['about_desc']			=	filter_text($this->input->post('about_desc'));
		
		$data['work_start_date']	=	(date('Y-m-d',strtotime($this->input->post('work_start_date'))));
		
		if($_POST['work_here']=="work_here"){
			
			$data['work_end_date']	=	"0000-00-00";
			
			$data['work_here']		=	"yes";
			
		}else{
		
			$data['work_end_date']	=	date('Y-m-d',strtotime($this->input->post('work_end_date')));
		}
		
		$data['privacy_status']		=	($this->input->post('privacy_status'));
		
		$data['status']				=	"Active";
		
		
		if($_POST['mode']!="edit"){
			
			$data['create_date']		=	date('Y-m-d h:i:s');

			$this->comman_fun->addItem($data,'work_experience');
			
		}else{
			
			$data['last_update']		=	date('Y-m-d h:i:s');
			
			$this->comman_fun->update($data,'work_experience',array('usercode'=>user_session('usercode'),'id'=>$_POST['id']));
		}
		
		
	}
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('work_experience',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'work_experience',array('id'=>$eid));
		
		header('Location: '.file_path('profile/work_experience'));
		
	}
	
	function skills_submit(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$countskill = count($this->input->post('skills'));
			
			if($countskill<1)
			{
				$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Update Successfully...'));
				
				header('Location: '.file_path('profile/work_experience'));
				
				exit;
				//$this->form_validation->set_rules('skills','Skills', 'required|trim');
			}
			
			//if ($this->form_validation->run() === FALSE){
				
			//	$this->work_experience();
				
			//}
			else{	
			
				$this->_skills_submit();
				
				$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Update Successfully...'));
				
				header('Location: '.file_path('profile/work_experience'));
				
				exit;
			}	
		}
	
	}
	
	
	private function _skills_submit(){
		
		$data=array();
		
		$data['usercode']			=	user_session('usercode');
		
		$input_skill_list 			= implode(",",$this->input->post('skills'));
		
		$data['skills']				=	($input_skill_list);
		
		$data['privacy_status']		=	($this->input->post('privacy_status'));
		
		$data['status']				=	"Active";
		
		
		if(!$this->comman_fun->check_record('professional_skills',array('usercode'=>user_session('usercode'),'status'=>'Active')))
   		{
			
			$data['create_date']		=	date('Y-m-d h:i:s');
			
			$this->comman_fun->addItem($data,'professional_skills');
		
		}else{
			
			$data['last_update']		=	date('Y-m-d h:i:s');
			
			$this->comman_fun->update($data,'professional_skills',array('usercode'=>user_session('usercode'),'status'=>'Active'));
		}
		
	}
	
	function delete_skill($eid){
		
		$record	=	$this->comman_fun->get_table_data('professional_skills',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'professional_skills',array('id'=>$eid));
		
		header('Location: '.file_path('profile/work_experience'));
		
	}
	
	
	function album()
	{
		$member_user 	 			= 	$this->uri->rsegment(3);
		
		$data['member']				=	$this->Member_module->get_member_by_username($member_user);
		
		$data['album_list']			=	$this->Album_photos_video_model->get_album_by_usercode($data['member']['usercode']);
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/album_list',$data);	
		
		$this->load->view('user/home/comman/footer');
		
		
		
	}
	
	
	
	function photo_album($albumid)
	{
		$data['member']	=	$this->Member_module->get_member_by_id(user_session('usercode'));
		
		$data['photos']	=	$this->Album_photos_video_model->get_album_photos($albumid);
		
		//var_dump($data['photos']);exit;
		
		$data['albumid'] = 	$albumid;
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/album_photos',$data);	
		
		$this->load->view('user/home/comman/footer');
		
		
		
	}
	
	
	
	
	
	
	
	//Cover Image Submit Event
	
	function upload_album_photo(){
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
		    $album_id  = $_POST['album_id'];
			
			$cpt = count($_FILES['input_album_photo']['name']);
			
			$files = $_FILES;
			
			$config = array();
			
			$config['upload_path'] 	 = 	'./upload/album';
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$config['max_size']      = '0';
			
			$config['overwrite']     = TRUE;
		
			$upload_count=0;
			
			if($cpt<1)
			{
				 echo json_encode(array('status'=>false,'msg'=>'File Not Selected'));
			}
			else
			{
					$img_html ='';
					
					for($i=0; $i<$cpt; $i++)
					{
								
								if($files['input_album_photo']['name'][$i])
								{
								
									$_FILES['userfile']['name'] 	= 	$files['input_album_photo']['name'][$i];
									
									$_FILES['userfile']['type'] 	= 	$files['input_album_photo']['type'][$i];
									
									$_FILES['userfile']['tmp_name']	= 	$files['input_album_photo']['tmp_name'][$i];
									
									$_FILES['userfile']['error']	= 	$files['input_album_photo']['error'][$i];
									
									$_FILES['userfile']['size']		= 	$files['input_album_photo']['size'][$i]; 	
									
									$rand = md5(uniqid(rand(), true));
									
									$fileName							=	'album_'.$rand.''.$_FILES['input_album_photo']['name'][$i];
									
									$fileName 							= 	str_replace(" ","",$fileName);
									
									$config['file_name'] 				= 	$fileName;
									
									$this->upload->initialize($config);
									
									$image_info = getimagesize($_FILES["input_album_photo"]["tmp_name"]);
								
									if ($this->upload->do_upload())
									{
										$upload_data    	= $this->upload->data();
										
										$data=array();
										
										$data['album_id']		=	$album_id;
										
										$data['image_path']		=	$upload_data['file_name'];
											
										$last_img_id = $this->comman_fun->addItem($data,'social_album_images');
										
										$img_html.= $this->ajax_get_album_photos($upload_data['file_name']);
										
									}else{
		
										 echo json_encode(array('status'=>false,'msg'=>$this->upload->display_errors()));
										
									}
									
								}//for loop if
								
					}//end for loop
					
					
					echo json_encode(array('status'=>true,'img_data'=>$img_html));
					
			}//above for loop else
							
							
		}
	
	}
	
	function ajax_get_album_photos($image_path)
	{
			$html ='';
			$html ='<div class="photo-item col-4-width">
						<img src="'.upload_path().'album/'.$image_path.'" alt="photo">
						<div class="overlay overlay-dark"></div>
						<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
						<a href="#" class="post-add-icon inline-items">
							<svg class="olymp-heart-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-heart-icon"></use></svg>
							<span>15</span>
						</a>
						<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
						<div class="content">
							<a href="#" class="h6 title">Header Photos</a>
							<time class="published" datetime="2017-03-24T18:18"></time>
						</div>
					</div>';
					
				return $html;
			
	}
	
	
	
	function create_album()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$data = array();
		
			$data['album_name']			=	($this->input->post('album_name'));
			
			$data['album_desc']			=	($this->input->post('album_desc'));
			
			$data['create_by']			=	user_session('usercode');
			
			$data['status']				=	"Active";
			
			$data['create_time']		=	time();
			
			$albumid = $this->comman_fun->addItem($data,'social_album_master');
			
			$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Album created Successfully...'));
			
			header('Location: '.file_path('profile/photo_album/'.$albumid));
				
				
		}
		
	}
	
	
	
	function delete_album($album_id)
	{
		
		$return_val = $this->check_album_for_delete($album_id);
		
		if($return_val=='true')
		{
			
			$this->comman_fun->delete('social_album_master',array('album_id'=>$album_id));
			
			$album_img =$this->comman_fun->get_table_data('social_album_images',array('album_id'=>$album_id));
			
			if(isset($album_img[0]))
			{
				$this->comman_fun->delete('social_album_images',array('album_id'=>$album_id));
				
				for($i=0;$i<count($album_img);$i++)
				{
					$filename = './upload/album/'.$album_img[$i]['image_path'];
					
					unlink($filename);
				}
				
				
						
			}
			
			echo json_encode(array('status'=>'true'));
			
		}
		else
		{
			echo json_encode(array('status'=>'false','msg'=>'Something went wrong...!!!'));
		}
		
	}
	
	function check_album_for_delete($album_id)
	{
		$record	=	$this->comman_fun->get_table_data('social_album_master',array('album_id'=>$album_id,'status'=>'Active','create_by'=>user_session('usercode')));
		
		if(isset($record[0]))
		{
			return 'true';
		}
		else
		{
			return 'false';
		}
		
	}
	
	
	
	
	function remove_cover_photo()
	{
		
		$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>user_session('usercode')));
		
		if($record[0]['cover_img']!='')
		{
			$data['cover_img'] = '';
			
			$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
				
			$filename = './upload/post/'.$record[0]['cover_img'];
					
			if($record[0]['cover_img'] != 'g_cover.jpg'){
					
				unlink($filename);
			
			}
			
			$file_path   = thumb('g_cover.jpg',0,0);
			
			$return_data = array(
				
							'status' => 'true',
							
							'file_path' => $file_path
									
							);
				
			echo json_encode($return_data);
				
		}
		else
		{
			echo json_encode(array('status'=>'false','msg'=>'Something went wrong...!!!'));
		}
		
	}
	
	
	
	
	function remove_profile_photo()
	{
		
		$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>user_session('usercode')));
		
		if($record[0]['profile_img']!='')
		{
			$data['profile_img'] = '';
			
			$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
				
			$filename = './upload/post/'.$record[0]['profile_img'];
			
			if($record[0]['profile_img'] != 'profile.png'){
					
				unlink($filename);
			
			}
			
			$file_path   = thumb('g_profile.jpg',0,0);
			
			$return_data = array(
				
							'status' => 'true',
							
							'file_path' => $file_path
									
							);
				
			echo json_encode($return_data);
				
		}
		else
		{
			echo json_encode(array('status'=>'false','msg'=>'Something went wrong...!!!'));
		}
		
	}
	
	
	
	
	
	//-----------------------------------
	
	
	function insert_skill()
	{
		
		$strings = $this->Skill_model->getSkill();
		
		$skill = explode('|',$strings);
	
		
		for($i=0;$i<count($skill);$i++)
		{
			$data['skill_name'] =$skill[$i];
			
			$albumid = $this->comman_fun->addItem(($data),'professional_skills_master');
		}
		
		
	}
	
	//--------------------------------------
	
	
	function mutual_friends()
	{
		$username 	 			= 	$this->uri->rsegment(3);
		
		$data['member']			=	$this->Member_module->get_member_by_username($username);
		
		$data['friend']			=	$this->Member_module->getMemberFriend($data['member']['usercode']);
		
		$data['TotalMemberFriend']	=	$this->Member_module->getCountMemberFriend($data['member']['usercode']);
		
		
		
		$data['mutualfrnds'] 		= $this->Member_module->mutual_friends($data['member']['usercode']);
		
		$data['TotMutualFrnds'] 	= count($data['mutualfrnds']);
		
		$data['menu_active'] 		= 	'menu-mutualfrnds';
		
		
		$data['profile_usercode']  	= $data['member']['usercode'];
		
		$data['login_usercode']  	= user_session('usercode');
		
	
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/profile/mutual_friends',$data);	
		
		$this->load->view('user/home/comman/footer');
	}
	
	
	
}


