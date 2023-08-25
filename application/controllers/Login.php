<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	 //Member_model
	 
	 function __construct(){
		
		header('X-Frame-Options: DENY');
		 
   		parent::__construct(); 
		
		$this->load->model('Member_model');
		
	//	$this->load->model('Email_model');
		
		$this->load->helper('security');
		
		$this->load->library('bcrypt'); //password security
		
		
		
 	}
	 
	function view($arr=NULL){
		
		$this->index($arr);
		
	}
	
	public function index($arr=NULL){  
		
		$this -> is_block_login();
		
		$this -> check_login();
		
		$data['show_msg']=$arr['msg'];
		
		$this->load->view('page/login',$data);
	
	}
	
	public function index2(){  
			
		$this->load->view('page/login2');
	
	}
	
	function check(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('username','Username', 'required|trim|xss_clean',
			
			array('xss_clean' => 'Error Message: your xss is not clean.')
			
			);
			
			$this->form_validation->set_rules('password','Password', 'required|trim|xss_clean',
			
			array('xss_clean' => 'Error Message: your xss is not clean.')
			
			);	
			
			
			
			
			
			if ($this->form_validation->run() === FALSE){
				
				//$this->session->set_flashdata('show_msg', 'Invaild Username And Password');
				
				//$arr['msg']='Invalid Username and Password';
				
				$this->view($arr);
			}
			else{	
			
				if(!$this->_check()){
					
					$arr['msg']='Invalid Username and Password';
					
					$this->view($arr);
					
				}
			}
			
		}else{
			
			$this->view();
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	protected function _check(){
		
		$result	 =	$this -> Member_model -> check_login();
	
		//==================record Found Check==================//
		if(!isset($result[0])){
			
			$this->login_record(0,$this->input->post('username'), $this->input->post('password'), 0);
			
			$this->loginTryInvalid($result);
			
			return false;
			
		}
		
		
		//==================password varification==================//
		
		if(!pass_decrypt_chk($this->input->post('password'),$result[0]['password'])){
			
			$this->login_record(0,$this->input->post('username'), $this->input->post('password'), $result[0]['usercode']);
			
			$this->loginTryInvalidPassword($result);
			
			return false;
			
		}else{
		
			//==================Check lock Account==================//
			
			if($result[0]['is_account_lock']=='1'){
		
				$this->is_lock_account($result);	
		
			}
			
		}
		
			
		//**true if account is block**//
		
		if($this->comman_fun->check_record('membermaster',array('usercode'=>$result[0]['usercode'],'is_block'=>'1'))){
			
			header('Location: '.file_path().'login/block/'.$result[0]['username']);
			
			exit;	
				
		}
		
		//**check Email Verified**//
		$this->is_email_verified($result);
		
		
		//**Two Factor Authentication**//
		
		$this->is_authentication_requried($result);
		
		
		//**Process To Login
		$this->_process_login($result[0]['usercode']);
		
	}
	
	
	private function fail_login(){
		
		$username = $this->input->post('username');
		
	}
	
	
	
	
	
	
	private function is_authentication_requried($result){
		//**Two Factor Authentication BY Googel**//
		if($this->comman_fun->check_record('two_factor_authentication',array('usercode'=>$result[0]['usercode']))){
			$info						=	array();
			$info['usercode']			=	$result[0]['usercode'];
			$info['status']				=	'true';
			$info['google']				=	'true';
			$this->session->set_userdata('smr_2fa', $info);
			header('Location: '.file_path().'login/authentication/');
			exit;		
		}
		$authentication = false;
		if($this->comman_fun->check_record('authentication',array('usercode'=>$result[0]['usercode']))){
			$authentication=false;
		}
		if($result[0]['usercode']=='1'){
			$authentication=false;
		}
		
		if($authentication==true){
			$verification_code = $this->Email_model->twofa_email($result[0]['usercode']);
			$info						=	array();
			$info['usercode']			=	$result[0]['usercode'];
			$info['status']				=	'true';
			$info['verification_code']	=	$verification_code;
			$info['count']	=	0;
			$this->session->set_userdata('smr_2fa', $info);
			header('Location: '.file_path().'login/authentication/');
			exit;	
		}
	}
	
	/////
	
	function authentication(){
		if($this->session->userdata['smr_2fa']){
			$this->load->view('page/2fa_authentication',$data);
		}else{
			$this->back();
		}	
	}
	
	
	
	
	function authentication_submit(){
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			if($this->session->userdata['smr_2fa']['google']=='true'){
			
				$this->form_validation->set_rules('verification_code','Verification Code', 'required|callback_check_google_authentication_code');	
			
			}
			else{
			
				$this->form_validation->set_rules('verification_code','Verification Code', 'required|callback_check_authentication_code');
			
			}
			
			if ($this->form_validation->run() === FALSE){
				
				$this->authentication();
				
			}
			else{	
		
				$this->_process_login($this->session->userdata['smr_2fa']['usercode']);
			
				exit;
			}
			
		}else{
		
			$this->authentication();
		
		}
	}
	
	private function is_email_verified($result){
	
			if($result[0]['email_verify']!='Y'){
			
				$sess_array=array();
				
				$sess_array['status']	=	true;
				
				$sess_array['usercode']	=	$result[0]['usercode'];
				
				$this->session->set_userdata('smr_email_verify', $sess_array);
				
				header('Location: '.file_path().'login/email_verify/');
				
				exit;	
			
			}
	
	}
	
	
	private function is_lock_account($result){
		
		$verification_code  =  $this->Email_model->unlock_account_link_send($result[0]['usercode']);
		
		$data = array('verification_code'  => $verification_code);
		
		$this->comman_fun->update($data,'email_verification',array('verification_code'=>$result[0]['usercode']));
		
		
		$sess_array=array();
			
		$sess_array['status']	=	true;
				
		$this->session->set_userdata('smr_lock_account', $sess_array);
			
		header('Location: '.file_path('login/lock_account/'));
			
		exit;	
			
	}
	
	
	function lock_account(){
		
		if($this->session->userdata['smr_lock_account']){
			
			$data['title']	=	'Account Locked';
			
			$data['msg']=	'<p style="text-align:left;">Your Account is locked!!!  <br><br>Check Your Email Account to Unlock Your Account</p>';
			
			$this->load->view('page/comman_msg',$data);
			
			
		}else{
			
			$this->back();
			
		}
	}
	
	
	
	
	
	
	private function _process_login($member_id){
			
			$result = $this->comman_fun->get_table_data('membermaster',array('usercode'=>$member_id));
			
			//***destroy session***//
			
			$this->session->set_userdata('smr_2fa',false);
			
			$sess_array						=	array();
				
			$sess_array['name']				=	$result[0]['fname'].' '.$result[0]['lname'];
				
			$sess_array['usercode']			=	$result[0]['usercode'];
				
			$sess_array['username']			=	$result[0]['username'];
				
			$sess_array['ref']				=	$result[0]['referralid'];
				
			$sess_array['emailid']			 =	$result[0]['emailid'];
			
			$sess_array['ref_key']			 =	$result[0]['ref_key'];
			
			$sess_array['is_paid']			 =	$this->Member_model->is_paid($result[0]['usercode']);
			
			$sess_array['next_payment']		 =	$result[0]['upgrade_payment_dt'];
			
			$isProfileComplated 			 = 	$this->isProfileComplated($result[0]);
			
			$sess_array['isProfileComplate'] =	$isProfileComplated;
			
			
			
			if($result[0]['profile_img']!=''){
				
				
				
				$profile_img= base_url().'upload/post/'.$result[0]['profile_img'];
				
				 if ($profile_img) {
					
					 $sess_array['profile_pic']	=	$result[0]['profile_img'];
					 
				 }else{
					 
					 $sess_array['profile_pic']	=	'profile.png';		
					 
				 }
				
				
			}else{
				
				$sess_array['profile_pic']	=	'profile.png';		
				
			}
				
				
			$sess_array['login']		=	'true';
				
			
			$sess_array['login_code']	=	$this->login_record(1,$result[0]['username'],'true_password',$result[0]['usercode']);
		
				
			$this->session->set_userdata('smr_web_login', $sess_array);
			
				
			if($this->Member_model->check_admin($result[0]['usercode'])){
				
				$info				=	array();
				
				$info['login']		=	'true';
				
				$info['admin']		=	'true';
				
				$this->session->set_userdata('smr_web_login_admin',$info);
				
				
				$info					=	array();
				
				$info['login']			=	true;
				
				$info['admin_code']		=	$result[0]['usercode'];
				
				$this->session->set_userdata('smr_superadmin',$info);
				
				header('Location: '.file_path('dashboard/view/'));
				
				exit;
				
			}
			
			header('Location: '.file_path('dashboard/view/'));
				
			exit;	
		
	}
	
	
	
	private function isProfileComplated($result){
		
		if($result['country']=='0' || $result['dob']=='0000-00-00')	{
			
			return false;
			
		}else{
			
			return true;
			
		}
		
	}
	
	//=====Email 2fa code check=====
	function check_authentication_code(){
		
		
		if($this->input->post('verification_code')!=$this->session->userdata['smr_2fa']['verification_code']){
			
			$this->form_validation->set_message('check_authentication_code', 'Invalid Code');
			
			$sess_login_verification = $this->session->userdata['smr_2fa'];
			
			$sess_login_verification['count']++;	
					
			$this->session->set_userdata('smr_2fa', $sess_login_verification);  
			
      		return false;
			
		}else{
		
			return true;
			
		}
		
		
	}
	
	
	
	function check_google_authentication_code(){
		
		require_once APPPATH .'third_party/google_2fa/autoload.php';
		
		$authenticator = new PHPGangsta_GoogleAuthenticator();
		
		$result = $this->comman_fun->get_table_data('two_factor_authentication',array('usercode'=>$this->session->userdata['smr_2fa']['usercode']));
		
		$secret 	=  $result[0]['code'];
		
		$otp 		=  $_POST['verification_code'];
		
		$tolerance 	=  8;
		
		$checkResult = $authenticator->verifyCode($secret, $otp, $tolerance); 
		
		if ($checkResult) {
		
			return true;
		
		}else {
		
		$this->form_validation->set_message('check_google_authentication_code', 'Error ! Your code is invalid. ');
		
			return false;
		
		}
	
	}
	

	//**check login**//
	protected function check_login(){
		
		if($this->session->userdata('smr_web_login_admin')){
				
			header('Location: '.file_path('dashboard/view/'));
			
			exit;
		}
			
		if($this->session->userdata('smr_web_login')){
			//header('Location: '.file_path('user').'dashboard/view/');
			
			header('Location: '.file_path('dashboard/view/'));
			
			exit;		
		}		
	}
	
	
	
	
	
	protected function login_record($type = 0, $username="", $password = "", $usercode = 0){
		
		$now = time();
		
		$data['username']		=	$username;
		
		$data['password']		=	$password;
		
		$data['timedt']			=	date('Y-m-d H:i:s');
		
		$data['status']			=	$type;
		
		$data['usercode']			=	$usercode;	
		
		if($type == '1'){
		
			$data['availeble']			=	'Y';
			
			$data['last_event']			=	time();
			
		}else{
			
			$data['availeble']			=	'N';
			
		}
		
		$data['logintime']				=	time();
		
		$data['ip']						=	get_user_ip();
		
		$data['browserdt']				=	$_SERVER["HTTP_USER_AGENT"];
		
		$login_code						=	$this->comman_fun->addItem($data,'web_login_info');	
		
		$data = false;
		
		return $login_code;
	}
	
	
	
	
	function logout(){
	
		$now = time();
	
		$data['availeble']		=	'N';
		
		$data['logout_time']	=	date('Y-m-d H:i:s');
		
		$this->comman_fun->update($data,'web_login_info','login_code',$this->session->userdata['smr_web_login']['login_code']);	
		
		$data = false;
		
		$user_data = $this->session->all_userdata();
		
		foreach ($user_data as $key => $value) {
		
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
			
				$this->session->unset_userdata($key);
			
			}
		
		}
		
		$user_data = $this->session->all_userdata();
			
		$this->session->sess_destroy();
	
		header('Location: '.file_path('login'));
		
		exit;
    }
	
	
	
	
	
	function email_verify()
	{
		if($this->session->userdata['smr_email_verify']){
			
			
			$result	 =	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['smr_email_verify']['usercode']));
			
			$data['title']=	'Email Verification Pending';
			
			//$data['msg']=	'<p style="text-align:left;">Hi, '.$result[0]['fname'].' '.$result[0]['lname'].' <br> your email address is not Verify please login your email address and verify <br> if you not reacive varification link click below link</p>';
			
			$data['msg']=	'<p style="text-align:left;">Please check and verify your Email Address to login into your Account.</p>';
			
			$data['msg'].=	'<p><a class="txt_red" href="'.file_path().'user/email_verification/send_varification">Send Verification Email Again</a></p>';
		
			$this->load->view('page/comman_msg',$data);
			
			
		}else{
			
			$this->back();
			
		}
	}
	
	
	function back(){
		
		header('Location: '.file_path('user/login'));
		
		exit;
		
	}
	
	
	function block($username){
	
		$result 		= $this->comman_fun->get_table_data('membermaster',array('username'=>$username));
		
		$admin_result   = $this->comman_fun->get_table_data('membermaster',array('username'=>'admin'));
		
		if($this->comman_fun->check_record('membermaster',array('usercode'=>$result[0]['usercode'],'status'=>'Active'))){
		
			$data['text']	= '<h4>Hello, '.$result[0]['fname'].' '.$result[0]['lname'].'</h4>
			
			<p>Sorry for the inconvenience. Your account has been blocked for a reason. Please contact the Admin for further details.</p>
			
			<p>Thank you</p>
			
			<p>Admin Email : <a href="mailto:Moderator@Vitae.Co" target="_top">Moderator@Vitae.Co</a></p>';
			
			$this->load->view('page/block_page',$data);
			//<p>Admin Email : <a href="mailto:'.$admin_result[0]['emailid'].'" target="_top">'.$admin_result[0]['emailid'].'</a></p>';
		}else{
		
			header('Location: '.base_url().'');
			
			exit;
		
		}
	
	}
	
	//google captcha testing for localhost
	//Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
	//Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
	
	
	function check_google_validate_captcha() {
		
		$google_captcha = $this->input->post('g-recaptcha-response');
		
		$google_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf1An4UAAAAAOeHGxXqwBK6gX47tWv7uh_9FANq&response=" . $google_captcha . "&remoteip=" . get_user_ip());
		
		if ($google_response . 'success' == false) {
			
			$this->form_validation->set_message('check_google_validate_captcha', 'Please check the the captcha form');
			
			return FALSE;
			
		} else {
			
			return TRUE;
		}
	}
	
	
	
	
	
	
	
	private function loginTryInvalidPassword($result){
		
		$this->load->model('Comman_model');
		
		$invalid = $this->Comman_model->loginTryInvalidPassword($result[0]['usercode']);	
		
		if($invalid == 5){
			
			$verification_code  =  $this->Email_model->loginTryInvalidPassword($result[0]['usercode']);
			
			$data = array(
	
				'is_account_lock' => '1',
				
				'verification_code' => $verification_code
			
			);
		
			$this->comman_fun->update($data,'membermaster',array('usercode'=>$result[0]['usercode']));
			
			$data = false;
			
			$this->comman_fun->update(array('invaild_password_clear'=>'1'),'web_login_info',array('usercode'=>$result[0]['usercode']));
			
				
		}
		
		$this->loginTryInvalid();
	
	}
	
	
	function loginTryInvalid(){
		
		$this->load->model('Comman_model');
	
		$invalid = $this->Comman_model->loginTryInvalid($result[0]['usercode']);	
		
		if($invalid > 9){
			
			$data = array(
			
				'ip' => get_user_ip(),
				
				'unlock_time' => time() + (60 * 60 * 24)
			
			);
			
			$this->comman_fun->addItem(filter_data($data),'ip_lock');
			
			$data = false;
			
			$this->comman_fun->update(array('invaild_login_clear'=>'1'),'web_login_info',array('ip'=>get_user_ip()));
			
			header('Location: '.file_path('user/login/block_login'));
				
			exit;		
		
		}
	
	}
	
	
	private function is_block_login(){
		
		$this->load->model('Comman_model');
		
		$is_block = $this->comman_fun->check_record('ip_lock',array('ip'=>get_user_ip(),'unlock_time >'=>time()));
		
		if($is_block){
			
			header('Location: '.file_path('user/login/block_login'));
			
			exit;	
			
		}
		
		
	
	}
	
	
	function block_login(){
	
		$this->load->model('Comman_model');
		
		if($this->comman_fun->check_record('ip_lock',array('ip'=>get_user_ip(),'unlock_time >'=>time()))){
		
			$data['title']=	'Login Page Blocked';
			
			$data['msg']=	'<p style="text-align:left;">You have Exceeded the Maximum Number of Login Attempts Allowed. You won\'t be able to login for the next 24 Hours.</p>';
			
			$this->load->view('page/comman_msg',$data);
		
		}else{
			
			header('Location: '.file_path('user/login'));
			
			exit;	
		}
	
	}
	
	
	function unlock_account($key){
		
		$this->load->model('Comman_model');
		
		if($key!=NULL){
		
			$result = $this->comman_fun->get_table_data('membermaster',array('verification_code'=>filter_data($key)));
			
			///$result = $this->Member_model->get_member_by_id(170);
			
			//var_dump($result);
			
			if(isset($result[0])){
			
				$data = array(
				
					'is_account_lock' => '0',
					
					'verification_code' => ''
				
				);
				
				$this->comman_fun->update($data,'membermaster',array('usercode'=>$result[0]['usercode']));
				
				$data = false;
				
				$this->comman_fun->update(array('invaild_password_clear'=>'1'),'web_login_info',array('usercode'=>$result[0]['usercode']));
			
				header('Location: '.file_path('user/login/index'));
				
				exit;	
			
			}
		
		}
		
		echo 'Invalid Request';
		
	}
	
}
