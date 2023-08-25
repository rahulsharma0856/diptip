<?php
Class Report_module extends CI_Model
{
	
		function get_earning_ajax(){	
		
			$aColumns = array( 'membermaster.usercode','membermaster.fname','membermaster.username','membermaster.username','membermaster.username','membermaster.username');
		
   			$sLimit = "";
			
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
				
				$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
				
			}
		
		
			if ( isset( $_GET['iSortCol_0'] ) ){
				
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
			
			
			
		
			$sQuery='SELECT DISTINCT downline_paid.usercode,downline_paid.id, membermaster.*
			
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
		
		
		
		
		
		
		function count_record_all(){
			
			$sQuery='SELECT DISTINCT downline_paid.usercode,count(*) as tot 
			
			FROM downline_paid 
			
			LEFT JOIN membermaster ON membermaster.usercode = downline_paid.usercode';
				
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
		  	return $the_content;
			
		}
		
		
		
		
		function user_received_ajax($type, $uid){	
			
			
			
			$aColumns = array( 'm_income.id','m_income.date_dt','m_income.level','m_income.amount','membermaster.fname','m_income.plan_type');
		
   			$sLimit = "";
			
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
				
				$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
				
			}
		
		
			if ( isset( $_GET['iSortCol_0'] ) ){
				
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
				
				$sWhere = "WHERE (";
			
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
			
				{
				
					$sWhere .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str( $_GET['sSearch'] )."%' OR ";
			
				}
			
				$sWhere = substr_replace( $sWhere, "", -3 );
				
			
				$sWhere .= ')';
			
			}

			
			$sWhere.=($sWhere=="" ? " WHERE " : " AND ");
			
			
			$sWhere.="m_income.wallet_type = '$type' AND m_income.usercode = '$uid'";
			
			
			$sQuery='SELECT m_income.*, membermaster.fname, membermaster.lname, membermaster.username FROM m_income 
			
			JOIN membermaster ON m_income.join_user = membermaster.usercode 
				
			'.$sWhere.'
			
			'.$sOrder.'
			
			'.$sLimit.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			$return['where']	=	$sWhere;
			
			$return['result']	=	$the_content;
			
			return $return;
			
		}
		
		
		function user_received_ajax_count($where){
		
				$sQuery = 'SELECT COUNT(m_income.id) as tot
				
				FROM  m_income
				
				JOIN membermaster ON m_income.join_user = membermaster.usercode
				
				'.$where.'';
				
				$query = $this->db->query($sQuery);
				
				$the_content = $query->result_array();
				
				return $the_content;
		
		}
		
		
		function get_paid_referral($eid){	
		
			$this -> db -> select('COUNT(membermaster.referralid) as tot_paid');
			
			$this -> db -> from('membermaster');
			
			$this -> db -> join('downline_paid','downline_paid.usercode = membermaster.usercode','inner');
			
			$this -> db -> where('membermaster.referralid',''.$eid.'');
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return (int)$the_content[0]['tot_paid'];
		
		}
		
		
		function get_maxrix_income_by_type($uid){
		
			$this -> db -> select('FORMAT(COALESCE(SUM(amount),0),2) as total,plan_type');
		
			$this -> db -> from('m_income');
		
			$this -> db -> where('m_income.usercode',''.$uid.'');
			
			$this -> db -> where('m_income.wallet_type','income');
			
			$this -> db -> group_by('plan_type');
		
			$query 		=	 $this -> db -> get();
		
			$the_content = $query->result_array();
		
			return $the_content;	
		
		}
		
		function get_referral_income_by_type($uid){
		
			$this -> db -> select('FORMAT(COALESCE(SUM(amount),0),2) as total,plan_type');
		
			$this -> db -> from('m_income');
		
			$this -> db -> where('m_income.usercode',''.$uid.'');
			
			$this -> db -> where('m_income.wallet_type','referral');
			
			$this -> db -> group_by('plan_type');
		
			$query 		=	 $this -> db -> get();
		
			$the_content = $query->result_array();
		
			return $the_content;	
		
		}
		
		
		
		
		
		function excel_export_data($start='0'){
			
			$sQuery='SELECT DISTINCT downline_paid.usercode,downline_paid.id, membermaster.* 
			
			FROM downline_paid 
			
			LEFT JOIN membermaster ON membermaster.usercode = downline_paid.usercode 
			
			INNER JOIN plan_a_position2 ON downline_paid.usercode = downline_paid.usercode 
			
			ORDER BY membermaster.usercode asc LIMIT '.$start.', 500';
			
			$query = $this->db->query($sQuery);
			
			return $query->result_array();
						
			
 		}
		
		function destiny_tree_add_date(){
			
			$this -> db -> select('m_withdrawal.time_dt, COUNT(m_withdrawal.time_dt) as tot');
			
			$this -> db -> from('m_withdrawal');

			$this -> db -> where('m_withdrawal.type_dt','destiny');
			
			$this -> db -> group_by('m_withdrawal.time_dt');
		
			$query 		=	 $this -> db -> get();
		
			$the_content = $query->result_array();
		
			return $the_content;	
			
		}
		
		function get_destiny_member_list($date){	
		
			$this -> db -> select('m_withdrawal.*');
			
			$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username');
			
			$this -> db -> from('m_withdrawal');
			
			$this -> db -> join('membermaster','m_withdrawal.usercode = membermaster.usercode','left');
			
			$this -> db -> where('m_withdrawal.time_dt',''.$date.'');
			
			$this -> db -> where('m_withdrawal.type_dt','destiny');
		
			$this -> db -> order_by('m_withdrawal.withdrawal_code','ASC');
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;
		
		}
		
		
		function destiny_member_payment_detail($uid,$date){
		
			$this -> db -> select('m_income.*');
			
			$this -> db -> select('membermaster.fname, membermaster.lname, membermaster.username');
			
			$this -> db -> from('m_income');
			
			$this -> db -> join('membermaster','m_income.usercode = membermaster.usercode','left');
			
			$this -> db -> where('m_income.time_dt',''.$date.'');
			
			$this -> db -> where('m_income.join_user',''.$uid.'');
			
			$this -> db -> where('m_income.plan_type','destiny');
		
			$this -> db -> order_by('m_income.id','ASC');
			
			$query = $this -> db -> get();
			
			$the_content = $query->result_array();
			
			return $the_content;
		
		}
		
		
		
		
		
				
		function garden_matrix_members_ajax($type, $uid){	
			
			
			
			$aColumns = array( 'membermaster.usercode','membermaster.usercode','membermaster.usercode','membermaster.usercode','membermaster.usercode','membermaster.usercode');
		
   			$sLimit = "";
			
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
				
				$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
				
			}
		
		
			if ( isset( $_GET['iSortCol_0'] ) ){
				
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
				
				$sWhere = "WHERE (";
			
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
			
				{
				
					$sWhere .= $aColumns[$i]." LIKE '%".$this->db->escape_like_str( $_GET['sSearch'] )."%' OR ";
			
				}
			
				$sWhere = substr_replace( $sWhere, "", -3 );
				
			
				$sWhere .= ')';
			
			}

			
			$sQuery='SELECT COUNT(downline_garden.usercode) as tot, membermaster.fname, membermaster.lname, membermaster.username, membermaster.usercode FROM downline_garden 
			
			JOIN membermaster ON downline_garden.usercode = membermaster.usercode 
				
			'.$sWhere.'
			
			GROUP BY  downline_garden.usercode
			
			'.$sOrder.'
			
			'.$sLimit.'';
			
			$query = $this->db->query($sQuery);
			
			$the_content = $query->result_array();
			
			$return['where']	=	$sWhere;
			
			$return['result']	=	$the_content;
			
			return $return;
			
		}
		
		
		function garden_matrix_members_ajax_count($where){
		
				$sQuery = 'SELECT COUNT(downline_garden.usercode) as tot
				
				FROM  downline_garden
				
				JOIN membermaster ON downline_garden.usercode = membermaster.usercode 
				
				GROUP BY  downline_garden.usercode
				
				'.$where.'';
				
				$query = $this->db->query($sQuery);
				
				$the_content = $query->result_array();
				
				$data[] = array(
					'tot' => count($the_content)
				);
				
				return $data;
		
		}
		
	
	
}
?>
