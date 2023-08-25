
<div class="container">
  <div class="row">
    <div class="col-xl-8 push-xl-4 col-lg-8 push-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title"><span class="html_tot_likes"><?=$TotalPageLikes?></span> People Likes</h6>
        </div>
        <div class="ui-block-content">
          <div class="row"> 
            
            <!-------->
            
            <?php for($i=0;$i<count($PagelikesMember);$i++){ ?>
            
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-6">
            
              <div class="ui-block" data-mh="friend-groups-item" style="height: 240px;">
              
                <div class="friend-item friend-groups">
                
                  <div class="friend-item-content">
                  
                    <div class="more"> <svg class="olymp-three-dots-icon">
					
                      <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
					  
                      </svg>
                      
                      <ul class="more-dropdown">
                      
                        <li> <a href="<?=file_path('profile/view/'.$PagelikesMember[$i]['username'])?>">View Profile</a> </li>
                        
                      </ul>
                      
                    </div>
                    
                    <div class="friend-avatar">
                    
                      <div class="author-thumb"> <img src="<?=thumb($PagelikesMember[$i]['profile_img'],150,150)?>" alt="Member" style="width:100%;"> </div>
                      
                      <div class="author-content"> <a href="<?=file_path('profile/view/'.$PagelikesMember[$i]['username'])?>" class="h5 author-name">
                      
                        <?=filter_message($PagelikesMember[$i]['name'])?>
                        
                        </a>
                        
                        <div class="country"></div>
                        
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
    <?php $this->load->view('user/page/bar_left2');?>
  </div>
</div>
