<div class="header-spacer"></div>
<!---Headre----> 

<!---End Header------>

<link rel="stylesheet" type="text/css" href="<?=asset_sm()?>css/bootstrap-select.css">
<style>
.form-group.label-static label.control-label, .form-group.label-placeholder label.control-label, .form-group.label-floating label.control-label {
	position: initial;
	pointer-events: none;
	transition: 0.3s ease all;
}
.error_p {
	color: #F00;
}
</style>

<!-- Your Account Personal Information -->
<div class="container">

  <div class="row">
  
    <div class="col-xl-6 push-xl-3 col-lg-12 push-lg-0 col-sm-12 col-xs-12">
    
      <div class="ui-block">
      
        <div class="ui-block-title">
        
          <h6 class="title">Page</h6>
          
           </div>
           
        	<ul class="notification-list friend-requests serach-list"></ul>
            
            <ul class="notification-list dis_none" id="li_view_more">
            
				<?php if(isset($category_selected)){
                
                	$url = '&category='.$category_selected.'&limit=20';
                
                }else{
                
                	$url = '&limit=20';
                
                }?>	
            	 <li style="text-align:center;"><a style="color:#00547b" id="link_load_more" href="<?=file_path('search/load_more_page')?>?q=<?=$filter_text?><?=$url?>">View More</a></li>
                 
            </ul>
            
      </div>
      
    </div>
    
    <?=$this->load->view('user/search/left_bar',$data);?>
    
    <?=$this->load->view('user/search/page_right_bar',$data);?>
    
  </div>
</div>

<!-- ... end Your Account Personal Information -->

<style>
	.ui-block-title .title {
	    display: inline-table;
		margin-left:15px;
}

.dropdown-toggle::after {
    display: inline-block !important;
	position: initial !important;
    width: 0;
    height: 0;
    margin-left: 0.3em;
    vertical-align: middle;
    content: "";
    border-top: 0.3em solid !important;
    border-right: 0.3em solid transparent !important;
    border-left: 0.3em solid transparent !important;
}
#btn2{
	margin-bottom:0px !important;
}
.dropdown-sub li{
	border-bottom:none !important;
}
</style>

<script nonce=<?=SC_NONCE?>>
	$(document).ready(function(e) {
		
      	load_more(); 
		
		$(window).scroll(function() {
			
			if($(window).scrollTop() + $(window).height() >= $(document).height()){
				
				load_more();
			}
		});
		
		 
    });
	
	$(document).on('click', '#link_load_more', function (e) {  
		
		e.preventDefault();

		load_more();
		
	});

	
	function load_more(){
		
		var total_post  = $(".serach-list > li").length;
				
		var url	= $('#link_load_more').attr('href') + '&start='+total_post;
		
		$.ajax({
			
			url:url,
			
			dataType : "json",
			
			success:function(obj){
				
				if(obj['count'] > 0){
					
					$('.serach-list').append(obj['html']);	
					
					$('#li_view_more').removeClass('dis_none');
					
				}else{
					
					$('#li_view_more').addClass('dis_none');	
					
				}
				
				
			}
			
		});

	}
	
	
	
		
	$(document).on('click', '#categoryRadios', function (e) {  
		
		var value = $( 'input[name=categoryRadios]:checked' ).val();
		
        window.location.href = value;
		
	});
	
</script>
