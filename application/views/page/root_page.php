<?php defined('BASEPATH') OR exit('You are under DIP Cyber Eye, No grant allowed.'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.gstatic.com/ https://www.google.com">
<title>Registration | DIPTIP</title>
<link rel="icon" href="<?=base_url(ASSET_FOLDER)?>favicon-32x32.ico" sizes="16x16">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" crossorigin="anonymous">
<link href="<?=base_url(ASSET_FOLDER)?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>css/nifty.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>plugins/pace/pace.min.css" rel="stylesheet">
<script src="<?=base_url(ASSET_FOLDER)?>plugins/pace/pace.min.js"></script>
<link href="<?=base_url(ASSET_FOLDER)?>css/demo/nifty-demo.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
<div id="container" class="cls-container">
  <div id="bg-overlay" class="bg-img" style="background-image: url(&quot;<?=base_url(ASSET_FOLDER)?>img/bg-img/bg-img-3.jpg&quot;);"></div>
  <div class="cls-content" style="padding-top:25px !important;">
    <div class="col-md-6">
      <div class="cls-content-lg panel" style="margin-right:0px;  background: none;">
        <div class="panel-body" style="background: none;">
          <iframe style="color:none;margin-top: -28px;" src="https://player.vimeo.com/video/302994214" width="510" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          <iframe src="https://player.vimeo.com/video/302994877" width="510" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          <div> </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="cls-content-lg panel" style="margin-left:0px;">
        <div class="panel-body" style="padding-bottom:10px;">
          <div class="mar-ver pad-btm">
            <p><img src="<?=base_url(ASSET_FOLDER.'images/Logo-Beta2.png')?>" style="width:110px;"></p>
            <h1 class="h3">Create a New Account</h1>
            <?php if($user){ ?>
            <p style="color:#1b9a43;font-weight:bold;font-size:14px;">Your Referral is "
              <?=$user->fname?>
              <?=$user->lname?>
              "</p>
            <?php } ?>
          </div>
          <form action="<?=file_path()?><?=$this->uri->rsegment(1)?>/check" method="post" name="registr" id="registr" onSubmit="return validate1();" enctype="multipart/form-data">
            <input type="hidden" name="ref_key" id="ref_key" value="<?=$user->username?>">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?php $form_value = set_value('fname',''); ?>
                  <input type="text" class="form-control" value="<?=$form_value?>" placeholder="First Name" name="fname" id="fname" required>
                  <?php echo form_error('fname', '<p class="error_p">', '</p>'); ?> </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <?php $form_value = set_value('lname',''); ?>
                  <input type="text" class="form-control" value="<?=$form_value?>" placeholder="Last Name" name="lname" id="lname" required>
                  <?php echo form_error('lname', '<p class="error_p">', '</p>'); ?> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <?php $form_value = set_value('emailid',''); ?>
                  <input type="email" class="form-control" value="<?=$form_value?>" placeholder="E-Mail" name="emailid" id="emailid" required>
                  <?php echo form_error('emailid', '<p class="error_p">', '</p>'); ?> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?php $form_value = set_value('gender',''); ?>
                  <select name="gender" id="gender" class="form-control" required>
                    <option value="">Gender</option>
                    <option <?=($form_value=="M") ? "selected" : ""?> value="M">Male</option>
                    <option <?=($form_value=="F") ? "selected" : ""?> value="F">Female</option>
                    <option <?=($form_value=="O") ? "selected" : ""?> value="O">Other</option>
                  </select>
                  <?php echo form_error('gender', '<p class="error_p">', '</p>'); ?> </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group"> 
                  <!-------->
                  <div id="demo-dp-component">
                    <div class="input-group date">
                      <?php $form_value = set_value('dob','01-01-2001'); ?>
                      <input required="required" type="text" class="form-control" name="dob" value="<?=$form_value?>">
                      <span class="input-group-addon"><i class="demo-pli-calendar-4"></i></span> </div>
                    <?php echo form_error('dob', '<p class="error_p">', '</p>'); ?> </div>
                  <!---------> 
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <?php $form_value = set_value('username',''); ?>
                  <input type="text" class="form-control" value="<?=$form_value?>" placeholder="Username" name="username" id="username" required>
                  <?php echo form_error('username', '<p class="error_p">', '</p>'); ?> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?php $form_value = set_value('password',''); ?>
                  <input type="password" required class="form-control" value="<?=$form_value?>" placeholder="Password" name="password" id="password" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <?php $form_value = set_value('con_password',''); ?>
                  <input type="password" required class="form-control" value="<?=$form_value?>" placeholder="Confirm Password" name="con_password" id="con_password">
                </div>
              </div>
              <?php echo form_error('password', '<p class="error_p">', '</p>'); ?> <?php echo form_error('con_password', '<p class="error_p">', '</p>'); ?>
           
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <p style="float:left;text-align: left;width: 100%;">
                    <?php $form_value = set_value('agree_terms_condi','');
                            if($form_value=='Y')
                            {
                                $chkf = 'checked';
                                
                            }
                         ?>
                    <input type="checkbox" <?=$chkf?> name="agree_terms_condi" id="agree_terms_condi" value="Y"  style="width:15px;height:15px;vertical-align: bottom;">
                    <span style="font-size: 12px;font-weight:600;padding: 0px 8px;">I have read and agree to the <a style="color:#1b9a43" target="_blank" href="<?=base_url()?>sm/index.php/about/terms">Terms & Conditions</a> and <a style="color:#1b9a43" target="_blank" href="<?=base_url()?>sm/index.php/about/privacy">Privacy Policy</a></span> <?php echo form_error('agree_terms_condi', '<p class="error_p">', '</p>'); ?> </p>
                </div>
              </div>
            </div>
            <?php if($user){ ?>
            <button class="btn btn-primary btn-lg btn-block tts" type="submit" style="background-color:#1b9a43;hover:">Register</button>
            <?php echo validation_errors(); ?> <?php echo form_error('ref_key', '<p class="error_p">', '</p>'); ?>
            <?php } ?>
          </form>
        </div>
        <div class="pad-all" style="padding-bottom: 35px;"> Already have an account ? <a href="<?=file_path()?>user/login" class="btn-link mar-rgt text-bold">Sign In</a> </div>
      </div>
    </div>
  </div>
 
</div>
<script src="<?=base_url(ASSET_FOLDER)?>js/jquery.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/bootstrap.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/nifty.min.js"></script> 
<script src="<?=base_url(ASSET_FOLDER)?>js/demo/bg-images.js"></script> 
<link href="<?=base_url(ASSET_FOLDER)?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=base_url(ASSET_FOLDER)?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
</body>
</html>
<style>
.error_p {
	color: #ff0000;
}
.tts {
	background-color: #1b9a43 !important;
	border-color: #1b9a43 !important;
}
.tts:hover {
	background-color: #1b9a43 !important;
	border-color: #1b9a43 !important;
}
</style>
<?php
	
	 $year 	= date('Y') - 18;
	 $month = date('m')-1;
	 $day 	= date('d');
	 
	 $legalAge = date('Y-m-d', strtotime('-18 year'));
	
	
?>
<script language="javascript" type="text/JavaScript" nonce=<?=SC_NONCE?>>
		
		
		$(document).on('submit','#registr',function(e){
		
			var txtpass=document.registr.password;
			
			var txtcpass=document.registr.con_password;
			
			var mno = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,30}$/;
			
			if(txtpass.value!=""){
				
				if(!txtpass.value.match(mno)){
				
					alert("Password must contain minimum 9 characters and maximum 30 characters, at least one uppercase letter, one lowercase letter and one number and one special character");
					
					txtpass.focus();
					
					return false;
					
				}
				
				else if(txtpass.value.length<9 && txtpass.value.length>30){
					
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
				
				alert("Confirm password not match");
				
				txtcpass.focus();
				
				return false;
				
			}
			
			if (!$('#agree_terms_condi').is(':checked')) {
				
				alert("Please indicate that you accept the Terms and Conditions");
			
				return false;
			}
			//
		
		});
		
		
	
	
		////////
		
		$(document).ready(function() {
			
			var d = new Date();
			
			d.setFullYear(<?=$year?>, <?=$month?>, <?=$day?>);

	  		$('#demo-dp-component .input-group.date').datepicker({
					autoclose:true,
					format: 'dd-mm-yyyy',
					endDate: d
			
			});
		});
			
</script>