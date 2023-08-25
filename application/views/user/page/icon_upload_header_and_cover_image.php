
<div class="btn btn-control bg-primary more"> <svg class="olymp-settings-icon">
  <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-settings-icon"></use>
  </svg>
  <ul id="cover_photo_option" class="more-dropdown more-with-triangle triangle-bottom-right">
    <li><a href="#" id="profile_photo">Update Profile Photo</a></li>
    <li><a href="#" id="header_photo">Update Cover Photo</a></li>
    <?php if($result[0]['profile_img']!='g_profile.jpg' and $result[0]['profile_img']!='') { ?>
    <li><a href="#" id="remove_profile_photo">Remove Profile Photo</a></li>
    <?php }?>
	<?php if($result[0]['cover_img']!='g_cover.jpg' and $result[0]['cover_img']!='') { ?>
    <li><a href="#" id="remove_header_photo">Remove Cover Photo</a></li>
    <?php }?>
    
  </ul>
  <form id="cover_image_frm" action="<?=file_path('upload_img_pg/upload_cover_image')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$result[0]['id']?>">
    <input type="hidden" name="imgPre" value="page_cover">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
    <input type="file" value="upload" id="cover_image" name="cover_image" style="display:none;">
  </form>
  <form id="profile_image_frm" action="<?=file_path('upload_img_pg/upload_profile_image')?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?=$result[0]['id']?>">
    <input type="hidden" name="imgPre" value="page_profile">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
    <input type="file" value="upload" id="profile_image" name="profile_image" style="display:none;">
  </form>
</div>
<script nonce=<?=SC_NONCE?>>
	
	$(document).on('click','#header_photo',function(e){
			
			$('#cover_image').trigger('click');	
			
		});
		
		
		$(document).on('change', '#cover_image', function () {
			
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
				
				$("#cover_image").prop('value', '');
	
				alert('Only jpeg, jpg and png Images type allowed');
						
				return false;
				
			}else{
				
				$('#cover_image_frm').submit();	
				
			}
			
		});
		
		
		//Submit
		
		$(document).on('submit', '#cover_image_frm', function (e) {
			
			e.preventDefault();
			
			var formData = new FormData(this);
			
			var action_url = $(this).attr('action');
            
            var oldSrc = $("#profile_header_image").attr("src");
			
			$.ajax(
			{
				url: action_url, // Url to which the request is send
				
				type: "POST",             // Type of request to be send, called as method
				
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				
				contentType: false,       // The content type used when sending data to the server.
				
				cache: false,             // To unable request pages to be cached
				
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				
				dataType : 'json',
				
				beforeSend: function(){
					
					var loding_img = '<?=asset_sm('loader.gif')?>';
					$('#profile_header_image').css('width','10%');
					$('#profile_header_image').css('height','10%');
					$('#profile_header_image').attr("src",loding_img);
					
				},
				success: function(data)// A function to be called if request succeeds
				{	
					
					console.log(data);	
				
					if(data['status']=='true'){
						
						$('#profile_header_image').css('width','');
						$('#profile_header_image').css('height','');
						$("#profile_header_image").attr("src",data['file_path']);
						
						$("#cover_photo_option").append('<li><a href="#" id="remove_header_photo">Remove Cover Photo</a></li>');
                        
                        $('#cover_image_frm')[0].reset();
						
					}else{
						
                        $('#profile_header_image').css('width','');
                        $('#profile_header_image').css('height','');
                        $("#profile_header_image").attr("src",oldSrc);
                        
                        $('#cover_image_frm')[0].reset();
                        
						alert(data['msg']);
						
					}
					
				}
			
			});
			
			
		});
		
		
		
		
		
		
		$(document).on('click','#profile_photo',function(e){
			
			$('#profile_image').trigger('click');	
			
		});
		
		
		$(document).on('change', '#profile_image', function () {
			
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
				
				$("#cover_image").prop('value', '');
	
				alert('Only jpeg, jpg and png Images type allowed');
						
				return false;
				
			}else{
				
				$('#profile_image_frm').submit();	
				
			}
			
		});
		
		
		//Submit
		
		$(document).on('submit', '#profile_image_frm', function (e) {
			
			e.preventDefault();
			
			var formData = new FormData(this);
			
			var action_url = $(this).attr('action');
            
            var oldSrc = $("#profile_profile_image").attr("src");
			
			$.ajax(
			{
				url: action_url, // Url to which the request is send
				
				type: "POST",             // Type of request to be send, called as method
				
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				
				contentType: false,       // The content type used when sending data to the server.
				
				cache: false,             // To unable request pages to be cached
				
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				
				dataType : 'json',
				
				beforeSend: function(){
					
					var loding_img = '<?=asset_sm('loader.gif')?>';
					//$('#profile_profile_image').css('width','25%');
					//$('#profile_profile_image').css('height','15%');
                    $('#profile_profile_image').attr('style', 'float: center; padding: 40px 30px 10px 30px; width: 100%; height: 60%;');
					$('#profile_profile_image').attr("src",loding_img);
					
				},
				success: function(data)// A function to be called if request succeeds
				{	
					
					console.log(data);	
				
					if(data['status']=='true'){
						
						$('#profile_profile_image').css('width','');
						$('#profile_profile_image').css('height','');
                        $('#profile_profile_image').attr('style', '')
						$("#profile_profile_image").attr("src",data['file_path']);
						
						$("#cover_photo_option").append('<li><a href="#" id="remove_profile_photo">Remove Profile Photo</a></li>');
                        
                        $('#profile_image_frm')[0].reset();
						
					}else{

						alert(data['msg']);
                        
                        $('#profile_profile_image').css('width','');
						$('#profile_profile_image').css('height','');
                        $('#profile_profile_image').attr('style', '');
                        $("#profile_profile_image").attr("src",oldSrc);
						
                        $('#profile_image_frm')[0].reset();
						
					}
					
				}
			
			});
			
			
		});

	//remove cover
	
	$(document).on('click', '#remove_header_photo', function (e) {
			
			e.preventDefault();
			
			var page_id = '<?=$result[0]['id']?>';
			
			var action_url = '<?=file_path('page/remove_cover_photo')?>'+page_id;
		
			$.ajax(
			{
				url: action_url, // Url to which the request is send
				
				type: "GET",             // Type of request to be send, called as method
				
				contentType: false,       // The content type used when sending data to the server.
				
				cache: false,             // To unable request pages to be cached
				
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				
				dataType : 'json',
				
				beforeSend: function(){
					
					var loding_img = '<?=asset_sm('loader.gif')?>';
					$('#profile_header_image').css('width','10%');
					$('#profile_header_image').css('height','10%');
					$('#profile_header_image').attr("src",loding_img);
					
				},
				success: function(data)// A function to be called if request succeeds
				{	
					console.log(data);	
					
					if(data['status']=='true'){
						
						$('#profile_header_image').css('width','');
						$('#profile_header_image').css('height','');
						$("#profile_header_image").attr("src",data['file_path']);
						
						$("li #remove_header_photo").closest("li").remove();
						
					}else{
						
						alert(data['msg']);
						
					}
					
				}
			
			});
			
			
		});
		
		//remove profile
	
	$(document).on('click', '#remove_profile_photo', function (e) {
			
			e.preventDefault();
			
			var page_id = '<?=$result[0]['id']?>';
			
			var action_url = '<?=file_path('page/remove_profile_photo')?>'+page_id;
		
			$.ajax(
			{
				url: action_url, // Url to which the request is send
				
				type: "GET",             // Type of request to be send, called as method
				
				contentType: false,       // The content type used when sending data to the server.
				
				cache: false,             // To unable request pages to be cached
				
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				
				dataType : 'json',
				
				beforeSend: function(){
					
					var loding_img = '<?=asset_sm('loader.gif')?>';
					$('#profile_profile_image').css('width','10%');
					$('#profile_profile_image').css('height','10%');
					$('#profile_profile_image').attr("src",loding_img);
					
				},
				success: function(data)// A function to be called if request succeeds
				{	
					console.log(data);	
					
					if(data['status']=='true'){
						
						$('#profile_profile_image').css('width','');
						$('#profile_profile_image').css('height','');
						$("#profile_profile_image").attr("src",data['file_path']);
						
						$("li #remove_profile_photo").closest("li").remove();
						
					}else{
						
						alert(data['msg']);
						
					}
					
				}
			
			});
			
			
		});
		
</script>