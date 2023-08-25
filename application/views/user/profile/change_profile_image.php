
<div class="header-spacer"></div>

<style>
.error_p
{
	color:#F00!important;
}
</style>
<!-- Your Account Personal Information -->

<div class="container">
	<div class="row">
		<div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
			 <?php 
			$msg = $this->session->flashdata('msg');
			if($msg!='')
			{?>
				  <div class="alert alert-success alert-dismissible fade show" role="alert">
				   <strong><?=$msg?></strong>
				   <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px;margin-top: 5px;">
					<span aria-hidden="true">&times;</span>
				  </button>
				   </div>
			<?php } ?>  
            
     
        
            <div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Change Profile Image</h6>
				</div>
				<div class="ui-block-content">
                	
                    <div class="col-md-12">
                    			
                              <p>
                              
                              	Cover display=300x1200<br>
                                
								Profile image display=250x250 
                                
                              </p> 
                            	
                                <?php
                                	if (!file_exists('./upload/post/'.$member['cover_img']) || $member['cover_img']=='') {
										
										$file = 'a_cover.jpg';
										
									}else{
										
										$file = $member['cover_img'];
											
									}
								?>
                                
                            <img id="cover" src="<?=thumb($file,0,0)?>" style="width:100%;cursor:pointer;max-height:300px;">
                            
                    </div>
                     <div class="col-md-12">
                    <div  style="width:150px;border:#5F5757;border:solid 1px #7E5050;margin-top:-75px;z-index:9999;">
                    
                    	   <?php
                                	if (!file_exists('./upload/post/'.$member['profile_img']) || $member['profile_img']=='') {
										
										$file = 'a_profile.png';
										
									}else{
										
										$file = $member['profile_img'];
											
									}
									
								
									
								?>
                                
                    	<img id="profile" src="<?=thumb($file,150,150)?>" style="width:100%;cursor:pointer;">	
                    </div>
                    </div>
                
					<form id="frm" action="<?=file_path()?>profile/submit_profile_image" method="post" enctype="multipart/form-data">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
                        <input type="file" value="upload" id="coverimg" name="cover_img" style="display:none;">	
                        <input type="file" value="upload" id="profileimg" name="profile_img" style="display:none;">	
					</form>
				</div>
			</div>
		</div>

		<?php $this->load->view('user/profile/bar_setting');?>
        
	</div>
</div>

<!-- ... end Your Account Personal Information -->
<script nonce=<?=SC_NONCE?>>

	$(document).on('click','#cover',function(e){
		$('#coverimg').trigger('click');	
	});
	
	
	$(document).on('click','#profile',function(e){
		$('#profileimg').trigger('click');	
		
	});
	
	
	
	$(document).on('change', '#coverimg', function () {
		
		var file = this.files;
		
		var length = this.files.length; // get length
		
		var match= ["image/jpeg","image/png","image/jpg"];
		
		var validation  = true;
		
		console.log(file);
		
		if (length > 0) {
			
			for (var i = 0; i < length; i++) {
				
				var imagefile = file[i].type;
		
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
					
					validation  = false;
					
					break;
				}
			}
		}
		
		if(validation!=true){
			
			$("#coverimg").prop('value', '');

			alert('Only jpeg, jpg and png Images type allowed');
					
			return false;
			
		}else{
			
			$('#frm').submit();	
            
            return true;
			
		}
		
	});
	
	
		$(document).on('change', '#profileimg', function () {
		
		var file = this.files;
		
		var length = this.files.length; // get length
		
		var match= ["image/jpeg","image/png","image/jpg"];
		
		var validation  = true;
		
		console.log(file);
		
		if (length > 0) {
			
			for (var i = 0; i < length; i++) {
				
				var imagefile = file[i].type;
		
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
					
					validation  = false;
					
					break;
				}
			}
		}
		
		if(validation!=true){
			
			$("#profileimg").prop('value', '');

			alert('Only jpeg, jpg and png Images type allowed');
					
			return false;
			
		}else{
		
			$('#frm').submit();	
            
            return true;
		
		}
		
	});

	
	
</script>
