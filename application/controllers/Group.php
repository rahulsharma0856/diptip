<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_user()){
			
			header('Location: '.file_path());
			
			exit;	
			
        }
		
		$this->load->model('user/Group_model','',TRUE);
		
		$this->load->model('user/Post_model','',TRUE);
		
		$this->load->model('user/Comment_model');
		
		$this->load->model('user/Notification_module');
		
		$this->load->model('Member_module','',TRUE);
		
		$this->load->library('image_lib');
		
		$this->load->library('upload');
   		
 	}
	
	public function index(){  
		
		$this->load->view('user/not_found');
				
	}
	
	
	
	function add(){
		
		$this -> Member_module -> check_paid(user_session('usercode'));
			
		$data['mode'] 			= 	'add' ;
		
		$data['MyGroup'] 		= 	$this->Group_model->getMyGroup();
		
		$data['category'] 		= 	$this->comman_fun->get_table_data('sm_page_category',array('status'=>'Active'));
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/group/group_add',$data);	
		
		$this->load->view('user/home/comman/footer');
	
	}
	
	
	function insert(){
					
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this -> Member_module -> check_paid(user_session('usercode'));
			
			$this->form_validation->set_rules('name','Name', 'required|trim');
			
			$this->form_validation->set_rules('description','Description', 'required|trim');
			
			//$this->form_validation->set_rules('profile_img','Profile Image', 'callback_is_profile_img_selected');	
			
			//$this->form_validation->set_rules('cover_img','Cover Image', 'callback_is_cover_img_selected');
		
		
		if ($this->form_validation->run() === FALSE){
		
			$this->add();
			
		}
		else{	
		
			$i = $this->_insert();
		
			redirect('/group/view/'.$i,'refresh');
		
		}
		
		}else{
		
			$this->index();
		
		}
	}
	
	
	function is_cover_img_selected(){
	
		$this->form_validation->set_message('is_cover_img_selected', 'Please select profile image.');
		
		if (empty($_FILES['cover_img']['name']) && $_POST['mode']=='add') {
			
			return false;
		
		}else{
			
			return true;
		
		}
		
	}
	
	
	function is_profile_img_selected(){
	
		$this->form_validation->set_message('is_profile_img_selected', 'Please select profile image.');
		
		if (empty($_FILES['profile_img']['name']) && $_POST['mode']=='add') {
			
			return false;
		
		}else{
			
			return true;
		
		}
		
	}
	
	
	
	protected function _insert(){
		
			$data=array();
		
			$data['name']			=	filter_text($_POST['name']);
			
			$data['title']			=	filter_text($_POST['name']);
			
			$data['description']	=	filter_text($_POST['description']);
			
			$data['group_privacy']	=	$_POST['group_privacy'];
			
			$data['group_posts']	=	$_POST['group_posts'];
		
			
			if(isset($_FILES['profile_img']['name'])){
				
				$file_name 		= 	$this->handle_upload('profile_img','group_profile');
				
				if($file_name!=''){
					
					$data['profile_img'] = $file_name;
										
				}
				
			}
			
			
			if(isset($_FILES['cover_img']['name'])){
				
				$file_name 		= 	$this->handle_upload('cover_img','group_cover');
				
				if($file_name!=''){
					
					$data['cover_img'] = $file_name;
					
				}
				
			}
			
			if($_POST['mode']=='edit'){
				
				
				$this->comman_fun->update($data,'social_page_group',array('id'=>$_POST['eid']));
				
				return $_POST['eid'];
				
			}
			
			else{
				
				$data['type']			=	'group';
				
				$data['uid']			=	user_session('usercode');
				
				$data['status']			=	'Active';
			
				$data['created_date']	=	date('Y-m-d H:i:s');
			
				$data['created_by']		=	user_session('usercode');
				
				$id 	= 	$this->comman_fun->addItem($data,'social_page_group');
				
				
			
			////
			
			$data = array(
			
				'type' => 'group',
				
				'pg_code' => $id,
				
				'usercode' => user_session('usercode'),
				
				'timedt' => time(),
				
				'status' => '1'
			
			);
			
			$this->comman_fun->addItem($data,'social_page_group_member');
			
			////
				
				
			
				return $id;
				
			}
			
			
	}
	
	
	
	
	
	function handle_upload($file_id,$prefix=NULL){ 
		
		if (isset($_FILES[$file_id]) && !empty($_FILES[$file_id]['name'])){
			
			$config = array();
			
			$config['upload_path'] 				= 	'./upload/post';
			
			$config['allowed_types'] 			= 	'jpg|jpeg|gif|png';
			
            $config['max_size'] = '2000';
            $config['max_filename'] = '128';
            
            $config['max_width'] = '2000';
            $config['max_height'] = '1600';
            
            $config['min_width'] = '32';
            $config['min_height'] = '32';
			
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
				
				return $upload_data['file_name'];
				
			}
			
			
		}
		
		return false;
		
	}

	
	
	
	function view($id = NULL){
		
		
		$data['result'] 		= 	$this->Group_model->getGroupById($id);
		
		if(isset($data['result'][0])){
		
			$data['isPageAdmin'] 	= 	$this->Group_model->isAdmin($id);
			
			$data['isGroupJoined'] 	= 	$this->Group_model->isGroupJoined($id);
			
			$data['JoinedGroups'] 	= 	$this->Group_model->getMemberJoinedGroups(user_session('usercode'));
			
			$data['MyGroup'] 		= 	$this->Group_model->getMyGroup();
			
			$data['isValidView']     = $this->isValidView($data);
			
			$this->load->view('user/home/comman/topheader');
			
			$this->load->view('user/home/comman/header');
			
			$this->load->view('user/group/top_section',$data);	
			
			if($data['isValidView']){
				
				$this->load->view('user/group/timeline',$data);	
			
			}else{
					
			
				$this->load->view('user/group/access_denied',$data);		
			
			}
			
			$this->load->view('user/home/comman/footer');	

		
		
		}else{
			
			$this->load->view('user/not_found');
			
		}
		
		
		
			
	}
	
	function isValidView($data){
		
		if($data['result'][0]['group_privacy']=='Public'){
			
			return true;
			
		}else{
			
			if($data['isPageAdmin'] == true || $data['isGroupJoined']==true){
				
				return true;
				
			}	
		}
		
		return false;
	}
	
	function requests($id = NULL){
		
		$data['result'] 		= 	$this->Group_model->getGroupById($id);
		
		$data['isPageAdmin'] 	= 	$this->Group_model->isAdmin($id);
		
		$data['isGroupJoined'] 	= 	$this->Group_model->isGroupJoined($id);
	
		$data['JoinedGroups'] 	= 	$this->Group_model->getMemberJoinedGroups(user_session('usercode'));
		
		$data['MyGroup'] 		= 	$this->Group_model->getMyGroup();
		
		$data['isValidView']    =   $this->isValidView($data);
		
		$data['GroupJoinRequest'] 	= 	$this->Group_model->getGroupJoinRequest($id);
		
		if($data['isPageAdmin']==true){
			
				$this->load->view('user/home/comman/topheader');
				
				$this->load->view('user/home/comman/header');
				
				$this->load->view('user/group/top_section',$data);	
				
				$this->load->view('user/group/requests',$data);	
				
				$this->load->view('user/home/comman/footer');	
			
		}
		
		
	
	}
	
	
	
	function join_request_delete($id){
		
		$request = $this->Group_model->getJoinRequestById($id);
		
		if(isset($request[0])){
		
			if($this->Group_model->isAdmin($request[0]['pg_code'])){
				
				$this->comman_fun->delete('social_page_group_member',array('id'=>$request[0]['id']));
				
				$this->comman_fun->delete('social_notification',array('usercode2'=>$request[0]['usercode'],'pgCode'=>$request[0]['pg_code']));
					
			}
			
			echo json_encode(array('status'=>true)); exit;
			
		}
		
		echo json_encode(array('status'=>false)); exit;
		
	}
	
	
	function join_request_accept($id){
		
		$request = $this->Group_model->getJoinRequestById($id);
		
		if(isset($request[0]) && $request[0]['status']=='0'){
		
			if($this->Group_model->isAdmin($request[0]['pg_code'])){
				
				$this->Group_model->join_request_accept($request);
				
				echo json_encode(array('status'=>true)); exit;
					
			}
		
		}
		
		echo json_encode(array('status'=>false)); exit;
		
	}
	
	function delete_member($id){
		
		$request = $this->Group_model->getJoinRequestById($id);
		
		if(isset($request[0])){
		
			if($this->Group_model->isAdmin($request[0]['pg_code'])){
				
				$this->comman_fun->delete('social_page_group_member',array('id'=>$request[0]['id']));
					
			}
			
			echo json_encode(array('status'=>true)); exit;
			
		}
		
		echo json_encode(array('status'=>false)); exit;
		
	}
	
	
	
	function members($id = NULL){
		
		$data['result'] 		= 	$this->Group_model->getGroupById($id);
		
		$data['isPageAdmin'] 	= 	$this->Group_model->isAdmin($id);
		
		$data['isGroupJoined'] 	= 	$this->Group_model->isGroupJoined($id);
	
		$data['JoinedGroups'] 	= 	$this->Group_model->getMemberJoinedGroups(user_session('usercode'));
		
		$data['MyGroup'] 		= 	$this->Group_model->getMyGroup();
		
		$data['isValidView']    =   $this->isValidView($data);
		
		$data['JoinedMembers'] 	= 	$this->Group_model->getGroupJoinedMemberList($id);
		
		if($data['isPageAdmin']==true){
		
			$this->load->view('user/home/comman/topheader');
			
			$this->load->view('user/home/comman/header');
			
			$this->load->view('user/group/top_section',$data);	
			
			$this->load->view('user/group/members',$data);	
			
			$this->load->view('user/home/comman/footer');	
		
		}
		
		
	
	}
	
	

	
	function load_post(){
	
		$html = $this->ajax_timeline_post();
		
		$data = array(
			
			'html' => $html,
			
			'id' => ($html=="") ? '0' : '1'
			
		);
		
		echo json_encode($data);
		
		exit;
		
	} 
	
	
	
	function ajax_timeline_post(){
		
		$start_from  	=  isset($_GET['s']) ? $_GET['s'] : 0;
		
		$result     =  $this->Post_model->getGroupTimelinePost($_GET['u'],$start_from);
		
		$html= '';
		
		for($i=0;$i<count($result);$i++){
			
			$html .= $this->load->view('user/post/post_single',array('result'=>$result[$i],'section'=>'group'),true);	
			
		}
		
		return $html;	
	}
	
	
	
	function checkNewMessages(){
		
		$data = array();
		
		if(isset($_GET['uid']) && isset($_GET['last'])){
			
			$last 	= $_GET['last'];
				
			if($this->Post_model->checkGrouptimelineNewMessages($_GET['uid'], $last)){
				
				$result = $this->Post_model->getGrouptimelineNewMessages($_GET['uid'], $last);
				
				for($i=0;$i<count($result);$i++){
			
					$data['post'.$result[$i]['post_id']] = $this->load->view('user/post/post_single',array('result'=>$result[$i],'section'=>'group'),true);	
			
				}
				
			}
		
		}
		
		echo json_encode($data);
		
		exit;
	
	}
	
	
	
	function group_edit($id){
	
		$data['isPageAdmin'] 	= 	$this->Group_model->isAdmin($id);
		
		if($data['isPageAdmin']!=true){
		
			redirect('/dashboard/view/'.$i);	
		
		}
		
		$data['isValidView']    =   $this->isValidView($data);
		
		$data['result'] 			= 	$this->Group_model->getGroupById($id);
		
		$this->load->view('user/home/comman/topheader');
			
		$this->load->view('user/home/comman/header');
		
		$this->load->view('user/group/top_section',$data);	
		
		$this->load->view('user/group/group_edit',$data);	
		
		$this->load->view('user/home/comman/footer');		
	
	}
	
	
	function send_join_request($id, $view='view1'){
		
		if(!$this->Group_model->isRequestSend($id)){
			
			$this->Group_model->send_join_request($id);
				
		}
		
		if($view=='view1'){
			
			$this->member_group_status($id);
			
		}
		
		if($view=='view2'){
			
			echo json_encode($this->ajaxJosnGroupHtml2($id));
			
			exit;
			
		}
		
		
	}
	
	
	function ajaxJosnGroupHtml2($id){
		
		$result =  $this->Group_model->getGroupById($id);
		
		$data = array();
		
		$data['status'] = 'true';
		
		$data['html'] = $this->load->view('user/search/group_html',array('result'=>$result[0],'only_inner'=>true),true);
		
		return $data;
		
	}
	
	
	function delete_request($id, $view='view1'){
		

		$this->Group_model->leave_group($id);
		
		
		if($view=='view1'){
			
			$this->member_group_status($id);
			
		}
		
		if($view=='view2'){
			
			echo json_encode($this->ajaxJosnGroupHtml2($id));
			
			exit;
			
		}
		
	}
	
	function member_group_status($id){
	
		
			if($this->Group_model->isGroupJoined($id)){
			
				$html  = '<div class="btn btn-control bg-green more reqicon" id="delete_request" value="'.$id.'" title="Joined Group"><a href="#"><i class="fa fa-user"></i></a></div>';
				
			}
			elseif($this->Group_model->isRequestPending($id)){
				
				$html = '<div class="btn btn-control bg-purple more reqicon" id="delete_request" value="'.$id.'" title="Request Pending"><a href="#"><i class="fa fa-user-times"></i></a></div>';
				
			}else if($this->Group_model->isGroupInvitation($id))
			{
				$html  = '<div style="font-size: 12px;" class="btn btn-green btn-sm" id="accept_group_request" value="'.$id.'" title="Accept Join Invitation"><a style="color:#fff;" href="#"><i style="margin-right: 10px;" class="fa fa-user-plus"></i>Accept Join Invitation</a></div>';
			}else{
				
				$html  = '<div class="btn btn-control bg-primary more reqicon" id="request_send" value="'.$id.'" title="Send Join Group Request"><a href="#"><i class="fa fa-user-plus"></i></a></div>';
				
			}
		
		
		
		
		
		$data['html'] = $html;
		
		echo json_encode($data);
		
		exit;
	
	}
	
	
	
	
	
	function mygroups()
	{
		
		$data['MyGroup'] 		= 	$this->Group_model->getMyGroup();
		
		$this->load->view('user/home/comman/topheader');
			
		$this->load->view('user/home/comman/header');
		
		$this->load->view('user/group/my_groups',$data);	
		
		$this->load->view('user/home/comman/footer');	
		
	}
	
	
	function joinedgroups()
	{
		
		$data['joinedGroups'] 			= 	$this->Group_model->getMemberJoinedGroups(user_session('usercode'));
		
		$this->load->view('user/home/comman/topheader');
			
		$this->load->view('user/home/comman/header');
		
		$this->load->view('user/group/joined_groups',$data);	
		
		$this->load->view('user/home/comman/footer');	
		
	}
	
	
	
	function remove_cover_photo($group_id)
	{
		$record	= $this->comman_fun->get_table_data('social_page_group',array('id'=>$group_id,'type'=>'group','created_by'=>user_session('usercode')));
		
		if($record[0]['cover_img']!='')
		{
			$data['cover_img'] = '';
			
			$this->comman_fun->update($data,'social_page_group',array('id'=>$group_id,'type'=>'group'));
				
			$filename = './upload/post/'.$record[0]['cover_img'];
					
			unlink($filename);
			
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
	
	
	
		
	function remove_profile_photo($group_id)
	{
		$record	= $this->comman_fun->get_table_data('social_page_group',array('id'=>$group_id,'type'=>'group','created_by'=>user_session('usercode')));
		
		if($record[0]['profile_img']!='')
		{
			$data['profile_img'] = '';
			
			$this->comman_fun->update($data,'social_page_group',array('id'=>$group_id,'type'=>'group'));
				
			$filename = './upload/post/'.$record[0]['profile_img'];
					
			unlink($filename);
			
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
	
	
	
	
	function delete_my_group($id){
	
		if($this->Group_model->isAdmin($id)){
			
			// delete group 
			
			$data = array(
			
				'status' => 'Delete'
			
			);
			
			$this->comman_fun->update($data,'social_page_group',array('id'=>$id));
			
			//delete group member
			
			$g_member_list = $this->Group_model->getGroupJoinedMemberList($id);
			
			if(isset($g_member_list[0]))
			{
				for($i=0;$i<count($g_member_list);$i++)
				{
					$this->comman_fun->delete('social_page_group_member',array('pg_code'=>$id,'usercode'=>$g_member_list[$i]['usercode'],'type'=>'group'));
				}
			}
			
			
			//delete group posts
			
			$record	= $this->comman_fun->get_table_data('social_post_master',array('group_page_id'=>$id,'post_category'=>'group'));
			
			if(isset($record[0]))
			{
				for($i=0;$i<count($record);$i++)
				{
					$this->comman_fun->delete('social_posts',array('id'=>$record[$i]['post_code']));
				}
				
				$this->comman_fun->delete('social_post_master',array('group_page_id'=>$id,'post_category'=>'group'));
			}
			
			$isDelete	= $this->comman_fun->get_table_data('social_page_group',array('id'=>$id,'status'=>'Delete'));
			
			if(isset($isDelete[0]))
			{
				$pass_dt['status'] = 'true';
			
				echo json_encode($pass_dt);
			}
			
			
		}
		
		
	
	
	}
	
	
	
	
	function accept_group_join_request($id)
	{
			
			if(!$this->Group_model->isGroupJoined($id))
			{
			
				$data = array(
				
					'type' => 'group',
					
					'pg_code' => $id,
					
					'usercode' => user_session('usercode'),
					
					'timedt' => time(),
					
					'status' => '1'
				
				);
				
				$insert_id = $this->comman_fun->addItem($data,'social_page_group_member');
				
				if(isset($insert_id))
				{
					$this->comman_fun->delete('social_invite',array('pg_id'=>$id,'usercode'=>user_session('usercode')));
					
					$this->member_group_status($id);		
				}
			
			
			}
			
	}
	
	
}


