<?php 

if($result['post_type']=='share'){
	
	echo $this->load->view('user/ads/single_share',array('result'=>$result,'section'=>$section),true); 
	
}
else{
	echo $this->load->view('user/ads/single_add',array('result'=>$result,'section'=>$section),true); 
}
 ?>





