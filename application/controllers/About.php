<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		
	}
	
	public function privacy()
	{
		$this->load->view('web/privacy',$data);	
		
		//if(!is_logged_user()){
		//			
		//			$this->load->view('web/privacy',$data);	
		//			
		//        }
		//		else
		//		{
		//				$this->load->view('user/home/comman/topheader');	
		//		
		//				$this->load->view('user/home/comman/header');	
		//				
		//				$this->load->view('user/privacy');	
		//				
		//				$this->load->view('user/home/comman/footer');
		//		}
		//		
	
	}
	
	public function terms()
	{
		
		$this->load->view('web/terms',$data);
				
		//		if(!is_logged_user()){
		//			
		//			$this->load->view('web/terms',$data);		
		//			
		//        }
		//		else
		//		{
		//			$this->load->view('user/home/comman/topheader');	
		//			
		//			$this->load->view('user/home/comman/header');	
		//			
		//			$this->load->view('user/terms');	
		//			
		//			$this->load->view('user/home/comman/footer');
		//		}
		
	}
	
	
	
	
	
}


