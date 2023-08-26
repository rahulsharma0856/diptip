<?php
Class Image_Model extends App_model
{
	
		function __construct(){
			
				$this->load->library('image_lib');
		
				$this->load->library('upload');
				
		}
}
?>
