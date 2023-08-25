<?php $this->load->view('user/profile/top_section');?>
<?php //var_dump($member);?>
<link rel="stylesheet" type="text/css" href="<?=asset_sm('')?>css/swiper.min.css">

<div class="container">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="ui-block responsive-flex">
				<div class="ui-block-title">
					<div class="h6 title"><?=$member['fname'].' '.$member['lname']?>'s Albums</div>
					<?php if($member['usercode']==user_session('usercode')) {?>
					<div class="block-btn align-right" style="float:right;padding:0;">
						<a href="#" data-toggle="modal" data-target="#create-photo-album" class="btn btn-primary btn-md-2">Create Album  +</a>
					</div>
					<?php }?>
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
						
                        <?php
							if(isset($album_list[0]))
							{
								for($i=0;$i<count($album_list);$i++)
								{
									if(isset($album_list[$i]['image_path']) and $album_list[$i]['image_path']!='')
									{
										$is_img		= '<img src="'.upload_path().'album/'.$album_list[$i]['image_path'].'" alt="photo">';
									}
									else 
									{
										$is_img		= '<img style="-webkit-filter: blur(5px);filter: blur(5px);" src="'.asset_sm('').'def_album.png" alt="photo">';
									}
									
									$html.='<div class="photo-item col-4-width album_'.$album_list[$i]['album_id'].'">
									
												'.$is_img.'
												
												<div class="overlay overlay-dark"></div>';
												
												if($member['usercode']==user_session('usercode')) {
												
												$html.='<div class="more">
												
														<svg class="olymp-three-dots-icon"><use xlink:href="'.asset_sm('').'icons/icons.svg#olymp-three-dots-icon"></use></svg>
														
														<ul class="more-dropdown">
														
															<li><a href="#" value="'.$album_list[$i]['album_id'].'" id="del_album">Delete</a> </li>
														</ul>
														
														</div>';
												}
												$html.='<div class="content">
														
														<a href="'.file_path('profile/photo_album').$album_list[$i]['album_id'].'" class="h6 title">'.$album_list[$i]['album_name'].' ('.$album_list[$i]['tot_album_img'].' images)</a>
														
														<time class="published" datetime="2017-03-24T18:18">'.time_ago($album_list[$i]['create_time']).'</time>
														
														</div>
											</div>';
									
									
								}
										
								echo $html;
									
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

<script nonce=<?=SC_NONCE?>>
$(document).on('click','#del_album',function(e){
	
	e.preventDefault()
	
	var albumid = $(this).attr('value');
	
	var action_url = "<?=file_path('profile/delete_album')?>"+albumid;
	
	$.ajax(
	{
		url: action_url, // Url to which the request is send
		
		type: "GET",             // Type of request to be send, called as method
		
		contentType: false,       // The content type used when sending data to the server.
		
		cache: false,             // To unable request pages to be cached
		
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		
		dataType : 'json',
		
		success: function(data)// A function to be called if request succeeds
		{	
			console.log(data);	
		
			if(data['status']=='true'){
				
				$( ".photo-album-wrapper .album_"+albumid ).remove();
					
			}else{
				
				alert(data['msg']);
				
			}
			
		}
	
	});

	
});
</script>
