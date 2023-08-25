<?php if(isset($member)){ ?>

<li id="req_div" style="padding: 13px 10px !important;">
  <div class="author-thumb"> <img src="<?=thumb($member['profile_img'],150,150)?>" alt="author" style="width:34px;height:34px;"> </div>
  <div class="notification-event" style="padding-left:1px;"> <a href="<?=file_path('profile/timeline/'.$member['username'])?>" class="h6 notification-friend">
    <?=$member['name']?>
    </a> 
    
    <!--<span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>--> </div>
  <span class="notification-icon"> 
  
  <a href="#" class="accept-request" id="accept_req" value="<?=$member['user_1']?>"> 
  <span class="icon-add without-text"><svg class="olymp-happy-face-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-face-icon"></use></svg> </span> 
  </a> 
  
  <a href="#" class="accept-request request-del" id="delete_req" value="<?=$member['user_1']?>"> 
  <span class="icon-minus"> <svg class="olymp-happy-face-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-face-icon"></use></svg> </span> 
  </a>
  
  </span> 
  
  </li>
<?php } ?>
