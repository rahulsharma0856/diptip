
<div class="container">
  <div class="row">
    <div class="col-xl-8 push-xl-4 col-lg-8 push-lg-4 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Update Page</h6>
        </div>
        <div class="ui-block-content">
         
            
            <!-------->
            
   			    <form action="<?=file_path()?><?=$this->uri->rsegment(1)?>/insert" method="post" enctype="multipart/form-data">
          	 <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
             <input type="hidden" name="mode" value="edit">
              <input type="hidden" name="eid" value="<?=$result[0]['id']?>">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="form-group label-floating11 is-empty">
                  <label class="control-label">Page Name</label>
                  <?php $form_value = set_value('name', isset($result[0]['name']) ? $result[0]['name'] : ''); ?>
                  <input class="form-control" name="name" type="text" required value="<?=$form_value?>" placeholder="The page name (will appear in URL)">
                   <?php echo form_error('name', '<p class="error_p">', '</p>'); ?>
                </div>
                <div class="form-group label-floating1 is-empty">
                <?php $form_value = set_value('title', isset($result[0]['title']) ? $result[0]['title'] : ''); ?>
                  <label class="control-label">Page Title</label>
                  <input class="form-control" name="title" type="text" required value="<?=html_entity_decode($form_value)?>" placeholder="The page title (will appear on the page's title)">
                   <?php echo form_error('title', '<p class="error_p">', '</p>'); ?>	
                </div>
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Description</label>
                   <?php $form_value = set_value('description', isset($result[0]['description']) ? $result[0]['description'] : ''); ?>
                  <textarea class="form-control" name="description" placeholder="The page description" required><?=$form_value?></textarea>
                   <?php echo form_error('description', '<p class="error_p">', '</p>'); ?>	 	
                </div>
                <div class="form-group label-floating1 is-select">
                
                	
                
                  <label class="control-label">Select Category</label>
                  <select class="selectpicker form-control" size="auto" name="category" required> 
                    <option value="">------------Select Category------------</option>
                    <?php
						for($i=0;$i<count($category);$i++)
						{
							if($category[$i]['id']==$result[0]['category'])
							{
								$selected = "selected='selected'";
							}else
							{
								$selected = "";
							}
							echo '<option '.$selected.' value="'.$category[$i]['id'].'">'.$category[$i]['cat_name'].'</option>';
						}
					?>
                   </select>
                   <?php echo form_error('category', '<p class="error_p">', '</p>'); ?>	 	
                </div>
              </div>
              
             <?php /*?> <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Profile Image</label>
                   <?php $form_value = set_value('profile_img', isset($result[0]['profile_img']) ? $result[0]['profile_img'] : ''); ?>
                   <?php if($form_value=='') { $reqpimg = "required='required'"; }?>
                   <input class="form-control" name="profile_img"  placeholder="The page title (will appear on the page's title)" <?=$reqpimg?>   type="file">
                   <input type="hidden" name="edit_pnm" value="<?=$form_value?>"/>
                    <?php echo form_error('profile_img', '<p class="error_p">', '</p>'); ?>
					<?php if($result[0]['profile_img']!='') { ?>
                    <div style="margin-top:10px;"> <img width="85" height="85" src="<?=thumb($result[0]['profile_img'],250,250)?>"/></div>
                    <?php } ?>		
                </div>
                
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Cover Image</label>
                  <?php $form_value = set_value('cover_img', isset($result[0]['cover_img']) ? $result[0]['cover_img'] : ''); ?>
                   <?php if($form_value=='') { $reqcimg = "required='required'"; }?>
                  <input class="form-control" name="cover_img" placeholder="The page title (will appear on the page's title)" <?=$reqcimg?>  type="file">
				  <input type="hidden" name="edit_cnm" value="<?=$form_value?>"/>	
					<?php echo form_error('cover_img', '<p class="error_p">', '</p>'); ?>	 	
                    <?php if($result[0]['cover_img']!='') { ?>
                    <div style="margin-top:10px;"><img width="85" height="85" src="<?=thumb($result[0]['cover_img'],250,250)?>"/></div> 
                    <?php } ?>
                </div>
             </div><?php */?>
             
            </div>
           <div class="">
              <div class="" style="margin: 0 auto;">
              
              		<button class="btn btn-primary btn-md-2" type="submit" value="save">Update</button> 
              </div>
            </div>
          </form>
          
            <!--------------> 
            
         
        </div>
      </div>
    </div>
    <?php $this->load->view('user/page/bar_left2');?>
  </div>
</div>
