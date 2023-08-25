<div class="modal fade show" id="fav-page-popup" style="display:block;">
  <div class="modal-dialog ui-block window-popup fav-page-popup"> <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"> <svg class="olymp-close-icon">
    <use xlink:href="icons/icons.svg#olymp-close-icon"></use>
    </svg> </a>
    <div class="ui-block-title">
      <h6 class="title"><?=filter_message($title)?> <span class="pull-right"><a href="#" class="popup-modal-dismiss"><i class="fa fa-times"></i></a></span> </h6>
    </div>
    <div class="ui-block-content invite_div" style="padding:0px 20px;">
    
      <form id="frm_invite_submit" action="<?=file_path('invite_friends/page_invite')?>" method="post">
      	
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            
            <input type="hidden" name="eid" value="<?=$result[0]['id']?>">
            
        <div class="row" id="scroll_div">
        	
          <ul class="notification-list friend-requests serach-list-friend" style="width:100%;max-height:450px;overflow:auto;">
            
          </ul>
          <div style="padding:10px 10px;">
            <button class="btn btn-green btn-sm" id="btn_invitations" disabled>Send Invitations</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>




<script nonce=<?=SC_NONCE?>>

$(document).ready(function() {
    	
		load_member();
		
		$('.serach-list-friend').scroll(function() {
			
			 if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
				 
				 load_member();
			 }
		
		}); 
   
});


function load_member(){
	
		
		var value = $(this).attr('value');
		
		var total  = $(".serach-list-friend li").length;
		
		var url = '<?=file_path('invite_friends/load_member/'.$result[0]['id'])?>?start_from='+total+'&p'+total;
	
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			beforeSend: function(){
				
     			
				
   			},
   			complete: function(){
				
     			
		
   			},
			
			success:function(data){
				
				if(data['html']!=''){
					
					$('.serach-list-friend').append(data['html']);	
					
				}else{
					
			
				}

		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});

	
}


$(document).on('change','#friendId',function(e){
	
	var total = total_select_count();
	
	
	if(total==0){
		
		$("#btn_invitations").html('Send Invitations');
		
		$("#btn_invitations").prop("disabled",true);
		
	}else{
		
		$("#btn_invitations").html('Send Invitations ('+total+')');
		
		$("#btn_invitations").prop("disabled",false);
		
	}
	
});

function total_select_count(){
	
	var total = 0;
	
	var p  = $(".friendChk").length;
	
	$('.friendChk').each(function (index, value) { 

		if($(this).prop('checked') == true){
		
			total++;
		
		}
		
	});
	
	return total;
}





		
		


$(document).on('submit','#frm_invite_submit',function(e){
	
		e.preventDefault();

		var total = total_select_count();
	
		if(total==0){
				
			alert('Please Select Friend');
				
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
					
   				},
   				complete: function(){
					
					//$.magnificPopup.close();
					
					$('.invite_div').html('<p class="title_txt">Invitation Sent successfully</p>');
				
   				},
			
				success: function(data)   // A function to be called if request succeeds
				{	
				
			 	}
		
		});
		
		
		
	});






</script>

<style>
	.fav-page-popup {
    	width: 540px;
	}
	.title_txt{
		font-size: 16px;
		text-align: center;
		padding: 20px;
	}
</style>
