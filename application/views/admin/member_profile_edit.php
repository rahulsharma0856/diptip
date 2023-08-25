
<div class="row">
  <div class="col-sm-6">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Update Member Profile</h3>
      </div>
      
      <!--Block Styled Form --> 
      <!--===================================================-->
      
      <div class="panel-body">
        <form class="form-horizontal" action="<?=file_path('admin/')?><?=$this->uri->rsegment(1)?>/profile_edit_insert" method="post" enctype="multipart/form-data">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
           <input type="hidden" name="usercode" value="<?=$result['usercode']?>">
          <div class="panel-body">
          
            <div class="form-group">
              <label class="col-sm-3 control-label" for="demo-hor-inputemail">Full Name</label>
              <div class="col-sm-9">
              
                <input type="text"  id="demo-hor-inputemail" class="form-control"  value="<?=$result['fname']?> <?=$result['lname']?>" readonly>
                </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label" for="demo-hor-inputemail">Email</label>
              <div class="col-sm-9">
                <?php $form_value = set_value('emailid', isset($result['emailid']) ? $result['emailid'] : ''); ?>
                <input type="email" name="emailid" id="demo-hor-inputemail" class="form-control"   value="<?=$form_value?>">
                 <?php echo form_error('emailid', '<p class="error_p">', '</p>'); ?>
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label" for="demo-hor-inputemail">Username</label>
              <div class="col-sm-9">
                <?php $form_value = set_value('username', isset($result['username']) ? $result['username'] : ''); ?>
                <input type="text" name="username" id="demo-hor-inputemail" class="form-control" required value="<?=$form_value?>">
                <?php echo form_error('username', '<p class="error_p">', '</p>'); ?> </div>
            </div>
            
            
           <?php /*?> <div class="form-group">
              <label class="col-sm-3 control-label" for="demo-hor-inputemail">Password</label>
              <div class="col-sm-9">
                <?php $form_value = set_value('password', isset($result['password']) ? $result['password'] : ''); ?>
                <input type="text" name="new_pass" id="demo-hor-inputemail" class="form-control" required value="<?=$form_value?>">
                <?php echo form_error('new_pass', '<p class="error_p">', '</p>'); ?> </div>
            </div><?php */?>
            
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label" for="demo-hor-inputemail">Mobile No</label>
              <div class="col-sm-9">
                <?php $form_value = set_value('mobileno', isset($result['mobileno']) ? $result['mobileno'] : ''); ?>
                <input type="number" name="mobileno" id="demo-hor-inputemail"  class="form-control" value="<?=$form_value?>">
                <?php echo form_error('mobileno', '<p class="error_p">', '</p>'); ?> </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label" for="demo-hor-inputemail">Skype</label>
              <div class="col-sm-9">
                <?php $form_value = set_value('skype', isset($result['skype']) ? $result['skype'] : ''); ?>
                <input type="text" name="skype" id="demo-hor-inputemail"  class="form-control" value="<?=$form_value?>">
                <?php echo form_error('skype', '<p class="error_p">', '</p>'); ?> </div>
            </div>
            
            
            
          </div>
          
            <div class="panel-footer text-right">
            	<button class="btn btn-success" type="submit">Submit</button>
            </div>
          
        </form>
      </div>
      
      <!--===================================================--> 
      <!--End Block Styled Form --> 
      
    </div>
  </div>
</div>
