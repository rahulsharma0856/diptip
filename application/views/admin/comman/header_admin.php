<div id="container" class="effect aside-float aside-bright mainnav-lg print-content">
<header id="navbar">
  <div id="navbar-container" class="boxed">
    <div class="navbar-header"> <a href="#" class="navbar-brand" style="background-color: white;
    text-align: -webkit-center !important;"> <img src="<?=base_url(ASSET_FOLDER)?>images/diptip.png" alt="Logo" class="brand-icon" style="width: 60%;
    padding: 5px;margin-left: 17%;"> </a> </div>
    <div class="navbar-content">
      <ul class="nav navbar-top-links">
        <li class="tgl-menu-btn"> <a class="mainnav-toggle" href="#"> <i class="demo-pli-list-view"></i> </a> </li>
        <li>
          <div class="custom-search-form">
            <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox"> <i class="demo-pli-magnifi-glass"></i> </label>
            <form>
              <div class="search-container collapse" id="nav-searchbox">
                <input id="search-input" type="text" class="form-control" placeholder="Type for search...">
              </div>
            </form>
          </div>
        </li>
      </ul>
      <ul class="nav navbar-top-links">
        <li id="dropdown-user" class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right"> <span class="ic-user pull-right"> <i class="demo-pli-male"></i> </span> </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
            <ul class="head-list">
              <li> <a href="<?=file_path('dashboard/view')?>"><i class="demo-pli-arrow-right icon-lg icon-fw"></i>Website</a> </li>
              <li> <a href="<?=file_path('login/logout')?>"><i class="demo-pli-arrow-left icon-lg icon-fw"></i> Logout</a> </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>
<nav id="mainnav-container">
  <div id="mainnav">
    <div id="mainnav-menu-wrap">
      <div class="nano">
        <div class="nano-content">
          <div id="mainnav-profile" class="mainnav-profile">
            <div class="profile-wrap text-center">
              <div class="pad-btm">
                <?php if($this->session->userdata['smr_web_login']['profile_pic']!=''){ ?>
                <img class="img-circle" width="100" height="100" src="<?=base_url()?>sm/upload/post/<?=$this->session->userdata['smr_web_login']['profile_pic']?>" alt="">
                <?php } else {?>
                <img class="img-circle img-md" src="<?=base_url(ASSET_FOLDER)?>img/profile-photos/profile.png" alt="Profile Picture">
                <?php } ?>
              </div>
              <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false"> <span class="pull-right dropdown-toggle">
              <?php /*?> <i class="dropdown-caret"></i><?php */?>
              </span>
              <p class="mnp-name">
                <?=$this->session->userdata['smr_web_login']['name']?>
              </p>
              <?php /*?><span class="mnp-desc">-</span><?php */?>
              </a> </div>
            
          </div>
          <div id="mainnav-shortcut" class="hidden">
            <ul class="list-unstyled shortcut-wrap">
              <li class="col-xs-3" data-content="My Profile"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint"> <i class="demo-pli-male"></i> </div>
                </a> </li>
              <li class="col-xs-3" data-content="Messages"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning"> <i class="demo-pli-speech-bubble-3"></i> </div>
                </a> </li>
              <li class="col-xs-3" data-content="Activity"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-success"> <i class="demo-pli-thunder"></i> </div>
                </a> </li>
              <li class="col-xs-3" data-content="Lock Screen"> <a class="shortcut-grid" href="#">
                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple"> <i class="demo-pli-lock-2"></i> </div>
                </a> </li>
            </ul>
          </div>
          <ul id="mainnav-menu" class="list-group">
            <li class="list-header">Navigation</li>
            <li> <a id="menu-dashboard" style="background-color: #337ab7;" href="<?=file_path('admin/dashboard/view/')?>"> <i class="demo-pli-home"></i> <span class="menu-title"> Dashboard </span> </a> </li>
            <li> <a id="menu-members" style="background-color: #337ab7;" href="<?=file_path('admin/member/all')?>"> <i class="demo-pli-male"></i> <span class="menu-title">Member</span> </a> </li>
            <li class="list-divider"></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="boxed">
<div id="content-container">
<div id="page-head">
  <div id="page-title">
    <h1 class="page-header text-overflow">
      <?=$page_title?>
    </h1>
  </div>
  <ol class="breadcrumb">
    <li><a href="#"><i class="demo-pli-home"></i></a></li>
    <li><a href="#">Home</a></li>
    <li class="active">
      <?=$page_title?>
    </li>
  </ol>
</div>
<div id="page-content">
<?php $top_msg=$this->session->flashdata('show_msg'); ?>
<?php if(is_array($top_msg)){  ?>
<div class="row">
  <?php if($top_msg['class']=='false'){	?>
  <div class="alert alert-danger">
    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
    <strong>Error</strong>
    <?=$top_msg['msg']?>
  </div>
  <?php } else{?>
  <div class="alert alert-success">
    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
    <strong>
    <?=$top_msg['msg']?>
    </strong> </div>
  <?php } ?>
</div>
<?php } ?>
<script nonce=<?=SC_NONCE?>>

   	

		$(document).ready(function(e) {

            //

			

			$('#<?=$menu_id?>').parent('li').addClass('active-link');

			

			$('#<?=$menu_id?>').parent('li').parent('ul').addClass('in');

			

			$('#<?=$menu_id?>').parent('li').parent('ul').parent('li').addClass('active');

			

			$('#<?=$menu_id?>').parent('li').parent('ul').parent('li').addClass('active-sub');

        });

	

   </script>
<style>

.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus {

	background-color: #337ab7!important;

	border-color: #104850!important;

}

</style>
