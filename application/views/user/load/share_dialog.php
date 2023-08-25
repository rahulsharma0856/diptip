
 <div id="dialog_share"></div>
 
 <div id="dialog_share_msg" title="Share"></div>

<script nonce=<?=SC_NONCE?>>
		$(function() {
			
			$("#dialog_share").dialog({
				
				autoOpen: false,
				
				modal: true,
				
				width: 600,
				
				height: 'auto',
				
				resizable: false,
				
				buttons: {
					
					"Cancel": function() {
						
						$(this).dialog("close");
						
					},
					
					"Share": function() {
						
						$('#frm_share').submit();
							
					},
				},
				position: {
					
					my: "center top",
					
					at: "center top",
					
					of: window,
					
					collision: "none"
				
				},
				create: function (event, ui) {
					
					$(event.target).parent().css('position', 'fixed');
					
				},
				
				open: function(event, ui){
					
					$(this).dialog('option', 'maxHeight', $(window).height());
					
				}, 
				close: function() {
					
				}
				
			});
			
			
			
			////
			
			$("#dialog_share_msg").dialog({
				
				autoOpen: false,
				
				modal: true,
				
				width: 500,
				
				height: 'auto',
				
				resizable: false,
				
				buttons: {
					
					"Close": function() {
						
						$(this).dialog("close");
						
					},
				},
				
				position: {
					
					my: "center top",
					
					at: "center top",
					
					of: window,
					
					collision: "none"
				
				},
				create: function (event, ui) {
					
					$(event.target).parent().css('position', 'fixed');
					
				},
				
				
			});
			

			
			/////
			
		});
		
		
		
		$(document).on('click','.share_post_link',function(e){
		
				e.preventDefault();
				
				$("#dialog_share").html("");
				
				$("#dialog_share").dialog("option", "title", $(this).text()).dialog("open");
				
				$("#dialog_share").load(this.href, function() {
					
					
				});	
		
		});
		

		
		
		
		
		$(document).on('submit','#frm_share',function(e){
	
			e.preventDefault();

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
					
					$('.ui-dialog-buttonpane').append(' <img style="float:right;" class="loader" src="<?=asset_sm('loader.gif')?>">');
					
					$('.ui-dialog-buttonset').hide();
					
     				
   				},
   				complete: function(){
				
     				$('.ui-dialog-buttonset').show();
					
					$('.ui-dialog-buttonpane .loader').remove()
					
									
   				},
			
				success: function(data)   // A function to be called if request succeeds
				{	
				
					console.log(data);	
					
			
					if(data['status']=='true'){
						
						$("#dialog_share").dialog("close");
						
						$('#dialog_share_msg').html('<h5 class="msg_dialog">Post shared successfully.</h5>');
						
						$("#dialog_share_msg").dialog("option", "title", 'Post Share Alert').dialog("open");
						
					
					}else{
						
						$("#dialog_share").dialog("close");
						
						$('#dialog_share_msg').html('<h5>'+data['text']+'</h5>');
						
						$("#dialog_share_msg").dialog("option", "title", 'Share Post').dialog("open");
						
					
					}
				
			 }
		
		});
		
		
		
	});
	

		
		
	</script>


<style>
	.msg_dialog{
		margin-top:20px;
	}
</style>



