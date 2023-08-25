$(document).on('click','#friend_request_send',function(e){
		
		e.preventDefault();
		
		var url =  $(this).attr('href');
		
		var sec_replace = $(this).closest('.sec-replace');
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				if(result['status']=='true'){
					
					sec_replace.html(result['html']);
						
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
});


$(document).on('click','#friend_request_delete',function(e){
		
		e.preventDefault();
		
		var url =  $(this).attr('href');
		
		var sec_replace = $(this).closest('.sec-replace');
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				if(result['status']=='true'){
					
					sec_replace.html(result['html']);
						
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
});


$(document).on('click','#friend_request_accept',function(e){
		
		e.preventDefault();
		
		var url =  $(this).attr('href');
		
		var sec_replace = $(this).closest('.sec-replace');
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(result){
				
				if(result['status']=='true'){
					
					sec_replace.html(result['html']);
						
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
		
});



