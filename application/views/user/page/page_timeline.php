

<div class="container">
	<div class="row">

		<!-- Main Content -->

		<div class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
        	
            
            
            
			<?php if($isPageAdmin==true){?>
            
                
                
					<?php 
                    
                    $setting = array(
                    
                   		 'type' => 'page',
						 
						 'endcode' => $result[0]['id']
                    
                    );
                    ?>
                    
                    <?php echo $this->load->view('user/post/post_form',array('setting'=>$setting),TRUE); ?>
                
                
                
            
            <?php } ?>
                
                
        
        		
                
            <div id="newsfeed-items-grid" class="post_item_section"></div>
            
            <a id="load-post-button" href="#" class="btn btn-control btn-more">
            <svg class="olymp-three-dots-icon">
            <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
            </svg>
            </a>

			
		</div>

		<!-- ... end Main Content -->


		<?php $this->load->view('user/page/bar_left');?>

		
        <?php $this->load->view('user/page/bar_right');?>
		

	</div>
</div>



  <?php $this->load->view('user/load/share_dialog');?>
  
  
  
  <script nonce=<?=SC_NONCE?>>
	
	$(document).on('click','#load-post-button',function(e){
		
		e.preventDefault();
		
		load_post();
		
	});
	
	function load_post(){
		
		var total_post  = $(".post_item_section > div").length;
		
		var url='<?=file_path('page/load_post')?><?php echo "?u=".$result[0]['id']?>&s='+total_post;
		

		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(data){
				
				if(data['id']=='1'){
					
					$('#newsfeed-items-grid').append(data['html']);	
					
					$('#load-post-button').removeClass('dis_none');
					
				}else{
					
					$('#load-post-button').addClass('dis_none');
					
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
	
	}
	
	function checkNewMessages() {
	
		//alert('HI');	
		var last = $(".post_item_section").children(":first").attr('data-id');
		
		var url='<?=file_path('page/checkNewMessages')?><?php echo "?uid=".$result[0]['id']?>&last='+last;
	
		
		if (last !== undefined){
		
			$.ajax({
				
			url: url,
			
			dataType: "json",
			
			beforeSend: function(){
				
			},
			complete: function(){
				
			},
			
			success:function(obj){
				
			$.each( obj, function( key, value ) {
				
				if($("#"+key).length==0){
				
					$('#newsfeed-items-grid').prepend(value);
					
					$("#newsfeed-items-grid .post-message:first-child").hide();
					
					$("#newsfeed-items-grid .post-message:first-child").fadeIn();
				
				}
			
			});	
			
			},
			error: function( jqXHR, textStatus, errorThrown) {
			}
			});	
		
		}
		
		stopNewMessages = setTimeout(checkNewMessages, 10000);
	
	}
	
</script>


<script nonce=<?=SC_NONCE?>>


	$(document).ready(function(e) {
	
       load_post();
	   
	   checkNewMessages();
	    
    });
	
</script>

