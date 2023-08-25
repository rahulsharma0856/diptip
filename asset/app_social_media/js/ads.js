$(document).on('click','#do_like_ads',function(e){
		
		e.preventDefault();
		
		var url = $(this).attr('value');
		
		var span = $(this).closest('span');
		
		var pid= $(this).attr('Acode');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				
				//span.html(data['html']);
				
				$('#sp_po_like'+pid).html(data['html']);
				
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
