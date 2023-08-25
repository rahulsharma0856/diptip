<?php //var_dump($member);exit;?>

<?php $this->load->view('user/profile/top_section');?>

<link rel="stylesheet" type="text/css" href="<?=asset_sm('')?>css/swiper.min.css">

<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block responsive-flex">
				<div class="ui-block-title">
					<div class="h6 title"><?=$photos[0]['album_name']?></div>
                    <a style="font-size:25px;float:right;fill: #47a247;-webkit-text-fill-color: #47a247;" href="<?=file_path('profile/album/'.$member['username'])?>"><i class="fa fa-arrow-circle-left"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="photo-page" role="tabpanel">

					<div class="photo-album-wrapper">
						
                        <div class="photo-album-item-wrap col-4-width" style="vertical-align: top;">
							<div class="photo-album-item create-album" data-mh="album-item" style="height:260px;">

								<a href="#" id="add_album_photo" class="  full-block"></a>

								<div class="content">

									<a style="background-color:#47a247;" href="#" id="add_album_photo" class="btn btn-control">
										<svg class="olymp-plus-icon"><use xlink:href="<?=asset_sm('')?>icons/icons.svg#olymp-plus-icon"></use></svg>
									</a>

									<a id="add_album_photo" href="#" class="title h5">Add Photos</a>
									<span class="sub-title">It only takes a few minutes!</span>
									<span id="count_select_img"></span>
								</div>

							</div>
                            
                           <form id="frm_album_photo" action="<?=file_path('profile/upload_album_photo')?>" method="post" enctype="multipart/form-data">
        						<input type="hidden" name="album_id" value="<?=$albumid?>">
    							<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
                                <input type="file" value="upload" id="input_album_photo" name="input_album_photo[]" multiple>
                                 
                            </form>
                            
						</div>
                         
                        
                        <?php
						
							$photos = $photos['album_photos'];
						
							if(isset($photos[0]))
							{
								for($i=0;$i<count($photos);$i++)
								{
									$html ='<div class="photo-item col-4-width">
												<img src="'.upload_path().'album/'.$photos[$i]['image_path'].'" alt="photo">
												<div class="overlay overlay-dark"></div>
												<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
												<a href="#" class="post-add-icon inline-items">
													<svg class="olymp-heart-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-heart-icon"></use></svg>
													<span>15</span>
												</a>
												<a href="#" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
												<div class="content">
													<a href="#" class="h6 title">Header Photos</a>
													<time class="published" datetime="2017-03-24T18:18">'.time_ago($photos[$i]['time_dt']).'</time>
												</div>
											</div>';
									echo $html;
									
								}
								//if($tot_photos['tot_img']>20)
								//{
								//	echo '<a href="#" id="load_more_photos" class="btn btn-control btn-more"><svg class="olymp-three-dots-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-three-dots-icon"></use></svg></a>';
								//}
							
							} ?>
                        
                      
						

					</div>

				</div>

				
			</div>

		</div>
	</div>
</div>



<style>
#input_album_photo {
    display: none;
}
</style>

<script nonce=<?=SC_NONCE?>>
	
	
	
	$(document).on('click','#add_album_photo',function(e){
		
		e.preventDefault()
		
		$('#input_album_photo').trigger('click');	
		
		
	});

	$(document).on('change', '#input_album_photo', function () {
		
			var file = this.files;
			
			var length = this.files.length; // get length
			
			var match= ["image/jpeg","image/png","image/jpg"];
			
			var validation  = true;
			
			console.log(file);
			
			if (length > 0) {
				
				for (var i = 0; i < length; i++) {
					
					var imagefile = file[i].type;
			
					if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
						
						validation  = false;
						
						break;
					}
				}
			}
			
			if(validation!=true){
				
				$("#input_album_photo").prop('value', '');
	
				alert('Only jpeg, jpg and png Images type allowed');
						
				return false;
				
			}else{
				
				$('#frm_album_photo').submit();	
				
			}
			

		
	});

	
	//Submit
		
		$(document).on('submit', '#frm_album_photo', function (e) {
			
			e.preventDefault();
			
			var formData = new FormData(this);
			
			var action_url = $(this).attr('action');
			
			$.ajax(
			{
				url: action_url, // Url to which the request is send
				
				type: "POST",             // Type of request to be send, called as method
				
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				
				contentType: false,       // The content type used when sending data to the server.
				
				cache: false,             // To unable request pages to be cached
				
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				
				dataType : 'json',
				
				success: function(data)// A function to be called if request succeeds
				{	
					
					console.log(data);	
				
					if(data['status']==true){
						
						$(".photo-album-wrapper").append(data['img_data']);
						
					}else{
						
						alert(data['msg']);
						
					}
					
				}
			
			});
			
			
		});
		
		
</script>

