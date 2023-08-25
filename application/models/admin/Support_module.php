<?php
Class Support_module extends CI_Model
{
	
		function get_list_all($type)
 		{	
			$aColumns = array( 'support_master.support_code','support_master.usercode','membermaster.fname','support_master.msg','support_master.create_date','tsupport_master.create_date');
		
   			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
			}
		
		
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
						$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".$_GET['sSortDir_'.$i] .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" ){
					$sOrder = "";
				}
			}
		
			$sWhere = "";
			if ( $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE";
				$filter = 	preg_replace('/\s\s+/', ' ',$_GET['sSearch']);
				$filter	=	explode(" ",$filter);
				if(isset($filter[1]))
				{
					$sWhere.='(membermaster.fname="'.$this->db->escape($filter[0]).'" and membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[1]).'%")';
				}
				else
				{
					if (ctype_digit($filter[0]))
					{
						$sWhere.='(membermaster.usercode="'.$filter[0].'")';
					}
					else
					{
						$sWhere.='(membermaster.fname  LIKE "%'.$this->db->escape_like_str($filter[0]).'%" or membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[0]).'%" or membermaster.username LIKE "%'.$this->db->escape_like_str($filter[0]).'%")';
					}	
				}
			}
			
			if($type=='active'){
				$where2 = " AND support_master.status = 'Active'";
			}
			
			if($type=='close'){
				$where2 = " AND support_master.status = 'Close'";
			}
			
			if($type=='replied'){
				$where2 = " AND support_master.reply_status = '1'";
			}
			if($type=='un_replied'){
				$where2 = " AND support_master.reply_status = '0'";
			}
			
		
			if($sWhere==""){
				$sWhere = "WHERE support_master.status != 'Delete' ".$where2;
			}else{
				$sWhere.= "AND support_master.status != 'Delete' ".$where2;
			}
			
			
			
			$sQuery='SELECT support_master.*, 
			COUNT(support_detail.support_code) as rpy,
			CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username
			FROM support_master 
			LEFT JOIN support_detail ON support_detail.support_code = support_master.support_code AND support_detail.type="M" AND support_detail.unread="0"
			LEFT JOIN membermaster ON membermaster.usercode = support_master.usercode
			'.$sWhere.'
			GROUP BY support_master.support_code 
			'.$sOrder.'
			'.$sLimit.'';
			
			$query = $this->db->query($sQuery);
			$the_content = $query->result_array();
			
			$return['where']	=	$sWhere;
			$return['result']	=	$the_content;
			
			return $return;
 		}
		
		function count_record_all($where){
			$sQuery='SELECT count(*) as tot FROM support_master LEFT JOIN membermaster ON membermaster.usercode = support_master.usercode '.$where.'';
			$query = $this->db->query($sQuery);
			$the_content = $query->result_array();
		  	return $the_content;
		}
		
		function active_ticket_by_code($eid){

			$this -> db -> select('support_master.*');
			$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name, membermaster.username');
			$this -> db -> join('membermaster','support_master.usercode = membermaster.usercode','left');
			$this -> db -> from('support_master');
			$this -> db -> where('support_master.support_code',''.$eid.'');
			$this -> db -> where('support_master.status !=','Delete');
			$query 		=	 $this -> db -> get();
			$the_content = $query->result_array();
			return $the_content;	
		}
		function conversion_history($eid){
			$this -> db -> select('*');
			$this -> db -> from('support_detail');
			$this -> db -> where('support_code',''.$eid.'');
			$this -> db -> where('status','Active');
			$this -> db -> order_by('id','ASC');
			$query 		=	 $this -> db -> get();
			$the_content = $query->result_array();
			return $the_content;	
		}
		
		
		
		
	
	
}
?>
