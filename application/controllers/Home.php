<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		
   		parent::__construct(); 
	
 	}
	public function index($eid='admin',$r=NULL){  
			
			
		$main_path = str_replace('/sm/index.php/','',file_path());
		
		header('Location: '.$main_path);
	
		exit;
			
		
	}
	
}


