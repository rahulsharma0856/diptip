<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends App {

	function __construct(){
		
   		parent::__construct(); 
		
		$this->load->library('image_lib');
		
		$this->load->library('upload');
		
		$this->load->model('user/Post_model');
		
		$this->load->model('user/Page_model');
		
		$this->load->model('user/Group_model');
		
		$this->load->model('user/Comment_model');
		
		$this->load->model('user/Notification_module');
		

		
		date_default_timezone_set('Asia/Calcutta'); 	
   		
 	}
	

	function add_comment_on_post(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('id','Post Id', 'callback_check_valid_post_comment');	
			
			$this->form_validation->set_rules('pcomment','Comment', 'required');	
			
			if ($this->form_validation->run() === FALSE){
			
				$data['text']   =  validation_errors();
				
				$data['status'] =  'false';
				
				echo json_encode($data);
					
				exit;	
			
			}else{
			
				$id = $this->_add_comment_on_post();
				
				$data['text'] =  $this->load_single_comment($id);
				
				$data['div_id'] = 'post_comments_list'.$_POST['id'];
				
				$data['summery'] = $this->Post_model->postCountLikesCommentShare($_POST['id']);
				
				$data['status'] =  'true';
				
				echo json_encode($data);
					
				exit;
					
			}
		
		}	
	
	}
	
	
	private function _add_comment_on_post(){
		
		$data=array(
			
			'post_id' => $this->input->post('id'),
			
		    'text_dt' => $this->input->post('pcomment'),
			
			'type' => 'comment'
		);

		$id =  $this->Comment_model->add_comment($data);
		
		return $id;
		
	}
	
	
	
	
	function check_valid_post_comment(){
		
		$result = $this->Post_model->get_post($this->input->post('id'));
	
		if(!isset($result[0])){
			
			$this->form_validation->set_message('check_valid_post_comment', 'Invaild Request');
			
      		return false;

		}
	
		return true;
		
	}
	
	
	function load_single_comment(int $id){
		
		$data['result'] = $this->Comment_model->getCommentById($id);
		
		return $this->load->view('user/post/view_single_comment',$data,TRUE);	
		
	}
	
	
	function ajax_post_load_comment(int $post_id, $start_from="0"){
		
		$comments =  $this->Comment_model->getPostComments($post_id ,$start_from);
		
		$html = "";
		
		for($i=0;$i<count($comments);$i++) {
		
			$html.= $this->load->view('user/post/view_single_comment',array('result'=>$comments[$i]),TRUE); 
		
		}
		
		$data = array(
			
			'html' => $html,
			
			'id' => (count($comments) < 1) ? '0' : '1'
			
		);
		
		echo json_encode($data);
		
		exit;
		
	}
	
	
	function delete_comment(int $comment_id)
	{
		$this->comman_fun->delete('social_comments',array('id'=>$comment_id,'usercode'=>user_session('usercode')));
			
		$data['status'] = 'true';
		
		echo json_encode($data);
		
		exit;
		
	}
	
	
	
	
	
	function do_like_comment(int $comment_id){
		
		$result = $this->Comment_model->do_like_comment($comment_id);
		
		$data = array(
		
		 'html' => $this->CommentLikesHtml($comment_id)
		
		);
		
	    
		echo json_encode($data);
		
		exit;
		
	}
	
	function do_unlike_comment(int $comment_id){
		
		$result = $this->Comment_model->do_unlike_comment($comment_id);
		
		$data = array(
		
		 'html' => $this->CommentLikesHtml($comment_id)
		
		);
		
		echo json_encode($data);
		
		exit;
		
	}
	
	function CommentLikesHtml(int $comment_id){
		
		$totalLikes = $this->Comment_model->countCommentTotalLikes($comment_id);
		
		if($this->Comment_model->isMemberLikeComment($comment_id)){
			
			$html = '<a style="margin-right:10px;" id="do_unlike_comment" href="#" class="post-add-icon-comment inline-items" value="'.$comment_id.'"> <i class="fa fa-heart"></i> <span>'.$totalLikes.'</span> </a>';
			
		}else{
		
			$html = '<a style="margin-right:10px;" id="do_like_comment" href="#" class="post-add-icon-comment inline-items" value="'.$comment_id.'"> <i class="fa fa-heart-o"></i> <span>'.$totalLikes.'</span> </a>';
		
		}
		
		return $html;
		
	}
	
    
	//get textbox for reply on comment	
	function get_reply_textarea(int $comment_id)
	{

        $user_dt = $this->comman_fun->get_table_data('membermaster',array('status'=>'Active','usercode'=>user_session('usercode')));
		
		$html='';
		
		$html.='<form action="'.file_path('Comment/add_reply_on_comment').'" method="post" id="reply_on_cmnt_frm">
		
		 		 <input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
    	
        		 <input type="hidden" name="comment_id" id="reply_comment_id" value="'.$comment_id.'">';
		
		$html.='<div id="reply_comment_div_'.$comment_id.'" style="width: 93%; margin-left: 30px;"><div style="margin-bottom: 0;display: inline-block;width: auto;" class="post__author author vcard inline-items">
		
		  		 <img src="'.thumb($user_dt[0]['profile_img'],100,100).'" alt="author"> </div>';
		
		$html.='<textarea name="reply_on_cmnt" class="form-control reply_on_cmnt_'.$comment_id.'" id="reply_on_cmnt" style="width:90%; display: inline-block; height: 35px; min-height: 35px; max-height: 300px; overflow: hidden; overflow-y: auto; padding: 7px; margin-top: 5px; padding-bottom: 5px; resize: vertical; vertical-align: middle;" placeholder="Write a reply..."></textarea>';
		 
		$html.='</div></form>';
		
		echo $html;
		
	}
	
	
	function add_reply_on_comment()
	{
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('id','Reply Id', 'check_valid_reply_on_comment');	
			
			$this->form_validation->set_rules('reply_on_cmnt','Reply', 'required');	
			
			if ($this->form_validation->run() === FALSE){
			
				$data['text']   =  validation_errors();
				
				$data['status'] =  'false';
				
				echo json_encode($data);
					
				exit;	
			
			}else{
			
				$id = $this->_add_reply_on_comment();
				
				$data['text'] 	   =  $this->ajax_getcomment_reply($id);
				
				$tot_reply		   =  $this->Comment_model->countTotalReplyByID($_POST['comment_id']);
				
				$data['tot_reply'] = $tot_reply['tot_reply'];
				
				$data['status'] =  'true';
				
				echo json_encode($data);
					
				exit;
					
			}
		}
	}
	
	
	private function _add_reply_on_comment()
	{
		
		$data=array(
			
			'post_id' => '0',
			
			'comment_id' => (isset($_POST['comment_id'])) ? $_POST['comment_id'] : '0',  
			
			'text_dt' => $this->input->post('reply_on_cmnt'),
			
			'usercode' => user_session('usercode'),
			
			'time_dt' => time()
			
		);
		
		$id 	 		= $this->comman_fun->addItem($data,'social_comments');
		
		//notification
		$cresult 		= $this->comman_fun->get_table_data('social_comments',array('id'=>$_POST['comment_id']));
		
		$post_result 	= $this->Post_model->get_post($cresult[0]['post_id']);
		
		if($cresult[0]['usercode']!=user_session('usercode')){
			
			$notification_data = array(
						
				'type'       => 'reply_on_comment',
				
				'usercode'   => $cresult[0]['usercode'],
				
				'usercode2'  => user_session('usercode'),
				
				'post_id'	 => $cresult[0]['post_id'],
				
				'comment_id' => $id
				
			);
			
			$this->Notification_module->add_notification($notification_data);
		}
		
		
		if($post_result[0]['added_by']!=user_session('usercode')){
			
			$notification_data = array(
						
				'type'       => 'comment',
				
				'usercode'   => $post_result[0]['added_by'],
				
				'usercode2'  => user_session('usercode'),
				
				'post_id'	 => $cresult[0]['post_id'],
				
				'comment_id' => $id
				
			);
			
			$this->Notification_module->add_notification($notification_data);
		}
		
		return $id;

	}
    
	
	function check_valid_reply_on_comment(){
		
		$result = $this->comman_fun->get_table_data('social_comments',array('id'=>$_POST['comment_id'])); 
	
		if(!isset($result[0])){
			
			$this->form_validation->set_message('check_valid_reply_on_comment', 'Invaild Request');
			
      		return false;

		}
	
		return true;
		
	}
	
	
	
	function ajax_getcomment_reply(int $comment_id)
	{
		$result  = $this->Comment_model->getReplyById($comment_id);
		
		$summary = $this->Comment_model->countCommentLikes($comment_id);
        
		$comment_txt = filter_message($result['text_dt']);
		
		$html ='';
		
		$html .='<div class="reply_div" id="reply_div_'.$result['id'].'">';
		
		$html .= '<div style="margin: 8px 0px 0px 32px; display: block;" class="post__author author vcard inline-items reply_div">
				 	<img src="'.thumb($result['member_profile_img'],100,100).'" alt="author" title="'.$reply_result['member_name'].'" style="margin-right: 6px;">
					<span class="comment_reply_txt_cls" style="word-break: break-all;">
						<div class="author-date"> 
						  <span><a class="h6 post__author-name fn" href="#">'.$result['member_name'].'</a>';
                            if($result['usercode']==user_session('usercode')) {
        $html .=                '<div class="more" style="margin-right: 2px; padding: 2px; display: inline;"> <svg class="olymp-three-dots-icon" viewBox="0 0 18 5" style="float: right;">
                                  <use xlink:href="'.asset_sm().'icons/icons.svg#olymp-three-dots-icon"></use>
                                  </svg>
                                  <div class="more-dropdown"><a id="edit_reply" value="'.$result['id'].'" href="#">Edit </a><a id="del_reply" value="'.$result['id'].'" href="#">Delete </a></div>
                                </div>';
                            }
        $html .=          '</span>';
		$html .= 		  ' <span>'.$comment_txt.'</span>
					   </div>
					</span>';

        $html .='</div>';

		$html .='<span style="margin-left: 78px;" class="sp_like_reply_'.$result['id'].'">';

        if((int)$summary['is_like'] > 0) {
            
            $html .='<span><a style="margin-right:10px;" id="do_unlike_comment" value="'.$result['id'].'" href="#" class="post-add-icon-reply inline-items"> <i class="fa fa-heart"></i> <span>'.$summary['total_likes'].'</span> </a> </span>';
        
        }else{
            
            $html .='<span><a style="margin-right:10px;" id="do_like_comment" value="'.$result['id'].'" href="#" class="post-add-icon-reply inline-items"> <i class="fa fa-heart-o"></i> <span>'.$summary['total_likes'].'</span> </a> </span>';
        
        }
        
        $html .='<span><a class="post-add-icon-reply" href="#">'.time_ago($result['time_dt']).'</a> </span></span>';
		
 		$html .= '</div>';		
					
		return $html;
		
	}
	
	
	function load_more_reply(int $comment_id, $start_from="0"){
		
		$reply =  $this->Comment_model->getAllReplyById($comment_id,$start_from);
		
		$html = "";
		
		for($i=0;$i<count($reply);$i++) {
		
			$html.= $this->load->view('user/post/view_comment_reply',array('reply_result'=>$reply[$i]),TRUE); 
		
		}
		
		$data = array(
			
			'html' => $html,
			
			'id' => (count($reply) < 1) ? '0' : '1'
			
		);
		
		echo json_encode($data);
		
		exit;
		
	}
	
	
	//-------edit comment ----------
	function get_edit_comment_textarea(int $comment_id)
	{
		 
		$user_dt = $this->comman_fun->get_table_data('membermaster',array('status'=>'Active','usercode'=>user_session('usercode')));
		 
		$result =  $this->Comment_model->getCommentById($comment_id);
		 
		$html='';
		 
		$html.='<form action="'.file_path('Comment/edit_comment_on_post').'" method="post" id="edit_comment_frm">
		 
		 		 <input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
    	
        		 <input type="hidden" name="comment_id" id="comment_id" value="'.$comment_id.'">
				 
				 <input type="hidden" name="comment_mode" id="comment_mode" value="edit">';
		
		$html.='<div id="edit_comment_div" style="width:100%"><div style="margin-bottom: 0;display: inline-block;width: auto;" class="post__author author vcard inline-items">
		 
		  		 <img src="'.thumb($user_dt[0]['profile_img'],100,100).'" alt="author"> </div>';
		 
		$html.='<textarea name="edit_comment_txt" class="form-control edit_cmnt_'.$comment_id.'" id="edit_comment_txt" style="border-radius: 20px!important; width:90%; display: inline-block; min-height: 35px; max-height: 300px; height: 35px; overflow: hidden; overflow-y: auto; padding: 7px; margin-top: 5px; resize: vertical; vertical-align: middle;">'.$result['text_dt'].'</textarea>';
		 
		$html.='</div><a href="#" id="cancle_edit_cmnt" value="'.$comment_id.'" style="margin-left: 46px;font-size: 10px;" title="Cancel Editing Comment">&#8226; cancel edit &#8226;</a></form>';
		
		
		echo $html;
		
		
	}
	
	
	//------edit comment submit---------
	function edit_comment_on_post(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('id','Post Id', 'callback_check_valid_edit_comment');	
			
			$this->form_validation->set_rules('edit_comment_txt','Comment', 'required');	
			
			if ($this->form_validation->run() === FALSE){
			
				$data['text']   =  validation_errors();
				
				$data['status'] =  'false';
				
				echo json_encode($data);
					
				exit;	
			
			} else {
			    
				$id = $this->_edit_comment_on_post();

				$data['text'] =  filter_post($_POST['edit_comment_txt']);
				
				$data['status'] =  'true';
				
				echo json_encode($data);
					
				exit;
					
			}
		
		}	
	
	}
	
	private function _edit_comment_on_post(){ 
	    
	    $comment_id = $_POST['comment_id'];
	    
		$update_data=array(
			
		    'text_dt' => $this->input->post('edit_comment_txt'),
			
		);
		
		$id =  $this->Comment_model->edit_comment($comment_id, $update_data);	
		
		return $id;
		
	}
	
	function check_valid_edit_comment(){
		
		$result =  $this->Comment_model->getCommentById($_POST['comment_id']); 
	 
		if(!isset($result)){
			
			$this->form_validation->set_message('check_valid_edit_comment', 'Invaild Request');
			
      		return false;

		}
		else if($result['usercode']!=user_session('usercode'))
		{
			$this->form_validation->set_message('check_valid_edit_comment', 'Invaild Request');
			
      		return false;
		}
		else if($_POST['comment_mode']!='edit')
		{
			$this->form_validation->set_message('check_valid_edit_comment', 'Invaild Request');
			
      		return false;
		}
		else
		{
			return true;
		}
	}	
	
	
	//-------edit comment reply ----------
	function get_edit_comment_reply_textarea(int $comment_id)
	{

        $user_dt = $this->comman_fun->get_table_data('membermaster',array('status'=>'Active','usercode'=>user_session('usercode')));

        $result =  $this->Comment_model->getCommentById($comment_id);

        $html='';

        $html.='<form action="'.file_path('Comment/edit_comment_reply_on_post').'" method="post" id="edit_comment_reply_frm"  style="width:100%">

             <input type="hidden" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">

             <input type="hidden" name="comment_id" id="reply_comment_id" value="'.$comment_id.'">
             
             <input type="hidden" name="comment_mode" id="comment_mode" value="edit">';

        $html.='<div id="edit_reply_comment_div" style="width: 93%; margin-left: 30px;"><div style="margin-bottom: 0;display: inline-block;width: auto;" class="post__author author vcard inline-items">

             <img src="'.thumb($user_dt[0]['profile_img'],100,100).'" alt="author"> </div>';

        $html.='<textarea name="edit_reply_on_cmnt" class="form-control edit_reply_on_cmnt_'.$comment_id.'" id="edit_reply_on_cmnt" style="border-radius: 20px!important;width:90%; display: inline-block; height: 35px; min-height: 35px; max-height: 300px; overflow: hidden; overflow-y: auto; padding: 7px; margin-top: 5px; padding-bottom: 5px; resize: vertical; vertical-align: middle;" placeholder="Write a reply...">'.$result['text_dt'].'</textarea>';
		 
        $html.='</div><a href="#" id="cancle_edit_cmnt_reply" value="'.$comment_id.'" style="margin-left: 74px;font-size: 10px;" title="Cancel Editing Comment Reply">&#8226; cancel edit &#8226;</a></form>';
		
		echo $html;
		
	}
	
	
	//------edit comment reply submit---------
	function edit_comment_reply_on_post(){
	
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
			$this->form_validation->set_rules('id','Post Id', 'callback_check_valid_edit_comment');	
			
			$this->form_validation->set_rules('edit_reply_on_cmnt','Reply', 'required');	
			
			if ($this->form_validation->run() === FALSE){
			
				$data['text']   =  validation_errors();
				
				$data['status'] =  'false';
				
				echo json_encode($data);
					
				exit;	
			
			}else{
				
				$id = $this->_edit_comment_reply_on_post();
				
				$data['text'] =  filter_message($_POST['edit_reply_on_cmnt']);
				
				$data['status'] =  'true';
				
				echo json_encode($data);
					
				exit;
					
			}
		
		}	
	
	}
	
	private function _edit_comment_reply_on_post(){
		
		$update_data=array(
			
		    'text_dt'     => $this->input->post('edit_reply_on_cmnt'),
			
		);
		
		$comment_id = $_POST['comment_id'];

		$this->comman_fun->update($update_data,'social_comments',array('id'=>$comment_id,'usercode'=>user_session('usercode')));	
		
		return $comment_id;
		
	}
	
	function delete_comment_reply(int $comment_id)
	{
		$result =  $this->Comment_model->getCommentById($comment_id); 
	 
		if(!isset($result)){
			
			$data['status'] = 'false';
			
      	}
		else if($result['usercode']!=user_session('usercode'))
		{
			$data['status'] = 'false';
		}
		else
		{
			$this->comman_fun->delete('social_comments',array('id'=>$comment_id,'usercode'=>user_session('usercode')));
			
			$data['status'] = 'true';
		}
		
		echo json_encode($data);
			
		exit;
		
	}
	
}


