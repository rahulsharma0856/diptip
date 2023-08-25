<?php defined('BASEPATH') OR exit('You are under DIP Cyber Eye, No grant allowed.'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com">
<title>LOGIN | DIPTIP</title>
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
    <div class="cls-content">
      <div class="cls-content-lg panel">
        <div class="panel-body">
          <div class="mar-ver pad-btm">
            <h1 class="h3">Registration</h1>
          </div>
          <div>Registration Successful.<br>
            We have sent a verification link to your registered Email Address.<br>
            Kindly check and verify your account.<br>
            Thank you.</div>
        </div>
        <div class="pad-all"> Already have an account ? <a href="<?=file_path()?>user/login" class="btn-link mar-rgt text-bold">Sign In</a> </div>
      </div>
    </div>
  </div>
  <!--=--> 
  
  <!-- DEMO PURPOSE ONLY --> 
  <!--=-->
  <div style="clear:both;overflow:hidden;"></div>
  <div style="padding:15px;position:absolute;bottom:0px;width:100%;"> <span style="font-size:14px;color:#FFFFFF;">Copyrights ©
    <?=date('Y')?>
    . All Rights Reserved By Data Intelligence Protocol Inc</span> <span style="font-size:14px;color:#FFFFFF;margin-left: 10%;"> <a style="color: #fff;margin-right:5px;" href="" target="_blank">Privacy Policy</a><span><b>|</b></span> <a style="color: #fff;" href="" target="_blank">Terms & Conditions</a> </span> </div>
</div>
<script src="<?=base_url(ASSET_FOLDER)?>js/jquery.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/bootstrap.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/nifty.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/demo/bg-images.js"></script>
</body>
</html>
