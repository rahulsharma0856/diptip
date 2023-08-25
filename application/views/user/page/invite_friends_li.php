<li class="sec-replace" style="padding: 8px 25px !important;">
				
        <div class="author-thumb"> <img src="<?=thumb($result['profile_img'],100,100)?>" style="width:40px;" alt="author"> </div>
        
        <div class="notification-event"> <span class="h6 notification-friend"> <?=$result['name']?> </span> </div>
        
        <span class="notification-icon" style="margin-top: 9px;"> 
        
        <?php if($result['join_pg']!=NULL) {?>
        
        		<span style="color:#000;">Joined</span>
                
        <?php } elseif($result['join_request']!=NULL) {?>
        
        		<span style="color:#000;">Invitation sent</span>
                
        <?php } else { ?>
        
            <div class="checkbox clicked">
            
                <label>
                
                <input type="checkbox" name="friendId[]" class="friendChk" id="friendId" value="<?=$result['friend']?>"><span class="checkbox-material"><span class="check"></span></span>
                
                </label>
            
            </div>
        
        <?php } ?>
        
        
        </span> 
					
</li>