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
          <h6 class="title">
            Create Group
          </h6>
        </div>
        <div class="ui-block-content">
          <form action="<?=file_path('group/insert')?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" name="mode" value="add">
            <input type="hidden" name="eid" value="<?=$result[0]['id']?>">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
               
                <div class="form-group  is-empty">
                  <label class="control-label">Group Name</label>
                  <?php $form_value = set_value('name', isset($result[0]['name']) ? $result[0]['name'] : ''); ?>
                  <input class="form-control" name="name" type="text" required value="<?=$form_value?>" placeholder="The group name">
                  <?php echo form_error('name', '<p class="error_p">', '</p>'); ?> 
                
                </div>
                 
                <div class="form-group  is-select">
                  <label class="control-label">Privacy</label>
                  <?php $form_value = set_value('group_privacy', isset($result[0]['group_privacy']) ? $result[0]['group_privacy'] : ''); ?>
                  <select class="selectpicker form-control" size="auto" name="group_privacy" required>
                    <option <?php if($form_value=='Public'){ echo "selected='selected'";}?>  value="Public">Public</option>
                    <option <?php if($form_value=='Private'){ echo "selected='selected'";}?> value="Private">Private</option>
                    <option <?php if($form_value=='Closed'){ echo "selected='selected'";}?> value="Closed">Closed</option>
                  </select>
                  <?php echo form_error('group_privacy', '<p class="error_p">', '</p>'); ?> 
                </div>
                  
                <div class="form-group  is-select">
                  <label class="control-label">Posts</label>
                  <?php $form_value = set_value('group_posts', isset($result[0]['group_posts']) ? $result[0]['group_posts'] : ''); ?>
                  <select class="selectpicker form-control" size="auto" name="group_posts" required>
                    <option <?php if($form_value=='Any'){ echo "selected='selected'";}?>  value="Any">Any Member</option>
                    <option <?php if($form_value=='Admin'){ echo "selected='selected'";}?>  value="Admin">Admin</option>
                  </select>
                  <?php echo form_error('group_posts', '<p class="error_p">', '</p>'); ?> 
                </div>
                  
                <div class="form-group  is-empty">
                  <label class="control-label">Description</label>
                  <?php $form_value = set_value('description', isset($result[0]['description']) ? $result[0]['description'] : ''); ?>
                  <textarea class="form-control" name="description" placeholder="The group description" required><?=$form_value?></textarea>
                  <?php echo form_error('description', '<p class="error_p">', '</p>'); ?> 
                </div>
                  
            
                
              </div>
              
           
              
            </div>
             <div class="">
              <div class="" style="margin: 0 auto;">
               
                <button class="btn btn-primary btn-md-2" type="submit" value="save">Save</button>
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
            <h6 class="title">Your Groups</h6>
          </div>
          <div class="ui-block-title "><i class="fa fa-users"></i> <a href="<?=file_path('group/add')?>" class="h6 title">Create Group</a> </div>
          <div class="ui-block-title "><i class="fa fa-users"></i> <a href="<?=file_path('group/mygroups')?>" class="h6 title">My Groups</a> </div>
          <div class="ui-block-title "><i class="fa fa-users"></i> <a href="<?=file_path('group/joinedgroups')?>" class="h6 title">Joined Groups</a> </div>
        </div>
      </div>
      
     <?php /*?> <div class="ui-block">
        <div class="your-profile">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Your Group</h6>
          </div>
           <ul class="widget w-friend-pages-added notification-list friend-requests">
            <?php for($i=0;$i<count($MyGroup);$i++){?>
            <li class="inline-items">
              <div class="author-thumb"> <img src="<?=thumb($MyGroup[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
              <div class="notification-event"> <a href="<?=file_path('group/view/'.$MyGroup[$i]['id'])?>" class="h6 notification-friend">
                <?=$MyGroup[$i]['title']?>
                </a> <span class="chat-message-item">
                <?=$MyGroup[$i]['group_privacy']?> Group
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
