
<div class="reply_div" id="reply_div_<?=$reply_result['id']?>">

    <div style="margin: 8px 0px 0px 32px; display: block;" class="post__author author vcard inline-items"> 

    <img src="<?=thumb(ProfileImg($reply_result['member_profile_img']),100,100)?>" alt="author" title="<?=$reply_result['member_name']?>" style="margin-right: 6px;">
     
     <span class="comment_reply_txt_cls" style="word-break: break-all;">
     
          <div class="author-date"> 
          
            <span>
                <a class="h6 post__author-name fn" href="<?=file_path('profile/view/'.$reply_result['member_username'])?>" title="<?=$reply_result['member_name']?>"><?=$reply_result['member_name']?></a>
            
                <?php if($reply_result['usercode']==user_session('usercode')) {?>
                 
                <div class="more" style="margin-right: 2px; padding: 2px; display: inline;">
                
                    <svg class="olymp-three-dots-icon" viewBox="0 0 18 5" style="float: right;">
                        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
                    </svg>
                   
                    <div class="more-dropdown" style="padding:5px 15px; background-color: #f7f7f7;">
                        <a id="edit_reply" value="<?=$reply_result['id']?>" href="#">Edit </a> 
                        <a id="del_reply" value="<?=$reply_result['id']?>" href="#">Delete </a>
                    </div>
                    
                 
                </div>
                  
                <?php } ?>  
            
            </span> 
            
            <span id="creplytext" style="word-break: break-word;"><?=filter_message($reply_result['text_dt'])?></span> 
            
          </div>
     
     </span>
    </div>

    <span style="margin-left: 78px;" class="sp_like_reply_<?=$reply_result['id']?>"> 
        
        <?php $summary = $this->Comment_model->countCommentLikes($reply_result['id']); ?>
        
        <?php if((int)$summary['is_like'] > 0) {?>
        
            <span>
                <a style="margin-right:10px;" id="do_unlike_comment" value="<?=$reply_result['id']?>" href="#" class="post-add-icon-reply inline-items"> <i class="fa fa-heart"></i> <span><?=$summary['total_likes']?></span> </a> 
            </span> 
        
        <?php } else { ?>
        
            <span>
                <a style="margin-right:10px;" id="do_like_comment" value="<?=$reply_result['id']?>" href="#" class="post-add-icon-reply inline-items"> <i class="fa fa-heart-o"></i> <span><?=$summary['total_likes']?></span> </a>
            </span>
       
        <?php } ?>
           
        <span><a style="cursor: default;" class="post-add-icon-reply inline-items"><?=time_ago($reply_result['time_dt'])?></a> </span> 
        
    </span>

</div>



