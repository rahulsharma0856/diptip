<style>

#profile_pic {

	width: 34px !important;

	height: 34px !important;

}

.account-settings i {

	margin-right: 15px;

	fill: #909090 !important;

	width: 20px;

	height: 20px;

	color: #909090 !important;

	font-size: 18px;

}

.account-settings i:hover {

	fill: #00547b !important;

	color: #00547b !important;

}

.header_logout {

	fill: #909090 !important;

	color: #909090 !important;

}

.header_logout:hover {

	fill: #00547b !important;

	color: #00547b !important;

}

.top_header_noti {

	top: 60px!important;

}

</style>

<?php $this->load->view('user/home/comman/bar_left');	 ?>

<?php $this->load->view('user/home/comman/bar_right');	 ?>



<!-- Header -->

<header class="header" id="site-header">

  <div class="page-title logo_name"> 

    <h6>
        	<img width="100" height="auto" src="<?=asset_sm()?>logo/diptip.png" alt="diptip" style="border-radius: 20px;background-color: white;padding: 4px;" />

        </h6>

  </div>

  <div class="header-content-wrapper">

   <?php if(!isset($serach_form_url)){



				$serach_form_url = file_path('search/top');



		}?>

    <form action="<?=$serach_form_url?>" method="get" class="search-bar w-search notification-list friend-requests">

      <div class="form-group with-button">

        <input class="form-control js-user-search1" id="membername" name="q" value="<?=utf8_decode(urldecode($_GET['q']))?>" placeholder="Search" type="text">

        <button> <svg class="olymp-magnifying-glass-icon">

        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-magnifying-glass-icon"></use>

        </svg> </button>

        <div  id="autocomplete_section"></div>

      </div>

    </form> 

    <div class="control-block">

   <div class="control-icon more has-items" style="margin-right:15px;"> <a href="<?=file_path('dashboard/view')?>" class="author-name fn">

        <div class="author-title"> Home </div>

        </a> </div>

      <div class="control-icon more has-items">

        <div style="margin-left:0px;" class="author-page author vcard inline-items more">

          <div class="author-thumb">

            <div class="more-dropdown more-with-triangle">

              <div class="mCustomScrollbar" data-mcs-theme="dark">

                <div class="ui-block-title ui-block-title-small">

                  <h6 class="title top_right_account_nm">Compose</h6>

                </div>

                <ul class="account-settings">

                  <li> <a href="<?=file_path('page/add')?>"> <i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-file-o" aria-hidden="true"></i> <span>Compose Page</span> </a> </li>

                  <li> <a href="<?=file_path('group/add')?>"> <i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-users" aria-hidden="true"></i> <span>Compose Group</span> </a> </li>

                  <li> <a href="<?=file_path('Ads/add')?>"> <i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-bullhorn" aria-hidden="true"></i> <span>Compose Adbox</span> </a> </li>

                </ul>

              </div>

            </div>

          </div>

          <div class="author-title"> Compose </div>

        </div>

      </div>

      

      <!-- Friend Request -->

      

      <div class="control-icon more has-items"> <a href="<?=file_path('notifiction/ajax_friend_request')?>" class="notifiction-popover" data-placement="auto" noti_position="top_header_noti">

	  

	  

	 

		          <div class="author-title"> My Network </div>

		

		

		 <span class="html_top_total_friend_request"></span> </a> </div>

      

      <!-- End Friend Request --> 

      

      <!---Messages -->

      

      <div class="control-icon more has-items"> <a href="<?=file_path('chat/message_notification')?>" class="notifiction-popover" data-placement="auto" noti_position="top_header_noti"> 

	  

	     <div class="author-title"> Messages </div>

	

		

		<span class="html_count_recive_unread_msg"></span> </a> </div>

      

      <!---End Messages--> 

      

      <!---Notifications-->

      

      <div class="control-icon more has-items"> <a href="<?=file_path('notifiction/get_gen_notification')?>" class="notifiction-popover" data-placement="auto" noti_position="top_header_noti"> 

	  

	  	          <div class="author-title"> Notifications </div>

	

		<span class="html_top_gen_notifiction"></span> </a> </div>

      

      <!---END Notifications-->

      

      <div class="author-page author vcard inline-items more">

        <div class="author-thumb"> <img alt="author" src="<?=thumb(ProfileImg(user_session('profile_img')),100,100)?>" class="avatar" id="profile_pic"> <span class="icon-status online"></span>

		

          <div class="more-dropdown more-with-triangle">

            <div class="mCustomScrollbar" data-mcs-theme="dark">

              <div class="ui-block-title ui-block-title-small">

                <h6 class="title top_right_account_nm">DIPTIP ACCOUNT</h6>

              </div>

              <ul class="account-settings">

                <li> <a href="<?=file_path('profile/view/'.user_session('username'))?>">

				

				 <i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-user" aria-hidden="true"></i>

				

				 <span>My Profile</span> </a> </li>

                <?php  $paid = $this->Member_module->is_paid(user_session('usercode'));  ?>

                <?php if($paid==true){ ?>

                <?php } ?>

                <li> <a href="<?=file_path('login/logout')?>"> 



				

				<i data-original-title="" data-toggle="tooltip" data-placement="right" class="fa fa-sign-out" aria-hidden="true"></i>

				  

				  

				   <span>Log Out</span> </a> </li>

                <?php if($this->session->userdata['smr_superadmin']['login']===true){ ?>

                <li> <a href="<?=file_path('admin/dashboard/view')?>"> <i data-original-title="Swamp To Admin" data-toggle="tooltip" data-placement="right" class="fa fa-arrow-circle-left" aria-hidden="true"></i> <span>Admin Account</span> </a> </li>

                <?php }?>

              </ul>

            </div>

          </div>

        </div>

        <a href="<?=file_path('profile/view/'.user_session('username'))?>" class="author-name fn">

      

		  

		   </a> </div>

    </div>

	

	

	

	

	

	

	

  </div>

  

  

</header>



<!-- ... end Header --> 













































<!-- Responsive Header -->



<header class="header header-responsive" id="site-header-responsive">

  <div class="header-content-wrapper">

    <ul class="nav nav-tabs mobile-app-tabs" role="tablist">

      <li class="nav-item"> <a href="<?=file_path('notifiction/ajax_friend_request')?>" class="nav-link notifiction-popover" data-placement="auto" noti_position="top_header_noti">

        <div class="control-icon has-items" style="width: 30px;"> 

		

		

		          <div class="author-title" style="text-align: -webkit-center;

    color: white;

    font-weight: bold;"> My Network </div>

		

		

		

		

		  <div class="html_top_total_friend_request"></div>

        </div>

        </a> </li>

      <li class="nav-item"> <a href="<?=file_path('chat/message_notification')?>" class="nav-link notifiction-popover" data-placement="auto" noti_position="top_header_noti">

        <div class="control-icon has-items" style="width: 30px;"> 

		

		<div class="author-title" style="text-align: -webkit-center;

    color: white;

    font-weight: bold;"> Recent Messages </div>

		

		  <div class="html_count_recive_unread_msg"></div>

        </div>

        </a> </li>

      <li class="nav-item"> <a href="<?=file_path('notifiction/get_gen_notification')?>" class="nav-link notifiction-popover" data-placement="auto" noti_position="top_header_noti">

        <div class="control-icon has-items" style="width: 30px;"> 

		

		<div class="author-title" style="text-align: -webkit-center;

    color: white;

    font-weight: bold;"> Recent Notifications </div>

		

		

		  <div class="html_top_gen_notifiction"></div>

        </div>

        </a> </li>

      <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#search" role="tab"> <svg class="olymp-magnifying-glass-icon">

        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-magnifying-glass-icon"></use>

        </svg> <svg class="olymp-close-icon">

        <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-close-icon"></use>

        </svg> </a> </li>

    </ul>

  </div>

  

  <!-- Tab panes -->

  <div class="tab-content tab-content-responsive">

    <div class="tab-pane " id="request" role="tabpanel">

      <div class="mCustomScrollbar" data-mcs-theme="dark">

        <div class="ui-block-title ui-block-title-small">

          <h6 class="title">FRIEND REQUESTS</h6>

        </div>

        <ul class="notification-list friend-requests html_top_friend_request_list">

        </ul>

        <a href="<?=file_path('profile/friends_request/')?>" class="view-all bg-blue">Check All Friends Request</a> </div>

    </div>

    <div class="tab-pane " id="chat" role="tabpanel">

      <div class="mCustomScrollbar" data-mcs-theme="dark">

        <div class="ui-block-title ui-block-title-small">

          <h6 class="title">Chat / Messages</h6>

        </div>

        <ul class="notification-list chat-message">

          <li class="message-unread">

            <div class="author-thumb"> <img src="<?=asset_sm()?>img/avatar59-sm.jpg" alt="author"> </div>

             <span class="notification-icon"> <svg class="olymp-chat---messages-icon">

            <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-chat---messages-icon"></use>

            </svg> </span>

            <div class="more"> <svg class="olymp-three-dots-icon">

              <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>

              </svg> </div>

          </li>

        </ul>

        <a href="#" class="view-all bg-purple">View All Messages</a> </div>

    </div>

    <div class="tab-pane " id="notification" role="tabpanel">

      <div class="mCustomScrollbar" data-mcs-theme="dark">

        <div class="ui-block-title ui-block-title-small">

          <h6 class="title">Notifications</h6>

        </div>

        <ul class="notification-list">

          <li>

            <div class="author-thumb"> <img src="<?=asset_sm()?>img/avatar62-sm.jpg" alt="author"> </div>

            <div class="notification-event">

              

              <span class="notification-date">

              </span> </div>

            <span class="notification-icon"> <svg class="olymp-comments-post-icon">

            <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-comments-post-icon"></use>

            </svg> </span>

            <div class="more"> <svg class="olymp-three-dots-icon">

              <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>

              </svg> <svg class="olymp-little-delete">

              <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-little-delete"></use>

              </svg> </div>

          </li>

        </ul>

        <a href="#" class="view-all bg-primary">View All Notifications</a> </div>

    </div>

    <div class="tab-pane " id="search" role="tabpanel">

      <form action="<?=$serach_form_url?>" method="get" class="search-bar w-search notification-list friend-requests" style="margin-top:4%;">

        <div class="form-group with-button">

          <input class="form-control js-user-search1" id="membername2" name="q" value="<?=utf8_decode(urldecode($_GET['q']))?>" placeholder="Search" type="text">

          <button> <svg class="olymp-magnifying-glass-icon">

          <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-magnifying-glass-icon"></use>

          </svg> </button>

          <div  id="autocomplete_section2"></div>

        </div>

      </form>

    </div>

  </div>

</header>



<!-- ... end Responsive Header --> 

<script nonce=<?=SC_NONCE?>>



	var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};



	$(document).ready(function(e) {



		get_notifaction();



        setInterval(function(){



    		get_notifaction();



		}, 5000);



    });









	function get_notifaction(){



		var url='<?=file_path('notifiction/ajaxGetAllSummery')?>?u_search='+$('#live_chat_search').val();



		$.ajax({



			url:url,



			dataType : "json",



			success:function(obj){



				$.each( obj, function( key, value ) {



					$('.'+key).html(value)



				});



				var quick = obj['quick'];



				$.each( quick, function( key, value ) {



					quickNotifaction(value);



				});





				var NewLikesPost = obj['NewLikesPost'];



				$.each( NewLikesPost, function( key, value ) {



					console.log('Post :'+value['post_id']+' Value : '+value['tot']);



                    var like_total = value['tot'] + ' Likes';

                    

                    if (value['tot'] == 1) {

                        like_total = value['tot'] + ' Like';

                    }                

                    

					$('.like-post-'+value['post_id']).html(like_total);



					console.log(value);



				});



				var NewCommentPost  = obj['NewCommentPost'];



				$.each( NewCommentPost, function( key, value ) {



                    var comment_total = value['tot'] + ' Comments';

                    

                    if (value['tot'] == 1) {

                        comment_total = value['tot'] + ' Comment';

                    }

                

					$('#total_post_total_comments_'+value['post_id']).html(comment_total);



					console.log(value);



				});







				var NewCommentList  = obj['NewCommentList'];



				$.each( NewCommentList, function( key, value ) {





					if($('#post_comments_list'+value['post']).find("#comment_id_"+value['id']).length < 1){



						$('#post_comments_list'+value['post']).append(value['html']);



					}



				});





			}

		});

	}











		function quickNotifaction(text_msg) {



			var opts = {



				title: "",



				text: text_msg,



				addclass: "stack-bottomleft",



				stack: stack_bottomright



			};



			opts.type = "success";



			new PNotify(opts);



		}



</script> 

<script nonce=<?=SC_NONCE?>>



$(document).ready(function(e) {



		$("#membername").autocomplete({

			source:'<?php echo file_path();?>comman_c/auto_camplate',

			appendTo: "#autocomplete_section",

			minLength:1,

			selectFirst: true,

			selectOnly: true,

			select: function(event, ui) {

				$(this).val(ui.item.label);

				window.location.href = ui.item.url;

			},

			focus: function(event, ui) {



			},

			change: function(event,ui)

			{

				$(this).val(ui.item.label);

			},

			search: function(){

				$(this).addClass('loading');

			},

			open: function(){

				$(this).removeClass('loading');

			}

		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {



        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="label"><h6><i class="' + item.icon + '"></i> ' + item.label + '</h6></div></div></a>';







        return $( "<li></li>" )

                .data( "item.autocomplete", item )

                .append(inner_html)

                .appendTo( ul );

    };;



	/*search for responsive */



	$("#membername2").autocomplete({

			source:'<?php echo file_path();?>comman_c/auto_camplate',

			appendTo: "#autocomplete_section2",

			minLength:1,

			selectFirst: true,

			selectOnly: true,

			select: function(event, ui) {

				$(this).val(ui.item.label);

				window.location.href = ui.item.url;

			},

			focus: function(event, ui) {



			},

			change: function(event,ui)

			{

				$(this).val(ui.item.label);

			},

			search: function(){

				$(this).addClass('loading');

			},

			open: function(){

				$(this).removeClass('loading');

			}

		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {



        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="label"><h6><i class="' + item.icon + '"></i> ' + item.label + '</h6></div></div></a>';







        return $( "<li></li>" )

                .data( "item.autocomplete", item )

                .append(inner_html)

                .appendTo( ul );

    };;







 });



</script> 

