<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com">
<title>2FA | Social Media Website</title>
<link rel="icon" href="<?=base_url(ASSET_FOLDER)?>favicon-32x32.ico" sizes="16x16">
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/bootstrap.min.css" />
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/maruti-login.css" />
</head>
<body>
<div id="loginbox">
  <form id="loginform" method="post" class="form-vertical" action="<?=file_path()?><?=$this->uri->rsegment(1)?>/authentication_submit">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
    <div class="control-group normal_text">
      <h3><img src="<?=base_url(ASSET_FOLDER)?>images/logo-primary.png" alt="Logo" /></h3>
    </div>
    <div class="control-group">
      <div class="controls">
        <?=$text?>
      </div>
    </div>
  </form>
</div>
<script src="<?=base_url(ASSET_FOLDER)?>js/jquery.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/maruti.login.js"></script>
</body>
</html>
