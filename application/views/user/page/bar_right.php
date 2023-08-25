<!-- Right Sidebar -->

<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
  
  <?php /*?><div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">My Pages</h6>
    </div>
    <ul class="widget w-friend-pages-added notification-list friend-requests">
      <?php for($i=0;$i<count($MyPages);$i++){?>
      <li class="inline-items">
        <div class="author-thumb"> <img src="<?=thumb($MyPages[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
        <div class="notification-event"> <a href="<?=file_path('page/view/'.$MyPages[$i]['id'])?>" class="h6 notification-friend">
          <?=$MyPages[$i]['title']?>
          </a> <span class="chat-message-item">
          <?=$MyPages[$i]['cat_name']?>
          </span> </div>
      </li>
      <?php } ?>
    </ul>
  </div><?php */?>
 
  
   <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Liked Pages</h6>
        </div>
        <ul class="widget w-friend-pages-added notification-list friend-requests">
          <?php for($i=0;$i<count($MemberLikedPages);$i++){?>
          <li class="inline-items">
            <div class="author-thumb"> <img src="<?=thumb($MemberLikedPages[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
            <div class="notification-event"> <a href="<?=file_path('page/view/'.$MemberLikedPages[$i]['id'])?>" class="h6 notification-friend">
              <?=filter_message($MemberLikedPages[$i]['title'])?>
              </a> <span class="chat-message-item">
              <?=$MemberLikedPages[$i]['cat_name']?>
              </span> </div>
          </li>
          <?php } ?>
        </ul>
      </div>
      
   <div class="sticky_area">    
      
      <?php if($isPagelike || $isPageAdmin){ ?>
      
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