<div class="modal fade show" id="fav-page-popup" style="display:block;">

  <div class="modal-dialog ui-block window-popup fav-page-popup"> 
  
  	<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"> 
	
		<svg class="olymp-close-icon">
        
            <use xlink:href="icons/icons.svg#olymp-close-icon"></use>
			
        </svg> 
    
    </a>
    
    <div class="ui-block-title">
    
      <h6 class="title">Edit Post <span class="pull-right"><a href="#" class="popup-modal-dismiss"><i class="fa fa-times"></i></a></span> </h6>
      
    </div>
    
    <div class="ui-block-content " style="padding:10px 20px;">
    	
     
        <form method="post" id="post_edit_frm" action="<?=file_path()?>post/post_edit_submit" enctype="multipart/form-data">  
        
            <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>">
          
            <input type="hidden" name="post_id" value="<?=$detail[0]['post_id']?>">
            
            <div class="form-group with-icon" style="margin-bottom: 10px;">
            
            <?php $txt_msg = ($detail[0]['post_type']=='add') ? $master[0]['post_text'] : $detail[0]['share_txt']?>
            
            <textarea class="form-control" placeholder="Share what you are thinking here..." name="post_text_r" id="post_text_r" style="height: 200px; max-height: 480px; min-height: 135px; overflow: visible; resize: vertical;"><?=$txt_msg?></textarea>
            
            </div>
            
            <?php if($master[0]['video_share']!="" && $detail[0]['post_type']=='add'){ ?>
            
            <div class="form-group with-icon" style="margin-bottom: 10px;">
            
            <input type="url" name="video_share" id="video_share" class="form-control VideoShareTextBox" value="<?=$master[0]['video_share']?>" placeholder="Share Link from YouTube or Vimeo" style="border-radius:0px;padding:5px 15px;width:100%;">
            
            </div>
       		
            <?php } ?>
            
            <?php if(count($TaggedMember) > 0 && $detail[0]['post_type']=='add'){ ?>
            
            <div class="row" style="margin-bottom: 10px;">
            	
                <div class="col-md-12">
                	
                   <?php  for($i=0;$i<count($TaggedMember);$i++){ ?>
                    
                    	<div class="tag_selected_member pull-left"><?=$TaggedMember[$i]['name']?>  <a href="#" id="tag_selected_member_remove">X</a><input type="hidden" class="txttagFriend" name="tagFriend[]" value="<?=$TaggedMember[$i]['id']?>"><input type="hidden" class="txttagFriendUsercode" name="tagFriendUsercode[]" value="<?=$TaggedMember[$i]['usercode']?>"></div>
                    
                  	<?php } ?>
                
                </div>
                
            </div>
            
            <?php } ?>
            
            <div class="row" style="margin-bottom: 10px;">
            
            <?php if(count($PostImage) > 0 && $detail[0]['post_type']=='add') { ?>
            
            	<?php for($i=0;$i<count($PostImage);$i++){ ?>
                
            		<div class="col-md-3 img_div">
                    
                    	<div style="position:relative;">
                        
                        <a href="<?=file_path('post/postImageDelete/'.$PostImage[$i]['id'])?>" class="img_delete_icon"><i class="fa fa-times"></i></a>	
                        
                    	<img src="<?=thumb($PostImage[$i]['image_path'],200,200)?>" width="100%">
                        
                        </div>
                        
                     </div>
                
                <?php } ?>
                
            <?php } ?>
            	
                <?php if($master[0]['video_upload']!="" && $detail[0]['post_type']=='add'){ ?>
                
                <div style="width:80%;margin:auto;">
                
                    <video style="width:100%;" controls>
                    
                        <source src="<?=base_url('upload/video/'.$master[0]['video_upload'])?>" type="video/mp4">
                        
                        <source src="mov_bbb.ogg" type="video/ogg">
                        
                        Your browser does not support HTML5 video. 
                    
                    </video>
                    
        
                    <div><a href="#">Delete Video</a></div>
                    
      			</div>
                
                <?php } ?>
                
                <?php if($master[0]['video_share']=="" && $detail[0]['post_type']=='add') {?>
                
            		<div class="uploadStatusImgMsg_edit" style="width:100%;border: #e4eaf3 solid 1px;padding: 10px 15px;margin:5px;">No Image(s)/Video Select</div>
                
                <?php } ?>
                
            
             </div>
             
              <div style="clear:both;overflow:hidden;"></div>
              
            <div class="add-options-message"> 
          
			 <?php if($master[0]['video_upload']=="" && $master[0]['video_share']=="" && $detail[0]['post_type']=='add'){ ?>
            
                <a href="javascript:void(0)" id="uploadImageIcon_edit" class="options-message" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add IMAGES"> 
				
				<svg class="olymp-camera-icon">
                
                	<use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-camera-icon"></use>
                
                </svg>
                
                </a>
            	
                <input type="file" value="upload" id="uploadStatusimg_edit" name="uploadStatusImg[]" multiple>
                
            <?php } ?>
            
            
            
       
    
			<?php if(count($PostImage) < 1 && $master[0]['video_share']=="" && $detail[0]['post_type']=='add') { ?>
            
                <a href="#" class="options-message margin_left_35" id="shareVideoIcon_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="UPLOAD VIDEO"> 
                
					<svg class="olymp-computer-icon">
                    
                    	<use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-computer-icon"></use>
                    
                    </svg> 
                
                </a>
            
            <?php } ?>
            
            
        
            
            <input type="file" value="upload" id="uploadStatusVideo_edit" name="uploadStatusVideo">
            
            <button class="btn btn-primary btn-md-2" type="submit">Update Post</button>
            
            <img style="float:right;" class="loader dis_none" src="<?=asset_sm('loader.gif')?>">
            
            <div style="clear:both;overflow:hidden;"></div>
            
          </div>
               <div style="clear:both;overflow:hidden;"></div>
        </form>
     
    </div>
    
  </div>
  
</div>




<style>
	.img_delete_icon{
		
		position: absolute !important;
		
		right: 5px !important;
		
	}
	
	.fav-page-popup {
		
    	width: 540px;
		
	}
	
	.title_txt{
		
		font-size: 16px;
		
		text-align: center;
		
		padding: 20px;
		
	}
	
	#uploadStatusimg_edit {
	
		display: none;
	
	}

	#uploadStatusVideo_edit {
		
		display: none;
		
	}
	
	.margin_left_35 {
		
		margin-left: 35px;
		
	}
	
	.uploadStatusImgMsg_edit {
		
		border-bottom: #e4eaf3 solid 1px;
		
		padding: 10px 15px;
		
	}

	
</style>
