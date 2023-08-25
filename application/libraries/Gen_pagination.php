<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Gen_pagination {

	
 	
	function get_link($arr){
		$CI =& get_instance();
		$CI->load->library('pagination');
	
		$config = array();
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
		$config["base_url"] = $arr['url'];
		$config["total_rows"] = $arr['total'];
		$config["per_page"] =  (isset($arr['per_page'])) ? $arr['per_page'] : RECORD_PER_PAGE ; 
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = SHOW_PAGE;
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</li>';
		$config['prev_link'] = 'prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config["uri_segment"] = (isset($arr['uri_segment'])) ? $arr['uri_segment'] : 3 ; 
		$config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		$CI->pagination->initialize($config);
		$str_links = $CI->pagination->create_links();
		return $str_links;
		
	}
	
	function get_link2($arr){
		$CI =& get_instance();
		$CI->load->library('pagination');
	
		$config = array();
		$config['full_tag_open'] = '<ul class="pagination modal-1">';
        $config['full_tag_close'] = '</ul>';
		$config["base_url"] = $arr['url'];
		$config["total_rows"] = $arr['total'];
		$config["per_page"] =  (isset($arr['per_page'])) ? $arr['per_page'] : RECORD_PER_PAGE ; 
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = SHOW_PAGE;
		$config['cur_tag_open'] = '<li class="pi-active"><a>';
		$config['cur_tag_close'] = '</li>';
		$config['prev_link'] = 'prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config["uri_segment"] = (isset($arr['uri_segment'])) ? $arr['uri_segment'] : 3 ; 
		$config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		$CI->pagination->initialize($config);
		$str_links = $CI->pagination->create_links();
		return $str_links;
		
	}
	
	
	
	
	
	
	
	

	
	
}
