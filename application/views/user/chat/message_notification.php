<?php for($i=0;$i<count($result);$i++){ ?>

<div class="mCustomScrollbar" data-mcs-theme="dark">

  <ul class="notification-list">
  
    <li>
    
      <div class="author-thumb"> <img src="<?=thumb($result[$i]['profile_img'],100,100)?>" width="34" alt="author"> </div>
      
      <div style="width:76%;" class="notification-event">
      
      	<a href="#" id="rightbar_online_mem" memcode="<?=$result[$i]['uid']?>"><div style="color:#00547b;">
		
        <?php
		if($result[$i]['type']=='r')
		{
			echo '<i class="fa fa-share" aria-hidden="true"></i>';
		}
		if($result[$i]['type']=='s')
		{
			echo '<i class="fa fa-reply" aria-hidden="true"></i>';
		}
		?>
		
		<?=$result[$i]['name'].' -'?> 
		
        <?php
		$strlen =  strlen($result[$i]['msg']);
		
		if($strlen > 50)
		{
			echo substr(filter_message($result[$i]['msg']), 0, 50) . '...';
		}
  		else
		{
			echo filter_message($result[$i]['msg']);
		}
		
		?>
       
		
		</div></a>
        
        <span class="notification-date">
        
        <time class="entry-date updated" datetime="2004-07-24T18:18"><?=time_ago($result[$i]['last_timestamp'])?></time>
        
        </span> 
        
        </div>
        
    </li>
    
  </ul>
  
</div>

<?php } ?>