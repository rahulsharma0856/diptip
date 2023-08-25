<style>

.dash_left_icon i

{

	fill: #909090 !important;

	color: #909090!important;

	font-size:25px!important;

}

.dash_left_icon i:hover

{

	fill: #909090 !important;

	color: #00547b!important;

	

}

.dash_left_logout

{

	fill: #909090 !important;

	color:#909090 !important;

}



.dash-left-menu a:hover svg {

     fill: #00547b!important;

	color: #00547b!important;

}

.account-settings a:hover {

    color: #00547b!important;

}

.about-olympus a:hover {

    color: #00547b!important;

}

</style>

<!-- Fixed Sidebar Left -->



<div class="fixed-sidebar">

   



	<?php /*?><div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">

		<a href="#" class="logo">

			<img src="<?=asset_sm()?>img/logo.png" alt="DipTip">

			<h6 class="logo-title">DipTip Boat</h6>

		</a>



		<div class="mCustomScrollbar" data-mcs-theme="dark">

			<ul class="left-menu">

				<li>

					<a href="#" class="js-sidebar-open">

						<svg class="olymp-close-icon left-menu-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-close-icon"></use></svg>

						<span class="left-menu-title">Collapse Menu</span>

					</a>

				</li>

				<li>

					<a href="#">

						<svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right" title="" data-original-title="NEWSFEED"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-newsfeed-icon"></use></svg>

						<span class="left-menu-title">Friends</span>

					</a>

				</li>

                <li>

					<a href="#">

						<svg class="olymp-happy-faces-icon left-menu-icon"  data-toggle="tooltip" data-placement="right" title="" data-original-title="FRIEND GROUPS"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-faces-icon"></use></svg>

						<span class="left-menu-title">Friend Groups</span>

					</a>

				</li>

				<li>

					<a href="#">

						<svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right" title="" data-original-title="FAV PAGE"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-star-icon"></use></svg>

						<span class="left-menu-title">Pages</span>

					</a>

				</li>

				

				

			</ul>



			<div class="profile-completion">



				<div class="skills-item">

					<div class="skills-item-info">

						<span class="skills-item-title">Profile Completion</span>

						<span class="skills-item-count"><span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="76" data-from="0"></span><span class="units">76%</span></span>

					</div>

					<div class="skills-item-meter">

						<span class="skills-item-meter-active bg-primary" style="width: 76%"></span>

					</div>

				</div>



				<span>Complete <a href="#">your profile</a> so people can know more about you!</span>



			</div>

		</div>

	</div><?php */?>

</div>



<!-- ... end Fixed Sidebar Left -->



<!-- Fixed Sidebar Left -->



<div class="fixed-sidebar fixed-sidebar-responsive">



	<div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive" >

		<a href="<?=file_path('dashboard/view/')?>" class="logo js-sidebar-open" title="" style="background-color:#FFFFFF !important">

			<img src="<?=asset_sm()?>logo/d.png" alt="" title="" width="40">

		</a>



	</div>



	<div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">

		<a href="<?=file_path('dashboard/view/')?>" class="logo" title="" style="text-align:center !important">

			<h6 class="logo-title" style="">

           <img src="<?=asset_sm()?>logo/diptip.png" alt="" width="100" title="" style="margin-right: 0px;
    border-radius: 20px;
    background-color: white;
    padding: 4px;" /> 

</h6>

		</a>



		<div class="mCustomScrollbar" data-mcs-theme="dark">



			<div class="control-block">

				<div class="author-page author vcard inline-items">

					<div class="author-thumb">

						<img alt="author" src="<?=thumb(ProfileImg(user_session('profile_pic')),100,100)?>" class="avatar" id="profile_pic">

                        <span class="icon-status online"></span>

					</div>

					<a href="#" class="author-name fn">

						<div class="author-title">

							<?=user_session('name')?> 

						</div>



					</a>

				</div>



			</div>







		<hr />

			<ul class="account-settings">

		

                <li>

					<a href="<?=file_path('dashboard/view/index.php')?>">

                    

                        <i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-home" aria-hidden="true"></i>



                        <span>Home</span>

                    </a>

				</li>







                <li>

					<a href="<?=file_path('profile/view/'.user_session('username'))?>">

                    

                        <i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-user" aria-hidden="true"></i>



                        <span>My Profile</span>

                    </a>

				</li>

                

				<li>

                    <a href="<?=file_path('page/add')?>">

                        <i data-original-title="Compose Page" data-toggle="tooltip" data-placement="right" class="fa fa-file-o" aria-hidden="true"></i>

                        <span>Compose Page</span>

                    </a>

                </li>

                <li>

                    <a href="<?=file_path('group/add')?>">

                        <i data-original-title="Compose group" data-toggle="tooltip" data-placement="right" class="fa fa-users" aria-hidden="true"></i>

    

                        <span>Compose Group</span>

                    </a>

                </li>

                 <li>

                    <a href="<?=file_path('Ads/add')?>">

                        <i data-original-title="Compose group" data-toggle="tooltip" data-placement="right" class="fa fa-bullhorn" aria-hidden="true"></i>

    

                        <span>Compose Adbox</span>

                    </a>

                </li>

            

                

                <li>

                    <a href="<?=file_path('login/logout')?>">



    				<i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-sign-out" aria-hidden="true"></i>

	

	

                        <span>Log Out</span>

                    </a>

                </li>

                 <?php if($this->session->userdata['smr_superadmin']['login']===true){

                     

                    $admin_url_arr  = 	explode('/sm/',base_url()); 

                    $admin_url 		=   $admin_url_arr[0];

                 ?>

                 <li>

                    <a href="<?php echo $admin_url.'/index.php/sm_panel/Change_account/admin'?>">

                        <i data-original-title="Swamp To Admin" data-toggle="tooltip" data-placement="right" class="fa fa-arrow-circle-left" aria-hidden="true"></i>

                        <span>Admin Account</span>

                    </a>

                </li>

                 

                 <?php }?>

                                





                                

			</ul>



		  

           

			<ul class="about-olympus">

		        <div> <span style="font-weight: 500;font-size: 13px;color:#00547b">Copyrights © <?=date('Y')?>. All Rights Reserved By Data Intelligence Protocol Inc</span> </div>

			</ul>



		</div>

	</div>

</div>







<!-- ... end Fixed Sidebar Left -->