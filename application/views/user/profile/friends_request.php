<?php $this->load->view('user/profile/top_section');?>

<div class="container">

  <div class="row"> 
    
    <!-- Main Content -->
    
    <div class="col-xl-9 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
    
      <div class="ui-block">
      
        <div class="ui-block-title">
        
          <h6 class="title"> Friend Request (<?=count($friend)?>)</h6>
          
        </div>
        
        <div class="ui-block-content">
        
          <div class="row"> 
            
            <!-------->
            
            <?php if(count($friend) < 1) {?>
            
            		<div class="col-md-12" style="text-align:center;" >No Friends Request</div>
                    
            <?php } ?>
            
            <?php for($i=0;$i<count($friend);$i++){ ?>
            
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-6" id="req_div">
            
              <div class="ui-block" data-mh="friend-groups-item" style="height: 263px;">
              
                <div class="friend-item friend-groups">
                  <div class="friend-item-content">
                    
                    <div class="friend-avatar" style="margin-bottom: 15px;">
                      <div class="author-thumb"> <img src="<?=thumb($friend[$i]['profile_img'],150,150)?>" alt="Fried" style="width:100%;"> </div>
                      <div class="author-content"> <a href="<?=file_path('profile/timeline/'.$friend[$i]['username'])?>" class="h5 author-name"><?=$friend[$i]['name']?></a> </div>
                    </div>
                    
                    
                        <span class="notification-icon">
                
                            <a href="#" class="accept-request" id="accept_req" value="<?=$friend[$i]['user_1']?>">
                                <span class="icon-add without-text">
                                	<svg class="olymp-happy-face-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-face-icon"></use></svg>
                                </span>
                            </a>
                            
                            <a href="#" class="accept-request request-del" id="delete_req" value="<?=$friend[$i]['user_1']?>">
                                <span class="icon-minus">
                               	 	<svg class="olymp-happy-face-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-face-icon"></use></svg>
                                </span>
                            </a>
                        
                        </span>
                    
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


