<?php for($i=0;$i<count($friend);$i++){ ?>
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-left friend-box" id="del_div" >
  <div class="ui-block" data-mh="friend-groups-item" style="height: 263px;">
    <div class="friend-item friend-groups">
      <div class="friend-item-content">
        <div class="more"> <svg class="olymp-three-dots-icon">
          <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
          </svg>
          <ul class="more-dropdown">
            <li> <a href="<?=file_path('profile/timeline/'.$friend[$i]['username'])?>">View Profile</a> </li>
            <?php if($profile_usercode==$login_usercode) { ?>
            <li> <a href="<?=file_path('profile/friend_delete/'.$friend[$i]['friend'])?>" id="unfriend_req">Unfriend</a> </li>
            <?php }?>
          </ul>
        </div>
        <div class="friend-avatar">
          <div class="author-thumb"> <img src="<?=thumb($friend[$i]['profile_img'],150,150)?>" alt="Friend" style="width:100%;"> </div>
          <div class="author-content"> <a href="<?=file_path('profile/timeline/'.$friend[$i]['username'])?>" class="h5 author-name">
            <?=$friend[$i]['name']?>
            </a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
