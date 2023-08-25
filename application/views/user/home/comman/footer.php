<?php /*?>
<!-- Window-popup Update Header Photo -->

<div class="modal fade" id="update-header-photo">
	<div class="modal-dialog ui-block window-popup update-header-photo">
		<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

		<div class="ui-block-title">
			<h6 class="title">Update Header Photo</h6>
		</div>

		<a href="#" class="upload-photo-item">
			<svg class="olymp-computer-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-computer-icon"></use></svg>

			<h6>Upload Photo</h6>
			<span>Browse your computer.</span>
		</a>

		<a href="#" class="upload-photo-item" data-toggle="modal" data-target="#choose-from-my-photo">

			<svg class="olymp-photos-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-photos-icon"></use></svg>

			<h6>Choose from My Photos</h6>
			<span>Choose from your uploaded photos</span>
		</a>
	</div>
</div>

<!-- ... end Window-popup Update Header Photo -->

<!-- Window-popup Choose from my Photo -->
<div class="modal fade" id="choose-from-my-photo">
	<div class="modal-dialog ui-block window-popup choose-from-my-photo">
		<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

		<div class="ui-block-title">
			<h6 class="title">Choose from My Photos</h6>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">
						<svg class="olymp-photos-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-photos-icon"></use></svg>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">
						<svg class="olymp-albums-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-albums-icon"></use></svg>
					</a>
				</li>
			</ul>
		</div>


		<div class="ui-block-content">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">

					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo1.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo2.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo3.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>

					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo4.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo5.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo6.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>

					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo7.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo8.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<div class="radio">
							<label class="custom-radio">
								<img src="<?=asset_sm()?>img/choose-photo9.jpg" alt="photo">
								<input type="radio" name="optionsRadios">
							</label>
						</div>
					</div>


					<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
					<a href="#" class="btn btn-primary btn-lg btn--half-width">Confirm Photo</a>

				</div>
				<div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">

					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="<?=asset_sm()?>img/choose-photo10.jpg" alt="photo">
							<figcaption>
								<a href="#">South America Vacations</a>
								<span>Last Added: 2 hours ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="<?=asset_sm()?>img/choose-photo11.jpg" alt="photo">
							<figcaption>
								<a href="#">Photoshoot Summer 2016</a>
								<span>Last Added: 5 weeks ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="<?=asset_sm()?>img/choose-photo12.jpg" alt="photo">
							<figcaption>
								<a href="#">Amazing Street Food</a>
								<span>Last Added: 6 mins ago</span>
							</figcaption>
						</figure>
					</div>

					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="<?=asset_sm()?>img/choose-photo13.jpg" alt="photo">
							<figcaption>
								<a href="#">Graffity & Street Art</a>
								<span>Last Added: 16 hours ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="<?=asset_sm()?>img/choose-photo14.jpg" alt="photo">
							<figcaption>
								<a href="#">Amazing Landscapes</a>
								<span>Last Added: 13 mins ago</span>
							</figcaption>
						</figure>
					</div>
					<div class="choose-photo-item" data-mh="choose-item">
						<figure>
							<img src="<?=asset_sm()?>img/choose-photo15.jpg" alt="photo">
							<figcaption>
								<a href="#">The Majestic Canyon</a>
								<span>Last Added: 57 mins ago</span>
							</figcaption>
						</figure>
					</div>


					<a href="#" class="btn btn-secondary btn-lg btn--half-width">Cancel</a>
					<a href="#" class="btn btn-primary btn-lg disabled btn--half-width">Confirm Photo</a>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- ... end Window-popup Choose from my Photo -->

<!-- Window-popup-CHAT for responsive min-width: 768px -->
<div class="ui-block popup-chat popup-chat-responsive">
	<div class="ui-block-title">
		<span class="icon-status online"></span>
		<h6 class="title" >Chat</h6>
		<div class="more">
			<svg class="olymp-three-dots-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use></svg>
			<svg class="olymp-little-delete js-chat-open"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-little-delete"></use></svg>
		</div>
	</div>
	<div class="mCustomScrollbar">
		<ul class="notification-list chat-message chat-message-field">
			<li>
				<div class="author-thumb">
					<img src="<?=asset_sm()?>img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
				</div>
				<div class="notification-event">
					<span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
					<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
				</div>
			</li>

			<li>
				<div class="author-thumb">
					<img src="<?=asset_sm()?>img/avatar63-sm.jpg" alt="author" class="mCS_img_loaded">
				</div>
				<div class="notification-event">
					<span class="chat-message-item">Don’t worry Mathilda!</span>
					<span class="chat-message-item">I already bought everything</span>
					<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:29pm</time></span>
				</div>
			</li>

			<li>
				<div class="author-thumb">
					<img src="<?=asset_sm()?>img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
				</div>
				<div class="notification-event">
					<span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
					<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
				</div>
			</li>
		</ul>
	</div>

	<form>

		<div class="form-group label-floating is-empty">
			<label class="control-label">Press enter to post...</label>
			<textarea class="form-control" placeholder=""></textarea>
			<div class="add-options-message">
				<a href="#" class="options-message">
					<svg class="olymp-computer-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-computer-icon"></use></svg>
				</a>
				<div class="options-message smile-block">

					<svg class="olymp-happy-sticker-icon"><use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-happy-sticker-icon"></use></svg>

					<ul class="more-dropdown more-with-triangle triangle-bottom-right">
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat1.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat2.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat3.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat4.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat5.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat6.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat7.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat8.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat9.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat10.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat11.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat12.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat13.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat14.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat15.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat16.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat17.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat18.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat19.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat20.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat21.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat22.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat23.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat24.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat25.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat26.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="<?=asset_sm()?>img/icon-chat27.png" alt="icon">
							</a>
						</li>
					</ul>
				</div>
			</div>
			<span class="material-input" ></span></div>

	</form>


</div>
<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->

<?php */?>

<!-- jQuery first, then Other JS. -->

<!-- Js effects for material design. + Tooltips -->
<script src="<?=asset_sm()?>js/material.min.js"></script>

<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
<script src="<?=asset_sm()?>js/theme-plugins.js"></script>

<!-- Init functions -->
<script src="<?=asset_sm()?>js/main.js"></script>

<!-- Load more news AJAX script -->
<script src="<?=asset_sm()?>js/ajax-pagination.js"></script>

<!-- Select / Sorting script -->
<script src="<?=asset_sm()?>js/selectize.min.js"></script>

<!-- Datepicker input field script-->
<script src="<?=asset_sm()?>js/moment.min.js"></script>
<script src="<?=asset_sm()?>js/daterangepicker.min.js"></script>

<!-- Widget with events script-->
<script src="<?=asset_sm()?>js/simplecalendar.js"></script>

<!-- Lightbox plugin script-->
<script src="<?=asset_sm()?>js/jquery.magnific-popup.min.js"></script>


<?php /*?><script src="<?=asset_sm()?>js/mediaelement-and-player.min.js"></script>

<script src="<?=asset_sm()?>js/mediaelement-playlist-plugin.min.js"></script><?php */?>


<script src="<?=asset_sm()?>popover/jquery.webui-popover.min.js"></script>	

<script src="<?=asset_sm()?>popover/app.js"></script>

<script src="<?=asset_sm()?>js/page.js"></script>

<script src="<?=asset_sm()?>js/member.js"></script>

<script src="<?=asset_sm()?>js/group.js"></script>

<script src="<?=asset_sm()?>js/edit_post.js"></script>

<script src="<?=asset_sm()?>js/ads.js"></script>

<link rel="stylesheet" href="<?=asset_sm('')?>popover/jquery.webui-popover.min.css">

<!-- Swiper / Sliders -->
<script src="<?=asset_sm()?>js/swiper.jquery.min.js"></script>

<script src="<?=asset_sm()?>js/jquery.autocomplete.multiselect.js"></script>

<link rel="stylesheet" href="<?=asset_sm('')?>css/jquery.autocomplete.multiselect.css">





<script nonce=<?=SC_NONCE?>>
	
	$(document).on('click','#delete_req',function(e){
		
		e.preventDefault();
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('profile/friend_request_delete')?>'+value;
		
		var req_div = $(this).closest('#req_div');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				req_div.hide(1000, function () {
				
					div.remove();
				
				});	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	
	
	$(document).on('click','#accept_req',function(e){
		
		e.preventDefault();
		
		var value = $(this).attr('value');
		
		var url = '<?=file_path('profile/friend_request_accept')?>'+value;
		
		var req_div = $(this).closest('#req_div');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				req_div.hide(1000, function () {
				
					div.remove();
				
				});	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	$(document).on('click','#unfriend_req',function(e){
		
		e.preventDefault();
		
		var url = $(this).attr('href');
		
		var req_div = $(this).closest('#del_div');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(result){
				
				req_div.hide(1000, function () {
				
					div.remove();
				
				});	
			
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	
	$(document).on('click','#do_like_post',function(e){
		
		e.preventDefault();
		
		var url = '<?=file_path('post/do_like_post')?>'+$(this).attr('value');
		
		var span = $(this).closest('span');
		
		var pid= $(this).attr('value');
		
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
	
	
	//-----------comment like---------------------
	
	
	$(document).on('click','#do_like_comment',function(e){
		
		e.preventDefault();
		
		var url = '<?=file_path('comment/do_like_comment')?>'+$(this).attr('value');
		
		var span = $(this).closest('span');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				span.html(data['html']);	
		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
		
		
		
		
	
	
	
	
	
	
	$(document).on('click','#load_more_comment',function(e){
		
		e.preventDefault();
		
		var btn = $(this);
		
		var Afrm = $(this);
		
		var value = $(this).attr('value');
		
		var total  = $("#post_comments_list"+value+' li').length;
		
		var url = '<?=file_path('comment/ajax_post_load_comment')?>'+value+'/'+total;
		
		var span = $(this).closest('span');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			
			beforeSend: function(){
				
     			Afrm.html('<img src="<?=asset_sm('loader.gif')?>">');
				
   			},
   			complete: function(){
				
     			Afrm.html('View more comments <span>+</span>');	
		
   			},
			
			success:function(data){
				
				if(data['id']=='1'){
					
					$('#post_comments_list'+value).prepend(data['html']);	
					
					btn.removeClass('dis_none');
					
				}else{
					
					btn.addClass('dis_none');
					
				}

		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	$(document).on('click','#do_unlike_post',function(e){
		
		e.preventDefault();
		
		var url = '<?=file_path('post/do_unlike_post')?>'+$(this).attr('value');
		
		var span = $(this).closest('span');
		
		var pid = $(this).attr('value')
		
		
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
	
	
	
	// unlike comment
	
	
	$(document).on('click','#do_unlike_comment',function(e){
		
		e.preventDefault();
		
		var url = '<?=file_path('comment/do_unlike_comment')?>'+$(this).attr('value');
		
		var span = $(this).closest('span');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				span.html(data['html']);	
		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	
	$(document).on('submit', '#post_comment_frm', function (e) {
		
		e.preventDefault();
		
		var text 		  =  $(this).find('#pcomment');
		
	
		if(text.val() == ''){
			
			text.focus();
				
			return false;
		}
		
		var formData = new FormData(this);
		
		var action_url = '<?=file_path('comment/add_comment_on_post')?>';
		
		var Afrm = $(this);
		
		var post = $(this).closest('.post-message');
		
		$.ajax(
		{
			url: action_url, // Url to which the request is send
			
			type: "POST",             // Type of request to be send, called as method
			
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
			contentType: false,       // The content type used when sending data to the server.
			
			cache: false,             // To unable request pages to be cached
			
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			
			dataType : 'json',
			
			beforeSend: function(){
				
     			Afrm.find(':submit').addClass('dis_none');
				
				Afrm.find('.loader').removeClass('dis_none');
   			},
   			complete: function(){
				
     			Afrm.find(':submit').removeClass('dis_none');
				
				Afrm.find('.loader').addClass('dis_none');
				
   			},
			
			success: function(data)   // A function to be called if request succeeds
			{	
				
				console.log(data);	
			
				if(data['status']=='true'){
					
					text.val('');
					 
					$('#'+data['div_id']).append(data['text']);	
					
					
					var obj = data['summery'];
					
					console.log(obj);
					
					$.each( obj, function( key, value ) {
                        
                        var comment_count = value + " Comments";
                        
                        if (value == 1) {
                            comment_count = value + " Comment";
                        }
                        
						post.find('.'+key).html(comment_count);
					
					});					
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
	});
	
	
	
	
	
	
</script>



</body>
</html>

<script nonce=<?=SC_NONCE?>>
	$(document).ready(function(e) {
		
		$('#user-search1').selectize({
		
			valueField: 'name',
			
			labelField: 'value',
			
			searchField: 'name',
			
			options: [],
			
			create: false,
			
			createOnBlur : true,
			
			onItemAdd: function (value, $item) {  
			
				var data = this.options[value];
				
				console.log(data);
				
		},
	
    render: {
		
        option: function(item, escape) {
           
				return '<div class="inline-items">' +
						(item.image ? '<div class="author-thumb"><img style="width:40px;" src="' + escape(item.image) + '" alt="avatar"></div>' : '') +
						'<div class="notification-event">' +
						(item.name ? '<span class="h6 notification-friend"></a>' + escape(item.name) + '</span>' : '') +
						(item.message ? '<span class="chat-message-item">' + escape(item.message) + '</span>' : '') +
						'</div>'+
						(item.icon ? '<span class="notification-icon"><svg class="' + escape(item.icon) + '"><use xlink:href="icons/icons.svg#' + escape(item.icon) + '"></use></svg></span>' : '') +
				'</div>';
        },
		item: function(item, escape) {
			var label = item.value;
			return '<div>' +
				'<span class="label">' + escape(label) + '</span>' +
				'</div>';
			}
		},
		
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: '<?=file_path('dashboard/find_member')?>',
				type: 'GET',
				dataType: 'json',
				data: {
				q: query,
				page_limit: 10,
				apikey: 'w82gs68n8m2gur98m6du5ugc'
				},
				error: function() {
					//alert('Error');
					callback();
				},
				success: function(res) {
					callback(res);
				}
			});
		}
		});
		
    });
	
	
	$(document).on('keypress','#pcomment',function(e){
		if (e.keyCode == 13 && e.shiftKey) 
		{
			return true;
		}
		else if(e.keyCode == 13)
		{
			$(this).closest('#post_comment_frm').submit();
			return false;
		}
	});
	
	//--------------------delete comment------------
	
	$(document).on('click','#del_comment',function(e){
		
		e.preventDefault();
		
		var url = '<?=file_path('comment/delete_comment')?>'+$(this).attr('value');
		       
        var post_comment  =  $(this).closest(".post-message").find(".total_comments");
        
        var post_comment_count  =  post_comment.html().split(" ")[0];
        
		var li = $(this).closest('li');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				if(data['status']=='true')
				{
					li.remove();
                    
                    var tot_reply_txt = '';
                    
                    post_comment_count -= 1;
                    
                    if(post_comment_count == 1)
                    {
                        tot_reply_txt = post_comment_count + ' Comment';                    
                    }
                    else
                    {
                        tot_reply_txt = post_comment_count + ' Comments';                
                    }
                    
                    post_comment.html('');

                    post_comment.html(tot_reply_txt);
				}
				
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	//--------------------load more likes------------
	
	
	
	$(document).on('click','#btn_post_comment',function(e){
		
		e.preventDefault();
		
		var value = $(this).attr('value');
		
		$('#post_bottom_'+value).slideToggle(500);
		
	});
	
	$(document).on('click','#load_more_likes',function(e){
		
		e.preventDefault();
		
		var btn = $(this);
		
		var Afrm = $(this);
		
		var value = $(this).attr('value');
		
		var total  = $("#post-likes-members"+value+' li').length;
		
		var url = '<?=file_path('dashboard/ajax_load_more_likes')?>'+value+'/'+total;
		
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			
			beforeSend: function(){
				
     			Afrm.html('<img src="<?=asset_sm('loader.gif')?>">');
				
   			},
   			complete: function(){
				
     			Afrm.html('View more likes +');	
		
   			},
			
			success:function(data){
				
				//alert(data['html']);
				if(data['id']=='1'){
					
					$("#post-likes-members"+value+'').append(data['html']);	
					
					btn.show();
					
				}else{
					
					btn.hide();
					
				}
				
		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
    
    var current_action_reply_comment_id = -1;
    
	//get reply textbox 
	
	$(document).on('click','#reply_on_comment',function(e){
		
			e.preventDefault();
			
			var comment_id		= $(this).attr("value");
            
            if (current_action_reply_comment_id == parseInt(comment_id)) {
                // Do nothing..
            } else if (current_action_reply_comment_id != -1) {
                $('.sp_like_reply_'+current_action_reply_comment_id).find('#reply_on_comment').html('<font color="#6e796d">Add Reply</font>');
                $('.sp_like_reply_'+current_action_reply_comment_id).find('#reply_on_comment').attr('title', 'Add Reply to Comment');
            
                $(this).closest('ul').find('#comment_id_'+current_action_reply_comment_id).find('#reply_on_cmnt_frm').remove();
                
                //comment_id = current_action_reply_comment_id;
            } else {
                current_action_reply_comment_id = comment_id;
            }
			
			var action_url		= "<?=file_path('Comment/get_reply_textarea')?>"+comment_id;	
			
			var li 				= $(this).closest('ul').find('#comment_id_'+comment_id);
			
			var count 			= li.find('#reply_comment_div_'+comment_id).length;
			
			$.ajax({
				
				url			: action_url,
				
                beforeSend: function() {
                    if (count == 0) {
                        $('.sp_like_reply_'+comment_id).find('#reply_on_comment').html('<font style="vertical-align: text-top; font-style: oblique; font-weight: bold;" color="#dd4212" size="0.97em">Cancel Add Reply..</font>');
                        $('.sp_like_reply_'+comment_id).find('#reply_on_comment').attr('title', 'Cancel Adding Reply to Comment');
                    } else {
                        $('.sp_like_reply_'+comment_id).find('#reply_on_comment').html('<font color="#6e796d">Add Reply</font>');
                        $('.sp_like_reply_'+comment_id).find('#reply_on_comment').attr('title', 'Add Reply to Comment');
                    }
                },
				success: function(res) {
                
					if(res!='') {
                    
                        current_action_reply_comment_id = -1;

						if(count==0)
						{
							li.append(res);
						}
						else
						{
                            li.find('#reply_on_cmnt_frm').remove();
                            
							count=0;
						}
					}
					
				},
				error: function (jqXHR, exception) {
					console.log(jqXHR);
					//alert(jqXHR.responseText );
				}
			
			});


		
	});	

	
	
	// reply on comment
	
	$(document).on('keypress','#reply_on_cmnt',function(e){
		
		if (e.keyCode == 13 && e.shiftKey) 
		{
			return true;
		}
		else if (e.keyCode == 13) {
			
		 	$(this).closest('#reply_on_cmnt_frm').submit();
			
			return false;
			
		}    
	});
	
	
	$(document).on('submit', '#reply_on_cmnt_frm', function (e) {
		
		e.preventDefault();
		
		var text 		  	  =  $(this).find('#reply_on_cmnt');
		
		var reply_comment_id  =  $(this).find('#reply_comment_id').val();
		
		if(text.val() == ''){
			
			text.focus();
				
			return false;
		}
		
        if (current_action_reply_comment_id == parseInt(reply_comment_id)) {
            // Do nothing..
        } else if (current_action_reply_comment_id != -1) {
            $('.sp_like_reply_'+reply_comment_id).find('#reply_on_comment').html('<font color="#6e796d">Add Reply</font>');
            $('.sp_like_reply_'+reply_comment_id).find('#reply_on_comment').attr('title', 'Add Reply to Comment');
        
            $(this).closest('ul').find('#comment_id_'+reply_comment_id).find('#reply_on_cmnt_frm').remove();
            
            reply_comment_id = current_action_reply_comment_id;
        }
		
		var formData = new FormData(this);
		
		var action_url = '<?=file_path('comment/add_reply_on_comment')?>';
		
		var Afrm = $(this);
        
        var li = $(this).closest('li');
		
		$.ajax(
		{
			url: action_url, // Url to which the request is send
			
			type: "POST",             // Type of request to be send, called as method
			
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
			contentType: false,       // The content type used when sending data to the server.
			
			cache: false,             // To unable request pages to be cached
			
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			
			dataType : 'json',
			
			beforeSend: function(){
				
     			Afrm.find(':submit').addClass('dis_none');
				
				Afrm.find('.loader').removeClass('dis_none');
                
   			},
   			complete: function(){
				
     			Afrm.find(':submit').removeClass('dis_none');
				
				Afrm.find('.loader').addClass('dis_none');
				
                $('.sp_like_reply_'+reply_comment_id).find('#reply_on_comment').html('<font color="#6e796d">Add Reply</font>');
                $('.sp_like_reply_'+reply_comment_id).find('#reply_on_comment').attr('title', 'Add Reply to Comment');
                
                current_action_reply_comment_id = -1;
   			},
			
			success: function(data)   // A function to be called if request succeeds
			{	
				console.log(data);	
				
				if(data['status']=='true'){
					
					text.val('');
                    
                    li.find('#reply_comment_div_'+reply_comment_id).remove();
					
					var tot_reply = data['tot_reply'];
					
					var tot_reply_txt ='';
					
					if(tot_reply>0)
					{
							if(tot_reply == 1)
							{
								tot_reply_txt = data['tot_reply']+' Reply';
							}
							else
							{
								tot_reply_txt = data['tot_reply']+' Replies';
							}
							
							$('.main_reply_div_'+reply_comment_id).append(data['text']);
							
							$('.sp_like_reply_'+reply_comment_id+' #replies_on_comment').html('');
					
							$('.sp_like_reply_'+reply_comment_id+' #replies_on_comment').html(tot_reply_txt);
							
							li.find('#reply_on_cmnt_frm').remove();
					
					}
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
	});
	
	
	//load more reply
	
	
	$(document).on('click','#load_more_reply',function(e){
		
		e.preventDefault();
		
		var btn = $(this);
		
		var Afrm = $(this);
		
		var value = $(this).attr('value');
		
		var total  = $("#main_reply_div_"+value+' .reply_div').length;
		
		var url = '<?=file_path('comment/load_more_reply')?>'+value+'/'+total;
		
		var span = $(this).closest('span');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			beforeSend: function(){
				
     			Afrm.html('<img src="<?=asset_sm('loader.gif')?>">');
				
   			},
   			complete: function(){
				
     			Afrm.html('View more reply <span>+</span>');	
		
   			},
			
			success:function(data){
				
				if(data['id']=='1'){
					
					$('#main_reply_div_'+value).prepend(data['html']);	
					
					btn.removeClass('dis_none');
					
				}else{
					
					btn.addClass('dis_none');
					
				}

		
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
			
	});	

</script>


<script nonce=<?=SC_NONCE?>>

	$(document).on('keyup','#pcomment,#reply_on_cmnt,#edit_comment_txt,#edit_reply_on_cmnt',function(e){
		
		if(this.value!=''){ 
			this.style.height = "1px";
	    	this.style.height = (2+this.scrollHeight)+"px";
		}else{
			this.style.height = "35px";
		}
	});
    
	$(document).on('focus','#pcomment,#reply_on_cmnt,#edit_comment_txt,#edit_reply_on_cmnt',function(e){
		
		if(this.value!=''){ 
			this.style.height = "1px";
	    	this.style.height = (2+this.scrollHeight)+"px";
		}else{
			this.style.height = "35px";
		}
	});
	
	$(document).on('focus','.js-zoom-gallery',function(e){
			$(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {
			enabled: true
			},
			removalDelay: 500, //delay removal by X to allow out-animation
			
			callbacks: {
			
			beforeOpen: function () {
			
			// just a hack that adds mfp-anim class to markup
			
			this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
			
			this.st.mainClass = 'mfp-zoom-in';
			}
			
			},
			
			closeOnContentClick: true,
			
			midClick: true
			
			});	
	});	
	
	
	
	$(document).on('click','#delete_post',function(e){
		
		e.preventDefault();
		
		var url = $(this).attr('href');
		
		var div = $(this).closest('.post-message');
		
		var conf = confirm('Delete post ?');
		
		if(!conf){
			
			return false;
			
		}
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				if(data['status']=='true'){
					
					div.remove();
                    
				}
				
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	/*-----chnage privacy-----*/
	
	$(document).on('click','#change_privacy',function(e){
		
		var a_link = $(this);	
		
		e.preventDefault();
		
		var url = $(this).attr('href');
		
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data){
				
				if(data['status']=='true'){
					
					$('.privacy_sel').css("color", "#515365!important");
					
					$('.more-dropdown li a').removeClass('privacy_sel');
										
					a_link.css("color", "#00547b"); 
					
					a_link.addClass('privacy_sel');
					
				}
				
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});
	
	
	/*--------edit comment-----*/
	var comment_li_html = '';
    var comment_li_edit = -1;
	
	$(document).on('click','#edit_comment',function(e){
		
        e.preventDefault();
        
        var comment_id		= $(this).attr("value");
        
        var action_url		= "<?=file_path('Comment/get_edit_comment_textarea')?>"+comment_id;	
                   
        if (comment_li_edit == parseInt(comment_id)) {
            // Do Nothing..
        } else if (comment_li_edit != -1) {
            if(comment_id == -1 || comment_li_html == '') {
                return false;
            }
            var other_li = $(this).closest('ul').find('#comment_main_'+comment_li_edit);
            
            other_li.html('');
            
            other_li.html(comment_li_html);
        }
        
        comment_li_edit = comment_id;
        
        var li 				= $(this).closest('ul').find('#comment_main_'+comment_id); //li
        
        $.ajax({
            
            url			: action_url,
            
            success: function(res) {
                
                if(res!='')
                {
                    li.closest('.comments-list').find('#cancle_edit_cmnt').submit();
                    li.closest('.comments-list').find('#cancle_edit_cmnt_reply').submit();
                
                    comment_li_html = li.html();
                    
                    li.html('');
                    
                    li.append(res);
                    
                }
                
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
                
            }
        
        });

	});
	
	
	//------submit edit comment-------
	
	$(document).on('keypress','#edit_comment_txt',function(e){
		
		if (e.keyCode == 13 && e.shiftKey) 
		{
			return true;
		}
		else if (e.keyCode == 13) {
			
			$(this).closest('#edit_comment_frm').submit();
			return false;
			
		}    
	});
	
	
	
	
	$(document).on('submit', '#edit_comment_frm', function (e) {
		
		e.preventDefault();
		
		var text 		  =  $(this).find('#edit_comment_txt');
        
        var comment_id	  =  $(this).find('#comment_id').attr("value");
		
		if(text.val() == ''){
			
			text.focus();
				
			return false;
		}
		
		var formData    = new FormData(this);
		
		var action_url  = '<?=file_path('comment/edit_comment_on_post')?>';
		
		var li  = $(this).closest('ul').find('#comment_main_'+comment_id); //li
		
		$.ajax(
		{
			url: action_url, // Url to which the request is send
			
			type: "POST",             // Type of request to be send, called as method
			
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
			contentType: false,       // The content type used when sending data to the server.
			
			cache: false,             // To unable request pages to be cached
			
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			
			dataType : 'json',
			
			success: function(data)   // A function to be called if request succeeds
			{	
				
				console.log(data);	
			
				if(data['status']=='true'){

					text.val('');
					
					li.html(comment_li_html);
					
					li.find('#ctext').html(data['text']);
                    
                    comment_li_edit = -1;
                    comment_li_html = '';
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
	});
	
	
	function nl2br(str,is_xhtml){
		var breakTag =(is_xhtml ||typeof is_xhtml ==='undefined')? '<br/>':'<br>'; 
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+breakTag + '$2');
	}
	

	//-----cancle edit comment-----
	
	$(document).on('click', '#cancle_edit_cmnt', function (e) {
        $('#cancle_edit_cmnt').submit();
        return false;
    });
    
	$(document).on('submit', '#cancle_edit_cmnt', function (e) {
		e.preventDefault();
		       
        var comment_id		= $(this).attr("value");
        
        if (comment_li_edit == parseInt(comment_id)) {
            // Do Nothing..
        } else if (comment_li_edit != -1) {
            comment_id = comment_li_edit;
        }
        
		var li 	= $(this).closest('#comment_main_'+comment_id); //li
        
        var li_html = li.html();
		
        if (comment_id != -1 && comment_li_html != '')
		{
			li.html('');
			li.append(comment_li_html);
			comment_li_html = '';
            comment_li_edit = -1;
		}
		
	});
	
	
	
	
	/*--------edit comment reply-----*/
	var comment_reply_li_html ='';
    var comment_reply_li_edit = -1;
	
	$(document).on('click','#edit_reply',function(e){
    
        e.preventDefault();
        
        var comment_id		= $(this).attr("value");
        
        var action_url		= "<?=file_path('Comment/get_edit_comment_reply_textarea')?>"+comment_id;	
        
        if (comment_reply_li_edit == parseInt(comment_id)) {
            // Do Nothing..
        } else if (comment_reply_li_edit != -1) {
            if(comment_id == -1 || comment_reply_li_html == '') {
                return false;
            }
            
            var other_li = $(this).closest('ul').find('#reply_div_'+comment_reply_li_edit);
            
            other_li.html('');
            
            other_li.html(comment_reply_li_html);
        }
        
        comment_reply_li_edit = comment_id;
        
        var li 				= $(this).closest('li').find('#reply_div_'+comment_reply_li_edit); //li
        
        $.ajax({
            
            url			: action_url,
            
            success: function(res) {
                
                if(res!='')
                {
                    li.closest('.comments-list').find('#cancle_edit_cmnt').submit();
                    li.closest('.comments-list').find('#cancle_edit_cmnt_reply').submit();
                
                    comment_reply_li_html = li.html();
                    
                    comment_reply_li_edit = comment_id;
                    
                    li.html('');
                    
                    li.append(res);
                    
                }
                
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
                
            }
        
        });

	});
	
	
	//------submit edit comment reply-------
	
	$(document).on('keypress','#edit_reply_on_cmnt',function(e){
		if (e.keyCode == 13 && e.shiftKey) 
		{
			return true;
		}
		else if (e.keyCode == 13) {
			$(this).closest('#edit_comment_reply_frm').submit();
			return false;
		}    
	});
	
	
	
	
	$(document).on('submit', '#edit_comment_reply_frm', function (e) {
		
		e.preventDefault();
		
		var text 		  =  $(this).find('#edit_reply_on_cmnt');
		
		if(text.val() == ''){
			
			text.focus();
				
			return false;
		}
        
        var comment_id	  =  $(this).find('#reply_comment_id').attr("value");
		
		var formData    = new FormData(this);
		
		var action_url  = '<?=file_path('comment/edit_comment_reply_on_post')?>';
		
		var li 	= $(this).closest('li').find('#reply_div_'+comment_id); //li
		
		$.ajax(
		{
			url: action_url, // Url to which the request is send
			
			type: "POST",             // Type of request to be send, called as method
			
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			
			contentType: false,       // The content type used when sending data to the server.
			
			cache: false,             // To unable request pages to be cached
			
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			
			dataType : 'json',
			
			success: function(data)   // A function to be called if request succeeds
			{	
				
				console.log(data);	
			
				if(data['status']=='true'){					
					
					li.html(comment_reply_li_html);

					comment_reply_li_html = '';
					
					li.find('#creplytext').html(data['text']);
                    
                    comment_reply_li_edit = -1;
                    comment_reply_li_html = '';
					
				}else{
					
					alert(data['text']);
					
				}
				
			}
		
		});
		
		
	});
	
	//-----cancle edit comment reply-----
		
	$(document).on('click', '#cancle_edit_cmnt_reply', function (e) {
        $('#cancle_edit_cmnt_reply').submit();
        return false;
    });
    
	$(document).on('submit', '#cancle_edit_cmnt_reply', function (e) {
		e.preventDefault();
		
        var comment_id		= $(this).attr("value");
        
        if (comment_reply_li_edit == parseInt(comment_id)) {
            // Do Nothing..
        } else if (comment_reply_li_edit != -1) {
            comment_id = comment_reply_li_edit;
        }
        
		var li 	= $(this).closest('li').find('#reply_div_'+comment_id); //li
		
		if(comment_id != -1 && comment_reply_li_html != '')
		{
			li.html('');
			li.append(comment_reply_li_html);
            
			comment_reply_li_html = '';
            comment_reply_li_edit = -1;
		}
		
	});
	
	//--------------------delete comment------------
	
	$(document).on('click','#del_reply',function(e){
		
		e.preventDefault();
		
		var url = '<?=file_path('comment/delete_comment_reply')?>'+$(this).attr('value');
        
        var reply_comment_id  =  $(this).attr("value");
        
        var reply_comment  =  $(this).closest("li").find("#replies_on_comment");
        
        var reply_comment_count  =  reply_comment.html().split(" ")[0];
        
        var li = $(this).closest('li').find('#reply_div_'+reply_comment_id); //li
        
		$.ajax({
		
			url : url,
			
			dataType : "json",
			
			success:function(data) {

				if(data['status']=='true') { 
                
                    li.remove();
                    
                    var tot_reply_txt = '';
                    
                    reply_comment_count -= 1;
                    
                    if(reply_comment_count == 1)
                    {
                        tot_reply_txt = reply_comment_count + ' Reply';                    
                    }
                    else
                    {
                        tot_reply_txt = reply_comment_count + ' Replies';                
                    }
                    
                    reply_comment.html('');

                    reply_comment.html(tot_reply_txt);
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
				
				alert(textStatus);
				
			}
		});
	});

	
	$(document).on('click','#delete_my_group',function(e){
			
			e.preventDefault();
			
			var c =confirm('Are you sure you want to delete this group?');
			
			if(c)
			{
				var url =  $(this).attr('href');
				
				$.ajax({
				
					url: url,
					
					dataType : "json",
					
					success:function(data){
						
						if(data['status']=='true')
						{
							
							window.location.href="<?php echo file_path('group/mygroups')?>";
						}
					
					},
					
					error: function( jqXHR, textStatus, errorThrown) {
					
					}
				
				});
				
			}
			
			
	});

</script>

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


<style>
	.notification-list .selectize-dropdown-content > *, .notification-list li {
    	padding: 13px 25px !important;
	}
	.post_comment_box{
		resize:none !important;
		padding:10 15px 10px 15px !important;
	}
	
	#do_like_ads i{
		font-size: 22px !important;
		margin-right: 8px !important;
	}
	#ads_liked i{
		font-size: 22px !important;
		margin-right: 8px !important;
		color: #00547b!important;
	}
</style>