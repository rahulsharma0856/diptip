<?php defined('BASEPATH') OR exit('You are under DIP Cyber Eye, No grant allowed.'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.gstatic.com">
<title>DIPTIP LOGIN PAGE</title>
<link rel="icon" href="<?=base_url(ASSET_FOLDER)?>favicon-32x32.ico" sizes="16x16">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" crossorigin="anonymous">
<link href="<?=base_url(ASSET_FOLDER)?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>css/nifty.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>plugins/pace/pace.min.css" rel="stylesheet">
<script src="<?=base_url(ASSET_FOLDER)?>plugins/pace/pace.min.js"></script>
<link href="<?=base_url(ASSET_FOLDER)?>css/demo/nifty-demo.min.css" rel="stylesheet">
</head>

<body>
<div id="container" class="cls-container">
  <div id="bg-overlay" class="bg-img" style="background-image: url(&quot;<?=base_url(ASSET_FOLDER)?>img/bg-img/bckg.jpg&quot;);"></div>
  <div class="row" style="height: 25px;"> </div>
  <div class="cls-content" style="padding-top:10px;">
    <div class="cls-content-sm panel">
      <div class="panel-body" style="padding-bottom:15px; background-color:#f5f5f5">
        <div class="mar-ver">
          <p><img src="<?=base_url(ASSET_FOLDER.'images/diptip.png')?>" style="width:140px;"></p>
          <h3>Log in to diptip</h3>
        </div>
        <form method="post" action="<?=file_path('login/check')?>">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          <div class="form-group">
            <label style="float: left;">Enter Username</label>
            <input type="text" name="username" id="username" required class="form-control" placeholder="Username" autofocus>
          </div>
          <div class="form-group">
            <label style="float: left;">Enter Password</label>
            <input type="password" name="password" id="password" required class="form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <?php /*?><div class="g-recaptcha" data-sitekey="6Lf1An4UAAAAABlN5j6VWFn3c8N7PKW8fUubzE2P"></div><?php */?>
          </div>
          <button class="btn btn-primary btn-lg btn-block tts" style=" background-color:#005a87 !important; border-color:#005a87 !important;" type="submit">Log In</button>
          <?php if($show_msg!=''){?>
          <p><span class="error_p">
            <?=$show_msg?>
            </span></p>
          <?php } ?>
          <span class="error_p"><?php echo validation_errors(); ?> </span>
        </form>
        <div class="pad-all forget_pass_link"> <a href="<?=file_path('forgot_password')?>" style=" color:#005e8c;" class="btn-link mar-rgt">Forgot password ?</a></div>
	<hr>
		<font style="text-align:left !important">
		New to diptip? <a href="<?=file_path('registration/view')?>" style="color:#005e8c"> Sign up now »</a>
		</font>
		
		
      </div>
    </div>
  </div>
  <div style="padding:15px;position:relative;bottom:0px;width:100%;">  </div>
</div>
<script src="<?=base_url(ASSET_FOLDER)?>js/jquery.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/bootstrap.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/nifty.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/demo/bg-images.js"></script> 
<script src='<?=base_url(ASSET_FOLDER)?>js/api.js'></script>
</body>
</html>
<style>
.error_p {
	color: #ff0000!important;
}
.tts {
	background-color: #1b9a43 !important;
	border-color: #1b9a43 !important;
}
.tts:hover {
	background-color: #1b9a43 !important;
	border-color: #1b9a43 !important;
}
.reg_link a:hover {
	color: #1b9a43 !important;
}
.forget_pass_link a:hover {
	color: #005e8c; !important;
}

@media screen and (max-width: 575px) {
#rc-imageselect, .g-recaptcha {
	transform: scale(0.77);
	-webkit-transform: scale(0.77);
	transform-origin: 0 0;
	-webkit-transform-origin: 0 0;
}
}
</style>
