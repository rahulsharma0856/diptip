
<div class="col-xl-4 pull-xl-8 col-lg-4 pull-lg-8 col-md-12 col-sm-12 col-xs-12">
  <div class="ui-block">
    <div class="ui-block-content"> 
      
      <!------------->
      
      <div class="widget w-socials">
        <h6 style="margin:0px;padding:0px;"> Total Likes : <span class="html_tot_likes">
          <?=$TotalPageLikes?>
          </span> </h6>
      </div>
    </div>
  </div>
  <div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">Category</h6>
    </div>
    <div class="ui-block-content"> 
      
      <!------------->
      
      <div class="widget w-socials">
        <h6 class="title">
          <?=$result[0]['cat_name']?>
        </h6>
      </div>
    </div>
  </div>
  <div class="ui-block">
    <div class="ui-block-title">
      <h6 class="title">Description</h6>
    </div>
    <div class="ui-block-content"> 
      
      <!------------->
      
      <div class="widget w-socials">
      	<span style="color:#000;word-wrap: break-word;">
        	<?=filter_post($result[0]['description'])?>
        </span>
      </div>
    </div>
  </div>
</div>
