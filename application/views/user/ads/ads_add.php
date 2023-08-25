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
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title"> Create Ads </h6>
        </div>
        <div class="ui-block-content">
          <form action="<?=file_path($this->uri->rsegment(1))?>insert" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" name="mode" value="add">
            <input type="hidden" name="eid" value="<?=$result[0]['id']?>">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                
                <div class="form-group label-floating1 is-empty">
                 
                  <?php $form_value = set_value('title', isset($result[0]['title']) ? $result[0]['title'] : ''); ?>
                
                  <label class="control-label">Ad Title</label>
                
                  <input class="form-control" name="title" type="text" required value="<?=$form_value?>" placeholder="The Ad title">
                
                  <?php echo form_error('title', '<p class="error_p">', '</p>'); ?> 
                
                </div>
                
               <div class="form-group label-floating1 is-empty">
                 
                  <label class="control-label">Description</label>
                  
				  <?php $form_value = set_value('description', isset($result[0]['description']) ? $result[0]['description'] : ''); ?>
                 
                  <textarea class="form-control" name="description" placeholder="The Ad description" required><?=$form_value?></textarea>
                  
				  <?php echo form_error('description', '<p class="error_p">', '</p>'); ?>
               
               </div>
               
               <div class="form-group label-floating1 is-empty">
                 
                  <?php $form_value = set_value('url', isset($result[0]['url']) ? $result[0]['url'] : ''); ?>
                
                  <label class="control-label">URL</label>
                
                  <input class="form-control" name="url" type="text" required value="<?=$form_value?>" placeholder="Ad URL">
                
                  <?php echo form_error('url', '<p class="error_p">', '</p>'); ?> 
                
                </div>
              	                  
              </div>
              
              
              
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Upload Image</label>
                 
                  <?php $form_value = set_value('ad_img', isset($result[0]['ad_img']) ? $result[0]['ad_img'] : ''); ?>
               
                  <input class="form-control" name="ad_img"  placeholder="Ad Image" <?=$reqpimg?>   type="file">
                 
                  <input type="hidden" name="edit_pnm" value="<?=$form_value?>"/>
                 
                  <?php echo form_error('ad_img', '<p class="error_p">', '</p>'); ?>
                  
                </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Upload Video</label>
                 
                  <?php $form_value = set_value('ad_video', isset($result[0]['ad_video']) ? $result[0]['ad_video'] : ''); ?>
                
                  <input class="form-control" name="ad_video" placeholder="Ad Video" <?=$reqcimg?>  type="file">
                  
                  <input type="hidden" name="edit_cnm" value="<?=$form_value?>"/>
                 
                  <?php echo form_error('ad_video', '<p class="error_p">', '</p>'); ?>
                </div>
              </div>
              
              

            <div class="col-sm-12 col-xs-12">
            	
                <div class="form-group label-floating1 is-empty">
            
                <label class="control-label">Country</label>
                
                <?php $form_value = set_value('country', isset($result[0]['country']) ? $result[0]['country'] : ''); ?>
                
                <select required name="country[]" data-placeholder="Select a countrys..." class="chosen-select form-control" multiple tabindex="4" style="height:150px;">
                
                    <?php for($i=0;$i<count($country);$i++){ ?>      
                            
                        <option value="<?=$country[$i]['id']?>"><?=$country[$i]['name']?></option>
                        
                    <?php } ?>
                    
                </select>
                
                <?php echo form_error('country', '<p class="error_p">', '</p>'); ?>
                
            </div>
            
          	</div>

			<div class="col-md-4">
            
                <div class="form-group label-floating1 is-empty">
                
                    <label class="control-label">Gender</label>
                    
                    <?php $form_value = set_value('gender', isset($result[0]['gender']) ? $result[0]['gender'] : ''); ?>
                    
                    <select name="gender" id="gender" class="form-control" style="height:auto;">
                    
                        <option value="Male">Male</option>
                        
                        <option value="Female">Female</option>
                        
                        <option value="Both">Both</option>
                    
                    </select>
                    <?php echo form_error('ad_video', '<p class="error_p">', '</p>'); ?>
                </div>
                
            </div>
            
            <div class="col-md-4">
            	
                 <div class="form-group label-floating1 is-empty">
                
                    <label class="control-label">Age Group (To)</label>
                    
                    <?php $age_group_to = set_value('age_group_to', isset($result[0]['age_group_to']) ? $result[0]['age_group_to'] : ''); ?>
                    
                    <select name="age_group_to" id="age_group_to" class="form-control" style="height:auto;" required>
                    
                       <?php for($i = 1 ; $i <= 100 ; $i++) {  ?>
                       		
                            	<option <?=($i==$age_group_to) ? "selected" : ""?>  value="<?=$i?>"><?=$i?></option>
                            
                       <?php } ?>
                    
                    </select>
                    
                    <?php echo form_error('age_group_to', '<p class="error_p">', '</p>'); ?>
                </div>
                
            </div>
            
            <div class="col-md-4">
            
                 <div class="form-group label-floating1 is-empty">
                
                    <label class="control-label">Age Group (From)</label>
                    
                    <?php $form_value = set_value('age_group_from', isset($result[0]['age_group_from']) ? $result[0]['age_group_from'] : ''); ?>
                    
                    <select name="age_group_from" id="age_group_from" class="form-control" style="height:auto;" required>
                    	
                        <?php $f = $age_group_to + 1;?>
                        
                       <?php for($i = $f ; $i <= 100 ; $i++) {  ?>
                       		
                            	 <?php for($i = $f ; $i <= 100 ; $i++) {  ?>
                       		
                            	<option <?=($i==$form_value) ? "selected" : ""?>  value="<?=$i?>"><?=$i?></option>
                            
                       			<?php } ?>
                            
                       <?php } ?>
                   
                    </select>
                    
                    <?php echo form_error('age_group_from', '<p class="error_p">', '</p>'); ?>
                </div>
                
            </div>
            
            
            
              
               
              
              
              
              
            </div>
            <div class="form-group">
              <div class="" style="margin: 0 auto;">
                <button class="btn btn-primary btn-md-2" type="submit" value="save">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
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
.chosen-container-multi .chosen-choices {
	height: 50px!important;
    border: 1px solid #e6ecf5!important;
    border-radius: 0.25rem!important;
	background-image:none!important;
	padding:10px 5px!important;
	
}

.chosen-choices {
	height: 50px!important;
    border: 1px solid #e6ecf5!important;
    border-radius: 0.25rem!important;
	background-image:none!important;
	padding:10px 5px!important;
}

/*[class*="col-"] .chosen-container {
    width:98%!important;
}
[class*="col-"] .chosen-container .chosen-search input[type="text"] {
    padding:2px 4%!important;
    width:90%!important;
    margin:5px 2%;
}
[class*="col-"] .chosen-container .chosen-drop {
    width: 100%!important;
}*/
</style>

<script nonce=<?=SC_NONCE?>>
	
	$(document).on('change','#age_group_to',function(e){
			
		var no = parseInt($(this).val());
		
		var html = '';
		
		no++;
		
		for(var i = no ; i <= 100 ; i++){
			
			html+= '<option value="'+i+'">'+i+'</option>';
			
		}	
		
		$('#age_group_from').html(html);
		
	});
	
</script>

