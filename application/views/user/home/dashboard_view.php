
<style type="text/css">
	.star-ratings-css {
  unicode-bidi: bidi-override;
  color: #ffb932;
  font-size: 15px;
  height: 25px;
  width: 100px;
  margin: 0 auto;
  position: relative;
  padding: 0;
  /*text-shadow: 0px 1px 0 #a2a2a2;*/
  
  &-top {
    color: #e7711b;
    padding: 0;
    position: absolute;
    z-index: 1;
    display: block;
    top: 0;
    left: 0;
    overflow: hidden;
  }
  &-bottom {
    padding: 0;
    display: block;
    z-index: 0;
  }
  .star-span {
  	margin-left: 1px;
  }
}
</style>
<div class="header-spacer" style="height: 69px;"></div>

<div class="container" style="width:92% !important">

  <div class="row"> 
    
    <!-- Main Content -->
    
    <main class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
    
      <?php 
    
		$setting = array(
		
		'type' => 'member'
		
		);
		
    ?>
    
    	
        
		    
            
				<?php echo $this->load->view('user/post/post_form',array('setting'=>$setting),TRUE); ?>
                
      
      
      <div id="newsfeed-items-grid" class="post_item_section"></div>
      
      <a id="load-post-button" href="#" class="btn btn-control btn-more"> 
	  
	  <svg class="olymp-three-dots-icon">
      <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
      </svg> </a> 
      
      </main>
    
    <!-- ... end Main Content --> 
    
    <!-- Left Sidebar -->
    
    <aside class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
       <?php
		$ads_result = $this->Page_model->get_ads_banners('Home-Top-Left');
		if(isset($ads_result)){?>
		<div class="ui-block">
        <div class="widget w-wethear1">

          <div style="width:100% !important;height:250px !important; padding: 8%; text-align:center !important">


                	<img alt="author" src="<?=thumb(ProfileImg(user_session('profile_img')),100,100)?>" class="img-circle" style="border-width: 2px;
    border-color: black;
    border-style: solid;
    border-radius: 25%;
    padding: 0.5%;">
					


<br><br>

	<a href="<?=file_path('profile/view/'.user_session('username'))?>" class="author-name fn">
					<div class="author-title" style="font-size: 15px;
    font-weight: bold;
    color: #3e3d3d;">
						<?=user_session('name')?> 
					</div>
				</a>

<hr>

			<div class="author-title" style="font-size: 10px;
    font-weight: bold;
    color: #3e3d3d;">
						<?=filter_message($member['about_desc'])?> 
					</div>
		
		<div class="star-ratings-css">
			<div class="star-ratings-css-top">
			  	<span class="star-span"><i class="fa fa-star"></i></span>
			  	<span class="star-span"><i class="fa fa-star"></i></span>
			  	<span class="star-span"><i class="fa fa-star"></i></span>
			  	<span class="star-span"><i class="fa fa-star-o"></i></span>
			  	<span class="star-span"><i class="fa fa-star-o"></i></span>
			</div>
		</div>
		
		<!-- <img src="" style="width:100%;height:50px;" alt="Space For Stars">  -->

</div>



        </div>
      </div>
      <?php }?>
      
      <!-- <div class="sticky_area"> -->

        <?php if(isset($SuggestedFriends[0])) {  ?>
        
                <div class="ui-block">
                    <div class="ui-block-title">
                    	<h6 class="title">People You May Add</h6>
                    </div>
                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                    <?php for($i=0;$i<count($SuggestedFriends);$i++){?>
                    <?php if(isset($SuggestedFriends[$i]['id'])){ ?>
                        <li class="inline-items new_friend friend_request_sent<?=$i?>" id="<?=$i?>">
                        <div class="author-thumb"> <img src="<?=thumb(ProfileImg($SuggestedFriends[$i]['profile_img']),250,250)?>" alt="author" style="max-width:30px;"> </div>
                        <div class="notification-event"> 
                        	<a href="<?=file_path()?>profile/view/<?=$SuggestedFriends[$i]['username']?>" class="h6 notification-friend">
                        	<?=$SuggestedFriends[$i]['name']?>
                        	</a> <span class="chat-message-item">
                       		<a style="color:#00547b" href="<?=file_path()?>dashboard/getMutualFriendsList/<?=$SuggestedFriends[$i]['friend']?>" class="notifiction-popover"><?=$SuggestedFriends[$i]['mutual_friends']?> Mutual Friends </a>
                        	</span>
                        	<div style="display: inline-flex;">
	                        	<button id="friend_request_send<?=$i?>" value="<?=$SuggestedFriends[$i]['friend']?>" class="btn btn-green btn-sm" style="margin-bottom: unset;width: 100px;height: 25px;padding: 3px 0 0 0;font-size:unset;"><i class="fa fa-user-plus">&nbsp;</i>Add Friend</button>
	                        	<button id="friend_request_remove<?=$i?>" value="<?=$SuggestedFriends[$i]['friend']?>" class="btn btn-green btn-sm" style="margin-bottom: unset;width: 65px;height: 25px;padding: 3px 0 0 0;font-size:unset;margin-left: 5px;background-color: #f5f4f4!important;border: #bdbdbd 1px solid;color: #01547b;">Remove</button>
                        	</div> 
					   	
                        </div>
                        </li>
                    <?php } }?>
                    </ul>
                </div>
        
        <?php } ?>
        
      <!-- </div> -->

      <div class="sticky_area">

        <?php if(isset($RecentFriends[0])) {  ?>
        
                <div class="ui-block">
                    <div class="ui-block-title">
                    	<h6 class="title">Your Added People</h6>
                    </div>
                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                    <?php for($i=0;$i<count($RecentFriends);$i++){?>
                        <li class="inline-items">
                        <div class="author-thumb"> <img src="<?=thumb(ProfileImg($RecentFriends[$i]['profile_img']),250,250)?>" alt="author" style="max-width:30px;"> </div>
                        <div class="notification-event"> <a href="<?=file_path()?>profile/view/<?=$RecentFriends[$i]['username']?>" class="h6 notification-friend">
                        <?=$RecentFriends[$i]['name']?>
                        </a> <span class="chat-message-item">
                       	<!-- <a style="color:#00547b" href="<?=file_path()?>dashboard/getMutualFriendsList/<?=$RecentFriends[$i]['friend']?>" class="notifiction-popover"><?=$RecentFriends[$i]['mutual_friends']?> Mutual Friends </a> -->
                        </span> </div>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
        
        <?php } ?>
        
      </div>
    </aside>
    
    <!-- ... end Left Sidebar --> 
    
    <!-- Right Sidebar -->
    
    <aside class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
           <div class="ui-block">
          <div class="ui-block-title">
            <h6 class="title">You May Like Pages</h6>
          </div>
          <ul class="widget w-friend-pages-added notification-list friend-requests">
            <?php for($i=0;$i<count($PageSuggestion);$i++){?>
            <li class="inline-items">
              <div class="author-thumb"> <img src="<?=thumb(ProfileImg($PageSuggestion[$i]['profile_img']),250,250)?>" alt="author" style="max-width:30px;"> </div>
              <div class="notification-event"> <a href="<?=file_path()?>page/view/<?=$PageSuggestion[$i]['id']?>" class="h6 notification-friend">
                <?=$PageSuggestion[$i]['title']?>
                </a> <span class="chat-message-item">
                <?=$PageSuggestion[$i]['cat_name']?>
                </span> </div>
            </li>
            <?php } ?>
          </ul>
        </div>
        
     
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Your Liked Pages <span><a href="<?=file_path('page/mypages')?>" class="hm_see_all">See All</a></span></h6>
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
     
        <div class="ui-block">
          <div class="ui-block-title">
            <h6 class="title">Your Joined Groups <span><a href="<?=file_path('group/mygroups')?>" class="hm_see_all">See All</a></span></h6>
          </div>
          <ul class="widget w-friend-pages-added notification-list friend-requests">
            <?php for($i=0;$i<count($myGroups);$i++){?>
            <li class="inline-items">
              <div class="author-thumb"> <img src="<?=thumb($myGroups[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
              <div class="notification-event"> <a href="<?=file_path('group/view/'.$myGroups[$i]['id'])?>" class="h6 notification-friend">
                <?=filter_message($myGroups[$i]['name'])?>
                </a> <span class="chat-message-item">
                <?=$myGroups[$i]['group_privacy']?>
                Group</span> </div>
            </li>
            <?php } ?>
          </ul>
        </div>
        
      <div class="sticky_area"> 
        
        <?php
		$ads_result = $this->Page_model->get_ads_banners('Home-Bottom-Right');
		if(isset($ads_result)){?>
		  <div class="ui-block">
			<div class="widget"> <img src="<?=$ads_result['ad_img_path']?>" style="width:100%;height:350px;">  </div>
		  </div>
	   <?php }?>
        
         <?php $this->load->view('user/term_privacy_link');?>
        
      </div>
    </aside>
    <?php $this->load->view('user/load/share_dialog');?>
    
    <!-- ... end Right Sidebar --> 
    
  </div>
</div>
<script nonce=<?=SC_NONCE?>>
	
	$(document).on('click','#load-post-button',function(e){
		
		e.preventDefault();
		
		load_post();
		
	});
	
	function load_post(){
		
		var total_post  = $(".post_item_section > div.post-message").length;
		
		var ads_code_list = get_ads_code();
		
		var url='<?=file_path('dashboard/load_post')?>?s='+total_post+'&ads='+ads_code_list;
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(data){
				
				if(data['id']=='1'){
					
					$('#newsfeed-items-grid').append(data['html']);	
					
					$('#load-post-button').removeClass('dis_none');
					
				}else{
					
					$('#load-post-button').addClass('dis_none');
					
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
	
	}
	
	function get_ads_code(){
		
		var collection = $(".post-ads-cls");
		
		var ads_code_list = '';
		
		collection.each(function(element, index, set) {
			
			ads_code_list+= $(this).attr('post_ads_code')+',';
		
		});
		
		return ads_code_list;
		
	}
	
	
	function checkNewMessages() {
	
		//alert('HI');	
		var last = $(".post_item_section").children(":first").attr('data-id');
		
		var url='<?=file_path('dashboard/checkNewMessages')?>?last='+last;
	
		
		if (last !== undefined){
		
			$.ajax({
				
			url: url,
			
			dataType: "json",
			
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			
			success:function(obj){
				
			$.each( obj, function( key, value ) {
				
				console.log($("#"+key).length);
				
				if($("#"+key).length==0){
				
					$('#newsfeed-items-grid').prepend(value);
					
					$("#newsfeed-items-grid .post-message:first-child").hide();
					
					$("#newsfeed-items-grid .post-message:first-child").fadeIn();
				
				}
			
			});	
			
			},
			error: function( jqXHR, textStatus, errorThrown) {
			}
			});	
		
		}
		
	
		stopNewMessages = setTimeout(checkNewMessages, 10000);
		

	}
	
	
</script> 
<script nonce=<?=SC_NONCE?>>

	
	$(document).ready(function(e) {
	
        load_post();
	   
	    checkNewMessages();
		
	
	});

	$(document).ready(function() {
		$('.new_friend').each(function () {
			var val = $(this).attr('id');
			$('#friend_request_send'+val).click(function(e){
				var value = $(this).attr('value');
				var url = '<?=file_path('profile/friend_request_send')?>'+value;
				
				$.ajax({
				
					url : url,
					
					dataType : "json",
					
					success:function(result){
						
						if(result){
							$('.friend_request_sent'+val).hide();
						}
					
					},
					
					error: function( jqXHR, textStatus, errorThrown) {
						
						alert(textStatus);
						
					}
				});
			});

			$('#friend_request_remove'+val).click(function(e){
				$('.friend_request_sent'+val).hide();
			});
		});
	});	

</script> 
