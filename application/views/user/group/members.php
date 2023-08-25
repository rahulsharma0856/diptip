<div class="container">
  <div class="row">
    <div class="col-xl-8 push-xl-4 col-lg-8 push-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title"><span class="html_tot_likes"></span>Members (<?=count($JoinedMembers)?>)</h6>
        </div>
        <div class="ui-block-content">
          <div class="row"> 
            
            <!-------->
            
           
            <?php for($i=0;$i<count($JoinedMembers);$i++){ ?>
            
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-6" id="req_div">
            
              <div class="ui-block" data-mh="friend-groups-item" style="height: 263px;">
              
                <div class="friend-item friend-groups">
                
                  <div class="friend-item-content">
                  
                    <div class="more"> <svg class="olymp-three-dots-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use></svg>
                    
                      <ul class="more-dropdown">
                      
                        <li> <a href="<?=file_path('profile/view/'.$JoinedMembers[$i]['username'])?>">View Profile</a> </li>
                        
						<?php if($JoinedMembers[$i]['usercode']!=$result[0]['uid']){ ?>
                        
                        	<li> <a href="#" id="delete_member" value="<?=$JoinedMembers[$i]['id']?>">Remove Member</a> </li>
                        
                        <?php } ?>
                        
                      </ul>
                      
                    </div>
                    
                    <div class="friend-avatar" style="margin-bottom: 15px;">
                    
                      <div class="author-thumb"> <img src="<?=thumb($JoinedMembers[$i]['profile_img'],150,150)?>" alt="Fried" style="width:100%;"> </div>
                      
                      <div class="author-content"> 
                      
                      <a href="<?=file_path('profile/timeline/'.$JoinedMembers[$i]['username'])?>" class="h5 author-name">
                      
                        <?=$JoinedMembers[$i]['name']?>
                        
                        </a>
                        
                        </div>
                    </div>
                    
                     </div>
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

	$(document).on('click','#delete_member',function(e){
		
		e.preventDefault();
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('group/delete_member')?>'+value;
		
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
