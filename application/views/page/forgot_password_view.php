<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com">
<title>Forgot Password | DIPTIP</title>
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
          <h1 class="h3">Forgot Password</h1>
          <p>Enter your Email Id</p>
        </div>
        <form method="post" action="<?=file_path('forgot_password/check')?>">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          <div class="form-group">
            <input type="email" name="emailid" id="emailid" required class="form-control" placeholder="Enter your Email Id">
            <?php $msg = form_error('emailid', '<p class="error_p">', '</p>'); ?>
          </div>
          <button class="btn btn-primary btn-lg btn-block tts" type="submit">Submit</button>
          <?php if($msg!=''){?>
          <p><span class="title-red">
            <?=$msg?>
            </span></p>
          <?php } ?>
          <?php $top_msg=$this->session->flashdata('show_msg'); ?>
          <?php if($top_msg['msg']!=''){?>
          <p><span class="title-red"><br>
            <?=$top_msg['msg']?>
            </span><br>
            <a href="<?=file_path()?>login">Login</a> </p>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
  <!--=--> 
  
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
