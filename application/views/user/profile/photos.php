<?php $this->load->view('user/profile/top_section');?>
<?php //var_dump($member);?>
<link rel="stylesheet" type="text/css" href="<?=asset_sm('')?>css/swiper.min.css">

<?php if($member['usercode']==user_session('usercode')) {?>

<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block responsive-flex">
				<div class="ui-block-title">
					<div class="h6 title"><?=$member['fname'].' '.$member['lname']?>'s Photo Gallery</div>

					<div class="block-btn align-right" style="float:right;padding:0;">
						<!--<a href="#" data-toggle="modal" data-target="#create-photo-album" class="btn btn-primary btn-md-2">Create Album  +</a>-->
						<a href="<?=file_path('profile/album/'.$member['username'])?>" class="btn btn-primary btn-md-2">Album</a>
                    </div>

					<!--<ul class="nav nav-tabs photo-gallery" role="tablist">
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#photo-page" role="tab">
								<svg class="olymp-photos-icon"><use xlink:href="<?=asset_sm('')?>icons/icons.svg#olymp-photos-icon"></use></svg>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#album-page" role="tab">
								<svg class="olymp-albums-icon"><use xlink:href="<?=asset_sm('')?>icons/icons.svg#olymp-albums-icon"></use></svg>
							</a>
						</li>

					</ul>-->
                   
					<!--<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="<?=asset_sm('')?>icons/icons.svg#olymp-three-dots-icon"></use></svg></a>-->
				</div>
			</div>
		</div>
	</div>
</div>
<?php }?>
<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="photo-page" role="tabpanel">

					<div class="photo-album-wrapper">
						
                        <?php
							if(isset($photos[0]))
							{
								for($i=0;$i<count($photos);$i++)
								{
									if($photos[$i]['post_text']!='')
									{
										$strlength =  strlen($photos[$i]['post_text']);
										
										if($strlength>25)
										{
											$app_dot = '...';
										}
										
										$post_text = substr($photos[$i]['post_text'], 0, 25).$app_dot;
										
										
									}
									$html ='<a href="'.file_path('dashboard').'post/'.$photos[$i]['post_id'].'">
											<div class="photo-item col-4-width">
												<img src="'.upload_path().'post/'.$photos[$i]['image_path'].'" alt="photo">
												<div class="content">
													<a href="#" class="h6 title">'.$post_text.'</a>
													<time class="published" datetime="2017-03-24T18:18">'.time_ago($photos[$i]['time_dt']).'</time>
												</div>
											</div></a>';
									echo $html;
									
								}
								if($tot_photos['tot_img']>20)
								{
									echo '<a href="#" id="load_more_photos" class="btn btn-control btn-more"><svg class="olymp-three-dots-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-three-dots-icon"></use></svg></a>';
								}
							
							} ?>
                        
                      
						

					</div>

				</div>

				
			</div>

		</div>
	</div>
</div>

<!-- Window-popup Create Photo Album -->

<div class="modal fade" id="create-photo-album">
	<div class="modal-dialog ui-block window-popup create-photo-album">
		<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
			<svg class="olymp-close-icon"><use xlink:href="<?=asset_sm('')?>icons/icons.svg#olymp-close-icon"></use></svg>
		</a>

	<div class="ui-block-title">
		<h6 class="title">Create Photo Album</h6>
	</div>

	<div class="ui-block-content">

		<form action="<?=file_path('profile/create_album')?>" method="post" class="form-group label-floating">
        
        	<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
            
        	<input class="form-control" type="text" name="album_name" placeholder="Album Name" required="required"> <br />
            
            <textarea class="form-control" name="album_desc" placeholder="Album Description" style="border: 1px solid #e6ecf5;border-radius: 0.25rem;"></textarea><br />
            
            <input style="padding: 15px;width: 25%;" class="btn btn-primary btn-lg btn--half-width" type="submit" name="create_album" value="Create Album" />
            
		</form>
		

	</div>
</div>
</div>

<!-- ... end Window-popup Create Photo Album -->
<script nonce=<?=SC_NONCE?>>
	
	
	$(document).on('click','#load_more_photos',function(e){
		
		e.preventDefault();
		
		load_images();
		
	});
	
	function load_images(){
		
		var total_img  = $(".photo-album-wrapper > .photo-item").length;
	
		var member 	   = '<?=$this->uri->rsegment(3)?>';
 		
		var url='<?=file_path('Profile/load_more_photos')?>?s='+total_img+'&m='+member;
		
		$.ajax({
		
			url: url,
			
			dataType: "json",

			beforeSend: function(){
			
			},
			
			complete: function(){
			
			},
			
			success:function(data){
				
				if(data['id']=='1'){
					
					$('#load_more_photos').before(data['html']);	
					
					var total_img_show  = $(".photo-album-wrapper > .photo-item").length;
					
					if(data['tot_img']==total_img_show)
					{
						$('#load_more_photos').addClass('dis_none');
					}
				}
			},
			
			error: function( jqXHR, textStatus, errorThrown) {
			
			}
		
		});
	
	}
</script>

