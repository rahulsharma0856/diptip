
        
        <form method="post" action="<?=file_path('post/post_share_submit')?>" id="frm_share">
        
        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
        
        <input type="hidden" name="type" value="<?=$section?>">
        
        <input type="hidden" name="post_id" value="<?=$detail['post_id']?>">
        
        
   
        <?php if($section=='page'){ ?>
        
            <div class="ui-block" style="border:none;">
            
                <select name="endcode" style="padding:5px;margin-bottom:10px;width: 45%;background-color:#E9E9E6;">
                
                <?php for($i=0;$i<count($pages);$i++) {?>
                
                <option value="<?=$pages[$i]['id']?>"><?=$pages[$i]['title']?></option>    	  	
                
                <?php } ?>
                
                </select>
            
            </div>
        
        <?php } ?>
        
        
            <?php if($section=='group'){ ?>
        
            <div class="ui-block" style="border:none;">
            
                <select name="endcode" style="padding:5px;margin-bottom:10px;width: 45%;background-color:#E9E9E6;">
                
                <?php for($i=0;$i<count($groups);$i++) {?>
                
                <option value="<?=$groups[$i]['id']?>"><?=$groups[$i]['title']?></option>    	  	
                
                <?php } ?>
                
                </select>
            
            </div>
        
        <?php } ?>



<div class="ui-block">
  

  
  <textarea  class="form-control" placeholder="Say sometime about this..." name="share_txt" id="share_txt" style="height: 61px;min-height: 60px;border-left:none !important;border-right:none;border-top:none; resize:none;"></textarea>
  
   
  
 	<?php if($detail['is_ads']=='1'){ ?> 
  		
         <?php 
		 
		 	$result2 = $this -> Ads_model -> getAdById($detail['ads_code']); 
			
			$result2 = $result2[0];
		 
		 ?>	
        
  		 <article class="hentry post has-post-thumbnail">
	
   	
    
   <!----Top Detail----> 
   
            <div class="post__author author vcard inline-items"> 
            
                <div class="author-date"> 
                
                <a class="author_nm h6 post__author-name fn 3" href="<?=$result2['url']?>" target="_blank"><?=$result2['title']?></a> 
            
            </div>
   
    
    
    <p><?=$result2['description']?></p>
      	
      
        
        
        
        <?php if($result2['ad_img']!='') { ?>
       
            <div class="post-block-photo js-zoom-gallery">
            
            	<a href="<?=base_url('upload/ads/'.$result2['ad_img'])?>" class="noclass" style="width:100%;"><img src="<?=base_url('upload/ads/'.$result2['ad_img'])?>" alt="photo" style="width:100%;"></a>
            
            </div>
       
        <?php } ?>
       
       <?php if($result['ad_video']!=''){ ?>
       
            <video style="width:100%;" controls>
            
                <source src="<?=base_url('upload/ads/video/'.$result2['ad_video'])?>" type="video/mp4">
                
                <source src="mov_bbb.ogg" type="video/ogg">
                
                Your browser does not support HTML5 video.
            
            </video>
      	
        <?php } ?>
        
        
        

  </article>
  
  	<?php } else { ?>
    
    	 <article class="hentry post has-post-thumbnail">
	
   	
    
   <!----Top Detail----> 
   
   
   
    <div class="post__author author vcard inline-items"> 
      
     			
            	<img src="<?=thumb(ProfileImg($result['detail']['r_profile_img']),100,100)?>" alt="author">
    
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
        

  </article>
    
    <?php } ?>
  
  
  
</div>


</form>
