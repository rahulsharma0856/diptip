$(document).on('click','#uploadImageIcon_edit',function(e){
		
		e.preventDefault();
		
		
		$('#uploadStatusimg_edit').trigger('click');	
		
		
	});
	

	
	$(document).on('click','#shareVideoIcon_edit',function(e){
		
		e.preventDefault()
		
		$('#uploadStatusVideo_edit').trigger('click');	
		
	});

	
	$(document).on('change', '#uploadStatusimg_edit', function () {
		
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
			
			reset_image2();
			
			alert('Only jpeg, jpg, gif and png Images type allowed');
					
			return false;
			
		}else{
			
			$('.uploadStatusImgMsg_edit').text(length + " Image(s) Select");
			
			$("#uploadStatusVideo_edit").prop('value', '');
		
		}
		
	});
	
	$(document).on('change', '#uploadStatusVideo_edit', function () {  
		
		var file = this.files[0];
		
		var imagefile = file.type;
		
		var match= ["video/mp4","video/ogv","video/avi","video/mkv"];	
		
		var FileSize = (file.size / 1024) /1024;
		
	
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
		
			reset_video();
			
			alert('Only mp4, ogv, avi and wmv Video type allowed');
					
			return false;
			
		}else{
			
			if (FileSize > 30) {
				
				reset_video2();
					
				alert('File size exceeds 30 MB');
			
			} else {
				
				$('.uploadStatusImgMsg_edit').text("1 Video Select");
				
				$("#uploadStatusImg_edit").prop('value', '');
				
			}	
			
		}
		
	});

	$(document).on('click', '.img_delete_icon', function (e) {  
	
		e.preventDefault();
			
		var url	= $(this).attr('href');
		
		var div = $(this).closest('.img_div');
		
		$.ajax({
			
			url:url,
			
			beforeSend: function(){
					
			},
			complete: function(){
					
			},
			success:function(){
				
				div.remove();
				
			},
			error: function( jqXHR, textStatus, errorThrown) {
				alert(textStatus);
			}
		});
		
	});
	
	function reset_image2(){
	
		$("#uploadStatusImg_edit").prop('value', '');
	
		$('.uploadStatusImgMsg_edit').text('No Image(s)/ Video Select'); 
	
	}
	
	function reset_video2(){
	
		$("#uploadStatusVideo_edit").prop('value', '');
	
		$('.uploadStatusImgMsg_edit').text('No Image(s)/ Video Select'); 
		
	}

	///
	
	var submit_frm = true;
	
	$(document).on('submit', '#post_edit_frm', function (e) {
		
		e.preventDefault();
		
		var formData = new FormData(this);
		
		var action_url = $(this).attr('action');
		
		var Afrm = $(this);
		
		if(submit_frm==false){
			
			return false;	
			
		}
		
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
				
				submit_frm = false; 
     			Afrm.find(':submit').addClass('dis_none');
				
				Afrm.find('.loader').removeClass('dis_none');
   			},
   			complete: function(){
				
     			Afrm.find(':submit').removeClass('dis_none');
				
				Afrm.find('.loader').addClass('dis_none');
				
				submit_frm = true; 
				
   			},
			
			success: function(data)   // A function to be called if request succeeds
			{	
				console.log(data);	
			
				if(data['status']=='true'){
					
					$('#'+data['divID']).html(data['text']);
					
					$.magnificPopup.close();
					
					alert('Post Update Successfully');
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
	});
	////