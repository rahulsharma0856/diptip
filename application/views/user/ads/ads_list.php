<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/bootstrap-select.css">
<style>
.form-group.label-static label.control-label, .form-group.label-placeholder label.control-label, .form-group.label-floating label.control-label {
	position: initial;
	pointer-events: none;
	transition: 0.3s ease all;
}
.error_p {
	color: #F00;
}
</style>
<div class="header-spacer"></div>
<!-- Your Account Personal Information -->
<div class="container">
  <div class="row">
    <div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
    
     <?php for($i=0;$i<count($list);$i++){ ?>
    	
        <?php 
		
			$country	=	$this->Ads_model->getAdsSelectCountry($list[$i]['id']); 
			
			$arr = array();
			
			
			for($p=0;$p<count($country);$p++){
				
				$arr[] = $country[$p]['name'];
				
			}
			
			$country_list  = implode(', ',$arr);
				
		?>
        
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title"> Create Ads </h6>
        </div>
        <div class="ui-block-content">
          <div class="row">
            <div class="col-md-4" id="del_div">
              <div class="ui-block" style="">
                <div style="padding:25px;"><img src="<?=base_url('upload/ads/'.$list[$i]['ad_img'])?>" alt="Friend" style="width:100%;"></div>
                <div style="clear:both;overflow:hidden;"></div>
              </div>
            </div>
            <div class="col-md-6" id="del_div">
              <div class="ui-block" style="">
                <div style="padding:25px;">
                  <p style="line-height:28px;"> <span class="stl"> Title : </span> <?=$list[$i]['title']?></br>
                    <span class="stl">Description : </span><?=$list[$i]['description']?></br>
                    <span class="stl">URL : </span><a href="<?=$list[$i]['url']?>" target="_blank"><?=$list[$i]['url']?></a></br>
                    <span class="stl">Country : </span><?=$country_list?></br>
                    <span class="stl">Gender : </span><?=$list[$i]['gender']?></br>
                    <span class="stl">Age Group :</span> <?=$list[$i]['age_group_to']?>-<?=$list[$i]['age_group_from']?></br>
                     <span class="stl">Date :</span> <?=date('d-m-Y',strtotime($list[$i]['time_dt']))?></br>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php } ?>
      
      
      
    </div>
    <div class="col-xl-3 pull-xl-9 col-lg-3 pull-lg-9 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="your-profile">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Ads Detail</h6>
          </div>
          <div class="ui-block-title "><i class="fa fa-file-o"></i> <a href="<?=file_path('ads/add')?>" class="h6 title">Add Ads</a> </div>
          <div class="ui-block-title "><i class="fa fa-user" aria-hidden="true"></i> <a href="<?=file_path('ads/view')?>" class="h6 title">Ads List</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ... end Your Account Personal Information -->

<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>chosen/chosen.css">
<script src="<?=asset_sm()?>chosen/chosen.jquery.js"></script> 
<script src="<?=asset_sm()?>chosen/init.js"></script>
<style>
	.stl{
		font-weight:bold;
	}
</style>
