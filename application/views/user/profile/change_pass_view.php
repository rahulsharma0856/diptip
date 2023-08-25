
<div class="header-spacer"></div>

<style>
.error_p
{
	color:#F00!important;
}
</style>
<!-- Your Account Personal Information -->

<div class="container">
	<div class="row">
		<div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
			 <?php 
			$msg = $this->session->flashdata('msg');
			if($msg!='')
			{?>
				  <div class="alert alert-success alert-dismissible fade show" role="alert">
				   <strong><?=$msg?></strong>
				   <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding: 5px;margin-top: 5px;">
					<span aria-hidden="true">&times;</span>
				  </button>
				   </div>
			<?php } ?>       
            <div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Change Password</h6>
				</div>
				<div class="ui-block-content">
					<form action="<?=file_path()?>profile/change_password_insert" method="post" enctype="multipart/form-data">
						 <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
                        <div class="row">

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group label-floating is-empty">
									<?php $form_value = set_value('old_pass',''); ?>
                                    <label class="control-label">Confirm Current Password</label>
									<input class="form-control" name="old_pass" id="old_pass" placeholder="" required="required" type="password" value="">
                                    <?php echo form_error('old_pass', '<p class="error_p">', '</p>'); ?>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group label-floating is-empty">
                               		<?php $form_value = set_value('new_pass',''); ?>
									<label class="control-label">Your New Password</label>
									<input class="form-control" name="new_pass" id="new_pass" placeholder="" type="password" required="required">
                                    <?php echo form_error('new_pass', '<p class="error_p">', '</p>'); ?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group label-floating is-empty">
									<?php $form_value = set_value('confirm_pass',''); ?>
                                    <label class="control-label">Confirm New Password</label>
									<input class="form-control"  name="confirm_pass" id="confirm_pass"  placeholder="" type="password" required="required">
                                    <?php echo form_error('confirm_pass', '<p class="error_p">', '</p>'); ?>
								</div>
							</div>

				

							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<button style="padding:15px;" class="btn btn-primary btn-lg full-width">Submit</button>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>

		<?php $this->load->view('user/profile/bar_setting');?>
        
        
        
	</div>
</div>

<!-- ... end Your Account Personal Information -->

