
<li>
  <div class="post__author author vcard inline-items"> <img src="<?=thumb($result['member_profile_img'],100,100)?>" alt="author">
    <div class="author-date"> <a class="h6 post__author-name fn" href="#">
      <?=$result['member_name']?>
      </a>
      <div class="post__date">
        <?php /*?> <time class="published"> <?=date('F d',$result['time_dt'])?> at <?=date('H:ia',$result['time_dt'])?> </time><?php */?>
        <time class="published">
          <?=time_ago($result['time_dt'])?>
        </time>
      </div>
    </div>
    <?php if($result['usercode']==user_session('usercode')) { ?>
    <div class="more"> <svg class="olymp-three-dots-icon">
      <use xlink:href="<?=asset_sm()?>icons/icons.svg#olymp-three-dots-icon"></use>
      </svg>
      <div class="more-dropdown"> <a href="#">Delete </a> </div>
    </div>
    <?php } ?>
  </div>
  <p>
    <?=$result['text_dt']?>
  </p>
  <a href="#" class="post-add-icon inline-items"> <i class="fa fa-heart-o"></i> <span>0</span> </a> <a href="#" class="reply">Reply</a> 
 
 
 </li>
