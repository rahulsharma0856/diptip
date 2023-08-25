<div class="bc-friends-container bc-friends-user" id="chat-window-<?=$member['usercode']?>">
  <div class="ui-block popup-chat">
    <div class="ui-block-title"> <?php /*?><span class="icon-status online"></span><?php */?>
      <h6 class="title" style="font-size: 13px !important;"><a style="color:#fff;" href="<?=file_path('profile/view/'.$member['username'])?>"><?=$member['fname']?> <?=$member['lname']?></a></h6>
      
       <div class="more" style="padding:5px;"> 
            
            <svg class="olymp-three-dots-icon">
            
            	<use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
            
            </svg>
            
            <ul class="more-dropdown">
            
            	<li> <a id="deleteAllChat" memcode="<?=$member['usercode']?>"  href="#">Delete All Chat</a> </li>
            
            </ul>
        
        </div> 
        <div class="more" style="padding:5px;"> 
        
        	<svg class="olymp-little-delete" id="closeChatWindow"  memcode="<?=$member['usercode']?>">
		
        	<use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-little-delete"></use>
		
        </svg> 
        
        </div>
        
     </div>
     <div class="scrollbar mCustomScrollbar Scrollbar-<?=$member['usercode']?>" data-mcs-theme="dark" id="style-1">
      
      <?php if(count($last_msg) > 0){ ?>
      
      		<div class="load-more-chat" id="more-chat-<?=$member['usercode']?>"><a href="#" id="load_more_chat" memcode="<?=$member['usercode']?>">View more conversations</a></div>
      
      <?php } ?>
      
      <ul class="notification-list chat-message chat-message-field" id="friends-chat-<?=$member['usercode']?>">
      
        <?php for($i=0;$i<count($last_msg);$i++) {?>
      	
        <?php 
		
			$profile = ($last_msg[$i]['user_1']==user_session('usercode')) ? user_session('profile_img') : $member['profile_img'];  
			
		?>

 	 <li class="<?=(user_session('usercode')==$last_msg[$i]['user_1']) ? "msg_by_self" : "msg_by_friend"?>" id="chat-message-<?=$last_msg[$i]['id']?>" data-message-id="<?=$last_msg[$i]['id']?>">
        
          <div class="author-thumb"> <img src="<?=thumb(ProfileImg($profile),50,50)?>" alt="author" width="34"> </div>
          
          <div class="notification-event"> 
          	
             <div style="min-width:130px;">
            	
                <?php if($last_msg[$i]['type']=='message'){ ?>
                
              		<span class="chat-message-item"><?=filter_message($last_msg[$i]['msg'])?> </span>   
                
              	<?php } else { ?>
                	
                    <?php
                        $imgPath = $last_msg[$i]['img_path'];
                        $imgPath = base_url() . 'upload/chat/' . basename($imgPath);
                    ?>
                    
                    <a href="<?=$imgPath?>" title="View Image Attachment" target="_blank">
                    	<img src="<?=chat_thumb($last_msg[$i]['img_path'],0,0)?>" alt="Image" style="max-width:150px; max-height:190px;">
                    </a>
                    
                <?php }  ?>
                
              </div> 
              
          	  <div style="height:0px;clear:both;overflow:hidden;"></div>
              
             <span class="notification-date">
             	<time class="entry-date updated" datetime="2004-07-24T18:18"><?=time_ago($last_msg[$i]['time_dt'])?></time> 
                	
                <time class="entry-date " datetime="">&nbsp;&nbsp;<a href="#" id="delete_chat_message" eid="<?=$last_msg[$i]['id']?>">Delete</a></time> 
                    
                </span> 
              
             	
          </div>
          
        </li>
        
       <?php } ?> 
    
      </ul>
      

      
    </div>
    
    <form id="chat-frm-<?=$member['usercode']?>" enctype="multipart/form-data">
    
        <div class="form-group label-floating1">
        
        <input type="hidden" name="id" value="<?=$member['usercode']?>">
        
        <div class="process_msg dis_none" id="process-<?=$member['usercode']?>"><img class="" src="<?=asset_sm('loader.gif')?>"></div>
        
        <textarea class="form-control chat_msg_box_txt" id="chat_msg_box_<?=$member['usercode']?>" memcode="<?=$member['usercode']?>"  name="chat_msg_box" value="" placeholder="type a message..."></textarea>
        
        <?php /*?> onKeyDown="if(event.keyCode == 13) {return postChat(<?=$member['usercode']?>)}" <?php */?>
        
        <div class="add-options-message"> 
        
        <a href="#" class="options-message" id="chatimgIcon" memcode="<?=$member['usercode']?>">
        
        	<?php /*?> onClick="return chatimgIcon(<?=$member['usercode']?>);"<?php */?> 
            
            <svg class="olymp-computer-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-computer-icon"></use></svg> 
           
        </a>
        
        <input type="file" class="chat_img1" memcode="<?=$member['usercode']?>" name="chat_img" id="chat-img-<?=$member['usercode']?>" style="display:none;"> 
        
        <?php /*?>onChange="chat_image_select(this, <?=$member['usercode']?>);"<?php */?>
        
        </div>
        
        <span class="material-input"></span>
        
        </div>
        
    </form>
    
  </div>
  
</div>
