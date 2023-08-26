
<div id="container" class="effect aside-float aside-bright mainnav-lg print-content">
<header id="navbar">
  <div id="navbar-container" class="boxed">
    <div class="navbar-header"> <a href="#" class="navbar-brand"> <img src="<?=base_url(ASSET_FOLDER)?>images/vitae-co-logo-matrix-dashboard.jpg" alt="Logo" class="brand-icon" style="width:100%;"> </a> </div>
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
        <?php /*?><?php $link =  $this->comman_fun->get_table_data('web_contain',array('option_type'=>'telegram_groups'));?>
        <li class="mega-dropdown1"><a href="<?=$link[0]['description']?>" title="Telegram" target="_blank">Join Our Telegram Group <i class="fa fa-telegram" style="font-size:23px;"></i></a></li><?php */?>
        <?php  $link =   $this->comman_fun->get_table_data('web_contain',array('option_type'=>'whatsapp_link')); ?>
        <?php /*?> <li class="mega-dropdown1"><a href="<?=$link[0]['description']?>" title="Whatsapp" target="_blank"> <i class="fa fa-whatsapp" style="font-size:23px;"></i></a></li><?php */?>
        <li id="dropdown-user" class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right"> <span class="ic-user pull-right"> <i class="demo-pli-male"></i> </span> </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
            <ul class="head-list">
              <li> <a href="<?=file_path()?>user/profile/view/"><i class="demo-pli-male icon-lg icon-fw"></i> Profile</a> </li>
              <li> <a href="<?=file_path()?>user/profile/change_username/"><i class="demo-pli-computer-secure icon-lg icon-fw"></i> Change Username</a> </li>
              <li> <a href="<?=file_path()?>user/profile/change_password/"><i class="demo-pli-gear icon-lg icon-fw"></i> Change Password</a> </li>
              <li> <a href="<?=file_path()?>user/two_factor_authentication/set/"><i style="font-size:18px;" class="fa fa-shield icon-lg icon-fw" aria-hidden="true"></i>Two Factor Authentication</a> </li>
              <li> <a href="<?=file_path()?>user/login/logout"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a> </li>
              <?php if($this->session->userdata['smr_superadmin']['login']===true){ ?>
              <li> <a href="<?=file_path('admin')?>change_account/admin/"><i class="demo-pli-add-user-star icon-lg icon-fw"></i> Admin Account</a> </li>
              <?php } ?>
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
                <img class="img-circle img-md" src="<?=base_url(ASSET_FOLDER)?>img/profile-photos/1.png" alt="Profile Picture">
                <?php } ?>
              </div>
              <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false"> <span class="pull-right dropdown-toggle"> <i class="dropdown-caret"></i> </span>
              <p class="mnp-name">
                <?=$this->session->userdata['smr_web_login']['name']?>
              </p>
             <?php /*?> <span class="mnp-desc">-</span><?php */?> </a> </div>
            <div id="profile-nav" class="collapse list-group bg-trans"> <a href="<?=file_path()?>user/profile/view/" class="list-group-item"> <i class="demo-pli-male icon-lg icon-fw"></i> View Profile </a> <a href="<?=file_path()?>user/login/logout" class="list-group-item"> <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout </a> </div>
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
            <!--Menu list item-->
            
            <li> <a id="menu-overview" href="<?=file_path('user/dashboard/view/')?>"> <i class="demo-pli-home"></i> <span class="menu-title"> DASHBOARD </span> </a> </li>
            <?php if($isPaid_member){ ?>
            <li> <a id="" href="<?=base_url()?>sm/index.php/dashboard/view/" target="_blank"> <i class="fa fa-share"></i> <span class="menu-title"> SOCIAL MEDIA </span> </a> </li>
            <?php } ?>
            <li> <a id="menu-educational-tool" href="<?=file_path()?>user/dashboard/educational_videos"> <i class="demo-psi-address-book"></i> <span class="menu-title"> Educational Videos </span> </a> </li>
            <li> <a id="menu-my-training_centre" href="<?=file_path('user')?>training_centre"> <i class="fa fa-graduation-cap"></i> <span class="menu-title">Training Centre </span> </a> </li>
            <?php $isPaid_member =  true?>
            <?php if($isPaid_member){ ?>
            <li> <a id="menu-wallet-us" href="<?=file_path('user/wallet/view')?>"> <i class="demo-psi-view-list"></i> <span class="menu-title"> USDC & SP WALLET </span> </a> </li>
            <li> <a id="menu-wallet" href="<?=file_path('user/transaction/view')?>"> <i class="demo-psi-credit-card-2"></i> <span class="menu-title"> MY WALLET </span> </a> </li>
            <li class=""> <a href="#"> <i class="demo-psi-credit-card-2"></i> <span class="menu-title">Income By Level</span> <i class="arrow"></i> </a> 
              
              <!--Submenu active-link-->
              
              <ul class="collapse">
                <li><a id="menu-purpose-in" href="<?=file_path('user/report/erning_by_level/')?>">Purpose Tree </a></li>
                <li><a id="menu-destiny-in" href="<?=file_path('user/report/destiny_erning_by_level/')?>">Destiny Tree </a></li>
                <li><a id="menu-garden-in" href="<?=file_path('user/tree_garden/tree')?>">Garden Tree </a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if($isPaid_member){ ?>
            <li> <a id="menu-my-downline" href="<?=file_path('user/direct_downline/view')?>"> <i class="demo-pli-checked-user"></i> <span class="menu-title"> MY DOWNLINE </span> </a> </li>
            <li class=""> <a href="#"> <i class="demo-pli-receipt-4"></i> <span class="menu-title">MY MATRIX</span> <i class="arrow"></i> </a>
              <ul class="collapse">
                <li><a id="menu-purpose" href="<?=file_path('user')?>tree_purpose/tree">Purpose </a></li>
                <li><a id="menu-destiny" href="<?=file_path('user')?>tree_destiny/tree">Destiny </a></li>
                <li><a id="menu-garden-in" href="<?=file_path('user')?>tree_garden/tree">Garden </a></li>
              </ul>
            </li>
            <li> <a id="menu-add-fund" href="<?=file_path('user/add_fund/view')?>"> <i class="demo-psi-credit-card-2"></i> <span class="menu-title"> ADD FUND </span> </a> </li>
            
           
            
            <?php } else { ?>
            <li> <a id="menu-wallet-us" href="<?=file_path('user/wallet/view')?>"> <i class="demo-psi-view-list"></i> <span class="menu-title"> USDC & SP WALLET </span> </a> </li>
            <li class=""> <a href="#"> <i class="demo-pli-receipt-4"></i> <span class="menu-title">MY MATRIX</span> <i class="arrow"></i> </a>
              <ul class="collapse">
                <li><a id="menu-garden" href="<?=file_path('user')?>tree_garden/tree">Garden </a></li>
              </ul>
            </li>
            <?php } ?>
            
            
            <li class=""> <a href="#"> <i class="demo-pli-receipt-4"></i> <span class="menu-title">LIKE MARKET</span> <i class="arrow"></i> </a>
            <ul class="collapse">
                <li><a id="menu-like-market" href="<?=file_path('user/like_market')?>">LIKE MARKET </a></li>
               <li><a id="menu-donation" href="<?=file_path('user/donation')?>">DONATION </a></li>
            </ul>
            </li>
            
            
            
            <li class=""> <a href="#"> <i class="demo-pli-mail"></i> <span class="menu-title">MESSAGE CENTER</span> <i class="arrow"></i> </a> 
              
              <!--Submenu-->
              <ul class="collapse">
                <li><a id="menu-msg-from-admin" href="<?=file_path('user')?>notification/message_from_admin/">From Admin</a></li>
                <li><a id="menu-msg-from-downline" href="<?=file_path('user')?>notification/message_from_downline/">From Downline</a></li>
                <li><a id="menu-msg-to-referal" href="<?=file_path('user')?>gen_from/message_to_referral/">Message To Sponsor</a></li>
              </ul>
            </li>
            <?php //if($isPaid_member){ ?>
            <?php /*?> <li class=""> <a href="#"> <i class="demo-pli-pen-5"></i> <span class="menu-title">Advertisement</span> <i class="arrow"></i> </a> 
                	<!--Submenu-->
                    <ul class="collapse">
                        <li><a id="menu-ads-list" href="<?=file_path('user')?>ads_list/">Ads List</a></li>
                        
                    </ul>
                </li> <?php */?>
            <?php //} ?>
            <?php /*?>  <li> <a id="menu-promotional-tool" href="<?=file_path()?>user/promotional_tools"> <i class="demo-pli-pen-5"></i> <span class="menu-title"> PROMOTIONAL TOOL </span> </a> </li><?php */?>
            <?php /*?>   <li> <a id="menu-profile-password" href="<?=file_path()?>user/dashboard/profile_password"> <i class="demo-pli-speech-bubble-5"></i> <span class="menu-title"> PROFILE/PASSWORD </span> </a> </li><?php */?>
            <li> <a id="menu-support" href="<?=file_path()?>user/support/view/"> <i class="demo-pli-pen-5"></i> <span class="menu-title"> Support </span> </a> </li>
            <li> <a id="menu-q2a" href="<?=file_path()?>user/page/q2a"> <i class="demo-pli-computer-secure"></i> <span class="menu-title"> FAQ </span> </a> </li>
            <?php if($isPaid_member){ ?>
            <li> <a id="menu-capture-page" href="<?=file_path()?>user/capture_page/view/"> <i class="demo-psi-view-list"></i> <span class="menu-title"> Capture Page </span> </a> </li>
            <?php } ?>
            <!--Menu list item--> 
            
            <!--<li> <a href="#"> <i class="demo-pli-home"></i> <span class="menu-title"> Dashboard </span> </a> </li>
            <li> <a href="#"> <i class="demo-pli-home"></i> <span class="menu-title"> Support </span> </a> </li>
            <li> <a href="#"> <i class="demo-pli-home"></i> <span class="menu-title"> Message From Admin </span> </a> </li>
            <li> <a href="<?=file_path()?>user/page/q2a/"> <i class="demo-pli-home"></i> <span class="menu-title"> Questions And Answers </span> </a> </li>-->
            
            <li class="list-divider"></li>
          </ul>
          <div style="text-align:center;margin-bottom:20px;padding-bottom:20px;"> <img src="<?=base_url(ASSET_FOLDER)?>images/banner2.png" alt="" class=""> </div>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="boxed">
<div id="content-container">
<div id="page-head">
  <div class="col-md-4">
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
  <div class="col-md-8">
    <div style="margin: 0px 10px 0px 10px;"> <a href="https://www.vitaetoken.io" target="_blank"> <img style="max-width:100%;" src="<?=base_url(ASSET_FOLDER)?>images/banner1.png" alt="" class=""> </a> </div>
  </div>
  <div style="clear:both;overflow:hidden;"></div>
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