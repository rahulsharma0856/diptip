<?php
if($this->uri->segment(2)=='likes')
{
	$li_likes = 'class="active"';
}
else if($this->uri->segment(2)=='page_edit')
{
	$li_page_edit = 'class="active"';
}else
{
	$li_timeline = 'class="active"';
}

?>
<div class="header-spacer"></div>
<!-- Top Header -->
<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block">
				<div class="top-header top-header-favorit">
					<div class="top-header-thumb">
						
                        <?php
						
                        if (!file_exists('./upload/post/'.$result[0]['cover_img']) || $result[0]['cover_img']=='') {
                        
                       	 	$file = 'g_cover.jpg';
                        
                        }else{
                        
                        	$file = $result[0]['cover_img'];
                        
                        }
						
						
                        if (!file_exists('./upload/post/'.$result[0]['profile_img']) || $result[0]['profile_img']=='') {
                        
                       	 	$profile = 'g_profile.jpg';
                        
                        }else{
                        
                        	$profile = $result[0]['profile_img'];
                        
                        }
                        ?>
                        
                    	<img id="profile_header_image" src="<?=thumb($file,0,0)?>"> <!--height="360"-->
                        
						<div class="top-header-author"  style="z-index: 20;">
							
                            <div class="author-thumb js-zoom-gallery">
							
                    			 <a href="<?=thumb($profile,250,250)?>">
                                 	
                                    <img id="profile_profile_image" src="<?=thumb($profile,250,250)?>" width="124"> <!--height="124"-->
                                    
                                 </a>  
                                
							</div>
							
						</div>
					</div>
					<div class="profile-section">
						<div class="row">
                       			 
							<div class="col-xl-11 offset-xl-1 col-lg-8 offset-lg-2 col-md-12 offset-md-0">
                            
								<div class="author-content" style="margin-top:0px;">
                                    
                                    <a href="#" class="h4 author-name"><?=filter_message($result[0]['title'])?></a>
                                    
                                    <div style="color: #00547b;" class="country"><?=$result[0]['cat_name']?></div>
                                    
                                </div>
                                
                                <ul class="profile-menu" style="margin-top:5px;">
									
                                    <li>
										<a href="<?=file_path('page/view/'.$result[0]['id'])?>" <?=$li_timeline?>>Timeline</a>
									</li>
                                    
									<li>
										<a href="<?=file_path('page/likes/'.$result[0]['id'])?>" <?=$li_likes?>>
                                        	<?php if($isPagelike){ ?>
                                        		Liked
                                            <?php } else { ?>
                                            	Likes
                                            <?php } ?>
                                         </a>
									</li>
                                    
                                    <?php if($isPageAdmin){ ?>
                                    
                      
									<li>
										<a href="<?=file_path('page/page_edit/'.$result[0]['id'])?>" <?=$li_page_edit?>>Edit</a> 
									</li>
                                    
                                    
                                    <?php } ?>
								
									
								</ul>
                                
							</div>
						</div>

						<div class="control-block-button like_unlike_control">
                        	
                            
                            <?php if($isPageAdmin == true ){ ?>
                            	
                                <?php $this->load->view('user/page/icon_upload_header_and_cover_image');?>
                                
                            <?php } else { ?>
                        
                        	<?php if(!$isPagelike){ ?>
                            
							<a href="#" class="btn btn-control bg-primary f30" title="like page" id="do_like" value="<?=$result[0]['id']?>">
                            
								<i class="fa fa-thumbs-up f30"></i>
                                
							</a>
                            
                            <?php } else { ?>
                            
                            <a href="#" class="btn btn-control bg-green f30" title="unlike page" id="do_unlike" value="<?=$result[0]['id']?>">
                            
                            	<i class="fa fa-thumbs-down f30"></i>
                                
                            </a>
                            
                            <?php } ?>
                            
                            <?php } ?>
                            
						</div>
                        
					</div>
                    
				</div>
                
			</div>
            
		</div>
        
	</div>
    
</div>

<!-- ... end Top Header -->


<style>

	#like_unlike_control i{
		
		font-size:30px !important;
		
	}
	
	.f30{
		
		font-size:30px !important;
		
	}
	@media screen and (max-width:1024px)
	{
		.profile-section .author-content
		{
			width: 100%!important;
			margin-bottom:20px!important;
			padding-left: 70px!important;
		}
		.profile-section .profile-menu
		{
			width: 100%!important;
			margin-bottom:10px!important;
			
		}
	}
	@media screen and (max-width:460px)
	{
		.profile-section .author-content
		{
			width: 100%!important;
			margin-bottom:20px!important;
			padding-left: 0px!important;
			text-align:center!important;
		}
		
	}
	
</style>

<script nonce=<?=SC_NONCE?>>

	$(document).on('click','#do_like',function(e){
	
		var url='<?=file_path('page/do_like')?>'+$(this).attr('value');
		
		e.preventDefault();
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				if(result['status']=='true'){
					
					$('.like_unlike_control').html(result['html']);
					
					$('.html_tot_likes').html(result['TotalPageLikes']);
					
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
	});
	
	
	
	$(document).on('click','#do_unlike',function(e){
	
		var url='<?=file_path('page/do_unlike')?>'+$(this).attr('value');
		
		e.preventDefault();
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				if(result['status']=='true'){
					
					$('.like_unlike_control').html(result['html']);
					
					$('.html_tot_likes').html(result['TotalPageLikes']);
					
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
	});
	
	
</script>

