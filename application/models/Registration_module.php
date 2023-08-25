<?php
Class registration_module extends CI_Model
{
	
	function get_user($eid)
 	{	
   		$this -> db -> select('*');
		$this -> db -> from('membermaster');
		$this -> db -> where('username',''.$eid.'');
		$this -> db -> where('status !=','Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;
 	}
	
	function check_ref($eid){
		$this -> db -> select('membermaster.*');
		$this -> db -> from('membermaster');
		$this -> db -> where('membermaster.username',''.$eid.'');
		$this -> db -> where('membermaster.status !=','Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function check_ref_by_key($eid){
		$this -> db -> select('membermaster.*');
		$this -> db -> from('membermaster');
		$this -> db -> where('membermaster.ref_key',''.$eid.'');
		$this -> db -> where('membermaster.status !=','Delete');
    	$query = $this -> db -> get();
    	$the_content = $query->result_array();
    	return $the_content;	
	}
	
	function addItem($data,$table){
    	$this->db->insert($table , $data);
    	return $this->db->insert_id();
	}
	
	function update($data,$table,$wherefield,$wherevalue){
		$this->db->where($wherefield, $wherevalue);
		$this->db->update($table, $data); 
	}
}
?>
