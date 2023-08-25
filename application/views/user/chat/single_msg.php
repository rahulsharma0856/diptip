
<?php for($i=0;$i<count($result);$i++){ ?>

 <li class="<?=(user_session('usercode')==$result[$i]['user_1']) ? "msg_by_self" : "msg_by_friend"?>" id="chat-message-<?=$result[$i]['id']?>" data-message-id="<?=$result[$i]['id']?>">

  <div class="author-thumb"> <img src="<?=thumb(ProfileImg($result[$i]['profile_img']),50,50)?>" alt="author" width="34"> </div>
  
  <div class="notification-event"> 
  
      <div style="min-width:130px;">
            
              	 <?php if($result[$i]['type']=='message'){ ?>
                
              		<span class="chat-message-item"><?=filter_message($result[$i]['msg'])?> </span>   
                
              	<?php } else { ?>
                	
                    <?php
                        $imgPath = $result[$i]['img_path'];
                        $imgPath = base_url() . 'upload/chat/' . basename($imgPath);
                    ?>
                    
                    <a href="<?=$imgPath?>" title="View Image Attachment" target="_blank">
                    	<img src="<?=chat_thumb($result[$i]['img_path'],0,0)?>" alt="Image" style="max-width:150px; max-height:190px;">
                    </a>
                    
                <?php }  ?>
              
              </div> 
              
          	  <div style="height:0px;clear:both;overflow:hidden;"></div>
      
      <span class="notification-date">
      
      	<time class="entry-date updated" datetime="2004-07-24T18:18"><?=time_ago($result[$i]['time_dt'])?></time>
        
         <time class="entry-date " datetime="">&nbsp;&nbsp;<a href="#" id="delete_chat_message" eid="<?=$result[$i]['id']?>">Delete</a></time> 
        
        </span> 
  
  </div>
  
</li>

<?php } ?>
        
      	