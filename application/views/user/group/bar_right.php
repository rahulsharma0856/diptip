<!-- Right Sidebar -->

<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <?php if(count($MyGroup) > 0) { ?>
  
  <?php /*?><div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">MY GROUP</h6>
    </div>
    <ul class="widget w-friend-pages-added notification-list friend-requests">
      <?php for($i=0;$i<count($MyGroup);$i++){?>
      <li class="inline-items">
        <div class="author-thumb"> <img src="<?=thumb($MyGroup[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
        <div class="notification-event"> <a href="<?=file_path('group/view/'.$MyGroup[$i]['id'])?>" class="h6 notification-friend">
          <?=$MyGroup[$i]['title']?>
          </a> <span class="chat-message-item">
          <?=$MyGroup[$i]['group_privacy']?>
          Group </span> </div>
      </li>
      <?php } ?>
    </ul>
  </div><?php */?>
  
  <?php } ?>
 
  
  <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">JOINED GROUPS</h6>
        </div>
        <ul class="widget w-friend-pages-added notification-list friend-requests">
          <?php for($i=0;$i<count($JoinedGroups);$i++){?>
          <li class="inline-items">
            <div class="author-thumb"> <img src="<?=thumb($JoinedGroups[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
            <div class="notification-event"> <a href="<?=file_path('group/view/'.$JoinedGroups[$i]['id'])?>" class="h6 notification-friend">
              <?=$JoinedGroups[$i]['title']?>
              </a> <span class="chat-message-item">
             <?=$MyGroup[$i]['group_privacy']?> Group
              </span> </div>
          </li>
          <?php } ?>
        </ul>
  </div>
  <div class="sticky_area">
  <?php if($isGroupJoined || $isPageAdmin){ ?>
  
   <div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">Invite</h6>
    </div>
    
    <div class="ui-block-content"> 
      
      <!------------->
      <div class="widget w-socials">
       <a href="<?=file_path('invite_friends/invite/'.$result[0]['id'])?>" class="btn btn-green btn-sm popup-modal">Invite Friends</a>
      </div>
    </div>
    
  </div>
  
  <?php } ?>
  
  
  <?php $this->load->view('user/term_privacy_link');?>
  
  
  </div>
  
</div>

<!-- ... end Right Sidebar -->