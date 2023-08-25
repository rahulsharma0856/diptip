<?php
Class Image_Model extends CI_Model
{
	
		function __construct(){
			
				$this->load->library('image_lib');
		
				$this->load->library('upload');
				
		}
}
?>
