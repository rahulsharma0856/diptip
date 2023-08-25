$(document).on('click','#group_request_send',function(e){
		
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



$(document).on('click','#group_delete_request',function(e){
		
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
