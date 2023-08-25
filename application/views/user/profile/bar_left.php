<!-- Left Sidebar -->
<?php $user_login  =  user_session('usercode');?>

<div class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
  <div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">Work Experience
        <?php	
            if($user_login==$member['usercode'])
            {
                echo '<span class="pull-right"><a href="'.file_path('profile/edit_profile/').'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>';
            }?>
      </h6>
    </div>
    <div class="ui-block-content">
      <ul class="widget w-personal-info item-block">
        <?php
                $workexp 	 = 	$this->comman_fun->get_table_data('work_experience',array('usercode'=>$member['usercode'],'status'=>'Active'));
                
                for($i=0;$i<count($workexp);$i++)
                {
                        $sdate = date_create($workexp[$i]['work_start_date']);
                        
                        $work_start_dt =  date_format($sdate,"M d, Y");
                        
                        if($workexp[$i]['work_here']=='yes')
                        {
                            $work_end_dt =  'present';
                        }
                        else
                        {
                            
                            $edate = date_create($workexp[$i]['work_end_date']);
                        
                            $work_end_dt =  date_format($edate,"M d, Y");
                        }
                        
                        $workexp_html ='<li>
                                            <span class="title">'.filter_message($workexp[$i]['company_name']).'</span><br /><br />
                                            <span class="text">'.filter_message($workexp[$i]['position']).' - '.$work_start_dt.' to '.$work_end_dt.'- '.$workexp[$i]['city_town'].'</span><br />
                                            <span class="text">'.filter_message($workexp[$i]['about_desc']).'</span>
                                        </li>';
                        
                        if($user_login==$workexp[$i]['usercode'])
                        {
                            echo $workexp_html;
                            
                        }
                        else
                        {
                            if($workexp[$i]['privacy_status']=='Public')
                            {
                                echo $workexp_html;
                            }
                            if(($workexp[$i]['privacy_status']=='Private') and ($user_login==$workexp[$i]['usercode']))
                            { 
                                echo $workexp_html;
                            }
                            
                            if(($workexp[$i]['privacy_status']=='Friends' and $isFriend==true))
                            {
                                echo $workexp_html;
                            }
                        } 
                                    
                                            
                }
            ?>
      </ul>
    </div>
  </div>
  <?php
        
            
        $friend_dt	 =	$this->comman_fun->get_table_data('social_friends_detail',array('usercode'=>$user_login,'friend'=>$member['usercode'],'status'=>1));
        
        if(isset($friend_dt[0]))
        {
            $isFriend = true;
        }
        
        $skills_dt 	 = 	$this->comman_fun->get_table_data('professional_skills',array('usercode'=>$member['usercode'],'status'=>'Active'));
	   	
		$skills 	= explode(',',$skills_dt[0]['skills']);
		
		for($i=0;$i<count($skills);$i++)
		{  
			
		 	$pskills 	   = 	$this->comman_fun->get_table_data('professional_skills_master',array('id'=>$skills[$i]));
			
			$pskills_html .= '';
			
			
			if(count($skills)-1==$i)
			{
				$add_comma  = '';
			}
			else
			{
				$add_comma  = ', ';
				
			}
			
			$pskills_html .= trim($pskills[0]['skill_name']).$add_comma; 
			
		} ?>
  <div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">Professional Skills
        <?php	
                if($user_login==$member['usercode'])
                {
                    echo '<span class="pull-right"><a href="'.file_path('profile/edit_profile/').'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>';
                }?>
      </h6>
    </div>
    <div class="ui-block-content">
      <ul class="widget w-personal-info item-block">
        <?php
                                    
                $skills_html = '<li><span class="title">'.$pskills_html.'</span></li>';
                
                if($user_login==$skills_dt[0]['usercode'])
                {
                    echo $skills_html;
                }
                else
                {
                    if($skills_dt[0]['privacy_status']=='Public')
                    {
                        echo $skills_html;
                    }
                    if(($skills_dt[0]['privacy_status']=='Private') and ($user_login==$skills_dt[0]['usercode']))
                    { 
                        echo $skills_html;
                    }
                    
                    if(($skills_dt[0]['privacy_status']=='Friends' and $isFriend==true))
                    {
                        echo $skills_html;
                    }
                } 
				?>
      </ul>
    </div>
  </div>
  <div class="sticky_area_timeline">
    <div class="ui-block">
      <div class="ui-block-title">
        <?php $TotalMemberFriend	=	$this->Member_module->getCountMemberFriend($member['usercode']); ?>
        <h6 class="title"><a style="color:#515365;" href="<?=file_path('profile/friends/'.$member['username'])?>">Friends - <span style="color: #00547b;">
          <?=$TotalMemberFriend?>
          </span> </a></h6>
      </div>
      <div class="ui-block-content">
        <ul class="widget w-last-photo">
          <?php 
                
                $recent_frnds		= 	$this->Member_module->get_last_recent_friends_pic($member['usercode']);
               
                for($i=0;$i<count($recent_frnds);$i++){ ?>
          <li style="position: relative;"> <a title="<?=$recent_frnds[$i]['name']?>" href="<?=file_path('profile/timeline/'.$recent_frnds[$i]['username'])?>"> <img src="<?=thumb($recent_frnds[$i]['profile_img'],150,150)?>" alt="<?=$recent_frnds[$i]['name']?>">
            <div class="recent_frnd_nm">
              <?=$recent_frnds[$i]['fname']?>
            </div>
            </a> </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ... end Left Sidebar -->
<style>
.w-last-photo li {
    width: 33.33%; /*49.33%;*/
}
.recent_frnd_cls
{
	background-repeat: no-repeat;    
	background-color: #cccccc; 
	background-size: 100% 100%;
	display: inline-block;
	width:98px;
	height:98px;
	position:relative;
}
.recent_frnd_nm {
    color: #00547b;
    /* position: absolute; */
    /* bottom: 7px; */
    /* left: 25px; */
    font-weight: bold;
    margin-top: 3px;
    font-size: 10px;
}
</style>
