<div class="col-xl-3 pull-xl-6 col-lg-6 pull-lg-0 col-md-6 col-sm-12 col-xs-12">

      <div class="ui-block">
      
        <div class="your-profile">
        
          <div class="ui-block-title" style="text-transform:uppercase">
          
            <h6 class="title">Search In</h6>
            
          </div>
         
          <div class="ui-block-title <?=($active_sub_menu=='people') ? "active_sub" : "" ?>"> <i class="fa fa-user"></i> <a href="<?=file_path('search/people')?>?q=<?=$filter_text?>" class="h6 title">People</a> </div>
          
          <div class="ui-block-title <?=($active_sub_menu=='page')   ? "active_sub" : "" ?>"> <i class="fa fa-file-text"></i> <a href="<?=file_path('search/page')?>?q=<?=$filter_text?>" class="h6 title">Page</a> </div>
          
          <div class="ui-block-title <?=($active_sub_menu=='group')  ? "active_sub" : "" ?>"> <i class="fa fa-users"></i><a href="<?=file_path('search/group')?>?q=<?=$filter_text?>" class="h6 title">Group</a> </div>
          
        </div>
        
      </div>
      
    </div>
    
    <style>
	
    	.active_sub{
			
			background-color:#ececec !important;
			
		}
		
    </style>