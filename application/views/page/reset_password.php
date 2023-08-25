<?php defined('BASEPATH') OR exit('You are under DIP Cyber Eye, No grant allowed.'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com">
<title>Reset Password | DIPTIP</title>
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
          <h1 class="h3">Reset Password</h1>
        </div>
        <form method="post" action="<?=file_path()?><?=$this->uri->rsegment(1)?>/reset_rassword_submit" name="registr" onSubmit="return validate1();">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          <input type="hidden" name="reset_code" value="<?=$reset_code?>">
          <div class="form-group">
            <input type="password" name="password" id="password" required class="form-control" placeholder="Enter New Password">
            <?php $msg = form_error('password', '<p class="error_p">', '</p>'); ?>
          </div>
          <div class="form-group">
            <input type="password" name="con_password" id="con_password" required class="form-control" placeholder="Confirm Password">
            <?php $msg = form_error('con_password', '<p class="error_p">', '</p>'); ?>
          </div>
          <p>Password must contain minimum 9 characters and maximum 30 characters, at least one uppercase letter, one lowercase letter and one number and one special character</p>
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
          <?php echo validation_errors(); ?>
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
<script language="javascript" type="text/JavaScript" nonce=<?=SC_NONCE?>>

		function validate1()
		{
			txtpass=document.registr.password;
			txtcpass=document.registr.con_password;
			
			
			mno = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,30}$/;
			
			if(txtpass.value!=""){
				if(!txtpass.value.match(mno)){
				
					alert("Password must contain minimum 9 characters and maximum 30 characters, at least one uppercase letter, one lowercase letter and one number and one special character");
					txtpass.focus();
					return false;
					
				}
				else if(txtpass.value.length<9 && txtpass.value.length>30)
				{
					alert("The Password must contain minimum 9 characters and maximum 30 characters long.");
					txtpass.focus();
					return false;
					
				}
				
			}
			
			if(txtcpass.value!=""){
				
				if(!txtcpass.value.match(mno)){
					alert("Confirm password not match");
					txtcpass.focus();
					return false;
				}
			}
			if(txtpass.value!=txtcpass.value){
				alert(txtpass.value);
				alert(txtcpass.value);
					alert("Confirm password not match");
					txtcpass.focus();
					return false;
			}
			
		}	
</script>
