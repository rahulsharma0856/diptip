		<!-- Left Sidebar -->

		<div class="col-xl-3 pull-xl-9 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">About
                    	
                        <?php if(user_session('usercode')==$member['usercode']){?>
                    		<span class="pull-right"><a href="<?=file_path('profile/edit_profile/')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span>
                        <?php } ?>
                        
                    </h6>
				</div>
				<div class="ui-block-content">
					<ul class="widget w-personal-info item-block">
						<li>
							<span class="title">About Me:</span>
							<span class="text"><?=filter_message($member['about_desc'])?></span>
						</li>
                        
						
       
					<?php $TotalMemberFriend	=	$this->Member_module->getCountMemberFriend($member['usercode']); ?>
                    <li>
                        <span class="title">Friends:  </span>
                        <span class="text"><a href="<?=file_path('profile/friends/'.$member['username'])?>"><?=$TotalMemberFriend?></a></span>
                    </li>
                        
						
					</ul>

					
				</div>
			</div>
	
		</div>

		<!-- ... end Left Sidebar -->