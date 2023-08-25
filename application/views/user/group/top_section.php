<?php
if($this->uri->segment(2)=='members')
{
	$li_members = 'class="active"';
}
else if($this->uri->segment(2)=='requests')
{
	$li_requests = 'class="active"';
	
}else if($this->uri->segment(2)=='group_edit')
{
	$li_group_edit = 'class="active"';
}
else
{
	$li_discussion = 'class="active"';
}

?>
<div class="header-spacer"></div>
<!-- Top Header -->
<div class="container">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="top-header top-header-favorit">
        
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

          <div class="top-header-thumb"> <img id="profile_header_image" src="<?=thumb($file,0,0)?>"> <!--height="360"-->
          
            <div class="top-header-author"  style="z-index: 20;">
             
              <div class="author-thumb js-zoom-gallery"> 
              
              	 <a href="<?=thumb($profile,250,250)?>">
                 
                 	<img id="profile_profile_image" src="<?=thumb($profile,250,250)?>" width="124"><!--height="124"-->
                    
                 </a>  
                   
              </div>
              
            </div>
            
          </div>
          
          <div class="profile-section">
            <div class="row">
              <div class="col-xl-11 offset-xl-1 col-lg-8 offset-lg-2 col-md-12 offset-md-0">
                
				 <div class="author-content" style="margin-top:0px;"> <a href="#" class="h4 author-name"><?=$result[0]['title']?></a>
                    <div style="color: #337ab7;" class="country"><?=$result[0]['group_privacy']?> Group</div>
                 </div>
				
				<?php if($isValidView==true) { ?>
                
                <ul class="profile-menu" style="margin-top:5px;">
                
                  <li> <a href="<?=file_path('group/view/'.$result[0]['id'])?>" <?=$li_discussion?>>Discussion</a> </li>
                  
                  <?php if($isPageAdmin){ ?>
                  
                  <li> <a href="<?=file_path('group/members/'.$result[0]['id'])?>" <?=$li_members?>>Members</a> </li>
                  
                  <?php if($result[0]['group_privacy']!='Public'){?>
                  
                  <li> <a href="<?=file_path('group/requests/'.$result[0]['id'])?>" <?=$li_requests?>>Requests</a> </li>
                  
                  <?php }?>
                  
                  <li> <a href="<?=file_path('group/group_edit/'.$result[0]['id'])?>" <?=$li_group_edit?>>Edit</a> </li>
                  
                  <?php } ?>
                  
                </ul>
                <?php } ?>
              </div>
            </div>
            <?php if($isPageAdmin==true){ ?>
            <div class="control-block-button">
              <?php $this->load->view('user/group/icon_upload_header_and_cover_image');?>
            </div>
            <?php } else { ?>
            <div class="control-block-button reqicon" id="group_status_button"></div>
            <?php } ?>
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
	
	
	
	$(document).ready(function(e) {
	
		
			$.ajax({
			
				url:'<?=file_path('group/member_group_status/'.$result[0]['id'])?>',
				
				dataType : "json",
				
				success:function(result){
				
					$('#group_status_button').html(result['html']);	
				
				},
				error: function( jqXHR, textStatus, errorThrown) {
					
					alert(textStatus);
				
				}
			
			});
		
		
		
			
    });
	
	
	
	$(document).on('click','#request_send',function(e){
	
		var url='<?=file_path('group/send_join_request/'.$result[0]['id'])?>';
		
		e.preventDefault();
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				$('#group_status_button').html(result['html']);	
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
	});
	
	
	
	$(document).on('click','#delete_request',function(e){
	
		var url='<?=file_path('group/delete_request/'.$result[0]['id'])?>';
		
		e.preventDefault();
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				$('#group_status_button').html(result['html']);	
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
	});
	
	
	
	$(document).on('click','#accept_group_request',function(e){
		
		var url='<?=file_path('group/accept_group_join_request/'.$result[0]['id'])?>';
		
		e.preventDefault();
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				$('#group_status_button').html(result['html']);	
				window.location.reload();
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
	});
	
</script>
<style>
	.reqicon i {
		color: #fff !important;
	}
</style>
