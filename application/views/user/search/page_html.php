<?php if($only_inner!=true) {?>

		<li style="padding:25px !important;" class="sec-replace">
        
 <?php } ?>
 	

    
  <div class="author-thumb"> <a href="<?=file_path('page/view/'.$result['id'])?>"><img src="<?=thumb($result['profile_img'],150,150)?>" style="width:40px;" alt="author"></a> </div>
  
  
  <div class="notification-event"> <a href="<?=file_path('page/view/'.$result['id'])?>" class="h6 notification-friend"><?=$result['name']?></a> <span class="chat-message-item"><?=$result['cat_name']?></span> </div>
  
  	
    	<?php if($result['pg_code']!=''){ ?>
        
            <span class="notification-icon">
            
                <div class="btn-group">
                
                <button type="button" class="btn btn-success" style="background-color:#00547b; border-color:#00547b;" id="btn2">LIKED</button>
                
                <button type="button" id="btn2" class="btn btn-success dropdown-toggle" style="background-color:#00547b; border-color:#00547b;" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> </button>
                
                <ul class="dropdown-menu dropdown-sub" role="menu">
                
                	<li><a id="do_unlike_page" href="<?=file_path('page/do_unlike_co/'.$result['id'].'/view2')?>">UNLIKE</a></li>
                
                </ul>
                
                </div>
            
            </span>
        
        <?php } else { ?>
        
        		<span class="notification-icon"><a id="do_like_page" href="<?=file_path('page/do_like_co/'.$result['id'].'/view2')?>" class="btn btn-green btn-sm">LIKE</a>  </span>
                
        <?php } ?>
        
        
<?php if($only_inner!=true) {?>   

</li>

<?php } ?>
