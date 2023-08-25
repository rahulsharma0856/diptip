<?php
Class Payment_module extends CI_Model{
	
	
	
	function get_post($id = NULL){
		
		$this -> db -> select('*');
		
		$this -> db -> from('social_post_master');
		
		$this -> db -> where('post_id',''.$id.'');
		
		$query 		=	 $this -> db -> get();
		
		$the_content = $query->result_array();
		
		return $the_content[0];	
		
	}
	
	
 	function doPaymentPostAdd($post_id = NULL){	
		
		$post_detail = $this->get_post($post_id);
	
		if(isset($post_detail['post_id'])){
			
			//Withdrawal
			
			$data = array(
			
				'usercode' 	=> $post_detail['added_by'],
				
				'post_id' 	=> $post_detail['post_id'],
				
				'amount' 	=>  0.10,
				
				'wallet' 	=> 'USD',
				
				'type_dt' 	=> 'add_post',
				
				'status' 	=> 'Active',
				
				'date_dt'  => date('Y-m-d'),
				
				'time_dt' 	=> time(),
				
				
			
			);
			
			$this->comman_fun->addItem($data,'m_withdrawal');
			
			
			$this->doSponsorPaymentPostAdd($post_detail);	
			
		}
		
 	}
	
	
	function doPaymentPostShare($post_id = NULL){
		
		$post_detail 	= 		$this -> GetSharePostDetail($post_id);
	
		if(isset($post_detail['post_id'])){
			
			//Withdrawal
			
			$data = array(
			
				'usercode' 	=> $post_detail['added_by'],
				
				'post_id' 	=> $post_detail['post_id'],
				
				'amount' 	=>  0.10,
				
				'wallet' 	=> 'USD',
				
				'type_dt' 	=> 'share_post',
				
				'status' 	=> 'Active',
				
				'date_dt'  => date('Y-m-d'),
				
				'time_dt' 	=> time()
			
			);
			
			$this->comman_fun->addItem($data,'m_withdrawal');
			
			
			$this->doSharePaymentPostShare($post_detail);	
			
			$this->doSponsorPaymentPostShare($post_detail);
			
		}
		
	}
	
	
	
	function doSponsorPaymentPostShare($post_detail = NULL){
		
		$member_field 	=	array('l1','l2','l3','l4','l5');	
		
		$payFromUser 	= 	$post_detail['added_by'];
		
		$member_list 	= 	$this->GetSponsorMember($payFromUser);
		
		$totalPayment  =  5 - count($post_detail['dt']);
		
		///
		
		for($i=0;$i<=count($totalPayment);$i++){
			
			$payToUser 	 = 	$member_list[0][$member_field[$i]];
			
			$p = $i + 1;

			$data = array(
			
				'usercode' 	=> $payToUser,
				
				'uid2' 		=> $payFromUser,
				
				'post_id' 	=> $post_detail['post_id'],
				
				'amount' 	=>  0.01,
				
				'wallet' 	=> 'USD',
				
				'wallet_type' => 'post_share',
					
				'type_dt' => 'Post Share Sponsor Payment Level -'.$p ,
				
				'time_dt' 	=> time()
			
			);
			
			$this->comman_fun->addItem($data,'m_income');
			
			
			
			$data = array(
			
				'usercode' 	=> 	$payToUser,
				
				'uid2' 		=> 	$payFromUser,
				
				'post_id' 	=> 	$post_detail['post_id'],
				
				'amount' 	=>  0.01,
				
				'wallet' 	=> 	'SP',
				
				'type_dt'    => 'Post Share Sponsor Payment Level -'.$p ,
				
				'status' 	=> 'Active',
				
				'date_dt'   => date('Y-m-d'),
				
				'time_dt' 	=> 	time()
			
			);
			
			$this->comman_fun->addItem($data,'m_income');
		
		}	
		
		///
	}
	
	function doSharePaymentPostShare($post_detail = NULL){
		
		$payFromUser 		= 	$post_detail['added_by'];
	
		$shareMemberList 	= $post_detail['dt'];
		
		for($i=0;$i<count($shareMemberList);$i++){
			
			$p = $i + 1;
			
			$payToUser 	 = 	$shareMemberList[$i];

			$data = array(
			
				'usercode' 	=> $payToUser,
				
				'uid2' 		=> $payFromUser,
				
				'post_id' 	=> $post_detail['post_id'],
				
				'amount' 	=>  0.01,
				
				'wallet' 	=> 'USD',
				
				'wallet_type' => 'post_share',
				
				'type_dt' => 'Post Share Payment Level -'.$p ,
				
				'time_dt' 	=> time()
				
			);
			
			$this->comman_fun->addItem($data,'m_income');
			
			
			
			$data = array(
			
				'usercode' 	=> 	$payToUser,
				
				'uid2' 		=> 	$payFromUser,
				
				'post_id' 	=> 	$post_detail['post_id'],
				
				'amount' 	=>  0.01,
				
				'wallet' 	=> 	'SP',
				
				'wallet_type' => 'post_share',
				
				'type_dt' => 'Post Share Payment Level -'.$p ,
				
				'time_dt' 	=> 	time()
				
			);
			
			$this->comman_fun->addItem($data,'m_income');
				
		}
		
	}
	
	
	
	
	private function doSponsorPaymentPostAdd($post_detail = NULL){
		
		$member_field 	=	array('l1','l2','l3','l4','l5');
		
		$payFromUser 	= 	$post_detail['added_by'];
		
		$member_list 	= 	$this->GetSponsorMember($payFromUser);
		
		
		
		for($i=0;$i<count($member_field);$i++){
		
			$payToUser 	 = 	$member_list[0][$member_field[$i]];
			
			$p = $p+1;
			
			$data = array(
			
				'usercode' 	=> $payToUser,
				
				'uid2' 		=> $payFromUser,
				
				'post_id' 	=> $post_detail['post_id'],
				
				'amount' 	=>  0.01,
				
				'wallet' 	=> 'USD',
				
				'wallet_type' 	=> 'post_add',
				
				'type_dt' => 'Post Share Sponsor Payment Level -'.$p ,
				
				'time_dt' 	=> time()
			
			);
			
			$this->comman_fun->addItem($data,'m_income');
			
			
			
			$data = array(
			
				'usercode' 	=> 	$payToUser,
				
				'uid2' 		=> 	$payFromUser,
				
				'post_id' 	=> 	$post_detail['post_id'],
				
				'amount' 	=>  0.01,
				
				'wallet' 	=> 	'SP',
				
				'wallet_type' 	=> 'post_add',
				
				'type_dt' => 'Post Share Sponsor Payment Level -'.$p ,
				
				'time_dt' 	=> 	time()
			
			);
			
			$this->comman_fun->addItem($data,'m_income');
		
		}	
		
	}
	
	
	
	function GetSponsorMember($eid = NULL){
	
		
		$eid = $this->db->escape($eid);
		
		$sQuery = 'SELECT 
		
		IFNULL(level1.usercode,0) as l1, IFNULL(level2.usercode,0) as l2, IFNULL(level3.usercode,0) as l3, IFNULL(level4.usercode,0) as l4, IFNULL(level5.usercode,0) as l5
		
		FROM (membermaster) 
		
		LEFT JOIN membermaster as level1 ON level1.usercode = membermaster.referralid
		
		LEFT JOIN membermaster as level2 ON level2.usercode = level1.referralid
		
		LEFT JOIN membermaster as level3 ON level3.usercode = level2.referralid
		
		LEFT JOIN membermaster as level4 ON level4.usercode = level3.referralid
		
		LEFT JOIN membermaster as level5 ON level5.usercode = level4.referralid
		
		WHERE membermaster.usercode = "'.$eid.'"';
		
		$query = $this->db->query($sQuery);
		
		$the_content = $query->result_array();
		
		return $the_content;
	
	}
	
	
	function GetSharePostDetail($eid = NULL){
		
		$eid = $this->db->escape($eid);
		
		$sQuery = 'SELECT social_post_master.post_id, social_post_master.added_by,
		
		IFNULL(level1.added_by,0) as s1, IFNULL(level2.added_by,0) as s2, IFNULL(level3.added_by,0) as s3, IFNULL(level4.added_by,0) as s4, IFNULL(level5.added_by,0) as s5
		
		FROM (social_post_master) 
		
		LEFT JOIN social_post_master as level1 ON level1.post_id = social_post_master.share_post_id
		
		LEFT JOIN social_post_master as level2 ON level2.post_id = level1.share_post_id
		
		LEFT JOIN social_post_master as level3 ON level3.post_id = level2.share_post_id
		
		LEFT JOIN social_post_master as level4 ON level4.post_id = level3.share_post_id
		
		LEFT JOIN social_post_master as level5 ON level5.post_id = level4.share_post_id
		
		WHERE social_post_master.post_id = "'.$eid.'"';
		
		$query = $this->db->query($sQuery);
		
		$the_content = $query->result_array();
		
		if(isset($the_content[0])){
		
			$arr = array();
			
			if($the_content[0]['s1']!='0'){
				
				$arr[] = $the_content[0]['s1'];
				
			}
			
			if($the_content[0]['s2']!='0'){
				
				$arr[] = $the_content[0]['s2'];
				
			}
			
			if($the_content[0]['s3']!='0'){
				
				$arr[] = $the_content[0]['s3'];
				
			}
			
			if($the_content[0]['s4']!='0'){
				
				$arr[] = $the_content[0]['s4'];
				
			}
			
		}
		
		
		return array(
		
			'post_id' => $the_content[0]['post_id'], 
			
			'added_by' =>  $the_content[0]['added_by'], 
			
			'dt' => $arr, 
			
		);
		
		return $the_content;
	
	}
	
	
	
	function GetSponsorPaymentAmount($type=''){
	
		$arr =array(
		
			'level1' => 0.01,
			
			'level2' => 0.01,
			
			'level3' => 0.01,
			
			'level4' => 0.01,
			
			'level5' => 0.01,
			
		);
		
		if (array_key_exists($type, $arr)) {
			
			return $arr[$type];
			
		}else{
			
			return false;
			
		}
		
	}
	
	
	
	
}
?>
