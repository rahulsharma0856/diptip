<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends App {

	function __construct()
 	{
   		parent::__construct(); 
		

		
		$this->load->model('user/Page_model','',TRUE);
		
		$this->load->model('user/Post_model','',TRUE);
		
		$this->load->model('user/Search_model');
		
		$this->load->model('Member_module');
		
		$this->load->library('image_lib');
		
		$this->load->library('upload');
   		
 	}
	
	
	public function top(){  
		
		if(isset($_GET['q'])){
			
		    $filter = filter_text(utf8_decode(urldecode($_GET['q'])));
			
			$data['filter_text'] = $filter;
			
			$data['friend'] = $this->filter_member_get($filter, 0, 3);
			
			$data['page'] = $this->filter_page_get($filter, 0, 3);
			
			$data['group'] = $this->filter_group_get($filter, 0, 3);
			
			
			
		}
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header');	
		
		$this->load->view('user/search/all',$data);	
		
		$this->load->view('user/home/comman/footer');	
		
	}
	
	
	public function people(){  
		
	    $filter = filter_text(utf8_decode(urldecode($_GET['q'])));
			
		$data['filter_text'] = $filter;
		
		$data['active_sub_menu'] = 'people';
		
		$header = array(
		
			'serach_form_url' => file_path('search/group')
			
		);
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header',$header);	
		
		$this->load->view('user/search/people',$data);	
		
		$this->load->view('user/home/comman/footer');	
		
	}
	
	public function page(){  
		
	    $filter = filter_text(utf8_decode(urldecode($_GET['q'])));
		
		if(isset($_GET['category'])){
			
			$data['category_selected'] = utf8_decode(urldecode($_GET['category']));
			
		}
		
		
		
		$data['filter_text'] = $filter;
		
		$data['active_sub_menu'] = 'page';
		
		$header = array(
		
			'serach_form_url' => file_path('search/page')
			
		);
		
		$data['category'] 		= 	$this->comman_fun->get_table_data('sm_page_category',array('status'=>'Active'));
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header',$header);	
		
		$this->load->view('user/search/page',$data);	
		
		$this->load->view('user/home/comman/footer');	
		
	}
	
	
	public function group(){  
		
	    $filter = filter_text(utf8_decode(urldecode($_GET['q'])));
			
		$data['filter_text'] = $filter;
		
		$data['active_sub_menu'] = 'group';
		
		$header = array(
		
			'serach_form_url' => file_path('search/group')
			
		);
		
		$data['category_selected'] = $_GET['category'];
		
		
		$this->load->view('user/home/comman/topheader');	
		
		$this->load->view('user/home/comman/header',$header);	
		
		$this->load->view('user/search/group',$data);	
		
		$this->load->view('user/home/comman/footer');	
		
	}
	
	
	function filter_member_get($filter_by, $start_from=0, $limit = 3){
	
		$result     	=  $this->Search_model->find_member($filter_by, $start_from, $limit);	
	
		for($i=0;$i<count($result);$i++){
		
			$html .= $this->load->view('user/search/friend_html',array('result'=>$result[$i]),true);
		
		}
		
		return array(
		
			'count' => count($result),
			
			'html' => $html
			
		);
		
	
	}
	
	
	function filter_page_get($filter_by, $start_from=0, $limit = 3){
	
		$result     	=  $this->Search_model->filter_page($filter_by, $start_from, $limit);	
		
		for($i=0;$i<count($result);$i++){
		
			$html .= $this->load->view('user/search/page_html',array('result'=>$result[$i]),true);
		
		}
		
		return array(
		
			'count' => count($result),
			
			'html' => $html
			
		);
		
	}
	
	
	function filter_group_get($filter_by, $start_from=0, $limit = 3){
		
		$result     	=  $this->Search_model->filter_group($filter_by, $start_from, $limit);	
	
		for($i=0;$i<count($result);$i++){
		
			$html .= $this->load->view('user/search/group_html',array('result'=>$result[$i]),true);
		
		}
		
		return array(
		
			'count' => count($result),
			
			'html' => $html
			
		);
		
	
	}
	
	
	function load_more_people(){
		
	    $filter = filter_text((urldecode($_GET['q'])));
		
		$limit  = (int)utf8_decode(urldecode($_GET['limit']));
		
		$start  = (int)utf8_decode(urldecode($_GET['start']));	
		
		$result = $this->filter_member_get($filter, $start, $limit);
		
		echo json_encode(
		
			$result
			
		);
		
		exit;
			
	}
	
	
	function load_more_page(){
		
	    $filter = filter_text(utf8_decode(urldecode($_GET['q'])));
		
		$limit  = (int)utf8_decode(urldecode($_GET['limit']));
		
		$start  = (int)utf8_decode(urldecode($_GET['start']));	
		
		$result = $this->filter_page_get($filter, $start, $limit);
		
		echo json_encode(
		
			$result
			
		);
		
		exit;
		
	}
	
	
	
	function load_more_group(){
		
	    $filter = filter_text(utf8_decode(urldecode($_GET['q'])));
		
		$limit  = (int)utf8_decode(urldecode($_GET['limit']));
		
		$start  = (int)utf8_decode(urldecode($_GET['start']));	
		
		$result = $this->filter_group_get($filter, $start, $limit);
		
		echo json_encode(
		
			$result
			
		);
		
		exit;
		
	}
	
}


