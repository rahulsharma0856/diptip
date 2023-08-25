<div class="header-spacer"></div>
<!---Headre----> 

<!---End Header------>

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

<!-- Your Account Personal Information -->
<div class="container">
  <div class="row">
    <div class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">My Groups  (<?=count($MyGroup)?>)</h6>
          <a href="#" class="more"><svg class="olymp-three-dots-icon">
          <use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use>
          </svg></a> </div>
        <ul class="notification-list friend-requests serach-list">
        
          <?php for($i=0;$i<count($MyGroup);$i++){?>
          
            <li class="inline-items">
            
                <div class="author-thumb"> <img src="<?=thumb($MyGroup[$i]['profile_img'],250,250)?>" alt="author" style="max-width:30px;"> </div>
                
                <div class="notification-event">
                     <a href="<?=file_path('group/view/'.$MyGroup[$i]['id'])?>" class="h6 notification-friend"><?=$MyGroup[$i]['title']?></a> 
                    <span class="chat-message-item"><?=$MyGroup[$i]['group_privacy']?> Group </span> 
                </div>
            
            </li>
          
          <?php } ?>
          
        </ul>
      </div>
    </div>
    <div class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
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
    </div>
  </div>
</div>

<!-- ... end Your Account Personal Information -->

<style>
	.ui-block-title .title {
	    display: inline-table;
		margin-left:15px;
}

.dropdown-toggle::after {
    display: inline-block !important;
	position: initial !important;
    width: 0;
    height: 0;
    margin-left: 0.3em;
    vertical-align: middle;
    content: "";
    border-top: 0.3em solid !important;
    border-right: 0.3em solid transparent !important;
    border-left: 0.3em solid transparent !important;
}
#btn2{
	margin-bottom:0px !important;
}
.dropdown-sub li{
	border-bottom:none !important;
}
</style>
