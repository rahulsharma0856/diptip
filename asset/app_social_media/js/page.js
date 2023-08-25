$(document).on('click','#do_like_page',function(e){
		
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



$(document).on('click','#do_unlike_page',function(e){
		
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
