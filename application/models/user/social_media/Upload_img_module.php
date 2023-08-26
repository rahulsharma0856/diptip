<?php
Class Upload_img_module extends App_model
{
	
	
	function get_post($post_id){
		
		$this -> db -> select('*');
		
		$this -> db -> from('sm_post_master');
		
		$this -> db -> where('id',$post_id);
		
		$this -> db -> where('status','Active');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	
	
	
	
	
}
?>
