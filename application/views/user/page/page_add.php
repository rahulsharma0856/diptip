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
          <h6 class="title"> Compose Page </h6>
        </div>
        <div class="ui-block-content">
          <form action="<?=file_path($this->uri->rsegment(1))?>insert" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" name="mode" value="add">
            <input type="hidden" name="eid" value="<?=$result[0]['id']?>">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Page Name</label>
                  <?php $form_value = set_value('name', isset($result[0]['name']) ? $result[0]['name'] : ''); ?>
                  <input class="form-control" name="name" type="text" required value="<?=$form_value?>" placeholder="The page name (will appear in URL)">
                  <?php echo form_error('name', '<p class="error_p">', '</p>'); ?> </div>
                <div class="form-group label-floating1 is-empty">
                  <?php $form_value = set_value('title', isset($result[0]['title']) ? $result[0]['title'] : ''); ?>
                  <label class="control-label">Page Title</label>
                  <input class="form-control" name="title" type="text" required value="<?=$form_value?>" placeholder="The page title (will appear on the page's title)">
                  <?php echo form_error('title', '<p class="error_p">', '</p>'); ?> </div>
              
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
                  <?php echo form_error('category', '<p class="error_p">', '</p>'); ?> </div>
               
               
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Description</label>
                  <?php $form_value = set_value('description', isset($result[0]['description']) ? filter_post($result[0]['description']) : ''); ?>
                  <textarea class="form-control" name="description" placeholder="The page description" required><?=$form_value?>
</textarea>
                  <?php echo form_error('description', '<p class="error_p">', '</p>'); ?> </div>
                  
               
                  
              </div>
              <?php /*?>     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Profile Image</label>
                  <?php $form_value = set_value('profile_img', isset($result[0]['profile_img']) ? $result[0]['profile_img'] : ''); ?>
               
                  <input class="form-control" name="profile_img"  placeholder="The page title (will appear on the page's title)" <?=$reqpimg?>   type="file">
                  <input type="hidden" name="edit_pnm" value="<?=$form_value?>"/>
                  <?php echo form_error('profile_img', '<p class="error_p">', '</p>'); ?>
                  
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group label-floating1 is-empty">
                  <label class="control-label">Cover Image</label>
                  <?php $form_value = set_value('cover_img', isset($result[0]['cover_img']) ? $result[0]['cover_img'] : ''); ?>
                
                  <input class="form-control" name="cover_img" placeholder="The page title (will appear on the page's title)" <?=$reqcimg?>  type="file">
                  <input type="hidden" name="edit_cnm" value="<?=$form_value?>"/>
                  <?php echo form_error('cover_img', '<p class="error_p">', '</p>'); ?>
                 
                </div>
              </div><?php */?>
            </div>
            <div class="form-group">
              <div class="" style="margin: 0 auto;">
                <button class="btn btn-primary btn-md-2" type="submit" value="save">Compose Page</button>
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
            <h6 class="title">Your Pages</h6>
          </div>
          <div class="ui-block-title "><i class="fa fa-file-o"></i> <a href="<?=file_path('page/add')?>" class="h6 title">Compose Page</a> </div>
          <div class="ui-block-title "><i class="fa fa-user" aria-hidden="true"></i> <a href="<?=file_path('page/mypages')?>" class="h6 title">My Pages</a> </div>
          <div class="ui-block-title "><i class="fa fa-thumbs-up" aria-hidden="true"></i> <a href="<?=file_path('page/likedpages')?>" class="h6 title">Liked Pages</a> </div>
        </div>
      </div>
      <?php /*?><div class="ui-block">
        <div class="your-profile">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Your Pages</h6>
          </div>
           <ul class="widget w-friend-pages-added notification-list friend-requests">
            <?php for($i=0;$i<count($myPages);$i++){?>
            <li class="inline-items">
              <div class="author-thumb"> <img src="<?=thumb($myPages[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
              <div class="notification-event"> <a href="<?=file_path('page/view/'.$myPages[$i]['id'])?>" class="h6 notification-friend">
                <?=$myPages[$i]['title']?>
                </a> <span class="chat-message-item">
                <?=$myPages[$i]['cat_name']?>
                </span> </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div><?php */?>
    </div>
  </div>
</div>

<!-- ... end Your Account Personal Information --> 
