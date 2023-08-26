<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends App {

	function __construct()
 	{
   		parent::__construct(); 
		
		$this->load->model('user/Page_model','',TRUE);
		
		$this->load->model('user/Post_model','',TRUE);
		
		$this->load->model('user/Comment_model');
		
		$this->load->model('user/Notification_module');
		
		$this->load->model('user/Ads_model','',TRUE);
		
		$this->load->model('Member_module','',TRUE);
		
		$this->load->library('image_lib');
		
		$this->load->library('upload');
   		
 	}
	
	public function index(){  
		
			
	}
	
	function add(){
			
		$data['mode'] 			= 	'add' ;
	
		$data['country']	=	$this->Member_module->getCountry();
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/ads/ads_add',$data);	
		
		$this->load->view('user/home/comman/footer');
	
	}
	
	
	function view(){
	
		$data['list']	=	$this->Member_module->getMemberAds();
		
		$data['country']	=	$this->Ads_model->getAdsSelectCountry();
			
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/ads/ads_list',$data);	
		
		$this->load->view('user/home/comman/footer');
	
	}
	
	
	function insert(){
					
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
			$this->form_validation->set_rules('title','Page title', 'required|trim');
			
			$this->form_validation->set_rules('description','Page Description', 'required|trim');
			
			$this->form_validation->set_rules('country','Country', 'callback_isCountrySelect');	
			
			$this->form_validation->set_rules('age_group_to','Age Group', 'required|trim');	
			
			$this->form_validation->set_rules('age_group_from','Age Group', 'required|trim');		
			
			//$this->form_validation->set_rules('profile_img','Profile Image', 'callback_is_profile_img_selected');	
			
			//$this->form_validation->set_rules('cover_img','Cover Image', 'callback_is_cover_img_selected');
		
		
		if ($this->form_validation->run() === FALSE){
		
			$this->add();
			
		}
		else{	
		
			$i = $this->_insert();
		
			redirect('/ads/view/'.$i,'refresh');
		
		}
		
		}else{
		
			$this->index();
		
		}
	}
	
	

	
	
	
	protected function _insert(){
		
			$data=array();
		
			$data['title']				=	filter_text($_POST['title']);
			
			$data['description']		=	filter_text($_POST['description']);
			
			$data['url']				=	filter_text($_POST['url']);
		
			$data['gender']				=	$_POST['gender']; 
			
			$data['age_group_to']		=	$_POST['age_group_to']; 
			
			$data['age_group_from']		=	$_POST['age_group_from']; 
			
			
			if(isset($_FILES['ad_img']['name'])){
				
				$file_name 		= 	$this->handle_upload('ad_img','ad');
				
				if($file_name!=''){
					
					$data['ad_img'] = $file_name;
										
				}
				
			}
			
			
			if(isset($_FILES['ad_video']['name'])){
				
				$file_name 		= 	$this->uplaod_video();
				
				if($file_name!=''){
					
					$data['ad_video'] = $file_name;
										
				}
				
			}
			
			if($_POST['mode']=='edit'){
				
				
				$this->comman_fun->update($data,'social_ads_create',array('id'=>$_POST['eid']));
				
				return $_POST['eid'];
				
			}
			
			else{
				
			
				$data['usercode']		=	user_session('usercode');
				
				$data['time_dt']		=	date('Y-m-d H:i:s');
			
				
				
				//gender
				
				$ad_id 	= 	$this->comman_fun->addItem($data,'social_ads_create');
				
				$this->addAdCountry($ad_id);
				
				//Add Post And Update Detail
				$post_id = $this->add_in_post($ad_id);
				
				$data = array(
					
					'post_id' => $post_id
					
					
				);
				
				$this->comman_fun->update($data,'social_ads_create',array('id'=>$ad_id));
				
				return $ad_id;
				
			}
			
			
	}
	
	private function add_in_post($ad_id){
		
		$result = $this -> Ads_model -> getAdById($ad_id);
		
		$data = array(
		
			'add_by' => '0',
			
		    'post_text' => filter_text($result[0]['description']),
			
			'video_upload' => '',
			
			'video_share' => '',
			
			'share_url' => '',
			
			'time_dt' => time(),
			
			'status' => 'Active',
			
			'ads_code' => $ad_id
			
		);
		
		$id = $this->comman_fun->addItem($data,'social_posts');
		
		$data = array(
		
			'post_code' => $id,
			
			'post_category' => 'Ads',
			
			'post_type' => 'add',
			
			'time_dt' => time(),
			
			'date_time' => date('Y-m-d'),
			
			'is_ads' => '1',
			
			'ads_code' => $ad_id,
			
			'status' => 'Active'
			
		);
		
		$post_id = $this->comman_fun->addItem($data,'social_post_master');
		
		return $post_id;
		
	}
	
	private function addAdCountry($ad_id = NULL){
		
		$list = $_POST['country'];
		
		for($i=0;$i<count($list);$i++){
			
			$data['ad_id']			=	$ad_id;
			
			$data['country']		=	$list[$i];
			
			$data['status']			=	'1';
		
			$this->comman_fun->addItem($data,'social_ads_country');
				
		}
		
	}
	
	
	
	function handle_upload($file_id,$prefix=NULL){ 
		
		if (isset($_FILES[$file_id]) && !empty($_FILES[$file_id]['name'])){
			
			$config = array();
			
			$config['upload_path'] 				= 	'./upload/ads';
			
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
				
			}else{
			
				echo $this->upload->display_errors();
				
				exit;
			
			}
			
			
		}
		
		return false;
		
	}

	
	
	 function uplaod_video(){
	
		$config = array();
		
		$config['upload_path'] 	 = 	'./upload/ads/video';
		
		$config['allowed_types'] = 'mp4|ogv|avi|mkv';
		
		$config['max_size']      = '30720';
		
		$config['overwrite']     = FALSE;
		
		$_FILES['userfile']['name'] 		= 	$_FILES['ad_video']['name'];
		
		$_FILES['userfile']['type'] 		= 	$_FILES['ad_video']['type'];
		
		$_FILES['userfile']['tmp_name']		= 	$_FILES['ad_video']['tmp_name'];
		
		$_FILES['userfile']['error']		= 	$_FILES['ad_video']['error'];
		
		$_FILES['userfile']['size']			= 	$_FILES['ad_video']['size'];
		
		
		$rand = md5(uniqid(rand(), true));
		
		$fileName							=	user_session('usercode').'_'.$rand;
		
		$fileName 							= 	str_replace(" ","",$fileName);
		
		$config['file_name'] 				= 	$fileName;
		
		$this->upload->initialize($config);
		
		if($this->upload->do_upload()){
			
			$upload_data    	= $this->upload->data();
			
			return $upload_data['file_name'];
			
		}else{
			
			$this->form_validation->set_message('ad_video', $this->upload->display_errors());
			
      		return FALSE;
			
			
		}
				
	}
	
	
	function isCountrySelect(){
		
		$country = $_POST['country'];
		
		if(count($country) < 1)
   		{
      		$this->form_validation->set_message('isCountrySelect', 'Select Country');
			
      		return FALSE;
   		}
		return TRUE;
	
	}
	
	function do_like_ads($id = NULL){
		
		$ads 	= $this -> Ads_model -> getAdById($id);
	
		$isAdsLike 	= $this -> Ads_model -> isAdsLike($id);
		
		if(isset($ads[0]) && $isAdsLike==false){
				
			$this -> adsLikeAdd($ads);
			
			$this -> like_html($id);
								
		}else{ // ads if end
		
			echo 'Invalid Request';
			
		}
		
	}
	
	
	function like_html($id = NULL){
		
		$totalLikes = $this -> Ads_model -> getAdTotalLike($id);
		
		$html = '<span><a href="#" class="post-add-icon inline-items" id="ads_liked"><i class="fa fa-heart"></i> </a></span>
		
		<span><a style="color:#888da8;" href="">'.$totalLikes.' Like</a>
		
		</span>';
		
		
		$data = array(
		
		 'html' => $html
		
		);
		
	    
		echo json_encode($data);
		
		exit;
		
	}
	
	
	private function adsLikeAdd($ads){
			
			$user 	= $this -> Ads_model -> getMemberLikesSummary(user_session('usercode'));
		
			$data = array();
			
			$data['ads_code'] 	= 	$ads[0]['id'];
			
			$data['post_id'] 	= 	$ads[0]['post_id'];
			
			$data['is_ads']		=  '1';
			
			$data['usercode'] 	= 	user_session('usercode');
			
			$data['time_dt'] 	= 	time();
			
			$data['is_pay'] = ($user['balance'] > 0) ? '1' : '0';
			
			$this->comman_fun->addItem($data,'social_likes');
		
		
		
			$this->Ads_model->updateLikes($ads[0]['id']);
			
			
			
			if($user['balance'] > 0){
			
				$this->adsPayment($ads[0]['id']);	
			
			}
		
	}
	
	
	private function adsPayment($ads_code = NULL){
	
		$data = array(
		
		'usercode' 	=> user_session('usercode'),
		
		'ads_code' 	=> $ads_code,
		
		'amount' 	=>  0.02,
		
		'wallet_type' => 'ads_like',
		
		'wallet' 	=> 'USD',
		
		'type_dt' => 'Like',
		
		'time_dt' 	=> time()
		
		);
	
		$this->comman_fun->addItem($data,'m_income');
	
	}	
	
}

