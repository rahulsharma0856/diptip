<?php if($inner != 'only_inner') { ?>

<div class="ui-block post-ads-cls" id="post<?=$result['post_id']?>" data-id="<?=$result['post_id']?>" post_ads_code = "<?=$result['id']?>" style="border: 1px solid #DDF9DB!important;border-radius: 2px;">

<?php } ?>
  <article class="hentry post has-post-thumbnail" style="background-color:#DDF9DB;">
	
   
 
   <!----Top Detail----> 
   
  
   
    <div class="post__author author vcard inline-items"> 
      			
                <div class="author-date"> 
            
                <a class="author_nm h6 post__author-name fn 3" href="<?=$result['url']?>" target="_blank" style="color: #fff !important;background: #47A247;padding: 5px 10px;"><?=$result['title']?></a> 
                         
                </div>
    </div>
    
    
   
		<?php
		
		if(preg_match('/iframe/',$result['description'])){
				
			$input_text = '<pre style="white-space: pre-wrap;font-size: 14px;color: #000;">'.htmlspecialchars($result['description']).'</pre>';
			
		}
		else
		{
			 $input_text = nl2br($result['description']);
		}
		
        
        ?>
    
    	
        <p style="color:#000;word-break: break-word;">
        
       		<?= getUrls($input_text)?>
        
        </p>
         
         
      
      
        
 
     
		<?php if($result['ad_img']!='') { ?>
       
            <div class="post-block-photo js-zoom-gallery">
            
            	<a href="<?=base_url('upload/ads/'.$result['ad_img'])?>" class="noclass" style="width:100%;"><img src="<?=base_url('upload/ads/'.$result['ad_img'])?>" alt="photo" style="width:100%;"></a>
            
            </div>
       
        <?php } ?>
        
       

        
        <?php if($result['ad_video']!=''){ ?>
        			
              	<?php 
				
				if(preg_match('/youtube|youtu.be/',$result['ad_video'])){ 
					
					$youtube=true;
					
					if (!preg_match('/embed/',$result['ad_video'])){
					
						$youtube_key 	= 	explode("?v=", $result['ad_video']);
						
						$youtube_key	= 	$youtube_key[1];
					
					}else{
					
						$youtube_key 	= 	explode("/", $result['ad_video']);
						
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
					
					}
					
					if(preg_match('/youtu.be/',$result['ad_video'])){
					
						$youtube_key 	= 	explode("/", $result['ad_video']);
							
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
						
					}
					
				}
				?>
 				
                <?php if($youtube==true) { ?>
                 	<iframe  width="100%" height="315" src="https://www.youtube.com/embed/<?=$youtube_key?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <?php } ?>
                
                <?php if(preg_match('/vimeo/',$result['ad_video'])){ ?>
                	<iframe  width="100%" height="315" src="<?=$result['ad_video']?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <?php } ?>
                
            
           
                    
        <?php } ?>
        
        <!-----Post summary------>
        
        
        <?php 
		
	
			$summary = $this->Post_model->postCountLikesCommentShare($result['post_id']);
			
		
		?>
        
        <div class="post-additional-info inline-items"> 
        	
           	<?php if((int)$summary['is_like'] > 0) {?>
            	
                <span class="post_do_like" id="sp_po_like<?=$result['post_id']?>">
                
                	<span>
                    
                        <span href="" class="post-add-icon inline-items" id="ads_liked" value="<?=$result['post_id']?>"> 
                        
                            <i class="fa fa-heart"></i> 
                            
                        </span>
                        
                    </span>
                    
                    <span>
						<a href="#" class="post-add-icon" id=""> 
                        
							<?=$summary['total_likes']?> Like
                            
                        </a>
                   </span>
               </span>
                
            <?php } else { ?>
            	
                <span class="post_do_like" id="sp_po_like<?=$result['post_id']?>">
                
                	<span>
                    
                    	<a href="#" class="post-add-icon inline-items" id="do_like_ads" Acode="<?=$result['post_id']?>" value="<?=file_path('ads/do_like_ads/'.$result['id'])?>"><i class="fa fa-heart-o fa fa-heart"></i></a> 
                        
                    </span>
                    
					<span>
                        <a href="" class="who-likes-popover post-add-icon like-post-<?=$result['post_id']?>" id="who-likes-popover"> 
                         	<?=$summary['total_likes']?> Like 
                        </a>    
                    </span>
                </span>
                
            <?php } ?>
            
            
           
            <div class="comments-shared"> 
            
                <span><a href="#" id="btn_post_comment" value="<?=$result['post_id']?>" class="post-add-icon inline-items"> <svg class="olymp-speech-balloon-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-speech-balloon-icon"></use></svg> 
                
                <span><span class="total_comments" id="total_post_total_comments_<?=$result['post_id']?>"><?=$summary['total_comments']?></span> Comment</span> </a> </span>
                
                 <span class="more">
                
                    <span class="post-add-icon inline-items">
                    
                    <svg class="olymp-share-icon"> <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-share-icon"></use></svg>  <?=$summary['total_share']?> Share
                    
                        <ul class="more-dropdown">
                        
                            <li><a class="share_post_link" href="<?=file_path('post/share_popup/'.$result['post_id'].'/member')?>" value="1">Share on your timeline</a> </li>
                            
                        </ul>
                    
                    </span>
                
                </span>
            
            </div>
        
        </div>
    
    
    	<!-----Post opration------>
        
        
      
      
  </article>
  
  		
        
        <?php
        	
				if(isset($_GET['comment_id'])){
					
					$cmt =  $this->Comment_model->getCommentById($_GET['comment_id']);
					
					if($cmt['comment_id']=='0'){
						
						$comments =  $this->Comment_model->getPostCommentsPerticuler($result['post_id'],$_GET['comment_id']);				
						
					}else{
					
						$comments =  $this->Comment_model->getPostPerticulerCommentById($result['post_id'], $cmt['comment_id']);		
						
					}
					
					
				}else{
				
					$cmt = false;
					
					$comments =  $this->Comment_model->getPostComments($result['post_id'],0);
					
				}
			
		?>
        

  
  			 <div id="post_bottom_<?=$result['post_id']?>">
             
            <?php if((int)$summary['total_comments'] > 3) {?>
            
  				<a href="#" class="more-comments" id="load_more_comment" value="<?=$result['post_id']?>">View more comments <span>+</span></a>
            
  			<?php } ?>
          
                
                <ul class="comments-list" id="post_comments_list<?=$result['post_id']?>">
                		
				<?php for($i=0;$i<count($comments);$i++) {?>
                
                	<?php echo $this->load->view('user/post/view_single_comment',array('result'=>$comments[$i],'cmt'=>$cmt),TRUE); ?>
                
                <?php } ?>
                        
                </ul>
                
                
  
  
      <form class="comment-form inline-items" method="post" id="post_comment_frm" style="border-top:none;border-top:none;padding: 10px 25px 10px 25px;">
    
    	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
    	
        <input type="hidden" name="id" value="<?=$result['post_id']?>">
    	
        <div class="post__author author vcard inline-items">
        
        	<img src="<?=thumb(ProfileImg(user_session('profile_img')),150,150)?>" alt="author"> 
            
        	<?php /*?><img src="<?=thumb(ProfileImg($result['detail']['r_profile_img']),100,100)?>" alt="author 2"><?php */?>
            
        </div>
        
        <div class="form-group with-icon-right is-empty">
        
        	<textarea placeholder="Write a comment..." style="height: 35px;min-height: 35px;overflow: hidden;padding: 5px;" class="form-control post_comment_box" id="pcomment" name="pcomment"></textarea>
            
        	<div class="add-options-message">
            
                <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                
                    <svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-camera-icon"></use></svg>
                    
                </a>
                
        	</div>
            
        	<span class="material-input"></span></div>
        <?php /*?>
        	<button style="margin-top:10px;padding: 5px;margin-right: 10px;" class="btn btn-md-2 btn-primary">Comment</button>
            
            <img style="float:right;margin-top: 15px; margin-right: 15px;" class="loader dis_none" src="<?=asset_sm('loader.gif')?>"><?php */?>
            
    </form>
    
    </div>
 
	<?php if($inner != 'only_inner') { ?>
    
    </div>
    
    <?php } ?>
