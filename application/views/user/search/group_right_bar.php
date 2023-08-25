<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Filter</h6>
          </div>
        <div class="ui-block-content">
         		 <div class="radio">
                        <label>
                        <input type="radio" id="categoryRadios" name="categoryRadios" value="<?=file_path('search/group')?>?q=<?=$filter_text?>" <?=(!isset($category_selected)) ? "checked" : ""?>><span class="circle"></span><span class="check"></span>
                       		All
                        </label>
                 </div>
                 
                  <div class="radio">
                        <label>
                        <input type="radio" id="categoryRadios" name="categoryRadios" value="<?=file_path('search/group')?>?q=<?=$filter_text?>&category=public" <?=($category_selected=='public') ? "checked" : ""?>><span class="circle"></span><span class="check"></span>
                       		Public
                        </label>
                 </div>
                 
                  <div class="radio">
                        <label>
                        <input type="radio" id="categoryRadios" name="categoryRadios" value="<?=file_path('search/group')?>?q=<?=$filter_text?>&category=close" <?=($category_selected=='close') ? "checked" : ""?>><span class="circle"></span><span class="check"></span>
                       		Close
                        </label>
                 </div>
                 
                 <div class="radio">
                        <label>
                        <input type="radio" id="categoryRadios" name="categoryRadios" value="<?=file_path('search/group')?>?q=<?=$filter_text?>&category=me" <?=($category_selected=='me') ? "checked" : ""?>><span class="circle"></span><span class="check"></span>
                       		Added By Me
                        </label>
                 </div>
				
                
                
							
        </div>
      </div>
    </div>
    
    
    
    
    
