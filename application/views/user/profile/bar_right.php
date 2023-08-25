
<?php $user_login  =  user_session('usercode');?>
<!-- Right Sidebar -->

<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
	
        <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">About Me
                <span class="pull-right">
                     <?php	if($user_login==$member['usercode']){?>
                        <a href="<?=file_path('profile/edit_profile/')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                     <?php }?>
                </span>
            </h6>
        </div>
        <div class="ui-block-content">
            <ul class="widget w-personal-info item-block">
            
            <?php if($member['about_desc']!='') {?>
                <li>
                    <!--<span class="title">About Me:</span>-->
                    <span class="text"><?=filter_message($member['about_desc'])?></span>
                </li>
                <?php } ?>
              
            </ul>
    
            
        </div>
    </div>
    
     
	  <?php	if($user_login==$member['usercode']){?>          
        <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Liked Pages <span><a href="<?=file_path('page/likedpages')?>" class="hm_see_all">See All</a></span></h6>
        </div>
        <ul class="widget w-friend-pages-added notification-list friend-requests">
          <?php for($i=0;$i<count($MemberLikedPages);$i++){?>
          <li class="inline-items">
            <div class="author-thumb"> <img src="<?=thumb($MemberLikedPages[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
            <div class="notification-event"> <a href="<?=file_path('page/view/'.$MemberLikedPages[$i]['id'])?>" class="h6 notification-friend">
              <?=$MemberLikedPages[$i]['title']?>
              </a> <span class="chat-message-item">
              <?=$MemberLikedPages[$i]['cat_name']?>
              </span> </div>
          </li>
          <?php } ?>
        </ul>
      </div>
      <?php }?>
       <div class="sticky_area_timeline"> 	
       <?php	if($user_login==$member['usercode']){?>
        <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Groups <span><a href="<?=file_path('group/mygroups')?>" class="hm_see_all">See All</a></span></h6>
        </div>
        <ul class="widget w-friend-pages-added notification-list friend-requests">
          <?php for($i=0;$i<count($myGroups);$i++){?>
          <li class="inline-items">
            <div class="author-thumb"> <img src="<?=thumb($myGroups[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
            <div class="notification-event"> <a href="<?=file_path('group/view/'.$myGroups[$i]['id'])?>" class="h6 notification-friend">
              <?=$myGroups[$i]['name']?>
              </a> <span class="chat-message-item">
              <?=$myGroups[$i]['group_privacy']?>
              Group (Post :
              <?=$myGroups[$i]['group_posts']?>
              )</span> </div>
          </li>
          <?php } ?>
        </ul>
      </div>
       <?php }?>
       
        <?php $this->load->view('user/term_privacy_link');?>
       
    </div>   
</div>

<!-- ... end Right Sidebar -->