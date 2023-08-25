<?php if($inner != 'only_inner') { ?>

<div class="ui-block post-message" id="post<?=$result['post_id']?>" data-id="<?=$result['post_id']?>">

  <?php } ?>
  
  <article class="hentry post has-post-thumbnail"> 
    
    <!----Top Detail---->
   
    <div class="post__author author vcard inline-items">
    	<img src="<?=thumb(ProfileImg($result['detail']['r_profile_img']),100,100)?>" alt="author" title="Post Author:  <?=$result['detail']['r_post_by']?>">
     	<?php /*?><img src="<?=thumb($result['detail']['r_profile_img'],100,100)?>" alt="author"><?php */?>
      <div class="author-date">
        <?php if($result['post_category']=='group') { ?>
        <a class="author_nm h6 post__author-name fn 2" href="<?=file_path('profile/view/'.$result['group_member_username'])?>" title="Post Author:  <?=$result['detail']['r_post_by']?>">
        <?=$result['detail']['r_post_by']?>
        </a>
        <?php if($section!='group'){ ?>
        &nbsp;&nbsp; <i class="fa fa-chevron-right"></i>&nbsp;&nbsp; <a class="h6 post__author-name fn 1" href="<?=file_path('group/view/'.$result['group_page_id'])?>">
        <?=$result['gp_name']?>
        </a>
        <?php } ?>
        <?php }  else { ?>
        <a class="author_nm h6 post__author-name fn 2" href="<?=$result['detail']['r_post_by_url']?>" title="Post Author:  <?=$result['detail']['r_post_by']?>">
        <?=$result['detail']['r_post_by']?>
        </a>
        <?php } ?>
        <span style="color:#6c6c6d"> shared a </span><a style="color:#00547b" href="<?=file_path('dashboard/post/'.$result['post_id'])?>" title="View Original Post">Post</a>
        <div class="post__date">
          <time class="published"> <a class="post_time" href="<?=file_path('dashboard/post/'.$result['post_id'])?>">
            <?=time_ago($result['time_dt'])?>
            </a> </time>
        </div>
      </div>
      <?php if($result['added_by']==user_session('usercode')) { ?>
      
      <!----Top Right Side Icon---->
      
      <div class="more"> <svg class="olymp-three-dots-icon">
        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
        </svg>
        <ul class="more-dropdown">
          <li> <a class="popup-modal" href="<?=file_path('post/edit_post/'.$result['post_id'])?>">Edit Post</a> </li>
          <li> <a id="delete_post"  href="<?=file_path('post/delete_post/'.$result['post_id'])?>">Delete Post</a> </li>
        </ul>
      </div>
      <?php } ?>
    </div>
        <span style="color:#000; word-wrap: break-word;">
            
           <?=filter_post($result['share_txt'])?>
                
        </span>

   		<?php  if($result['share_url']!=""){ ?>
        
        <?php $share_url_info = json_decode(trim($result['share_url_info']),true); ?>
        
        <a href="<?=$result['share_url']?>" target="_blank">
        
        <p style="margin: 5px 0px;color:#888da8;word-break: break-word;"><?=$result['share_url']?></p>
        
        <img src="<?=$share_url_info['image']?>" alt="photo" style="width:100%;">
        
        <div style="background-color:#f2f3f5;padding:10px;color:#888da8;">
        
        <p style="margin: 0px;font-weight: bold;color:#888da8;word-break: break-word;"><?=$share_url_info['title']?></p>
        
        <p style="margin: 7px 0px;color:#888da8;word-break: break-word;"><?=$share_url_info['description']?></p>
        
        </div>
        
        </a>
        
        <?php } ?>
    
    
    
    <?php  $shared = $result['share_detail']; ?>
    
    <!------------>
    <?php $images = $result['image']; ?>
    <?php $imagesCount = count($result['image']); ?>
    <?php $imageShowCount = ($imagesCount > 5) ? 5 : $imagesCount ; ?>
    <?php if(count($images) > 0) { ?>
    <?php $ImageClass =  getPostImageClass($imagesCount); ?>
    <div class="post-block-photo js-zoom-gallery">
      <?php for($i=0; $i<$imageShowCount; $i++){ ?>
      <?php $imageNumber = $i + 1; ?>
      <?php $Image_size = explode('-',$ImageClass['size'][$i]) ?>
      <a href="<?=thumb($images[$i]['image_path'],0,0)?>" class="<?=$ImageClass['class'][$i]?>"><img src="<?=thumb($images[$i]['image_path'],$Image_size[0],$Image_size[1])?>" alt="photo">
      <?php if($imageNumber == 5 && $imagesCount > 5 ) { ?>
      <span class="h2">+
      <?=$imagesCount -  5?>
      </span>
      <?php } ?>
      </a>
      <?php }  ?>
    </div>
    <?php } ?>
    <?php if($result['video_upload']!=''){ ?>
    <video style="width:100%;" controls>
      <source src="<?=base_url('upload/video/'.$result['video_upload'])?>" type="video/mp4">
      <source src="mov_bbb.ogg" type="video/ogg">
      Your browser does not support HTML5 video. </video>
    <?php } ?>
    <?php if($result['video_share']!=''){ ?>
    <?php 
				
				// https://www.youtube.com/watch?v=LzseUKw2OMs
				
				// https://youtu.be/LzseUKw2OMs
				
				
				if(preg_match('/youtube|youtu.be/',$result['video_share'])){
				
					$youtube=true;
					
					if (!preg_match('/embed/',$result['video_share'])){
					
						$youtube_key 	= 	explode("?v=", $result['video_share']);
						
						$youtube_key	= 	$youtube_key[1];
					
					}else{
					
						$youtube_key 	= 	explode("/", $result['video_share']);
						
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
					
					}
					
					if(preg_match('/youtu.be/',$result['video_share'])){
					
						$youtube_key 	= 	explode("/", $result['video_share']);
							
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
						
					}
					
				}
				
				
				?>
    <?php if($youtube==true) {?>
    <iframe  width="100%" height="315" src="https://www.youtube.com/embed/<?=$youtube_key?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <?php } ?>
    <?php if(preg_match('/vimeo/',$result['video_share'])){ ?>
    <iframe  width="100%" height="315" src="<?=$result['video_share']?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    <?php } ?>
    <?php } ?>
    <?php
   
   	$CountPostTaggedMember = $this->Post_model->getCountPostTaggedMember($shared['post_id']);
	
	
	
	if($CountPostTaggedMember > 0){
		
		$PostTaggedMember = $this->Post_model->getPostTaggedMember($shared['post_id'],1);
		
		
		if($CountPostTaggedMember == 1){
			
			$tagHtml = 'is with <a href="'.file_path('profile/view/'.$PostTaggedMember[0]['username']).'" class="theme-txt1">'.$PostTaggedMember[0]['name'].'</a>';
			
		}else{
			
			$otherMemberCount = $CountPostTaggedMember - 1;
			
			$tagHtml = 'is with <a href="#" class="theme-txt1">'.$PostTaggedMember[0]['name'].'</a> and <a class="notifiction-popover theme-txt1" data-placement="bottom" href="'.file_path('tag/taggedmembertist/'.$shared['post_id']).'">'.$otherMemberCount.' other </a>';
		
		}
		
		
	}
   	
   ?>
   
    
    
     <?php if($result['is_ads']=='0'){ ?>
     	
                <ul class="children single-children">
                
               		 <li>
                
                <div class="post__author author vcard inline-items"> 
                
                <?php   /*?> <img src="<?=thumb($shared['detail']['r_profile_img'],100,100)?>" alt="author"><?php */?>
                
                <img src="<?=thumb(ProfileImg($shared['detail']['r_profile_img']),100,100)?>" alt="author1" title="Share Author:  <?=$result['detail']['r_post_by']?>">
                
                <div class="author-date">
                
                <?php if($shared['post_category']=='group'){ ?>
                
                <a class="h6 post__author-name fn" href="<?=file_path('profile/view/'.$shared['group_member_username'])?>" title="Share Author:  <?=$result['detail']['r_post_by']?>">
                
                <?=$shared['detail']['r_post_by']?>
                
                </a> &nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp; <a class="h6 post__author-name fn" href="<?=file_path('group/view/'.$shared['group_page_id'])?>" title="Share Author:  <?=$result['detail']['r_post_by']?>">
                <?=$shared['gp_title']?>
                </a>
                <?=$tagHtml?>
                <?php } elseif($shared['post_category']=='page'){ ?>
                <a class="h6 post__author-name fn" href="<?=$shared['detail']['r_post_by_url']?>">
                <?=$shared['detail']['r_post_by']?>
                </a>
                <?php } elseif($shared['post_category']=='tag') { ?>
                <a class="h6 post__author-name fn" href="<?=$shared['detail']['r_post_by_url']?>">
                <?=$shared['detail']['r_post_by']?>
                </a> &nbsp;&nbsp; <i class="fa fa-chevron-right"></i>&nbsp;&nbsp; <a class="author_nm h6 post__author-name fn 3" href="<?=$shared['detail']['r_post_by']?>">
                <?=$shared['detail']['tag_to']?>
                </a>
                <?php }else{ ?>
                <a class="h6 post__author-name fn" href="<?=$shared['detail']['r_post_by_url']?>">
                <?=$shared['detail']['r_post_by']?>
                </a>
                <?=$tagHtml?>
                <?php } ?>
                <div class="post__date">
                <time class="published"> <a class="post_time" href="<?=file_path('dashboard/post/'.$result['post_id'])?>">
                <?=time_ago($shared['time_dt'])?>
                </a> </time>
                </div>
                </div>
                </div>
                <span style="color:#000; word-wrap: break-word;">
                
                    <?=filter_post($shared['post_text'])?>
                    
                </span>
                
                </p>
                </li>
                
                </ul>
        
        
     <?php } else { ?>
     		
                 <ul class="children single-children" style="background-color:#DDF9DB;padding-bottom:5px;">
                
                	<?php echo $this->load->view('user/post/ads_share_view',array('result'=>$result),TRUE); ?>
                
                 </ul>
            
     <?php } ?>
    <!------------> 
    
    <!-----Post summary------>
    
    <?php 
		
	
			$summary = $this->Post_model->postCountLikesCommentShare($result['post_id']);
			
		
		?>
    <div class="post-additional-info inline-items">
    
      <?php if((int)$summary['is_like'] > 0) {?>
      
            <span class="post_do_like" id="sp_po_like<?=$result['post_id']?>"> 
                
                <span><a href="#" class="post-add-icon inline-items" id="do_unlike_post" value="<?=$result['post_id']?>" title="Unlike Post"> <i class="fa fa-heart"></i></a> </span> 
                
                <span>
                
                	<a href="<?=file_path('dashboard/getWhoPostLikesMember/'.$result['post_id'])?>" class="who-likes-popover post-add-icon like-post-<?=$result['post_id']?>" id="who-likes-popover">
                    <?php if ($summary['total_likes'] == 1) {?>
                        <?=$summary['total_likes']?> Like
                    <?php } else {?>
                        <?=$summary['total_likes']?> Likes
                    <?php }?>
                    
                </span> 
                
            </span>
      
      <?php } else { ?>
      
            <span class="post_do_like" id="sp_po_like<?=$result['post_id']?>"> 
                
                <span><a href="#" class="post-add-icon inline-items" id="do_like_post" value="<?=$result['post_id']?>" title="Like Post"> <i class="fa fa-heart-o fa fa-heart"></i> </a> </span> 
                
                <span>
                    <a href="<?=file_path('dashboard/getWhoPostLikesMember/'.$result['post_id'])?>" class="who-likes-popover post-add-icon like-post-<?=$result['post_id']?>" id="who-likes-popover">
                    <?php if ($summary['total_likes'] == 1) {?>
                        <?=$summary['total_likes']?> Like
                    <?php } else {?>
                        <?=$summary['total_likes']?> Likes
                    <?php }?>
                </span>
                
            </span>
      
      <?php } ?>
      
      <div class="comments-shared" style="margin-top: 0px;"> <span><a id="btn_post_comment" value="<?=$result['post_id']?>" href="#" class="post-add-icon inline-items"> 
	  
	            <svg class="olymp-speech-balloon-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-speech-balloon-icon"></use></svg>
	  
		 <span class="total_comments">
        <?=$summary['total_comments']?>
        <?php if($summary['total_comments'] != 1) {?>Comments<?php } else {?>Comment<?php }?></span> </a> </span> 
        
        <span class="more"> <span class="post-add-icon inline-items"> <svg class="olymp-share-icon">
        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-share-icon"></use>
        </svg>
        <?=$summary['total_share']?>
        <?php if($summary['total_share'] != 1) {?>Shares<?php } else {?>Share<?php }?>
        <ul class="more-dropdown">
          <li><a class="share_post_link" href="<?=file_path('post/share_popup/'.$result['post_id'].'/member')?>" value="1">Share on your timeline</a> </li>
         
        </ul>
        </span> </span>
        <?php /*?> <span>
                
                <a href="#" class="post-add-icon inline-items post_share_link"  value="<?=$result['post_id']?>"> <svg class="olymp-share-icon"> <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-share-icon"></use></svg> 
                
                <span><?=$summary['total_share']?> Share</span>  </a>
                
                </span> <?php */?>
      </div>
    </div>
    
    <!-----Post opration------> 
    
  </article>
  <?php  $comments =  $this->Comment_model->getPostComments($result['post_id'],0);?>
  <div id="post_bottom_<?=$result['post_id']?>">
    <?php if((int)$summary['total_comments'] > 3) {?>
    <a href="#" class="more-comments" id="load_more_comment" value="<?=$result['post_id']?>">View more comments <span>+</span></a>
    <?php } ?>
    <ul class="comments-list" id="post_comments_list<?=$result['post_id']?>">
      <?php for($i=0;$i<count($comments);$i++) {?>
      <?php echo $this->load->view('user/post/view_single_comment',array('result'=>$comments[$i]),TRUE); ?>
      <?php } ?>
    </ul>
    <form class="comment-form inline-items" method="post" id="post_comment_frm" style="border-top:none;border-top:none;padding: 10px 25px 10px 25px;">
      <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
      <input type="hidden" name="id" value="<?=$result['post_id']?>">
      <div class="post__author author vcard inline-items"> 
      <img src="<?=thumb(ProfileImg(user_session('profile_img')),150,150)?>" alt="author"> 
      <?php /*?><img src="<?=thumb(ProfileImg($shared['detail']['r_profile_img']),100,100)?>" alt="author 1"><?php */?>
      </div>
      <div class="form-group with-icon-right is-empty">
        <textarea placeholder="Write a comment..." style="height: 35px;min-height: 35px;overflow: hidden;padding: 5px;" class="form-control post_comment_box" id="pcomment" name="pcomment"></textarea>
        <div class="add-options-message"> <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo"> <svg class="olymp-camera-icon">
          <use xlink:href="icons/icons.svg#olymp-camera-icon"></use>
          </svg> </a> </div>
        <span class="material-input"></span></div>
      <?php /*?><button style="margin-top:10px;padding: 5px;margin-right: 10px;" class="btn btn-md-2 btn-primary">Comment</button>
            
            <img style="float:right;margin-top: 15px; margin-right: 15px;" class="loader dis_none" src="<?=asset_sm('loader.gif')?>"><?php */?>
    </form>
  </div>
  <?php if($inner != 'only_inner') { ?>
</div>
<?php } ?>


<style>
.post-additional-info > * {
    margin-right: 0px!important;
}
</style>