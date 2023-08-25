    <div class="col-xl-3 pull-xl-9 col-lg-3 pull-lg-9 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="your-profile">
          <div class="ui-block-title" style="text-transform:uppercase;">
            <h6 class="title">Settings</h6>
          </div>
          <ul class="your-profile-menu">
            <li> <a href="<?=file_path('profile/edit_profile')?>">General</a> </li>
            <?php /*?><li> <a href="<?=file_path('profile/change_profile_image')?>">Profile Images</a> </li><?php */?>
            <?php /*?><li> <a href="<?=file_path('profile/change_password')?>">Change Password</a> </li><?php */?>
			<li> <a href="<?=file_path('profile/work_experience')?>">Experience & Skills</a> </li>
          </ul>
        </div>
      </div>
      
      <?php $this->load->view('user/term_privacy_link');?>
    </div>