
        
        <form method="post" action="<?=file_path('post/post_share_submit')?>" id="frm_share">
        
        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
        
        <input type="hidden" name="type" value="<?=$section?>">
        
        <input type="hidden" name="post_id" value="<?=$detail['post_id']?>">
       
<div class="ui-block">
  

  
  <textarea  class="form-control" placeholder="Say sometime about this..." name="share_txt" id="share_txt" style="height: 61px;min-height: 60px;border-left:none !important;border-right:none;border-top:none; resize:none;"></textarea>
  
  
  <article class="hentry post has-post-thumbnail">
	
   	
    
   <!----Top Detail----> 
   
      <div class="post__author author vcard inline-items"> 
      			
                <div class="author-date"> 
            
                <a class="author_nm h6 post__author-name fn 3" href="<?=$result['url']?>" target="_blank"><?=$result['title']?></a> 
                         
                </div>
    </div>
    
    <p><?=$result['description']?></p>
      	
        <?php $images = $result['image']; ?>
        
        <?php $imagesCount = count($result['image']); ?>
        
        <?php $imageShowCount = ($imagesCount > 5) ? 5 : $imagesCount ; ?>
        
        
        
        <?php if($result['ad_img']!='') { ?>
       
            <div class="post-block-photo js-zoom-gallery">
            
            	<a href="<?=base_url('upload/ads/'.$result['ad_img'])?>" class="noclass" style="width:100%;"><img src="<?=base_url('upload/ads/'.$result['ad_img'])?>" alt="photo" style="width:100%;"></a>
            
            </div>
       
        <?php } ?>
        
       
       <?php if($result['video_upload']!=''){ ?>
       
            <video style="width:100%;" controls>
            
                <source src="<?=base_url('upload/video/'.$result['video_upload'])?>" type="video/mp4">
                
                <source src="mov_bbb.ogg" type="video/ogg">
                
                Your browser does not support HTML5 video.
            
            </video>
      	
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
        

  </article>
  
</div>
</form>
