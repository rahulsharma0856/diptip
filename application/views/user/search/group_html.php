<?php if($only_inner!=true){ ?>

<li class="sec-replace" style="padding:25px !important;">

<?php } ?>
  <div class="author-thumb"> <img src="<?=thumb($result['profile_img'],150,150)?>" style="width:40px;" alt="author"> </div>
  <div class="notification-event"> <a href="<?=file_path('group/view/'.$result['id'])?>" class="h6 notification-friend"><?=$result['name']?></a> <span class="chat-message-item"><?=$result['group_privacy']?></span> </div>
  
  
    <span class="notification-icon">
    
    <?php if($result['join_status']=='1'){ ?>
        <div class="btn-group">
            <button type="button" class="btn btn-success" style="background-color:#337ab7; border-color:#337ab7;" id="btn2">Joined</button>
            <button type="button" id="btn2" class="btn btn-success dropdown-toggle" style="background-color:#337ab7; border-color:#337ab7;" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> </button>
            <ul class="dropdown-menu dropdown-sub" role="menu">
                <li><a id="group_delete_request" href="<?=file_path('group/delete_request/'.$result['id'].'/view2')?>">Leave Group</a></li>
                 <li><a href="<?=file_path('group/view/'.$result['id'])?>">View Group</a></li> 
            </ul>
        </div>
    <?php } elseif($result['join_status']=='0'){ ?>
   
            <div class="btn-group">
                <button type="button" class="btn btn-success" id="btn2">Request Sent</button>
                <button type="button" id="btn2" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> </button>
                <ul class="dropdown-menu dropdown-sub" role="menu">
                    <li><a id="group_delete_request" href="<?=file_path('group/delete_request/'.$result['id'].'/view2')?>">Cancel Request</a></li>
                    <li><a href="<?=file_path('group/view/'.$result['id'])?>">View Group</a></li> 
                </ul>
            </div>
        
      <?php } else{?>
      			<a id="group_request_send" href="<?=file_path('group/send_join_request/'.$result['id'].'/view2')?>" class="btn btn-blue btn-sm"><i class="fa fa-plus"></i> Join</a>
      <?php } ?>
    
    </span>

<?php if($only_inner!=true){ ?>   

</li>

<?php } ?>
