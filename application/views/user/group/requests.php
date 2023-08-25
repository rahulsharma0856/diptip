<div class="container">
  <div class="row">
    <div class="col-xl-8 push-xl-4 col-lg-8 push-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title"><span class="html_tot_likes"></span>Join Requests (<?=count($GroupJoinRequest)?>)</h6>
        </div>
        <div class="ui-block-content">
          <div class="row"> 
            
            <!-------->
            
            <?php for($i=0;$i<count($GroupJoinRequest);$i++){ ?>
            
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-6" id="req_div">
            
              <div class="ui-block" data-mh="friend-groups-item" style="height: 263px;">
              
                <div class="friend-item friend-groups">
                
                  <div class="friend-item-content">
                  
                    <div class="more"> <svg class="olymp-three-dots-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use></svg>
                    
                      <ul class="more-dropdown">
                      
                        <li> <a href="<?=file_path('profile/view/'.$GroupJoinRequest[$i]['username'])?>">View Profile</a> </li>
                        
                      </ul>
                      
                    </div>
                    
                    <div class="friend-avatar" style="margin-bottom: 15px;">
                    
                      <div class="author-thumb"> <img src="<?=thumb($GroupJoinRequest[$i]['profile_img'],150,150)?>" alt="Fried" style="width:100%;"> </div>
                      
                      <div class="author-content"> 
                      
                      <a href="<?=file_path('profile/timeline/'.$GroupJoinRequest[$i]['username'])?>" class="h5 author-name">
                      
                        <?=$GroupJoinRequest[$i]['name']?>
                        
                        </a>
                        
                        </div>
                    </div>
                    
                    <span class="notification-icon"> <a href="#" class="accept-request" id="accept_join_req" value="<?=$GroupJoinRequest[$i]['id']?>"> <span class="icon-add without-text"> <svg class="olymp-happy-face-icon">
                    <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-face-icon"></use>
                    </svg> </span> </a> <a href="#" class="accept-request request-del" id="delete_join_req" value="<?=$GroupJoinRequest[$i]['id']?>"> <span class="icon-minus"> <svg class="olymp-happy-face-icon">
                    <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-face-icon"></use>
                    </svg> </span> </a> </span> </div>
                </div>
              </div>
            </div>
            <?php } ?>
            
            <!--------------> 
            
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('user/group/bar_left2');?>
  </div>
</div>

<script nonce=<?=SC_NONCE?>>

	$(document).on('click','#delete_join_req',function(e){
		
		e.preventDefault();
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('group/join_request_delete')?>'+value;
		
		var req_div = $(this).closest('#req_div');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				req_div.hide(1000, function () {
				
					div.remove();
				
				});	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	
	
	$(document).on('click','#accept_join_req',function(e){
		
		e.preventDefault();
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('group/join_request_accept')?>'+value;
		
		var req_div = $(this).closest('#req_div');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				req_div.hide(1000, function () {
				
					div.remove();
				
				});	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});

</script>
