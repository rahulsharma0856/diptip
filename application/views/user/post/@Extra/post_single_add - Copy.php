


<div class="ui-block">
  <article class="hentry post has-post-thumbnail">
	
   	
    
   <!----Top Detail----> 
   
    <div class="post__author author vcard inline-items"> 
      
     
            	<img src="<?=thumb($result['detail']['r_profile_img'],100,100)?>" alt="author">
    
                <div class="author-date"> 
                
                <?php if($result['post_category']=='group') { ?>
                
                    <a class="h6 post__author-name fn 2" href="<?=file_path('profile/view/'.$result['detail']['r_post_by_url'])?>"><?=$result['detail']['r_post_by']?></a>  
                    
                     <?php if($section!='group'){ ?>
                    
                            &nbsp;&nbsp; <i class="fa fa-chevron-right"></i>&nbsp;&nbsp;  
                            
                            <a class="h6 post__author-name fn 1" href="<?=file_path('group/view/'.$result['group_page_id'])?>"><?=$result['gp_name']?></a>
                    
                    <?php } ?>
                    
                  
                
                <?php } else { ?>
                
                	<a class="h6 post__author-name fn 3" href="<?=$result['r_post_by_url']?>"><?=$result['detail']['r_post_by']?></a> 
                
                <?php } ?>
                
                
               
                
                <div class="post__date">
                
                <time class="published" datetime="2004-07-24T18:18"> <?=time_ago($result['time_dt'])?></time>
                
                </div>
                
                </div>
            
   
      
      
      
      
      
      <?php if($result['add_by']==user_session('usercode')) { ?>
      
      <!----Top Right Side Icon---->
      
      <div class="more">
      
	  <svg class="olymp-three-dots-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use></svg>
      
        <ul class="more-dropdown">
        
          <li> <a href="#">Edit Post</a> </li>
          
          <li> <a href="#">Delete Post</a> </li>
          
        </ul>
        
      </div>
      
      <?php } ?>
      
    </div>
    
    <p><?=$result['post_text']?></p>
      	
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
                                        
                                            <span class="h2">+<?=$imagesCount -  5?></span>
                                        
                                         <?php } ?>
                                     
                                    </a>
                            
                        <?php }  ?>

                    </div>
                    
                    
        <?php } ?>
       
       <?php if($result['video_upload']!=''){ ?>
       
            <video style="width:100%;" controls>
            
                <source src="<?=base_url('upload/social_media/post/video/'.$result['video_upload'])?>" type="video/mp4">
                
                <source src="mov_bbb.ogg" type="video/ogg">
                
                Your browser does not support HTML5 video.
            
            </video>
      	
        <?php } ?>
        
        <?php if($result['video_share']!=''){ ?>
        			
              	<?php 
				
				if(preg_match('/youtube/',$result['video_share'])){
				
					$youtube=true;
					
					if (!preg_match('/embed/',$result['video_share'])){
					
						$youtube_key 	= 	explode("?v=", $result['video_share']);
						
						$youtube_key	= 	$youtube_key[1];
					
					}else{
					
						$youtube_key 	= 	explode("/", $result['video_share']);
						
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
					
					}
				
				}
				?>
 				
                <?php if($youtube==true) { ?>
                 	<iframe  width="100%" height="315" src="https://www.youtube.com/embed/<?=$youtube_key?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <?php } ?>
                
                <?php if(preg_match('/vimeo/',$result['video_share'])){ ?>
                	<iframe  width="100%" height="315" src="<?=$result['video_share']?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <?php } ?>
                
            
           
                    
        <?php } ?>
        
        <!-----Post summary------>
        
        
        <?php 
		
	
			$summary = $this->Post_model->postCountLikesCommentShare($result['post_id']);
			
		
		?>
        
        <div class="post-additional-info inline-items"> 
        	
           	<?php if((int)$summary['is_like'] > 0) {?>
            	
                <span><a href="#" class="post-add-icon inline-items" id="do_unlike_post" value="<?=$result['post_id']?>"> <i class="fa fa-heart"></i> <span><?=$summary['total_likes']?> Like</span></a></span>
                
            <?php } else { ?>
            	
                <span><a href="#" class="post-add-icon inline-items" id="do_like_post" value="<?=$result['post_id']?>"> <i class="fa fa-heart-o fa fa-heart"></i> <span><?=$summary['total_likes']?> Like</span></a></span>
                
            <?php } ?>
            
            
           
            <div class="comments-shared"> 
            
                <span><a href="#" class="post-add-icon inline-items"> <svg class="olymp-speech-balloon-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-speech-balloon-icon"></use></svg> <span><?=$summary['total_comments']?> Comment</span> </a> </span>
                
                <span><a href="#" class="post-add-icon inline-items post_share_link"  value="<?=$result['post_id']?>"> <svg class="olymp-share-icon"> <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-share-icon"></use></svg> <span><?=$summary['total_share']?> Share</span>  </a></span> 
            
            </div>
        
        </div>
    
    
    	<!-----Post opration------>
        
        
      
      
  </article>
  
  
  <?php  $comments =  $this->Comment_model->getPostComments($result['post_id'],0);?>
  
  			
            <?php if((int)$summary['total_comments'] > 3) {?>
            
  				<a href="#" class="more-comments" id="load_more_comment" value="<?=$result['post_id']?>">View more comments <span>+</span></a>
            
  			<?php } ?>
            
                <ul class="comments-list" id="post_comments_list<?=$result['post_id']?>">
                		
				<?php for($i=0;$i<count($comments);$i++) {?>
                
                	<?php echo $this->load->view('user/post/view_single_comment',array('result'=>$comments[$i]),TRUE); ?>
                
                <?php } ?>
                        
                </ul>
                
                
  
  
    <form class="comment-form inline-items" method="post" id="post_comment_frm" style="border-top:none;">
    
    	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
    	
        <input type="hidden" name="id" value="<?=$result['post_id']?>">
    	
        <div class="post__author author vcard inline-items">
        
        	<img src="<?=thumb(user_session('profile_img'),150,150)?>" alt="author">
        
        </div>
        
        <div class="form-group with-icon-right is-empty">
        
        	<textarea class="form-control post_comment_box" id="pcomment" name="pcomment" placeholder="" onKeyUp="countChar(this)"></textarea>
            
        	<div class="add-options-message">
            
                <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                
                    <svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
                    
                </a>
                
        	</div>
            
        	<span class="material-input"></span></div>
        
        	<button class="btn btn-md-2 btn-primary">Post Comment</button>
            
            <img style="float:right;margin-top: 15px; margin-right: 15px;" class="loader dis_none" src="<?=asset_sm('loader.gif')?>">
            
    </form>
  
</div>
