<?php

	if($result['type']=='Invite'){
		
		if($result['pg_type']=='page'){
			
			$txt = '<a href="'.file_path('page/view/'.$result['pgCode']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">invited you to like</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';
			
		}
		
		if($result['pg_type']=='group'){
			
			$txt = '<a href="'.file_path('group/view/'.$result['pgCode']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">invited you to join</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';
			
		}
		
	}
	
	elseif($result['type']=='like'){
		
		$post_type = ($result['post_type']=='add') ? "added" : "shared";
		
		//$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">liked your post you '.$post_type.'</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">liked your post</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
	}
	
	elseif($result['type']=='comment'){
		
		$post_type = ($result['post_type']=='add') ? "added" : "shared";  
		
		//$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">commented on your post you '.$post_type.'</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'?comment_id='.$result['comment_id'].'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">commented on your post</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
	}
	
	elseif($result['type']=='page_like'){
		
		$txt = '<a href="'.file_path('page/view/'.$result['pgCode']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">liked your page</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
	}
	
	elseif($result['type']=='group_join_request'){
		
		$txt = '<a href="'.file_path('group/requests/'.$result['pgCode']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">requested to join group </font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
	}
	
	elseif($result['type']=='group_join'){
		
		$txt = '<a href="'.file_path('group/members/'.$result['pgCode']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">joined your group</font > <b class="theme-txt2">'.$result['pg_name'].'</b></a>.';	
		
	}
	
	elseif($result['type']=='group_join_accept'){
		
		$txt = '<a href="'.file_path('group/view/'.$result['pgCode']).'" class="">  <font class="theme-txt2">Your request to join </font > <b class="theme-txt2">'.$result['pg_name'].'</b>  <font class="theme-txt2">has been approved. You can now post and comment in this group.</a>.</font >';	
		
	}
	
	elseif($result['type']=='timeline_write'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">posted on your timeline</font ></a>.';	
		
	}
	
	elseif($result['type']=='share_on_timeline'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">shared your post</font ></a>.';	
		
	}
	
	elseif($result['type']=='share_on_page'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">shared your post</font ></a>.';	
		
	}
	
	elseif($result['type']=='share_on_group'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">shared your post</font ></a>.';	
		
	}
	elseif($result['type']=='friend_request_accept'){
		
		$txt = '<a href="'.file_path('profile/view/'.$result['username']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">accepted your friend request</font ></a>.';	
		
	}
	elseif($result['type']=='reply_on_comment'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'?comment_id='.$result['comment_id'].'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">replied to your comment</font >.';	
		
	}
	elseif($result['type']=='comment_like'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">likes your comment.</font >.';	
		
	}
	elseif($result['type']=='tagged'){
		
		$txt = '<a href="'.file_path('dashboard/post/'.$result['post_id']).'" class=""><font class="theme-txt1">'.$result['member_name'].'</font>  <font class="theme-txt2">tagged you in a post</font >.';	
		
	}
?>

<div class="mCustomScrollbar" data-mcs-theme="dark">
  <ul class="notification-list">
    <li>
      <div class="author-thumb"> <img src="<?=thumb(ProfileImg($result['profile_img']),100,100)?>" width="34" alt="author"> </div>
      <div style="width:76%;" class="notification-event">
      	<a href="#">
        <div><?=$txt?></div>
        </a>
        <span class="notification-date">
        <time class="entry-date updated" datetime="2004-07-24T18:18"><?=time_ago($result['timedt'])?></time>
        </span> </div>
    </li>
  </ul>
</div>
