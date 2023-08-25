<style>
.chosen-container-multi .chosen-choices {
	height: 50px!important;
    border: 1px solid #e6ecf5!important;
    border-radius: 0.25rem!important;
	background-image:none!important;
	padding:10px 5px!important;
}

</style>

<script type="text/javascript">
	$(document).ready(function() {
		if ( $( "#work_here"  ).is( ":checked" ) ) {
				$( "#end_date" ).hide();
			} else {
				$( "#end_date" ).show();
			}
	});

	
	$( function () {
		$( "#work_here" ).click( function () {
			if ( $( this ).is( ":checked" ) ) {
				$( "#end_date" ).hide();
			} else {
				$( "#end_date" ).show();
			}
		} );
	} );
</script>
<?php 
	if($this->uri->rsegment(3)=="edit"){
		
		$id =$this->uri->rsegment(4);
		
		$work_edit	= $this->comman_fun->get_table_data('work_experience',array('usercode'=>user_session('usercode'),'status'=>'Active','id'=>$id));
		
		$mode="edit";
	}
?>
<div class="header-spacer"></div>
<div class="container">
	<div class="row">
		<div class="col-xl-9 push-xl-3 col-lg-9 push-lg-3 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Workplace Add</h6>
				</div>
				<div class="ui-block-content">
					<form method="post" action="<?=file_path('profile/work_submit')?>" enctype="multipart/form-data">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
						
						<input type="hidden" name="mode" value="<?=$mode;?>">
						<?php $form_value = set_value('id', isset($work_edit[0]['id']) ? $work_edit[0]['id'] : ''); ?>
						<input type="hidden" name="id" value="<?=$form_value;?>">
						
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group  is-empty">
									<label class="control-label">Company*</label>
									<?php $form_value = set_value('company_name', isset($work_edit[0]['company_name']) ? $work_edit[0]['company_name'] : ''); ?>
									<input name="company_name" id="company_name" class="form-control" placeholder="Where have you worked?" type="text" value="<?=$form_value?>" required>
								</div>
								<div class="form-group  is-empty">
									<label class="control-label">Position</label>
									<?php $form_value = set_value('position', isset($work_edit[0]['position']) ? $work_edit[0]['position'] : ''); ?>
									<input class="form-control" placeholder="What is your job title?" value="<?=$form_value?>" name="position" type="text" required>
								</div>

								<div class="form-group  is-empty">
									<label class="control-label">City/Town</label>
									<?php $form_value = set_value('city_town', isset($work_edit[0]['city_town']) ? $work_edit[0]['city_town'] : ''); ?>
									<input class="form-control" name="city_town" value="<?=$form_value?>"  type="text" required>
								</div>

								<div class="form-group  is-empty">
									<label class="control-label">Description</label>
									<?php $form_value = set_value('about_desc', isset($work_edit[0]['about_desc']) ? $work_edit[0]['about_desc'] : ''); ?>
									<textarea name="about_desc" id="about_desc" class="form-control" placeholder=""><?=$form_value?></textarea>
								</div>

								<div class="form-group  is-empty">
									<label class="control-label">Time Period</label>
								<?php if($work_edit[0]['work_here']=="yes"){ 
										$yes="checked";	
										}
									?>
									<div class="checkbox">
										<label>
							<input name="work_here" <?=$yes;?> type="checkbox" value="work_here" id="work_here"><span class="checkbox-material"></span>
							I currently work here
						</label>
									


									</div>


								</div>

							</div>
								<?php $form_value = set_value('work_start_date', isset($work_edit[0]['work_start_date']) ? date('d-m-Y',strtotime($work_edit[0]['work_start_date'])) : ''); ?>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group date-time-picker ">
									<label class="control-label">Start Date</label>
									<input type="text" name="work_start_date" id="datetimepicker" value="<?=$form_value?>" required/>
									<span class="input-group-addon"> <svg class="olymp-month-calendar-icon icon">
                  <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-month-calendar-icon"></use>
                  </svg> </span>
								

								</div>
							</div>
							<?php $form_value = set_value('work_end_date', isset($work_edit[0]['work_end_date']) ? date('d-m-Y',strtotime($work_edit[0]['work_end_date'])) : ''); ?>
							
							<?php if($form_value=="01-01-1970" or $form_value=="00-00-0000"){
								$form_value=date('d-m-Y');
									
							} ?>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group date-time-picker" id="end_date">
									<label class="control-label">End Date</label>
									<input type="text" name="work_end_date" value="<?=$form_value?>" id="datetimepicker"/>
									<span class="input-group-addon"> <svg class="olymp-month-calendar-icon icon">
                  <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-month-calendar-icon"></use>
                  </svg> </span>
								

								</div>
							</div>

							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
								<div class="form-group is-select">
									<?php
									if ( $work_edit[0]['privacy_status'] == "Public" ) {
										$sel1 = "selected";
									} elseif ( $work_edit[0]['privacy_status'] == "Friends" ) {
										$sel2 = "selected";
									} elseif ( $work_edit[0]['privacy_status'] == "Private" ) {
										$sel3 = "selected";
									}?>
									<select name="privacy_status" id="privacy_status" class="selectpicker form-control" size="auto">
										<option <?=$sel1;?> value="Public">Public</option>
										<option <?=$sel2;?> value="Friends">Friends</option>
										<option <?=$sel3;?> value="Private">Private</option>

									</select>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">

								<button style="padding:15px;" class="btn btn-primary btn-lg full-width">Save Changes</button>
								<?php echo validation_errors(); ?> </div>
						</div>
					</form>
				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">WORK</h6>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="#olymp-three-dots-icon"></use></svg></a>
				</div>
				<div class="ui-block-content">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<ul class="widget w-personal-info item-block">
								<?php for($i=0;$i<count($result);$i++){ ?>
								<li>
									<span class="title">
										<?=$result[$i]['company_name'];?>
									</span>


									<span class="title" style="float: right;">


										<div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use></svg>
											<ul class="more-dropdown" style="width: 100px;">
												<li style="padding: 0px 0;">
													<a href="<?=file_path('profile/work_experience/edit')?><?=$result[$i]['id'];?>">Edit</a>
												</li>
												<li style="padding: 0px 0;">
													<a href="<?=file_path('profile/delete_record')?><?=$result[$i]['id'];?>#">Delete</a>
												</li>

											</ul>
										</div>

									</span>
									<span class="date">
										<?=date('Y',strtotime($result[$i]['work_start_date']))?>-
										<?php if($result[$i]['work_here']=="no"){ ?><?=date('Y',strtotime($result[$i]['work_end_date']))?><?php }else{ echo "Present";}?>
									</span>
									<span class="text">
										<?=$result[$i]['about_desc'];?>
									</span>
								</li>
								<?php } ?>

							</ul>
						</div>

					</div>
				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">PROFESSIONAL SKILLS</h6>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="#olymp-three-dots-icon"></use></svg></a>
				</div>

				<div class="ui-block-content">
					<form method="post" action="<?=file_path('profile/skills_submit')?>" enctype="multipart/form-data">
						<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
						<div class="row">
							
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <label class="control-label">Skills*
                              
                               </label>
                              <div class="form-group is-select">
                              
                                <select required name="skills[]" data-placeholder="Choose a Skills..." class="chosen-select form-control" multiple tabindex="4">
                                	
                                    <?php
									
									$edit_skills 	= $skills[0]['skills'];
						  
									$edit_skills_f   = explode(',',$edit_skills);
									 
									for($i=0;$i<count($skillslist);$i++)
									{
										if(in_array($skillslist[$i]['id'],$edit_skills_f))
										{
											$select ="selected";
										}
										else
										{
											$select ='';
										}
										echo '<option '.$select.' value="'.$skillslist[$i]['id'].'">'.$skillslist[$i]['skill_name'].'</option>';
										
									}
								
									?>
                                    
                                </select>
                                
                               </div> 
                              
                            </div>
                            
                            
                           <?php /*?> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group  is-empty">
									<label class="control-label">Skills*</label>
									<input name="skills" id="skills" value="<?=$skills[0]['skills'];?>" class="form-control" placeholder="add skills seprated by comma" type="text" required>
								</div>
							</div><?php */?>

							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
								<div class="form-group is-select">
									<?php
									if ( $skills[ 0 ][ 'privacy_status' ] == "Public" ) {
										$sel1 = "selected";
									} elseif ( $skills[ 0 ][ 'privacy_status' ] == "Friends" ) {
										$sel2 = "selected";
									} elseif ( $skills[ 0 ][ 'privacy_status' ] == "Private" ) {
										$sel3 = "selected";
									}


									?>
									<select name="privacy_status" id="privacy_status" class="selectpicker form-control" size="auto">
										<option <?=$sel1;?> value="Public">Public</option>
										<option <?=$sel2;?> value="Friends">Friends</option>
										<option <?=$sel3;?> value="Private">Private</option>

									</select>
								</div>
							</div>

							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">

								<button style="padding:15px;" class="btn btn-primary btn-lg full-width">Save Changes</button>
								<?php echo validation_errors(); ?> </div>
						</div>
					</form>
				</div>

				<!--professional skill end form-->

				<div class="ui-block-content">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
						</div>

					</div>
				</div>
			</div>
		</div>

		<!---->
		<?php $this->load->view('user/profile/bar_setting');?>
		<!---->

	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>chosen/chosen.css">

<script src="<?=asset_sm()?>chosen/chosen.jquery.js"></script>
<script src="<?=asset_sm()?>chosen/init.js"></script>
