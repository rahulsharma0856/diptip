
/*$(document).on('focus', '.notifiction-popover-xx', function (e) {
		
		var url = $(this).attr('href');
		
		$(this).webuiPopover('destroy'); // the trick
		
		$(this).webuiPopover({
				
				width:340,
				
				padding:false,
				
				animation:'pop',
				
				trigger:'click',
				
				type:'async',//content type, values:'html','iframe','async'
				
				url: url
				
		}); 
			
});
*/

$(document).on('focus', '.notifiction-popover', function (e) {
		
		var url = $(this).attr('href');
		
		var noti_position = $(this).attr('noti_position');
		
		$(this).webuiPopover('destroy'); // the trick
		
		$(this).webuiPopover({
				
				width:340,
				
				padding:false,
				
				animation:'pop',
				
				trigger:'click',
				
				type:'async',//content type, values:'html','iframe','async'
				
				url: url
				
		}).on('show.webui.popover',function(e,tgt){
				//console.log(e,tgt);
				if(noti_position=='top_header_noti')
				{
					$('.webui-popover').css('position', 'fixed');
					$('.webui-popover').addClass('top_header_noti');
				}
				
				
	    });
			
});

		
		
	
$(document).on('focus', '.who-likes-popover', function () {
		
		var url = $(this).attr('href');
		
		//$(this).webuiPopover('destroy'); // the trick
		
		$('.webui-popover').remove();
		
		$('a .who-likes-popover').webuiPopover('destroy');
		
			$(this).webuiPopover({
				
				width:340,
				
				cache:false,

				padding:false,
				
				animation:'pop',
				
				trigger:'click',
				
				type:'async',//content type, values:'html','iframe','async'
				
				url: url
				
		}); 
			
});
	
	

