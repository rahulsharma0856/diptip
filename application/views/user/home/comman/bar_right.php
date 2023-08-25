<!-- Fixed Sidebar Right -->

<div class="fixed-sidebar right">
	<div class="fixed-sidebar-right sidebar--small" id="sidebar-right">

		<div class="mCustomScrollbar" data-mcs-theme="dark">
			<ul class="chat-users right_bar_online_friend_short">
				 
			</ul>
		</div>

	
		<a href="#" class="js-sidebar-open olympus-chat inline-items" title="Open Chat">
			
			
<i style="font-size: x-large !important;float: right;color: white;" data-toggle="tooltip" data-placement="right" class="fa fa-comment" aria-hidden="true"></i>
			
        </a>

	</div>

	<div class="fixed-sidebar-right sidebar--large" id="sidebar-right-1">

		<div class="mCustomScrollbar" data-mcs-theme="dark">

			<div class="ui-block-title ui-block-title-small">
            	<h6 class="title">
								<span class="icon-status online" style="width: 10px;  height: 10px;"></span>
				Messaging

				</h6>
				    <a href="#" class="js-sidebar-open" title="close">
				 <i style="font-size: large !important;float: right;" data-toggle="tooltip" data-placement="right" class="fa fa-remove" aria-hidden="true"></i>
				
			</a>

			</div>
			
			
			<div class="ui-block-title ui-block-title-small" style="padding: 5px; border-bottom:1px solid #e6ecf5;">
            	<form class="form-group">
				<input class="form-control" id="live_chat_search" onKeyUp="live_chat_search_fun(this)" placeholder="Search..." value="" type="text">
			</form>
			
				
	
			</div>
				
			
			
			
			
			
			
			
			<ul class="chat-users right_bar_online_friend_full">
            </ul>

		</div>

		
        
	</div>
    
</div>

<!-- ... end Fixed Sidebar Right -->

<!-- Fixed Sidebar Right -->


<!-- ... end Fixed Sidebar Right -->

<!-------------------------->

<div class="bc-container" id="chat-static-section">
  


  
  
</div>

<style>

.chat-close-icon{
	color: #fff;
    margin-left: 20px;
    font-size: 13px;
}

	.bc-container {
		position: fixed;
		bottom: 2px;
		right: 270px;
		height: 350px;
		margin-right: 10px;
		pointer-events: none;
		z-index:9999;
	}


	.bc-friends-container {
		width: 250px;
		float: right;
		bottom: 0;
		margin-left: 10px;
		box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
		pointer-events: all;
	}

	.bc-friends-content .sidebar-users a {
		border-bottom: 1px solid #EEE;
	}
	.bc-friends-chat {
		background: #FFF;
		height: 228px;
		border: 1px solid #BFBFBF;
		border-top: none;
		border-bottom: none;
		padding: 0 5px;
		overflow: auto;
	}


	.bc-friends-user {
		margin-top: -15px;
	}
	
	.online_f_img{
		width:34px !important;
	}
	
	.msg_by_self .chat-message-item{
		
		float: right !important;
		
		background-color: #328232 !important;
		
		color:#FFFFFF !important;
		
		/*min-width: 130px !important;*/
	}
	
	.msg_by_self .author-thumb  {
		
    	float: right !important;
		
	}
	
	.msg_by_self .notification-date{
		float:right !important;
	}
	
	.msg_by_friend  .chat-message-item{
		
		background-color: #f0f4f9 !important;
		
    	color: #888da8  !important;
		
		/*min-width: 130px !important;*/
		
	}
	.msg_by_friend .author-thumb {
		
	   float: none !important;
	   
	}
	
	.popup-chat .mCustomScrollbar {
		
   	 	min-height: 266px !important;
		
	}
	
	.process_msg{
		
		text-align: center;
		
		padding: 20px;
		
		border: #e6ecf5 solid 1px;
		
		
	
	}
	
	.load-more-chat{
		
		text-align: center !important;
		
		padding: 5px !important;
		
		border: #f0f4f9 solid 1px !important;
		
	}
	
	
	
	.popup-chat .chat-message-field li {
		
		overflow: hidden;
		
		padding: 9px 15px !important;
	
	}
	
	.chat-message .author-thumb {
		
  	  	height: 36px !important;
		
    	width: 36px !important;
		
	}
	
	.msg_by_friend .delete-message{
		font-weight: bold;
		color: #c2f1c3 !important;
	   
		border-radius: 50%;
		font-size: 10px;
		position: absolute;
		top: -6px;
		right: 0px;
		background: #cc2c2c;
		width: 15px;
		height: 15px;
		text-align: center;
		padding-top: 1px;
		display:none;
	}
	
	.msg_by_self .delete-message{
		
   
		font-weight: bold;
		color: #c2f1c3 !important;
	   
		border-radius: 50%;
		font-size: 10px;
		position: absolute;
		top: -6px;
		right: 0px;
		background: #cc2c2c;
		width: 15px;
		height: 15px;
		text-align: center;
		padding-top: 1px;
		display:none;
	}
	
	.chat-message-item:hover .delete-message{
		display:inline-block;
	}
</style>
<script nonce=<?=SC_NONCE?>>

	var array_chat_window = [];
	
	$(document).on('click','#closeChatWindow',function(e){
        
		e.preventDefault();
		
		var uid = $(this).attr('memcode');
		
		closeChatWindow(uid);
		
    });
	
	
	function closeChatWindow(id) {
		
		$('#chat-window-'+id).remove();
		
		remove_array_chat_window(id);
	
	}


	function remove_array_chat_window(removeItem){
	
		array_chat_window.splice( $.inArray(removeItem,array_chat_window) ,1 );
		
		setCookie('sm_chat',array_chat_window,1);

	}
	
	function add_array_chat_window(id){
	
		if(array_chat_window.indexOf(id) == -1 && id > 0) {
			
			array_chat_window.push(id);
		
		}
		
		setCookie('sm_chat',array_chat_window,1);
		
	
	}

	
	function setCookie(cname, cvalue, exdays) {
		
		var d = new Date();
		
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		
		var expires = "expires="+d.toUTCString();
		
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		
	}

	
	function getCookie(cname) {
		
		var name = cname + "=";
		
		var ca = document.cookie.split(';');
		
		for(var i = 0; i < ca.length; i++) {
			
			var c = ca[i];
			
			while (c.charAt(0) == ' ') {
				
				c = c.substring(1);
				
			}
			
			if (c.indexOf(name) == 0) {
				
				return c.substring(name.length, c.length);
				
			}
			
		}
		
		return "";
}
	
	$(document).on('click','#rightbar_online_mem',function(e){
        
		e.preventDefault();
		
		var uid = $(this).attr('memcode');
		
		open_chat(uid);
		
    });


	function open_chat(uid){
		
		var url = '<?=file_path('chat/open_chat_box')?>'+uid;
		
		var child = $('#chat-static-section').find("#chat-window-"+uid);
		
		if(child.length > 0) {
			
			return false;
		
		}
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				
				if($('#chat-static-section').find("#chat-window-"+uid).length < 1){
					
					add_array_chat_window(uid);
					
					$('#chat-static-section').append(data['box']);
					
					msg_noti_sound();
				
				}
				
		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			//alert(textStatus);
			
			}
		
		});
	
		return false;
	}

	$(document).on('keydown','#chat_msg_box1',function(e){
		
		if (e.which == 13) {
		
			var form = $(this).closest('form')[0];
			
			var sub_form = new FormData(form);
			
			console.log(sub_form);
					
			var action_url = '<?=file_path('chat/add_message')?>';
			
			$.ajax({
				
				url: action_url, 			// Url to which the request is send
			
				type: "POST",             // Type of request to be send, called as method
			
				data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
				contentType: false,       // The content type used when sending data to the server.
			
				cache: false,             // To unable request pages to be cached
			
				processData:false,        // To send DOMDocument or non processed data file it is set to false
			
				dataType : 'json',
			
				beforeSend: function(){
				
     				//Afrm.find(':submit').addClass('dis_none');
				
					//Afrm.find('.loader').removeClass('dis_none');
                    
   				},
   				complete: function(){
				
     				//Afrm.find(':submit').removeClass('dis_none');
				
					//Afrm.find('.loader').addClass('dis_none');
				
   				},
			
				success: function(data)   // A function to be called if request succeeds
				{	
				
					console.log(data);	
			
					if(data['status']=='true'){
                    
					}else{
		
                        alert(data['text']);
					
					}
				
			}
		
		});
			
			////
			
			return false;
		
		}    
	});
	
	
	$(document).on('keydown','.chat_msg_box_txt',function(e){
		
		if (e.which == 13) {
			
				var uid = $(this).attr('memcode');
		
				postChat(uid);
			
		}
	});
	
	
	function postChat(id){
		
		var message = $('#chat_msg_box_'+id).val();
		
		if(message==''){
			
			return false;
			
		}
		
		$('#chat_msg_box_'+id).val('...');
		
		$('#chat_msg_box_'+id).addClass('dis_none');
		
		$('#process-'+id).removeClass('dis_none');
		
		$.ajax({
			
		type: "POST",
		
		url: "<?=file_path('chat/add_message')?>",
		
		data: 'message='+encodeURIComponent(message)+'&id='+id,
		
		cache: false,
		
		dataType : 'json',
        
        beforeSend: function(){
            // Apply temp colors..
            $('#chat-frm-'+id).attr('style', ' border-style: solid; border-width: 1px; border-color: rgba(205, 132, 19, 0.6); '
                + 'background-image: radial-gradient(rgba(231, 229, 35, 0.6), rgba(245, 244, 167, 0.4), rgba(255, 255, 255, 0.10));');
        },
		
		success: function(data) {
            
            // Check if valid status.. Change colors.
            if (data['status'] == 'true') {
                $('#chat_msg_box_'+id).attr('style', 'background-color: #47a348; opacity: 0.6;');
            } else {
                $('#chat_msg_box_'+id).attr('style', 'background-color: #cd8413; opacity: 0.6;');
            }
            
			// Check if in the mean time any message was sent
			
			// Append the new chat to the div chat container
			
			$('#chat_msg_box_'+id).removeClass('dis_none');
		
			$('#process-'+id).addClass('dis_none');
			
			$('#friends-chat-'+id).append(data['html']);
            
			$('.Scrollbar-'+id).scrollTop($('.Scrollbar-'+id)[0].scrollHeight);
			
			$('#chat_msg_box_'+id).focus();
			
		},
        
        complete: function() {
            
            // Remove temp colors..
            $('#chat-frm-'+id).attr('style','background-color: inherit;');
        
            $('#chat_msg_box_'+id).attr('style','background-color: inherit;');
            
            $('#chat_msg_box_'+id).val('');
            
        }
        
	});
	
	return false;
	
	}
	

	
	$(document).on('click','#load_more_chat',function(e){
        
		e.preventDefault();
		
		var uid = $(this).attr('memcode');
		
		load_more_chat(uid);
		
    });
	
	
	
	function load_more_chat(id){
        
		var last_id = $("ul#friends-chat-"+id+" li:first").attr("data-message-id");
		
		$.ajax({
			
			type: "GET",
			
			url: "<?=file_path('chat/load_more_chat')?>",
			
			data: 'id='+id+'&last_id='+last_id,
			
			cache: false,
			
			dataType : 'json',
			
			success: function(data) {
			
				$('#friends-chat-'+id).prepend(data['html']);
				
				if(data['total']==0){
					
					$('#more-chat-'+id).hide();
					
				}
					
			}
		});
	
	return false;
	}
	
	
	
	function checkChatMsg(){
			
		
			$.ajax({
			
				type: "GET",
				
				url: "<?=file_path('chat/checkNewMessage')?>",
				
				data: 'friend='+array_chat_window,
				
				cache: false,
				
				dataType : 'json',
			
				success:function(data){
			
					console.log(data);	
					
					var message = data['message'];
					
					$('.html_count_recive_unread_msg').html(data['count_recive_unread_msg']);
					
					$.each( message, function( key, obj ) {
						
						if($('#friends-chat-'+obj['window']).find("#chat-message-"+obj['id']).length < 1){
							
							$('#friends-chat-'+obj['window']).append(obj['html']);
						
							$('.Scrollbar-'+obj['window']).scrollTop($('.Scrollbar-'+obj['window'])[0].scrollHeight);
							
							// msg noti sound
							
							msg_noti_sound();
							
							
						}
											
					
					});
					
					
					var unreadMessge = data['unreadMessge'];
					
					
					
					$.each( unreadMessge, function( key, obj ) {
						
						if($('#chat-window-'+obj['id']).length < 1){
							
							if($('.bc-friends-container').length < 4){
								
								open_chat(obj['id']);		
								
							}
					
						}
							
					});	
					

				},
			
				error: function( jqXHR, textStatus, errorThrown) {
				
				//alert(textStatus);
			
				}
			
			});
			
			return false;
			
	}
	
	
	$(document).ready(function(e) {
	
		var friends_cid = getCookie('sm_chat');
		
		friends_cid = friends_cid.split(',');
		
		$.each( friends_cid, function( key, value ) {
			
		
			if(value!=""){
				
				open_chat(value);
				
			}
			
			
		});

        setInterval(function(){ 
		
    		checkChatMsg();
				
		}, 3300);
		
    });
	
	
	
	function live_chat_search_fun(){
		
		
		
		var u_serach = $('#live_chat_search').val();
		
		$.ajax({
		
			type: "GET",
			
			url: "<?=file_path('notifiction/live_chat_search')?>",
			
			data: 'u_serach='+u_serach,
			
			cache: false,
			
			dataType : 'json',
			
			success:function(data){
			
				$('.right_bar_online_friend_full').html(data['html']);
			
			
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
				//alert(textStatus);
			
			}
		
		});
		
		
	}
	
	
	
	//delete_chat_message
	
	$(document).on('click','#delete_chat_message',function(e){
        
		e.preventDefault();
		
		var eid = $(this).attr('eid');
		
		delete_chat_message(eid);
		
    });
	
	
	function delete_chat_message(id){
		
		var confirm_delete = confirm('Delete Message ?');
		
		if(!confirm_delete){
		
			return false;
		
		}
		
		var u_serach = $('#live_chat_search').val();
		
		$.ajax({
		
			type: "GET",
			
			url: "<?=file_path('chat/chat_message_delete')?>",
			
			data: 'id='+id,
			
			cache: false,
			
			dataType : 'json',
			
			success:function(data){
				
				$('#chat-message-'+data['id']).remove();
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
				//alert(textStatus);
			
			}
		
		});
		
		return false;
		
	}
	
	
	//deleteAllChat
	
	$(document).on('click','#deleteAllChat',function(e){
		
		e.preventDefault();
		
		var uid = $(this).attr('memcode');
		
		deleteAllChat(uid);
			
		
	});
	
	function deleteAllChat(id){
		
		var confirm_delete = confirm('Delete All Chat ?');
		
		if(!confirm_delete){
		
			return false;
		
		}
		

		$.ajax({
		
			type: "GET",
			
			url: "<?=file_path('chat/chat_message_delete_all')?>",
			
			data: 'id='+id,
			
			cache: false,
			
			dataType : 'json',
			
			success:function(data){
				
				$('#friends-chat-'+data['id']).html('');
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
				//alert(textStatus);
			
			}
		
		});
		
		return false;
		
	}
	
	
	$(document).on('click','#chatimgIcon',function(e){
		
		e.preventDefault();
		
		var uid = $(this).attr('memcode');
		
		chatimgIcon(uid);
			
		
	});
	
	
	
	function chatimgIcon(id){
		
		$('#chat-img-'+id).trigger('click');	
		
		return false;	
	}
	
	
	$(document).on('change','.chat_img1',function(e){
		
		e.preventDefault();
		
		var uid = $(this).attr('memcode');
		
		var type = $(this);
		
		chat_image_select(type[0],uid);
			
		
	});
	
	function chat_image_select(oInput, uid){
		
			var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]; 
	
			console.log(oInput.value)
			
			if (oInput.type == "file") {
				
			var sFileName = oInput.value;
			
			 if (sFileName.length > 0) {
				 
				var blnValid = false;
				
				for (var j = 0; j < _validFileExtensions.length; j++) {
					
					var sCurExtension = _validFileExtensions[j];
					
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						
						blnValid = true;
						
						break;
						
					}
					
				}
				
				if (!blnValid) {
					
					alert("Sorry, invalid file selected, allowed extensions are: " + _validFileExtensions.join(", "));
					
					oInput.value = "";
					
					return false;
					
				}else{
					
					image_submit(uid);
					
				}
				
			}
			
		}
		
		return true;
		
	}
	
	function image_submit(uid){
	
		////
		
		var frm = $('#chat-frm-'+uid)[0];
		
		
		$('#chat_msg_box_'+uid).val('');
		
		$('#chat_msg_box_'+uid).addClass('dis_none');
		
		$('#process-'+uid).removeClass('dis_none');
		
		$.ajax(
		{
			url: "<?=file_path('chat/add_image')?>", // Url to which the request is send
			
			type: "POST",             // Type of request to be send, called as method
			
			data: new FormData(frm), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
			contentType: false,       // The content type used when sending data to the server.
			
			cache: false,             // To unable request pages to be cached
			
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			
			dataType : 'json',
			
			beforeSend: function(){
            				
				$('#chat_msg_box_'+uid).val('');
			
				$('#chat_msg_box_'+uid).addClass('dis_none');
                
                $('#chat-frm-'+uid).attr('style', ' border-style: solid; border-width: 1px; border-color: rgba(205, 132, 19, 0.6); '
                    + 'background-image: radial-gradient(rgba(231, 229, 35, 0.6), rgba(245, 244, 167, 0.4), rgba(255, 255, 255, 0.10));');
                
				$('#process-'+uid).removeClass('dis_none');
				
   			},
   			complete: function(){
				
                $('#chat-frm-'+uid).attr('style','background-color: inherit;');
                
                $('#chat_msg_box_'+uid).attr('style','background-color: inherit;');
	
   			},
			
			success: function(data){	
				
                if (data['status'] == 'false') {
                    
                    $('#chat_msg_box_'+uid).attr('style', 'background-color: #cd8413; opacity: 0.6;');
                
                    $('#chat_msg_box_'+uid).removeClass('dis_none');
                    
                    $('#process-'+uid).addClass('dis_none');
                    
                    alert(data['text']);
                    
                    $('.Scrollbar-'+uid).scrollTop($('.Scrollbar-'+uid)[0].scrollHeight);
                    
                    $('#chat_msg_box_'+uid).focus();
                                        
                    $('#chat-frm-'+uid)[0].reset();
                    
                } else {
                
                    $('#chat_msg_box_'+uid).attr('style', 'background-color: #47a348; opacity: 0.6;');
				
                    $('#chat_msg_box_'+uid).removeClass('dis_none');
                    
                    $('#process-'+uid).addClass('dis_none');
                    
                    $('#friends-chat-'+uid).append(data['html']);
                                       
                    $('.Scrollbar-'+uid).scrollTop($('.Scrollbar-'+uid)[0].scrollHeight);
                    
                    $('#chat_msg_box_'+uid).focus();
                    
                    $('#chat-frm-'+uid)[0].reset();
			
                }
		
			},
            
            error: function(){
                // TODO: use this?
   			}
		
		});
		

		
		////	
		
	}

	
	//msg noti sound
	
	function msg_noti_sound()
	{	
		var sound_file = "<?=asset_sm()?>mp3/noti.mp3";
		var audio = new Audio(sound_file);
        audio.play();
	}
	
	
</script> 
<style>
 
#style-1{
	overflow-y: scroll !important;
}

#style-1::-webkit-scrollbar{
	width: 2px;
	background-color: #FFFFFF;
}

/**  STYLE 4 */
#style-1::-webkit-scrollbar-track {
	/*-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);*/
	background-color: #FFFFFF;
}

#style-1::-webkit-scrollbar-thumb {
	background-color: rgba(0, 0, 0, 0.3);
	border: 2px solid rgba(85, 85, 85, 0.2);
}
.load-more-chat::after {
	content: '';
	display: inherit;
	width: 100%;
	margin: 5px auto;
	border-top: 1px solid #ff5e3a;
}
 </style>
