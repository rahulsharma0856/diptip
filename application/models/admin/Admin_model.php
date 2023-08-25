<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Admin_model extends CI_Model
{
 	function Contain_getAll($eid)
 	{	
   		$this -> db -> select('web_contain.*');
		
   		$this -> db -> from('web_contain');
		
   		$this -> db -> where('web_contain.status !=', 'Delete');
		
		$this -> db -> where('web_contain.option_type', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
 	}
	
	function Contain_get_record($eid){
		
		$this -> db -> select('web_contain.*');
		
   		$this -> db -> from('web_contain');
		
   		$this -> db -> where('web_contain.status !=', 'Delete');
		
		$this -> db -> where('web_contain.code', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
	}
	
	function get_capture_page(){
		
			$this -> db -> select('capture_master.*');
		
			$this -> db -> select('capture_record.page_name as mst_page_name, capture_record.page_title as mst_page_title');
		
			$this -> db -> from('capture_master');
		
			$this -> db -> join('capture_record','capture_record.page_code = capture_master.master_page_code');
		
			$this -> db -> where('capture_master.status !=','Delete');
		
			$query 		=	 $this -> db -> get();
		
			$the_content = $query->result_array();
		
			return $the_content;	
		
	}
	
	
	function get_all_memes(){
		
		$this -> db -> select('*');
		
		$this -> db -> from('memes_gallery');
		
		$this -> db -> order_by('id','desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}	
	
	
	function upgrade_request(){
	
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid',false);
		
		$this -> db -> select('social_send_payment.*');
		
		$this -> db -> from('social_send_payment');
		
		$this -> db -> join('membermaster','membermaster.usercode =  social_send_payment.usercode','left');
		
		$this -> db -> join('downline_paid','downline_paid.usercode =  social_send_payment.usercode','left');
		
		$this -> db -> where('downline_paid.usercode IS NULL');
		
		$this -> db -> where('social_send_payment.status','Active');
		
		$this -> db -> order_by('social_send_payment.id','DESC');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
	
	}
	
	
	function ads_payment_upgrade_request(){
	
		$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid',false);
		
		$this -> db -> select('social_ads_payment.*');
		
		$this -> db -> from('social_ads_payment');
		
		$this -> db -> join('membermaster','membermaster.usercode =  social_ads_payment.usercode','left');
		
		$this -> db -> where('social_ads_payment.status','Active');
		
		$this -> db -> order_by('social_ads_payment.id','DESC');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;	
	
	}
	
	
	
	
	
		function get_list_all(){
				
			$aColumns = array( 'membermaster.usercode','membermaster.fname','membermaster.username','membermaster.mobileno','membermaster.emailid','membermaster.usercode','membermaster.usercode','membermaster.mobileno');
		
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
				
				if(isset($filter[1])){
					
					$sWhere.='(membermaster.fname='.$this->db->escape($filter[0]).' and membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[1]).'%")';
					
				}
				
				else
				{
					if (ctype_digit($filter[0]))
					{
						$sWhere.='(membermaster.usercode='.$this->db->escape($filter[0]).')';
					}
					else
					{
						$sWhere.='(membermaster.fname  LIKE "%'.$this->db->escape_like_str($filter[0]).'%" or membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[0]).'%" or membermaster.username LIKE "%'.$this->db->escape_like_str($filter[0]).'%")';
					}	
				}
			}
			
			
			
		
			$sQuery='SELECT downline_paid.id as paid, membermaster.*
			
			FROM membermaster 
			
			LEFT JOIN downline_paid ON membermaster.usercode = downline_paid.usercode 
			
			'.$sWhere.'
			
			'.$sOrder.'
			
			'.$sLimit.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			$return['where']	=	$sWhere;
			$return['result']	=	$the_content;
			
			return $return;
			
			
			
 		}
		
		function count_record_all($where){
			
			$sQuery='SELECT count(membermaster.usercode) as tot FROM membermaster '.$where.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
		  	return $the_content;
		}
	
	
	
		function get_withdrawal_list(){
		
			$this -> db -> select('m_withdrawal.*');
			
			$this -> db -> select('CONCAT(membermaster.fname," ",membermaster.lname) as name,membermaster.username,membermaster.emailid',false);
			
			$this -> db -> from('m_withdrawal');
			
			$this -> db -> join('membermaster','membermaster.usercode =  m_withdrawal.usercode','left');
			
			$this -> db -> where('m_withdrawal.status','Pendding');
			
			$this -> db -> order_by('m_withdrawal.withdrawal_code','DESC');
			
			$query 		=	 $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;	
		
		}
		
		
		
	
		
		
		
		
		function get_list_paid($status = NULL){
				
			$aColumns = array( 'membermaster.usercode','membermaster.fname','membermaster.username','membermaster.mobileno','membermaster.upgrade_payment_dt','membermaster.usercode','membermaster.usercode','membermaster.mobileno');
		
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
				
				if(isset($filter[1])){
					
					$sWhere.='(membermaster.fname="'.$filter[0].'" and membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[1]).'%")';
					
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
			
			if($status=='active'){
			
				if($sWhere==""){
				
					$sWhere = " WHERE membermaster.upgrade_payment_dt > ".strtotime(date('d-m-Y'))."";	
				
				}else{
				
					$sWhere = " AND membermaster.upgrade_payment_dt > ".strtotime(date('d-m-Y'))."";	
				
				}
			
			}
			
			elseif($status=='due'){
				
				if($sWhere==""){
				
					$sWhere = " WHERE membermaster.upgrade_payment_dt < ".strtotime(date('d-m-Y'))."";	
				
				}else{
				
					$sWhere = " AND membermaster.upgrade_payment_dt < ".strtotime(date('d-m-Y'))."";	
				
				}
			
			}
			
			
			
		
			$sQuery='SELECT downline_paid.id as paid, membermaster.*
			
			FROM downline_paid 
			
			LEFT JOIN membermaster ON membermaster.usercode = downline_paid.usercode 
			
			'.$sWhere.'
			
			'.$sOrder.'
			
			'.$sLimit.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			$return['where']	=	$sWhere;
			
			$return['result']	=	$the_content;
			
			return $return;
			
			
			
 		}
		
		function count_record_paid($where){
			
			$sQuery='SELECT count(downline_paid.id) as tot FROM downline_paid 
			
			LEFT JOIN membermaster ON membermaster.usercode = downline_paid.usercode
			
			'.$where.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
		  	return $the_content;
		}
		
		
		
		
		function get_list_free(){
				
			$aColumns = array( 'membermaster.usercode','membermaster.fname','membermaster.username','membermaster.mobileno','membermaster.upgrade_payment_dt','membermaster.usercode','membermaster.usercode','membermaster.mobileno');
		
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
				
				if(isset($filter[1])){
					
					$sWhere.='(membermaster.fname="'.$filter[0].'" and membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[1]).'%")';
					
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
			
			
			if($sWhere==""){
				
				$sWhere = " WHERE downline_paid.id IS NULL ";	
				
			}else{
				
				$sWhere = " AND downline_paid.id IS NULL ";	
				
			}
		
			$sQuery='SELECT downline_paid.id as paid, membermaster.*
			
			FROM membermaster 
			
			LEFT JOIN downline_paid ON membermaster.usercode = downline_paid.usercode 
			
			'.$sWhere.'
			
			'.$sOrder.'
			
			'.$sLimit.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			$return['where']	=	$sWhere;
			
			$return['result']	=	$the_content;
			
			return $return;
			
			
			
 		}
		
		function count_record_free($where){
			
			$sQuery='SELECT count(membermaster.usercode) as tot 
			
			FROM membermaster 
			
			LEFT JOIN downline_paid ON membermaster.usercode = downline_paid.usercode 
			
			'.$where.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
		  	return $the_content;
		}
	

	
	
	
	
}
?>
