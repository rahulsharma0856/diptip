<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline'; script-src 'self' 'nonce-<?=SC_NONCE?>' https://www.google.com https://files.coinmarketcap.com/ https://ajax.googleapis.com/ https://widgets.coinmarketcap.com/">

<title>DIP :: CONTROL PANEL</title>

<link rel="icon" href="<?=base_url(ASSET_FOLDER)?>favicon-32x32.ico" sizes="16x16">   
<link href="<?=base_url(ASSET_FOLDER)?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>css/nifty.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>plugins/pace/pace.min.css" rel="stylesheet">
<script src="<?=base_url(ASSET_FOLDER)?>plugins/pace/pace.min.js"></script>
<link href="<?=base_url(ASSET_FOLDER)?>css/demo/nifty-demo.min.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">


<script src="<?=base_url(ASSET_FOLDER)?>js/jquery.min.js"></script>
	
<script src="<?=base_url(ASSET_FOLDER)?>js/bootstrap.min.js"></script>
<script src="<?=base_url(ASSET_FOLDER)?>js/nifty.min.js"></script>
<script src="<?=base_url(ASSET_FOLDER)?>plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?=base_url(ASSET_FOLDER)?>plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url(ASSET_FOLDER)?>plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<link href="<?=base_url(ASSET_FOLDER)?>plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?=base_url(ASSET_FOLDER)?>plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="<?=base_url(ASSET_FOLDER)?>js/clipboard.min.js"></script>
<link rel="stylesheet" href="<?=base_url(ASSET_FOLDER)?>css/font-awesome.min.css" />

<script src="<?=base_url(ASSET_FOLDER)?>popup/js/lightbox.js"></script>
<script src="<?=base_url(ASSET_FOLDER)?>popup/js/jquery.carouFredSel-5.5.0-packed.js"></script>
<script src="<?=base_url(ASSET_FOLDER)?>popup/js/jquery.magnific-popup.js"></script>
<link  rel="stylesheet" type="text/css" href="<?=base_url(ASSET_FOLDER)?>popup/css/lightbox.css">

<script nonce=<?=SC_NONCE?>>

	$(document).on('click', '.popup-modal', function (e) {
		
			e.preventDefault();
			
			var url=$(this).attr('href');
			
			$.magnificPopup.open({items: { src:url},type: 'ajax',modal: true,preloader: false}, 0);
			
		});
		
		$(document).on('click', '.popup-modal-dismiss', function (e) {
			
			e.preventDefault();
			
			$.magnificPopup.close();
			
		}); 
		
		$(document).on('click', '.jconfirm', function (e) {
			
			var con=confirm('Are You Sure');
			
			if(!con){
				
				e.preventDefault();
				
				return false;
				
			}
			
		}); 
	
</script>



</head>

<body>

<style>
	.menu-title{
		
		text-transform:uppercase;
		
	}
	.mainnav-menu li ul li a{
		
		text-transform:uppercase !important;
		
	}
	#mainnav-menu-wrap{
		
		background-color:#101d25 !important;
		
	}
	.profile-wrap{
		
		background-color:#101d25 !important;
		
	}
	#mainnav {
		
		color: #FFFFFF !important;
		
		font-weight: bold !important;
		
	}
	#mainnav-menu>.active {
		
    	background-color: #337ab7 !important;
		
	}
	
	#mainnav-menu>li>a:hover, #mainnav-menu>li>a:active {
		
		color: #FFFFFF !important;
		
	}
	
	.mainnav-profile .mnp-name{
	
		color: #FFFFFF !important;
		
		font-weight: bold !important;
		
	}
	
	#mainnav .list-header{
	
		color: #FFFFFF !important;
		
		font-weight: bold !important;	
	
	}
	
	#mainnav-menu ul .active-link a, .menu-popover .sub-menu ul .active-link a {
 
    	color: #98dcc9 !important;
		
	}
	#mainnav-menu .active-link{
		
		background-color:#337ab7 !important;
		
	}
	  #mainnav-menu ul a:hover{
	  
		  color: #98dcc9 !important;
	  
	  }
	#mainnav-menu .active:not(.active-sub)>a {
		
    	color: #FFFFFF !important;
		
	}
	
	#mainnav-menu > li:hover{
		background-color:#337ab7 !important;
	}
	
	
</style>