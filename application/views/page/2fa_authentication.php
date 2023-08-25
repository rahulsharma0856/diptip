<?php defined('BASEPATH') OR exit('You are under DIP Cyber Eye, No grant allowed.'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com">
<title>2FA Verification | DIPTIP</title>
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
  <div id="bg-overlay" class="bg-img" style="background-image: url(&quot;<?=base_url(ASSET_FOLDER)?>img/bg-img/bg-img-3.jpg&quot;);"></div>
  <div class="cls-content">
    <div class="cls-content-sm panel">
      <div class="panel-body">
        <div class="mar-ver pad-btm">
          <p><img src="<?=base_url(ASSET_FOLDER.'images/Vitae_Logo.png')?>" style="width:80px;"></p>
          <h1 class="h3">2FA Verification</h1>
          <p>Enter your 2FA Code</p>
        </div>
        <form method="post" action="<?=file_path()?><?=$this->uri->rsegment(1)?>/authentication_submit">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          <div class="form-group">
            <input type="text" name="verification_code" id="verification_code" required class="form-control" placeholder="Enter Verification Code">
             <?php if($this->session->userdata['smr_2fa']['google']=='true'){ ?>
         			<p style="color:#1d8432;font-weight:bold;">Enter Google 2FA Code</p> 
            <?php } ?>
            <?php echo validation_errors(); ?> 
         </div>
          <?php if($_GET['a']=='1'){ ?>
          <p>
            <?=$this->session->userdata['smr_2fa']['verification_code']?>
          </p>
          <?php } ?>
          <button class="btn btn-primary btn-lg btn-block tts" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!--=--> 
  
  <!-- DEMO PURPOSE ONLY --> 
  <!--=-->
  <div style="clear:both;overflow:hidden;"></div>
</div>
<script src="<?=base_url(ASSET_FOLDER)?>js/jquery.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/bootstrap.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/nifty.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/demo/bg-images.js"></script>
</body>
</html>
<style>
.tts {
	background-color: #1b9a43 !important;
	border-color: #1b9a43 !important;
}
.tts:hover {
	background-color: #1b9a43 !important;
	border-color: #1b9a43 !important;
}
</style>
