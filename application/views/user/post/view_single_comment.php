
<li style="padding: 12px 25px;" id="comment_id_<?=$result['id']?>">

  <div id="comment_main_<?=$result['id']?>">
  
  <div style="margin: 0px 0px 5px 0px; display: block;" class="post__author author vcard inline-items">
  
  <img src="<?=thumb(ProfileImg($result['member_profile_img']),100,100)?>" alt="author" title="<?=$result['member_name']?>" style="margin-right: 6px;">
  
    <span class="comment_txt_cls">
    
    	<div class="author-date"> 
        
    	  <span>
            <a class="h6 post__author-name fn" href="<?=file_path('profile/view/'.$result['member_username'])?>" title="<?=$result['member_name']?>"><?=$result['member_name']?></a>

            <?php if($result['usercode']==user_session('usercode')) { ?>
            
            <div class="more" style="margin-right: 2px; padding: 3px; display: inline;">
            
                <svg class="olymp-three-dots-icon" viewBox="0 0 18 5" style="float: right;">
                    <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
                </svg>
              
                <div class="more-dropdown" style="padding:5px 15px; background-color: #f7f7f7;">

                  <a id="edit_comment" value="<?=$result['id']?>" href="#">Edit </a> 
                  
                  <a id="del_comment" value="<?=$result['id']?>" href="#">Delete </a>
                  
                </div>
             
            </div>
            
            <?php } ?>
            
          </span> 
          
          <span id="ctext" style="word-break: break-word;"><?=filter_post($result['text_dt'])?></span>
          
       </div>
    
    </span>
    
  </div>
 
  <span style="margin-left:42px;" class="sp_like_reply_<?=$result['id']?>">
  
		<?php $summary = $this->Comment_model->countCommentLikes($result['id']); ?>
        
        
        <?php if((int)$summary['is_like'] > 0) {?>
            
            <span><a style="margin-right:10px;" id="do_unlike_comment" value="<?=$result['id']?>" href="#" class="post-add-icon post-add-icon-comment inline-items"> <i class="fa fa-heart"></i> <span><?=$summary['total_likes']?></span> </a> </span>
            
        <?php } else { ?>
            
            <span><a style="margin-right:10px;" id="do_like_comment" value="<?=$result['id']?>" href="#" class="post-add-icon post-add-icon-comment inline-items" title="Like Comment"> <i class="fa fa-heart-o"></i> <span><?=$summary['total_likes']?></span> </a> </span>
            
        <?php } ?>
        <?php if($result['tot_reply']>0){
			
				if($result['tot_reply']>1){
					
					$reply_txt = $result['tot_reply']. ' Replies';
					
				}
				else{
					
					$reply_txt = $result['tot_reply'].' Reply';
					
				}
		} else {
			
			$reply_txt = '0 Replies';
			
		}?>
        
        <span>
        	<a id="reply_on_comment" style="margin-right:10px;" value="<?=$result['id']?>" href="#" class="reply post-add-icon post-add-icon-comment inline-items" title="Add Reply to Comment"><font color=#6e796d>Add Reply</font></a> 
        </span>
        <span>
        	<a id="replies_on_comment" style="margin-right:10px;" value="<?=$result['id']?>" class="reply post-add-icon post-add-icon-comment inline-items"><?=$reply_txt?></a> 
        </span>
        
        <span><a style="cursor: default;" class="post-add-icon post-add-icon-comment inline-items"><?=time_ago($result['time_dt'])?></a> </span>
    
  </span>
 
 
 </div>
 
 	 <!--load comment reply -->
 	
	 <?php //if($result['tot_reply']>0){  ?>		 
			
            <div class="main_reply_div_<?=$result['id']?>">
    
     <?php		 
	 		
			if($result['tot_reply']>1){		
					
				echo '<div style="padding-left: 45px;padding-top: 5px;padding-bottom: 5px;">
				
					<span><a style="color:#000000;" href="#" id="load_more_reply" value="'.$result['id'].'">View more reply +</a></span>
				
				</div>';
			}
			
			if($cmt == FALSE){
				
				$reply_result 				 = $this->Comment_model->getAllReplyById($result['id'],0);	
				 
			}else{
			
				$reply_result 				 = $this->Comment_model->getPerticulerReplyById($result['id'],$_GET['comment_id']);	
			
			}
			
			echo '<div id="main_reply_div_'.$result['id'].'">';
			
			for($i=0;$i<count($reply_result);$i++) {
			    
			 	echo $this->load->view('user/post/view_comment_reply',array('reply_result'=>$reply_result[$i]),TRUE);
				
			}
			
			echo '</div>';
	?>		
			</div>
     
    <?php //} ?> 	
	
    	
 
 
 </li>
