<?php 

	$ads_detail =  $this->comman_fun->get_table_data('social_ads_create',array('id'=>$result['ads_code']));
	
	
	
?>
<li>
     	
        <div>
         
        <div class="post__author author vcard inline-items"> 
        
       
       
      
        
          <div class="author-date">
          
         
            	<a class="h6 post__author-name fn" href="<?=$ads_detail[0]['url']?>" style="color: #fff !important;background: #47A247;padding: 5px 10px;">
            
            		<?=$ads_detail[0]['title']?>
            
            	</a>
            </a>
         
          </div>
          
          
          
          
        </div>
        
        
        <?php if($ads_detail[0]['ad_img']!='') { ?>
       
            <div class="post-block-photo js-zoom-gallery">
            
            	<a href="<?=base_url('upload/ads/'.$ads_detail[0]['ad_img'])?>" class="noclass" style="width:100%;"><img src="<?=base_url('upload/ads/'.$ads_detail[0]['ad_img'])?>" alt="photo" style="width:100%;"></a>
            
            </div>
       
        <?php } ?>
        
        
        
        <?php if($ads_detail[0]['ad_video']!=''){ ?>
        			
              	<?php 
				
				if(preg_match('/youtube|youtu.be/',$ads_detail[0]['ad_video'])){ 
					
					$youtube=true;
					
					if (!preg_match('/embed/',$ads_detail[0]['ad_video'])){
					
						$youtube_key 	= 	explode("?v=", $ads_detail[0]['ad_video']);
						
						$youtube_key	= 	$youtube_key[1];
					
					}else{
					
						$youtube_key 	= 	explode("/", $ads_detail[0]['ad_video']);
						
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
					
					}
					
					if(preg_match('/youtu.be/',$ads_detail[0]['ad_video'])){
					
						$youtube_key 	= 	explode("/", $ads_detail[0]['ad_video']);
							
						$youtube_key	= 	$youtube_key[count($youtube_key)-1];
						
					}
					
				}
				?>
 				
                <?php if($youtube==true) { ?>
                 	<iframe  width="100%" height="315" src="https://www.youtube.com/embed/<?=$youtube_key?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <?php } ?>
                
                <?php if(preg_match('/vimeo/',$ads_detail[0]['ad_video'])){ ?>
                	<iframe  width="100%" height="315" src="<?=$ads_detail[0]['ad_video']?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <?php } ?>
                
            
           
                    
        <?php } ?>
        
        
        <p style="color:#000;">
          <?=nl2br($ads_detail[0]['description'])?>
        </p>
        
        </div>
      </li>