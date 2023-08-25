<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_user()){
			
			header('Location: '.file_path());
			
			exit;	
			
        }
	
		$this->load->model('Member_module','',TRUE);
		
		date_default_timezone_set('Asia/Calcutta'); 	
		
		
 	}
	
	function index(){
			
		$data['mode'] 			= 	'add' ;
	
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/upgrade',$data);	
		
		$this->load->view('user/home/comman/footer');
	
	}
	
	

}


