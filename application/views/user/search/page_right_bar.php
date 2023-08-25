<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Filter</h6>
          </div>
        <div class="ui-block-content">
         		 <div class="radio">
                        <label>
                        <input type="radio" id="categoryRadios" name="categoryRadios" value="<?=file_path('search/page')?>?q=<?=$filter_text?>" <?=(!isset($category_selected)) ? "checked" : ""?>><span class="circle"></span><span class="check"></span>
                       		All
                        </label>
                    </div>
				<?php for($i=0;$i<count($category);$i++){ ?>
                    <div class="radio">
                        <label>
                        <input type="radio" id="categoryRadios" name="categoryRadios" value="<?=file_path('search/page')?>?q=<?=$filter_text?>&category=<?=$category[$i]['id']?>" <?=($category_selected==$category[$i]['id']) ? "checked" : ""?>><span class="circle"></span><span class="check"></span>
                       		<?=$category[$i]['cat_name']?>
                        </label>
                    </div>
                <?php } ?>
                
                
							
        </div>
      </div>
    </div>
    
    
    
    
    
