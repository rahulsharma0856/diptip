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
          <h6 class="title">People</h6>
          <a href="#" class="more"><svg class="olymp-three-dots-icon">
          <use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use>
          </svg></a> </div>
        <ul class="notification-list friend-requests serach-list">
          <?=$friend['html']?>
          <?php if($friend['count'] > 0) {?>
          <li style="text-align:center;"><a style="color:#337ab7;" href="<?=file_path('search/people')?>?q=<?=$filter_text?>">See All</a></li>
          <?php } else { ?>
          <li style="text-align:center;">We couldn't find anything for <b>
            <?=$filter_text?>
            </b> </li>
          <?php } ?>
        </ul>
      </div>
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Page</h6>
          <a href="#" class="more"><svg class="olymp-three-dots-icon">
          <use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use>
          </svg></a> </div>
        <ul class="notification-list friend-requests serach-list">
          <?=$page['html']?>
          <?php if($page['count'] > 0) {?>
          <li style="text-align:center;"><a style="color:#337ab7;" href="<?=file_path('search/page')?>?q=<?=$filter_text?>">See All</a></li>
          <?php } else { ?>
          <li style="text-align:center;">We couldn't find anything for <b>
            <?=$filter_text?>
            </b> </li>
          <?php } ?>
        </ul>
      </div>
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Group</h6>
          <a href="#" class="more"><svg class="olymp-three-dots-icon">
          <use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use>
          </svg></a> </div>
        <ul class="notification-list friend-requests serach-list">
          <?=$group['html']?>
          <?php if($group['count'] > 0) {?>
          <li style="text-align:center;"><a style="color:#337ab7;" href="<?=file_path('search/group')?>?q=<?=$filter_text?>">See All</a></li>
          <?php } else { ?>
          <li style="text-align:center;">We couldn't find anything for <b>
            <?=$filter_text?>
            </b> </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    
      <?php $this->load->view('user/search/left_bar',$data); ?>
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
