<!DOCTYPE html>
<html lang="en">
<head>

	<title>diptip</title>

	<!-- Required meta tags always come first -->
	<!--<meta charset="utf-8">-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' cdn.jsdelivr.net 'nonce-<?=SC_NONCE?>' https://cdn.jsdelivr.net/ https://www.google.com/; img-src * data:;">
	<!-- Main Font -->
	<script src="<?=asset_sm()?>js/webfontloader.min.js"></script>
	<script nonce=<?=SC_NONCE?>>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>
   <link rel="icon" href="<?=asset_sm()?>favicon-32x32.ico" sizes="16x16">  
    
	<!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?=asset_sm()?>custom.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>Bootstrap/dist/css/bootstrap-grid.css">
	<!-- Theme Styles CSS -->
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/theme-styles.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/blocks.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/fonts.css">
	<!-- Styles for plugins -->
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/simplecalendar.css">
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/bootstrap-select.css">
	<!-- Lightbox popup script-->
	<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?=asset_sm()?>fontawesome/css/font-awesome.css">
    <script src="<?=asset_sm()?>js/jquery-3.2.0.min.js"></script>
    <link rel="stylesheet" href="<?=asset_sm()?>dialog/jquery-ui.css">
    <script src="<?=asset_sm()?>dialog/jquery-ui.js"></script>
    <script type="text/javascript" src="<?=asset_sm()?>pnotify/pnotify.js"></script>
    <link type="text/css" rel="stylesheet" href="<?=asset_sm()?>pnotify/pnotify.css" />
    <link type="text/css" rel="stylesheet" href="<?=asset_sm()?>pnotify/pnotify.brighttheme.css" />
</head>

<body>

<style>
	.dis_none{
		display:none !important;
	}
	#do_like_post i{
		font-size: 22px !important;
	    margin-right: 8px !important;
	}
	
	#do_unlike_post i{
		font-size: 22px !important;
	    margin-right: 8px !important;
		color:#ff5e3a;
	}
	@media screen and (max-width: 1080px) {
	
		.header .page-title {
			display: block!important;
		}
		.header .logo_name {
			padding: 5px 50px 26px 20px!important;
		}
	}
	@media screen and (min-width: 780px) {
	
		.search-bar.w-search {
			width: 400px!important;
		}
		
	} 
	@media screen and (max-width: 768px) {
		
		.header{
			padding-right:0px!important;
		}
		.header-responsive .mobile-app-tabs .nav-link {
			padding: 0 25px!important;
		}
				
		
		.search-bar .form-group.with-button input {
    		 border:none!important;
		}
		.mobile-app-tabs .nav-link.active {
			border-bottom-color: #00547b!important;
		}
		.search-bar .selectize-input {
			height: 60px!important;
		}
		.search-bar .form-group.with-button button {
			border:none!important;
		}
		.search-bar {
			height: 52px!important;
		}
		.search-bar.w-search {
			min-height: 52px!important;
		}
		.w-search .form-group {
   			margin-top: 0px!important; 
		}
		
		/*top-header notification*/
		.webui-popover
		{
			width: 92%!important;
			margin-left: 15px!important;
			margin-right: 15px!important;
			left: 0px!important;
		}
		
		/* chat sys popup */
		
		#chat-static-section{
			display:none!important;
		}
		/* chat msg btn in timeline */
		#msg_btn{
			display:none!important;
		}
	} 
	
	
	@media screen and (max-width: 560px) {
	
		.post-additional-info .post_do_like
		{
			display: inline-block!important;
    		width: 30%!important;
		}
		
		.post-additional-info .comments-shared
		{
			display: inline-block!important;
			margin-top: 0px!important;
		}
	}
	
	@media screen and (max-width: 480px) {
		.add-options-message .options-message {
			margin-left: 15px!important;
		}
	
	}
	@media screen and (max-width: 400px) {
	
		.post-additional-info .post_do_like {
			display:block!important; 
			width: 30%!important;
		}
		.post-additional-info .comments-shared {
			display:block!important; 
			margin-top: 8px!important;
		}
		.post-additional-info .comments-shared #btn_post_comment
		{
			margin-right: 180px!important;
		}
		.post-additional-info .comments-shared > .more
		{
			margin-right: 180px!important;
			line-height: 2.7!important;

		}
		
	}
	
	.theme-txt1{
		  color: #00547b!important;
		  font-weight:bold;
	}
	.theme-txt2{
		color:#888da8 !important;
	}
	.theme-txt3{
		color:#FFFFFF;	
	}
	.webui-popover-content{
		max-height:350px !important;
	}
	.tag_selected_member {
		position: relative;
		margin: 3px 5px 3px 0;
		padding: 3px 5px 3px 5px;
		border: 1px solid #e4eaf3;
		max-width: 100%;
		border-radius: 3px;
		background-size: 100% 19px;
		background-repeat: repeat-x;
		background-clip: padding-box;
		color: #333;
		line-height: 13px;
		cursor: default;
	}
	
	#tag_selected_member_remove {
		font-weight: bold;
		margin-left: 5px;
	}
</style>



