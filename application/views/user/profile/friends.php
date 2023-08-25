<?php $this->load->view('user/profile/top_section');?>

<div class="container">
  <div class="row"> 
    
    <!-- Main Content -->
    
    <div class="col-xl-9 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
      <div class="ui-block">
         <div class="ui-block-title">
          <h6 class="title"> Total Friends <?=$TotalMemberFriend?>
          
          	<span class="pull-right">
            	<span class="pull-left">
         		<input type="search" id="find_friend" placeholder="Find Friend" style="padding: 5px;border-radius: 0px;border-right:none;">  
                </span>
                <span class="pull-right">
                	<button class="btn btn-sm btnsearch" style="padding: 7px 5px;border-radius: 0px;"><i class="fa fa-search"></i></button>
                </span>
            </span>
          </h6>
        </div>
        <div class="ui-block-content">
          <div class="row"> 
            <!-------->
            
             <?php if($TotalMemberFriend == 0) {?>
            		<div class="col-md-12" style="text-align:center;" >No Friends</div>
            <?php } ?>
            
            <div class="col-md-12" id="div-friends-list" style="width:100%;"></div>
            <p style="text-align:center;display:none;width:100%;" id="loading"><img src="<?=base_url('asset/app_social_media/loader.gif')?>" alt="loading"></p>
            
            <!--------------> 
            
          </div>
        </div>
      </div>
    </div>
    
    <!-- ... end Main Content -->
    
    <?php $this->load->view('user/profile/bar_left2');?>
  </div>
</div>

<script nonce=<?=SC_NONCE?>>
    
		$(document).ready(function(){
			appendContent();
			$(window).bind('scroll',fetchMoreData);
		});
		
		var fetchMoreData = function(){
			var position = $(window).scrollTop();
			var bottom = $(document).height() - $(window).height();
			if( position == bottom ){
				$(window).unbind('scroll',fetchMoreData);
				appendContent();
			}	
		};
		
		var appendContent=function appendContent(){
			var _search = $('#find_friend').val(); 
			$.ajax({
			type: "GET",
				url: "<?=file_path('profile/load_friends/'.$member['username'].'/')?>"+$("#div-friends-list > div.friend-box").length+'?search='+_search,
				cache: false,
				dataType : 'json',
				beforeSend: function(){
					$('#loading').fadeIn();		
   				},
				complete: function(){
					$('#loading').fadeOut();
   				},
				success: function(data) {
					$('#div-friends-list').append(data['data']);
					if(data['tot']!='0'){
						$(window).bind('scroll',fetchMoreData);	
					}
				}
			});
		};
		
		$(document).on('click','.btnsearch',function(e){
		
			if ( $('#find_friend').val().length >= 1 ) {
				
				$('#div-friends-list').html("");
				
				appendContent();
				
			}
		});
		
		$(document).on('search','#find_friend',function(e){
		
			if ( $('#find_friend').val().length >= 1 ) {
				
				$('#div-friends-list').html("");
				
				appendContent();
				
			}
		});
		
    </script>
