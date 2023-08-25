<?php if($only_inner!=true) {?>

<li class="sec-replace" style="padding:25px !important;">

<?php } ?>



  <div class="author-thumb"> <a href="<?=file_path('profile/view/'.$result['username'])?>"><img src="<?=thumb($result['profile_img'],150,150)?>" style="width:40px;" alt="author"></a> </div>
  
  <div class="notification-event"> 
  	
	
    
        <a href="<?=file_path('profile/view/'.$result['username'])?>" class="h6 notification-friend"><?=$result['name']?></a> 
        
        <?php if($result['mutual_friends'] > 0){ ?>  
         
       	 <span class="chat-message-item"><?=$result['mutual_friends']?> Mutual Friend</span> 
        
        <?php } ?>
    
  </div>
  
  
  <?php if(!isset($result['friend'])){ ?>
  
  		 <span class="notification-icon"> <a id="friend_request_send" href="<?=file_path('profile/friend_request_send/'.$result['usercode'].'/view2')?>" class="btn btn-green btn-sm">Send Friend Request</a> </span>
   
   <?php } else { ?>
   		
        <?php if($result['friend']['status']=='0'){ ?>
        
        	 <?php if($result['friend']['user_1']==user_session('usercode')){ ?>
             
             		<span class="notification-icon"> <a id="friend_request_delete" href="<?=file_path('profile/friend_request_delete/'.$result['usercode'].'/view2')?>" class="btn btn-danger  btn-sm"><i class="fa fa-times"></i> Delete Request</a></span>
                    
             <?php } else { ?>
             		
                <span class="notification-icon">    
                
                	<a id="friend_request_accept" href="<?=file_path('profile/friend_request_accept/'.$result['usercode'].'/view2')?>" class="btn btn-blue btn-sm"><i class="fa fa-plus-square-o"></i> Accept </a>  
                    
                	<a id="friend_request_delete" href="<?=file_path('profile/friend_request_delete/'.$result['usercode'].'/view2')?>" class="btn btn-danger btn-sm"><i class="fa fa-minus-square-o"></i> Delete</a>
                    
                </span>
                    
             <?php } ?>
	   			
        
        <?php } else { ?>
        	
            <span class="notification-icon"> <a href="#" class="btn btn-green btn-sm">Friend</a></span>
            
        <?php } ?>
   
   <?php } ?>
 
<?php if($only_inner!=true) {?>   

</li>

<?php } ?>
