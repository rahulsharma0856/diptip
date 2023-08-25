<?php 

if($result['post_type']=='add'){

	echo $this->load->view('user/post/post_single_add',array('result'=>$result,'section'=>$section),true); 

 } 
 elseif($result['post_type']=='share'){
	
	echo $this->load->view('user/post/post_single_share',array('result'=>$result,'section'=>$section),true); 
	
}
 ?>





