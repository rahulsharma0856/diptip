<style>

input[type="file1"] {
	
	position: absolute;
	
	left: 0;
	
	opacity: 0;
	
	top: 0;
	
	bottom: 0;
	
	width: 40px;
	
	border: #706161 solid 1px;
	
}
#uploadStatusImg {
	
	display: none;
	
}

#uploadStatusVideo {
	
	display: none;
	
}

.margin_left_35 {
	
	margin-left: 35px;
	
}

.uploadStatusImgMsg {
	
	border-bottom: #e4eaf3 solid 1px;
	
	padding: 10px 15px;
	
}


.tagListDiv1 {

	padding: 10px 15px;
	
}

.tagListDiv2 {

	padding: 10px 15px;
	
}

.uploadStatusVideoMsg {
	
	border-bottom: #e4eaf3 solid 1px;
	
	padding: 10px 15px;
	
	display: none;
	
}
.noclass {
	
	width: 100% !important;
	
}
.post_status_txt{
	
	font-size:15px;
	
	font-weight:500;
	
}

.tag_selected_member{
	
	position: relative;
	
	margin: 3px 5px 3px 0;
	
	padding: 3px 5px 3px 5px;
	
	border: 1px solid #e4eaf3;
	
	max-width: 100%;
	
	border-radius: 3px;
	
	background-size: 100% 19px;
	
	background-repeat: repeat-x;
	
	background-clip: padding-box;
	
	color: #333;
	
	line-height: 13px;
	
	cursor: default;
	
}

#tag_selected_member_remove{
	
	font-weight:bold;
	
	margin-left:5px;
	
}


@media screen and (max-width:420px)
{
	.cust_nav_item
	{
		width:55%!important;
	}
	.news-feed-form .nav-tabs .cust_nav_link {
   		padding: 10px!important;
	}
}

</style>

<div class="ui-block" style="border: 1px solid #e1e1e3!important;border-radius: 2px;">

  <div class="news-feed-form"> 
  
    <!-- Nav tabs -->
    
    <ul class="nav nav-tabs" role="tablist">
    
      <li class="nav-item cust_nav_item" > <a class="nav-link active inline-items cust_nav_link" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true"> <svg class="olymp-status-icon">
        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-status-icon"></use>
        </svg> <span class="post_status_txt">Status</span> </a> </li>
        
      <li class="nav-item"> <a class="nav-link inline-items cust_nav_link" data-toggle="tab" href="#profile-1" role="tab" aria-expanded="true"> <svg class="olymp-multimedia-icon">
        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-multimedia-icon"></use>
        </svg> <span class="post_status_txt">Video / URL Share</span> </a> </li>
        
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content"> 
      
      <!----Status And Image------>
      
      <?php
      
	  	if($setting['type']=='tag'){ 
		
			$placeholder = 'Write on your friend’s Timeline...';
			
		}else{
			
			$placeholder = 'Share what you are thinking here...';
			
		}
	  	
	  ?>
      
      <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
      
        <form method="post" id="add_post_status" action="<?=file_path()?>post/add_post_status" enctype="multipart/form-data">
        
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          
           <input type="hidden" name="type" value="<?=$setting['type']?>">
           
           <input type="hidden" name="endcode" value="<?=$setting['endcode']?>">
           
          <div class="author-thumb"> <img src="<?=thumb(ProfileImg(user_session('profile_pic')),150,150)?>" alt="author" style="width:36px;height:36px;"> </div>
          
          <div class="form-group with-icon label-floating is-empty">
          
            <textarea class="form-control" placeholder="<?=$placeholder?>" name="post_text" id="post_text"></textarea>
            
            <div class="uploadStatusImgMsg">No Image(s)/Video Select</div>
            
            <div class="tagListDiv1"></div>
            
          </div>
          
          <div class="add-options-message"> 
          
            <a href="javascript:void(0)" id="uploadImageIcon" class="options-message" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add IMAGES"> <svg class="olymp-camera-icon">
			
            <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-camera-icon"></use>
			
            </svg>
            
            </a>
            
            <input type="file" value="upload" id="uploadStatusImg" name="uploadStatusImg[]" multiple />
            
            <a href="#" class="options-message margin_left_35" id="shareVideoIcon" data-toggle="tooltip" data-placement="top" title="" data-original-title="UPLOAD VIDEO"> <svg class="olymp-computer-icon">
			
            <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-computer-icon"></use>
			
            </svg> 
            
            </a>
            
            
            <a href="<?=file_path('tag/tag_member_box/tagListDiv1')?>" id="tagicon1" tag="tagListDiv1" class="options-message margin_left_35 notifiction-popover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Tag Friend"> 
            
            <i style="font-size:20px;" class="fa fa-users"></i>
            
            </a>
            
            <input type="file" value="upload" id="uploadStatusVideo" name="uploadStatusVideo" accept="video/*" /> 
            
            <button style="float: right;" class="btn btn-primary btn-md-2" type="submit">Post Status</button>
            
            <img style="float:right;" class="loader dis_none" src="<?=asset_sm('loader.gif')?>">
            
          </div>
          
        </form>
        
      </div>
      
      <!----END Status And Image------> 
      
      <!----Share Video------>
      
      <div class="tab-pane" id="profile-1" role="tabpanel" aria-expanded="true">
      
        <form method="post" id="add_post_share_video" action="<?=file_path()?>post/add_post_share_video" enctype="multipart/form-data">
        
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          
           <input type="hidden" name="type" value="<?=$setting['type']?>">
           
            <input type="hidden" name="endcode" value="<?=$setting['endcode']?>">
            
          <div class="author-thumb"> <img src="<?=thumb(ProfileImg(user_session('profile_pic')),150,150)?>" alt="author" style="width:36px;height:36px;"> </div>
          
          <div class="form-group with-icon label-floating is-empty">
          
            <label class="control-label"></label>
            
            <textarea class="form-control" placeholder="<?=$placeholder?>" name="post_text2" id="post_text2"></textarea>
            
            <input type="url" name="video_share" id="video_share" class="form-control VideoShareTextBox" placeholder="Share Url OR Share Link from YouTube or Vimeo" style="border-top:none;border-radius:0px;padding:5px 15px;width:100%;">
            
            <div class="tagListDiv2"></div>
            
            <div  id="autocomplete_section2"></div>


          </div>
          <div class="add-options-message">
          
            <button style="float:right;" class="btn btn-primary btn-md-2" type="submit">Post Status</button>
            
          
            <a href="<?=file_path('tag/tag_member_box/tagListDiv2')?>" id="tagicon2" tag="tagListDiv2" class="options-message margin_left_35 notifiction-popover"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tag Friend"> 
            
            <i style="font-size:20px;" class="fa fa-users"></i>
            
            </a>
            
            <img style="float:right;" class="loader dis_none" src="<?=asset_sm('loader.gif')?>">
            
          </div>
           
        </form>
        
      </div>
      
      <!----END Share Video------> 
      
    </div>
  </div>
</div>

<script nonce=<?=SC_NONCE?>>

	$(document).on('click','#uploadImageIcon',function(e){
		
		e.preventDefault()
		
		$('#uploadStatusImg').trigger('click');	
		
		
	});
	

	
	$(document).on('click','#shareVideoIcon',function(e){
		
		e.preventDefault()
		
		$('#uploadStatusVideo').trigger('click');	
		
	});
	
	
	$(document).on('change', '#uploadStatusImg', function () {
		
		var file = this.files;
		
		var length = this.files.length; // get length
		
		var match= ["image/jpeg","image/png","image/jpg","image/gif"];
		
		var validation  = true;
		
		if (length > 0) {
			
			for (var i = 0; i < length; i++) {
				
				var imagefile = file[i].type;
		
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) )){
					
					validation  = false;
					
					break;
				}
			}
		}
		
		if(validation!=true){
			
			reset_image();
			
			alert('Only jpeg, jpg, gif and png Images type allowed');
					
			return false;
			
		}else{
			
			$('.uploadStatusImgMsg').text(length + " Image(s) Select");
			
			$("#uploadStatusVideo").prop('value', '');
		
		}
		
	});
	
	$(document).on('change', '#uploadStatusVideo', function () {  
	
		
		var file = this.files[0];
		
		var imagefile = file.type;
		
		var res = imagefile.split("/");
		
		var FileSize = file.size /1024 / 1024 ;
		
//		var match= ["video/mp4","video/ogv","video/avi","video/mkv"];	
//		
//		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
//		
//			reset_video();
//			
//			alert('Only mp4, ogv, avi and wmv Video type allowed');
//					
//			return false;
//			
//		}
		
		if(res[0]!='video')
		{
			 reset_video();
			
			 alert('Only video type allowed');
					
			 return false;
		}
		else{
			
			if (FileSize > 30) {
				
				reset_video();
					
				alert('File size exceeds 30 MB');
			
			} else {
				
				$('.uploadStatusImgMsg').text("1 Video Select");
				
				$("#uploadStatusImg").prop('value', '');
				
			}	
			
		}
		
	});
	
	
		
	$(document).on('submit', '#add_post_status', function (e) {
		
		e.preventDefault();
		
		var posttext 			= $('#post_text').val();
		
		var upload_img			= $('#uploadStatusImg').get(0).files.length;
		
		var upload_video		= $('#uploadStatusVideo').get(0).files.length;
		
		if(posttext == '' && upload_img == 0 && upload_video == 0){
			
			$('#post_text').focus();
				
			return false;
		}
		
		
		var formData = new FormData(this);
		
		var action_url = $(this).attr('action');
		
		var Afrm = $(this);
		
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
				
     			Afrm.find(':submit').addClass('dis_none');
				
				Afrm.find('.loader').removeClass('dis_none');
   			},
   			complete: function(){
				
     			Afrm.find(':submit').removeClass('dis_none');
				
				Afrm.find('.loader').addClass('dis_none');
				
   			},
			
			success: function(data)   // A function to be called if request succeeds
			{	
				
				console.log(data);	
			
				if(data['status']=='true'){
					
					$('#post_text').val('');
					
					$('.tagListDiv1').html('');
					
					$('.tagListDiv2').html('');
					 
					reset_image();
					
					reset_video();
					 
					$('#newsfeed-items-grid').prepend(data['text']);
					
					$("#newsfeed-items-grid .post-message:first-child").hide();
					
				    $("#newsfeed-items-grid .post-message:first-child").fadeIn();
				   
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
	});
	
	//uploadStatusImg
	
	
	
	
	$(document).on('submit','#add_post_share_video',function(e){
	
		e.preventDefault();
		
		var posttext 		= $('#post_text2').val();
		
		var video_share 		= $('#video_share').val();
		
		if(posttext == '' && video_share =='' ){
			
			$('#post_text2').focus();
				
			return false;
		}
		
		var formData = new FormData(this);
		
		var action_url = $(this).attr('action');
		
		var Afrm = $(this);
		
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
				
     			Afrm.find(':submit').addClass('dis_none');
				
				Afrm.find('.loader').removeClass('dis_none');
   			},
   			complete: function(){
				
     			Afrm.find(':submit').removeClass('dis_none');
				
				Afrm.find('.loader').addClass('dis_none');
				
   			},
			
			success: function(data)   // A function to be called if request succeeds
			{	
				
				console.log(data);	
			
				if(data['status']=='true'){
					
					$('#post_text2').val('');
					
					$('#video_share').val('');
					
					$('.tagListDiv1').html('');
					
					$('.tagListDiv2').html('');
					 
					reset_image();
					
					reset_video();
					 
					$('#newsfeed-items-grid').prepend(data['text']);
					
					$("#newsfeed-items-grid .post-message:first-child").hide();
					
				    $("#newsfeed-items-grid .post-message:first-child").fadeIn();
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
		
	});
	

	
	
	
	function reset_image(){
		
		$("#uploadStatusImg").prop('value', '');
		
		$('.uploadStatusImgMsg').text('No Image(s)/ Video Select'); 
		
	}
	
	function reset_video(){
		
		$("#uploadStatusVideo").prop('value', '');
		
		$('.uploadStatusImgMsg').text('No Image(s)/ Video Select'); 
	}
	
	
	
	
	

$(document).ready(function(e) {
	
		$("#myAutocomplete1").autocomplete({
			
			source:'<?php echo file_path();?>comman_c/auto_camplate',
			
			appendTo: "#autocomplete_section2",
			
			multiselect: true,
			
			open: function() {
				
				$('.ui-autocomplete-multiselect').css('min-width','100%');
				
    		}
				
		});	
		
		
		
});
</script>
	


<script nonce=<?=SC_NONCE?>>


	$(document).on('keyup', '#tagFriendSearch', function (e) {
		
		e.preventDefault();
		
		var search_value 		= $(this).val();
		
		if(search_value == ''){
				
			return false;
		}
		
		var action_url 	= 	'<?php echo file_path();?>tag/find_friend/?term='+search_value;
		
		var Afrm 		= 	$(this).closest('.webui-popover-content');
		
		
		
		$.ajax(
		{
			url: action_url, // Url to which the request is send
			
			type: "GET",             // Type of request to be send, called as method
			
			dataType : 'json',
			
			beforeSend: function(){
				
				$('.search-list-taging').html('');
				
   			},
   			complete: function(){
					
   			},
			
			success: function(obj)   // A function to be called if request succeeds
			{	
				
				$('.search-list-taging').html('');
				
				var keys = [];
				
				var member = getMemberSelected();
				
				console.log(member);
				
				$.each( obj, function( key, value ) {
					
					//txttagFriend
					
					
					if(jQuery.inArray(value['uid'], member) == -1) {
						
						$('.search-list-taging').append(value['html']);
						
					}
					
					//$('.'+key).html(value)
				});
				
				var scrollHeight = $('.search-list-taging').prop('scrollHeight')
				
		
				Afrm.height(scrollHeight+50);
				
		
			}
		
		});
		
		
	});
	

	
	$(document).on('click', '#tag_friend_sel', function (e) {
		
		e.preventDefault();
		
		var tot_tag_frnd = getMemberSelected().length+1;
		
		//console.log(tot_tag_frnd+1);
		
		if(tot_tag_frnd>50) //tag frnd limit;
		{
			return false;
		}
		
			
		var title = $(this).attr('title');
		
		var uid = $(this).attr('uid');
		
		var tab = $(this).closest('.search-list-taging').attr('tab')
		
		var html = '<div class="tag_selected_member pull-left">'+title+'  <a href="#" id="tag_selected_member_remove">X</a><input type="hidden" class="txttagFriend" name="tagFriend[]" value="'+uid+'"></div>';
		
		$('.'+tab).append(html);
		
		
		
		
		$(this).closest('li').remove();
			
	});	
	
	$(document).on('click', '#tag_selected_member_remove', function (e) {
		
		e.preventDefault();
		
		$(this).closest('div').remove();
			
	});		
	
	
	function getMemberSelected(){
		
		var member = [];
		
		$('.txttagFriend').each(function (index, value){
			
			member.push($(this).val());
		
		});
		
		return member;
		
	}
	

	
	
	
</script>
	
	
<style>

</style>

