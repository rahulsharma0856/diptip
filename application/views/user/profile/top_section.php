<?php //var_dump($member);exit;?>
<div class="header-spacer"></div>


<!-- Top Header -->

<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block">
				<div class="top-header">
					<div class="top-header-thumb">
                    	
						<?php
						
                        if (!file_exists('./upload/post/'.$member['cover_img']) || $member['cover_img']=='') {
                        
                       	 	$file = 'g_cover.jpg';
                        
                        }else{
                        
                        	$file = $member['cover_img'];
                        
                        }
                        ?>
                    
						<img id="profile_header_image" src="<?=thumb($file,0,0)?>" alt="nature" style="max-height:300px;">
					</div>
					<div class="profile-section">
						
                        <div class="row">
							
                           <div class="col-md-6">
								<ul class="profile-menu">
									<li>
										<a href="<?=file_path('profile/timeline/'.$member['username'])?>" class="menu-timeline">Timeline</a>
									</li>
									<li>
										<a href="<?=file_path('profile/about/'.$member['username'])?>" class="menu-about">About</a>
									</li>
									<li>
										<a href="<?=file_path('profile/friends/'.$member['username'])?>" class="menu-friends">Friends</a>
									</li>
                                    
                                </ul>
							</div> 
                            
                            
                            <div class="col-md-6 pro_top_mrg">
								<ul class="profile-menu">
									
                                    <li style="margin-left:20px;">  
										<a href="<?=file_path('profile/photos/'.$member['username'])?>" class="menu-photos">Photos</a>
									</li>
									<li style="margin-left:40px;">
										<a href="<?=file_path('profile/videos/'.$member['username'])?>" class="menu-videos">Videos</a>
									</li>
                                    
                                
                                    <?php if(user_session('usercode') != $member['usercode']){ ?>
                                    
                                    <li>
										<a id="rightbar_online_mem" memcode="<?=$member['usercode']?>" style="margin-bottom:0px;color:#fff;padding: 0.3rem 1rem;" href="#" class="menu-videos btn btn-primary">Message</a>
									</li>
                                    
                                    <?php }else { echo '<li style="width:95px;"></li>';} ?>
                                    
								</ul>
							</div>
							
						</div>

						<div class="control-block-button" id="friend_request_btn">
                        				
								<?php if(user_session('usercode') == $member['usercode']){ ?>
                                
                                  		<?php $this->load->view('user/profile/icon_upload_header_and_cover_image');?>
                                
                                <?php } ?>      
                                        	
                        </div>
                       
					</div>
					<div class="top-header-author" style="z-index:20;">
                    	
					<?php
						
						 if (!file_exists('./upload/post/'.$member['profile_img']) || $member['profile_img']=='') {
                        
                       	 	$profile = 'g_profile.jpg';
                        
                        }else{
                        
                        	$profile = $member['profile_img'];
                        
                        }
						
					  ?>
                        <div class="js-zoom-gallery">
                           
                            <a href="<?=thumb($profile,250,250)?>" class="author-thumb">
                            	
                                <img id="profile_profile_image" src="<?=thumb($profile,250,250)?>" alt="author"  height="124" width="124">
                           
                            </a>
                            
                        </div>
						<div class="author-content">
                        
							<a href="#" class="h5 author-name"><?=$member['fname']?> <?=$member['lname']?></a>
                            
							<div class="country"></div>
                            
						</div>
                        
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ... end Top Header -->

<style>
	.reqicon i{
		color:#fff !important;
	}
	@media screen and (max-width: 800px) {
		.pro_top_mrg{
			margin-top:15px!important;
		}
	}
	
</style>

<script nonce=<?=SC_NONCE?>>
	$(document).ready(function(e) {
		
		  $('.<?=$menu_active?>').addClass('active')
		 
		<?php if(user_session('usercode') != $member['usercode']){ ?>
		
			$.ajax({
			
				url:'<?=file_path('profile/friend_request_button/'.$member['usercode'])?>',
				
				dataType : "json",
				
				success:function(result){
				
				$('#friend_request_btn').html(result['html']);	
				
				},
				error: function( jqXHR, textStatus, errorThrown) {
					
				alert(textStatus);
				
				}
			
			});
		
		<?php } ?>
		
			
    });
	

	
	$(document).on('click','#request_send',function(e){
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('profile/friend_request_send')?>'+value;
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				$('#friend_request_btn').html(result['html']);	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	$(document).on('click','#request_delete',function(e){
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('profile/friend_request_delete')?>'+value;
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				$('#friend_request_btn').html(result['html']);	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	
	
	$(document).on('click','#request_accept',function(e){
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('profile/friend_request_accept')?>'+value;
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				$('#friend_request_btn').html(result['html']);	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	$(document).on('click','#delete_friend',function(e){
		
		var membernm = '<?php echo $member['fullname'];?>';
		
		var result = confirm("Are you sure you want to remove "+membernm+" as a friend ?");
		
		if(result)
		{
			
			var value = $(this).attr('value');
		
			var url = '<?=file_path('profile/friend_delete')?>'+value;
			
			$.ajax({
			
				url : url,
				
				dataType : "json",
				
				success:function(result){
					
					$('#friend_request_btn').html(result['html']);	
				
				},
				
				error: function( jqXHR, textStatus, errorThrown) {
					
					alert(textStatus);
					
				}
			});
			
		}
		
		
		
	});
	

	
</script>


