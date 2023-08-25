<?php $this->load->view('user/profile/top_section');?>

<div class="container">
  <div class="row"> 
    
    <!-- Main Content -->
    
    <div class="col-xl-9 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title"> Total Mutual Friends <?=$TotMutualFrnds?></h6>
        </div>
        <div class="ui-block-content">
          <div class="row"> 
             <!-------->
            
             <?php if(count($TotMutualFrnds) < 1) {?>
            		<div class="col-md-12" style="text-align:center;" >No Mutual Friends</div>
            <?php } ?>
            
            <?php for($i=0;$i<count($mutualfrnds);$i++){
				
				$member_rs = $this->Member_module->get_member_by_id($mutualfrnds[$i]['friendID']);
				
			?>
            
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-6" id="del_div">
              <div class="ui-block" data-mh="friend-groups-item" style="height: 263px;">
                <div class="friend-item friend-groups">
                  <div class="friend-item-content">
                    <div class="more"> <svg class="olymp-three-dots-icon">
                      <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
                      </svg>
                      <ul class="more-dropdown">
                        <li> <a href="<?=file_path('profile/timeline/'.$member_rs['username'])?>">View Profile</a> </li>
                        
						<?php if($profile_usercode==$login_usercode) { ?>
                         <li> <a href="<?=file_path('profile/friend_delete/'.$member_rs['usercode'])?>" id="unfriend_req">Unfriend</a> </li>  
                        <?php }?>
                      
                      </ul>
                    </div>
                    <div class="friend-avatar">
                      <div class="author-thumb"> <img src="<?=thumb($member_rs['profile_img'],150,150)?>" alt="Friend" style="width:100%;"> </div>
                      <div class="author-content"> <a href="<?=file_path('profile/timeline/'.$friend[$i]['username'])?>" class="h5 author-name"><?=$member_rs['fullname']?></a> </div>
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
    
    <!-- ... end Main Content -->
    
    <?php $this->load->view('user/profile/bar_left2');?>
  </div>
</div>
