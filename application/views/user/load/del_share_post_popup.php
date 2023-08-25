<div class="modal fade " id="postShareModal" tabindex="-1" role="dialog" aria-labelledby="postShareModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postShareModalLabel">Share</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body"> Are you sure do you want to share this message on your timeline? </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="share_post_btn">Share</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade " id="postShareSucessModal" tabindex="-1" role="dialog" aria-labelledby="postShareSucessModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postShareSucessModalLabel">Share</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body"> The post has been successfully shared on your timeline.</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   
      </div>
    </div>
  </div>
</div>




<script nonce=<?=SC_NONCE?>>

	var share_post_id = 0;
	
	$(document).on('click','.post_share_link',function(e){
		
		e.preventDefault();
		
		share_post_id = $(this).attr('value');
			
		$('#postShareModal').modal('show');
		
	});
	
	$(document).on('click','#share_post_btn',function(e){
		
		if(share_post_id==0){
			
			$('#postShareModal').modal('hide');
			
			
			
			return false;
			
		}
		
		var url='<?=file_path('post/share_post')?>'+share_post_id;
		
		$.ajax({
		
			url:url,
			
			dataType : "json",
			
			success:function(data){
			
				$('#newsfeed-items-grid').prepend(data['text']);	
				
				$('#postShareModal').modal('hide');
				
				$('#postShareSucessModal').modal('show');
				
			}
		});
	});
</script> 
