<div class="header-spacer"></div>
<div class="container">
  <div class="row">
    <div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">General</h6>
        </div>
        <div class="ui-block-content">
          <form method="post" action="<?=file_path('profile/edit_profile_submit')?>" enctype="multipart/form-data">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group  is-empty">
                  <label class="control-label">First Name*</label>
                  <input name="fname" id="fname" class="form-control" placeholder="" type="text" value="<?=$result['fname']?>">
                </div>
                <div class="form-group  is-empty">
                  <label class="control-label">Your Email</label>
                  <input readonly class="form-control" placeholder="" type="email" value="<?=$result['emailid']?>">
                </div>
                <div class="form-group date-time-picker ">
                  <label class="control-label">Your Birthday</label>
                  <?php
				  	
					if($result['dob']=='1970-01-01' or $result['dob']=='0000-00-00')
					{
						$birth_date = date('d-m-Y');
					}
					else
					{  
						$birth_date = date('d-m-Y',strtotime($result['dob']));
					}
					
				  
				  ?>
                  
                  <input name="dob" id="datetimepicker_profile" value="<?php echo $birth_date;?>" />
                  <span class="input-group-addon" style="padding-top: 45px;"> <svg class="olymp-month-calendar-icon icon">
                  <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-month-calendar-icon"></use>
                  </svg> </span> </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group  is-empty">
                  <label class="control-label">Last Name*</label>
                  <input name="lname" id="lname" class="form-control" placeholder="" type="text" value="<?=$result['lname']?>">
                </div>
                <div class="form-group  is-select">
                  <label class="control-label">Your Gender</label>
                  <select name="gender" id="gender"  class="selectpicker form-control" size="auto">
                    <option <?=$result['gender']=='M'? "selected" : "" ?> value="M">Male</option>
                    <option <?=$result['gender']=='F'? "selected" : "" ?> value="F">Female</option>
                    <option <?=$result['gender']=='O'? "selected" : "" ?> value="O">Other</option>
                  </select>
                </div>
                <div class="form-group  is-empty">
                  <label class="control-label">Your Phone Number*</label>
                  <input name="mobileno" id="mobileno" class="form-control" placeholder="" type="text" value="<?=$result['mobileno']?>">
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group  is-select">
                  <label class="control-label">Your Country</label>
                  <select name="country" id="country" class="selectpicker form-control" size="auto">
                    <option value="">Select Your Country</option>
                    <?php for($i=0;$i<count($CountryList);$i++){ ?>
                    <option <?=$result['country']==$CountryList[$i]['id'] ? "selected" : "" ?> value="<?=$CountryList[$i]['id']?>">
                    <?=$CountryList[$i]['name']?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group  is-empty">
                  <label class="control-label">Your State / Province</label>
                  <input name="state" id="state" class="form-control" placeholder="" type="text" value="<?=$result['state']?>">
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group  is-empty">
                  <label class="control-label">Your City</label>
                  <input name="city" id="city" class="form-control" placeholder="" type="text" value="<?=$result['city']?>">
                </div>
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group  is-empty">
                  <label class="control-label">Write a little description about you (Max- 50 words) <div id="about_desc_count"></div></label>
                  <textarea name="about_desc" id="about_desc" class="form-control word_count" onkeydown="return word_count(event);" placeholder=""><?=$result['about_desc']?>
				   </textarea>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group  is-empty">
                  <label class="control-label">Your Occupation</label>
                  <input name="occupation" id="occupation" class="form-control" placeholder="" type="text" value="<?=$result['occupation']?>">
                </div>
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group with-icon  is-empty">
                  <label class="control-label">Your Facebook Account</label>
                  <input name="facebook_link" id="facebook_link" class="form-control" type="text" value="<?=$result['facebook_link']?>">
                  <i class="fa fa-facebook c-facebook" style="top: 28px;height: 67%;"></i> </div>
                <div class="form-group with-icon  is-empty">
                  <label class="control-label">Your Twitter Account</label>
                  <input name="twitter_link" id="twitter_link" class="form-control" type="text" value="<?=$result['twitter_link']?>">
                  <i class="fa fa-twitter c-twitter"  style="top: 28px;height: 67%;"></i> </div>
              </div>
              
              
              <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <button class="btn btn-primary btn-lg full-width">SAVE</button>
                <?php echo validation_errors(); ?> </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <!---->
		<?php $this->load->view('user/profile/bar_setting');?>
    <!----> 
    
  </div>
</div>

<script nonce=<?=SC_NONCE?>>

$(document).ready(function(event) {
	
	 $('#about_desc').keyup(function() {
		
		  var t= word_count(event);
			
			if(t==true)
			{
				return true;
			}
			else
			{
				return false;
			}
		  
		  
	});
	
	
	
	
	
});


function word_count(event) {
	 
	var key = window.event ? event.keyCode : event.which;

	var number = 0;	
	
	var field = $('#about_desc');
	
	var matches = $(field).val().match(/\b/g);
	
	if(matches) {
		
		number = matches.length/2;
		
		$('#about_desc_count').text( number + ' word' + (number != 1 ? 's' : '') + ' approx');
		
		if(number>49)
		{
		  	if (event.keyCode == 8 || event.keyCode == 46) {
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
		
	}
}
</script>
<script nonce=<?=SC_NONCE?>>
$(function() {
	
  $('input[id="datetimepicker_profile"]').datepicker({
  
	changeMonth: true, 
	changeYear: true, 
	dateFormat: "dd-mm-yy",
	yearRange: "-100:+0", // last hundred years
  
  });

});

</script>
<style>
.ui-datepicker-month
{
	display: inline-block!important;
    padding: 0!important;
    width: 50%!important;
}
.ui-datepicker-year
{
	display: inline-block!important;
    padding: 0!important;
    width: 50%!important;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
  
    color: #fb1606!important;
}
</style>