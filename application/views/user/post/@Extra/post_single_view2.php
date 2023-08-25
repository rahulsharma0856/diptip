<div class="header-spacer"></div>
<div class="container">
  <div class="row"> 
    
    <!-- Main Content -->
    
    <main class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
   
    <div id="newsfeed-items-grid" class="post_item_section">
		<?php 
    
        if($result['post_type']=='add'){
        	
			
			
            echo $this->load->view('user/post/post_single_add2',array('result'=>$result,'section'=>$section),true); 
        
         } 
         elseif($result['post_type']=='share'){
            
            echo $this->load->view('user/post/post_single_share',array('result'=>$result,'section'=>$section),true); 
            
        }
        ?>
    </div>
 
    </main>
    
    <!-- ... end Main Content --> 
    
    <!-- Left Sidebar -->
    
    <aside class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
     
      <?php
		$ads_result = $this->Page_model->get_ads_banners('Single-Post-Top-Left');
		if(isset($ads_result)){?>
		<div class="ui-block">
        <div class="widget w-wethear1">
      	 <img src="<?=$ads_result['ad_img_path']?>" style="width:100%;height:350px;"> 
        </div>
      </div>
      <?php }?>
      <div class="sticky_area"> 	
       <?php
		$ads_result = $this->Page_model->get_ads_banners('Single-Post-Bottom-Left');
		if(isset($ads_result)){?>
		<div class="ui-block">
        <div class="widget w-wethear1">
      	 <img src="<?=$ads_result['ad_img_path']?>" style="width:100%;height:350px;"> 
        </div>
      </div>
      <?php }?>
      
      </div>
    </aside>
    
    <!-- ... end Left Sidebar --> 
    
    <!-- Right Sidebar -->
    
    <aside class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
    
      <?php
		$ads_result = $this->Page_model->get_ads_banners('Single-Post-Top-Right');
		if(isset($ads_result)){?>
		<div class="ui-block">
        <div class="widget w-wethear1">
      	 <img src="<?=$ads_result['ad_img_path']?>" style="width:100%;height:350px;"> 
        </div>
      </div>
      <?php }?>
      
      <div class="sticky_area"> 	
      <?php $this->load->view('user/term_privacy_link');?>
     </div>
    </aside>
       <?php $this->load->view('user/load/share_dialog');?>
    <!-- ... end Right Sidebar --> 
    
  </div>
</div>

