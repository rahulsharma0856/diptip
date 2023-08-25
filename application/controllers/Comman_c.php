<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comman_c extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		$this->load->model('user/Search_model');
			
 	}
	
	
	function auto_camplate(){
		
		$filter_by = utf8_decode(urldecode($_GET['term']));
		
		$result     	=  $this->Search_model->filterSearchBoxInput($filter_by);
		
		$json=array();
		
		for($i=0; $i<count($result); $i++){
			
			if($result[$i]['type']=='group'){
				
				$icon = 'fa fa-users';
				
			}
			
			elseif($result[$i]['type']=='page'){
				
				$icon = 'fa fa-file-text';
				
			}else{
				
				$icon = 'fa fa-user';
				
			}
				
			$json[]=array(
			
				'label'	=>	$result[$i]['name'],
				
				'url'	=>	file_path('search/top').'?q='.$result[$i]['name'],
				
				'value'	=>	$result[$i]['name'],
				
				'icon' => $icon
				
        	);
		}
		
		echo json_encode($json);
		
	}
	

	
	
	
}


