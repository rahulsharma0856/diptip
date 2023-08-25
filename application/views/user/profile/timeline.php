<?php $this->load->view('user/profile/top_section');?>

<div class="container">

  <div class="row"> 
    
    <!-- Main Content -->
    
    <div class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
    
    	
        <?php /*?><?php if($balance['balance'] >= 210.10 && $paid_sts==true) {?><?php */?>
        
					<?php if($member['usercode']==user_session('usercode')) {?>
                    
					<?php 
                    
						$setting = array(
						
							'type' => 'member'
						
						);
					
                    ?>
                    
                    <?php echo $this->load->view('user/post/post_form',array('setting'=>$setting),TRUE); ?>
                    
                    
                    <?php } elseif($isMyFriend==true){?>
                    
						<?php 
                        
                        $setting = array(
                        
							'type' => 'tag',
							
							'endcode' => $member['usercode']
                        
                        );
                        
                        ?>
                    
                    <?php echo $this->load->view('user/post/post_form',array('setting'=>$setting),TRUE); ?>
                    
                    <?php } ?>
        
					<?php /*?><?php } else { ?>
                    
                        <p style="color:#47a247;font-weight:bold;">Your Account Balance is Less. Please Refer Your Friends OR Like/Share Someone's Post on the SRW to Earn Some Money. Your Account Balance Should have a MINIMUM of $210.10 to Make a Post on the SRW.</p>
                        
                        <?php if($paid_sts==true){?>
                        
                        <p style="color:#47a247;font-weight:bold;">$210 will be Locked as per RRS. $200 is Reserved to Run Monthly Subscriptions and Remaining $10 can be used to Purchase Positions.</p>
                    
                    <?php } ?>
                    
                    <?php } ?><?php */?>
      
      
      
     <?php /*?> <div class="ui-pnotify stack-bottomright ui-pnotify-fade-normal ui-pnotify-move ui-pnotify-in ui-pnotify-fade-in" aria-live="assertive" aria-role="alertdialog" style="display: none; width: 300px; right: 25px; bottom: 25px;"><div class="brighttheme ui-pnotify-container brighttheme-success ui-pnotify-shadow" role="alert" style="min-height: 16px;"><div class="ui-pnotify-icon"><span class="brighttheme-icon-success"></span></div><h4 class="ui-pnotify-title"></h4><div class="ui-pnotify-text" aria-role="alert">
<br><a href="http://172.16.16.23/socialMediaReward/sm/index.php/dashboard/post/242/" class=""><font class="theme-txt1">User 5 -</font>  <font class="theme-txt2">commented on your post you shared</font> <b class="theme-txt2"></b></a>.</div></div></div>
      <?php */?>
      
      <div id="newsfeed-items-grid" class="post_item_section"></div>
      	
         <a id="load-post-button" href="#" class="btn btn-control btn-more">
			<svg class="olymp-three-dots-icon">
            	<use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
            </svg>
        </a>
      
    </div>
    
    <!-- ... end Main Content -->
    
    <?php $this->load->view('user/profile/bar_left');?>
    
    <?php $this->load->view('user/profile/bar_right');?>
    
    <?php $this->load->view('user/load/share_dialog');?>
    

    
  </div>
  
</div>

<script nonce=<?=SC_NONCE?>>
	
	$(document).ready(function(e) {
	
       load_post();
	   
	   checkNewMessages();
	    
    });
	
	
	
	
	
	$(document).on('click','#load-post-button',function(e){
		
		e.preventDefault();
		
		load_post();
		
	});
	
	function load_post(){
		
		var total_post  = $(".post_item_section > div").length;
		
		var url='<?=file_path('profile/load_post')?><?php echo "?u=".$member['username']?>&s='+total_post;
		

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
		
		var url='<?=file_path('profile/checkNewMessages')?><?php echo "?uid=".$member['username']?>&last='+last;
	
		
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

