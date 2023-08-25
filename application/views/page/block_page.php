<?php defined('BASEPATH') OR exit('You are under DIP Cyber Eye, No grant allowed.'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com">
<title>DIPTIP</title>
<link rel="icon" href="<?=base_url(ASSET_FOLDER)?>favicon-32x32.ico" sizes="16x16">
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/bootstrap.min.css" />
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/maruti-login.css" />
</head>
<body>
<div id="loginbox">
 
    <div class="control-group normal_text" style="background: #101d24;">
      <h3><img src="<?=base_url(ASSET_FOLDER)?>images/500x150-unvitae.jpg" alt="Logo" width="100%" /></h3>
    </div>
    <div class="control-group" style="background:#fff">
      <div class="controls">
        <?=$text?>
      </div>
    </div>
 
</div>
</body>
</html>
