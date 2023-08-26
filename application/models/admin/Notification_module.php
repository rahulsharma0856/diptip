<?php
Class Notification_module extends App_model
{
	
	
	function message_listing($start_record){
		
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid',false);
		
		$this -> db -> select('message.*');
		
		$this -> db -> from('message');
		
		$this -> db -> join('membermaster','membermaster.usercode =  message.EndCode','left');
		
		$this -> db -> where('message.usercode','0');
		
		$this -> db -> where('message.status','Active');
		
		$this -> db -> order_by('message.id','DESC');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function count_all()
	{
		$this -> db -> select('COUNT(*) as tot');
		
    	$this->db->from('message');
		
		$this -> db -> join('membermaster','membermaster.usercode =  message.EndCode','left');
		
		$this -> db -> where('message.usercode','0');
		
		$this -> db -> where('message.status','Active');
		
		$this -> db -> order_by('message.id','DESC');
		
     	$query = $this -> db -> get();
		
		$the_content = $query->result_array();
		
    	return $the_content;
	}
		
}
?>
