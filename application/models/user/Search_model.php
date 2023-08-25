<?php
Class Search_model extends CI_Model{
	

	function find_member($filter_by, $start_from = 0, $limit = 4){
	
		$filter_by = 	strtolower(preg_replace('/\s\s+/', ' ',$filter_by));
				
		$sWhere.=' WHERE m.status="Active" AND m.usercode !="'.user_session('usercode').'" ';
		
		if(isset($filter_by) and $filter_by!=''){
			
			
			$sWhere.=' AND (LOWER(fullname) LIKE "%'.$this->db->escape_like_str($filter_by).'%")';	
			
		}
		
		
		$sQuery='SELECT CONCAT(m.fname," ",m.lname) as name, m.username, m.usercode, m.profile_img
		
		FROM membermaster as m
		
		'.$sWhere.'
		
		LIMIT '.$start_from.' , '.$limit.'
		
		';
	
	
		$query = $this->db->query($sQuery);
		
		$the_content = $query->result_array();
		

		
		for($i=0;$i<count($the_content);$i++){
			
			$friend 		=  $this->Member_module->Checkfriendstatus($the_content[$i]['usercode']);
			
			$mutual_friends =  $this->Member_module->mutual_friends($the_content[$i]['usercode']);
			
			$the_content[$i]['mutual_friends'] =  count($mutual_friends);
			
			$the_content[$i]['friend'] =  $friend[0];
			
		}
		
		return $the_content;
	
	}
	
	function filterSearchBoxInput($filter){
			
		//$sWhere.=' AND (LOWER(fname) LIKE "%'.$filter[0].'%" OR LOWER(lname)  LIKE "%'.$filter[0].'%")';	
			
			$sWhere.=' AND (LOWER(fullname) LIKE "%'.$this->db->escape_like_str($filter).'%")';	
				
			$sQuery='SELECT CONCAT(fname," ",lname) as name, usercode as id, mobileno as type FROM membermaster WHERE status = "Active" '.$sWhere.' 
			
			UNION
			
			SELECT title as name ,id, type FROM social_page_group WHERE status = "Active" AND title LIKE "%'.$this->db->escape_like_str($filter).'%"
			
			ORDER BY name ASC LIMIT 10';	
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			return $the_content;
			
			
	}
	
	function filter_page($filter_by, $start_from = 0, $limit = 4){
			
			$filter = 	strtolower(preg_replace('/\s\s+/', ' ',$filter_by));
			
			$where = '';
			
			if(isset($_GET['category'])){
				
				$where = ' AND category = '.$this->db->escape($this->input->get('category'));
				
			}
			
			
			
			$sQuery = 'SELECT pg.*, pgm.pg_code, c.cat_name
			
			FROM social_page_group as pg
			
			LEFT JOIN social_page_group_member as pgm ON pgm.pg_code  = pg.id AND pgm.usercode = "'.user_session('usercode').'"
			
			LEFT JOIN sm_page_category as c ON c.id  = pg.category
			
			WHERE pg.status = "Active" AND LOWER(pg.title) LIKE "%'.$this->db->escape_like_str($filter).'%" AND pg.type = "page" '.$where.'
			
			ORDER BY pg.title DESC  LIMIT '.$start_from.' , '.$limit.'';	
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			return $the_content;
			
	}
	
	function filter_group($filter_by, $start_from = 0, $limit = 4){
			
			$filter = 	strtolower(preg_replace('/\s\s+/', ' ',$filter_by));
			
			$where = '';
			
			if(isset($_GET['category']))
			{
				if($_GET['category']=='public')
				{
					$where = " AND  pg.group_privacy = 'Public'";
				}
				if($_GET['category']=='close')
				{
					$where = " AND  pg.group_privacy = 'Closed'";
				}
					if($_GET['category']=='me')
				{
					$where = " AND  pg.uid = '".user_session('usercode')."'";
				}
				
				
			}
			
			
			
			$sQuery = 'SELECT pg.*, pgm.pg_code, pgm.status as join_status
			
			FROM social_page_group as pg
			
			LEFT JOIN social_page_group_member as pgm ON pgm.pg_code  = pg.id AND pgm.usercode = "'.user_session('usercode').'"
			
			WHERE pg.status = "Active" AND LOWER(pg.title) LIKE "%'.$this->db->escape_like_str($filter).'%" AND pg.type = "group" '.$where.'
			
			ORDER BY pg.title DESC  LIMIT '.$start_from.' , '.$limit.'';	
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			return $the_content;
			
	}
	
	
	
	function find_friend($filter_by, $start_from = 0, $limit = 20){
	
		$filter_by = 	strtolower(preg_replace('/\s\s+/', ' ',$filter_by));
				
		$sWhere.=' WHERE m.status="Active" AND m.usercode !="'.user_session('usercode').'" AND f.usercode = "'.user_session('usercode').'"';
		
		if(isset($filter_by) and $filter_by!=''){
			
			$sWhere.=' AND (LOWER(fullname) LIKE "%'.$this->db->escape_like_str($filter_by).'%")';	
		}
		
		$sQuery='SELECT CONCAT(m.fname," ",m.lname) as name, m.username, m.usercode, m.profile_img
		
		FROM social_friends_detail as f
		
		LEFT JOIN membermaster as m ON m.usercode = f.friend
		
		'.$sWhere.'
		
		LIMIT '.$start_from.' , '.$limit.'
		
		';
	
	
		$query = $this->db->query($sQuery);
		
		$the_content = $query->result_array();
		
		return $the_content;
	
	}
	
			
}
?>
