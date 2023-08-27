<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends App
{
    /**
        @property load $this->load
    */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user/social_media/post_module', 'ObjM', true);
        $this->load->model('user/social_media/Page_module', '', true);
        $this->load->model('user/social_media/groups_module', '', true);
        $this->load->model('user/Page_model', '', true);
        $this->load->model('user/Post_model', '', true);
        $this->load->model('user/Group_model', '', true);
        $this->load->model('user/Ads_model', '', true);
        $this->load->model('Member_module', '', true);
        $this->load->model('user/Comment_model');

        date_default_timezone_set('Asia/Calcutta');
    }

    public function view()
    {

        //$this -> Member_module -> check_paid(user_session('usercode'));

        $limit = 3; //dashboard sidebar item limit

        $data['MemberLikedPages'] 	= 	$this->Page_model->getMemberLikedPages(user_session('usercode'), $limit);
      
        if(isset($data['MemberLikedPages'][0])) {
            $likedPage = 'Yes';
        } else {
            $likedPage = 'No';
        }
  

        $data['PageSuggestion'] 	= 	$this->Page_model->getPageSuggestion($likedPage);
        $data['SuggestedFriends'] 	= 	$this->Member_module->Suggested_friends(user_session('usercode'));
        $data['RecentFriends'] 	= 	$this->Member_module->get_last_recent_friends_pic(user_session('usercode'));

        $data['paid_sts']			=	$this->Member_module->is_paid(user_session('usercode'));
        $data['myGroups'] 			= 	$this->Group_model->getMemberJoinedGroups(user_session('usercode'), $limit);

        $this->template->data = $data;
        $this->template->title = 'Login';
        $this->template->view = 'user/home/dashboard_view';
        $this->load->view('user/layout');

    }

    public function load_post()
    {

        $html = $this->ajax_timeline_post();
        $data = [
            'html' => $html,
            'id' => ($html == "") ? '0' : '1'
        ];

        echo json_encode($data);

        exit;

    }



    public function ajax_timeline_post()
    {

        $start_from  	=  isset($_GET['s']) ? $_GET['s'] : 0;

        $result     	=  $this	->	Post_model	->	getMemberHomePost($start_from);

        $ads     		=  $this	->	Ads_model	->	getAdsForView($_GET['ads']);


        //echo $this -> db -> last_query();

        $html			= '';

        for($i = 0;$i < count($result);$i++) {

            $html .= $this->load->view('user/post/post_single', array('result' => $result[$i]), true);

        }

        for($i = 0;$i < count($ads);$i++) {

            $html .= $this->load->view('user/ads/single', array('result' => $ads[$i]), true);

        }

        return $html;
    }

    public function find_member()
    {

        $arr = array();

        if($_GET['q'] != '') {

            $result     	=  $this->Member_module->find_member($start_from);

            for($i = 0;$i < count($result);$i++) {

                $arr[] = array(

                    'name' => $result[$i]['name'],

                    'value' => $result[$i]['username'],

                    'image' => thumb($result[$i]['profile_img'], 100, 100),

                    'message' => $result[$i]['username'],

                    'icon' => '',

                    'url' => file_path('profile/view/'.$result[$i]['username'])

                );
            }

        }
        echo json_encode($arr);

        exit;

    }


    public function checkNewMessages()
    {

        $data = array();

        if(isset($_GET['last'])) {

            $last 	= $_GET['last'];

            if($this->Post_model->checkMemberHomeNewMessages($last)) {

                $result = $this->Post_model->getMemberHomeNewMessages($last);

                for($i = 0;$i < count($result);$i++) {

                    $data['post'.$result[$i]['post_id']] = $this->load->view('user/post/post_single', array('result' => $result[$i]), true);

                }

            }

        }

        echo json_encode($data);

        exit;

    }




    public function post(int $postid)
    {

        //$this -> Member_module -> check_paid(user_session('usercode'));

        $data = array();

        $data['result']   =  $this->Post_model->getPostById($postid);
        //var_dump($data);exit;
        if(isset($data['result'])) {

            $this->load->view('user/home/comman/topheader');

            $this->load->view('user/home/comman/header');

            $this->load->view('user/post/post_single_view', $data);

            $this->load->view('user/home/comman/footer');

        } else {

            $this->load->view('user/not_found');

        }



    }

    public function getWhoPostLikesMember(int $postid)
    {

        $like_rs = $this->Post_model->getWhoLikesbyPostid($postid);

        $output = '';

        $output .= '<div class="mCustomScrollbar" data-mcs-theme="dark">
					<ul class="notification-list" id="post-likes-members'.$postid.'">';

        for($i = 0;$i < count($like_rs);$i++) {
            $output .= '<li style="padding: 5px 10px !important;">
								<div class="author-thumb" style="height: 35px;width: 35px;">
									<img src="'.thumb(ProfileImg($like_rs[$i]['profile_img']), 35, 35).'" alt="author">
								</div>
								<div style="width:76%;padding-left:5px;" class="notification-event">

										<a href="'.file_path('profile/view/'.$like_rs[$i]['username']).'" class="h6 notification-friend">'.$like_rs[$i]['member_name'].'</a>
										<span class="notification-date">
											<time class="entry-date updated" datetime="2004-07-24T18:18">'.time_ago($like_rs[$i]['time_dt']).'</time>
										</span>
								</div>
							</li>';

        }
        $output .= '</ul>';

        $totpostlike = $this->Post_model->countPostTotalLikes($postid);

        if($totpostlike > 5) {
            $output .= '<div style="text-align:center;margin-top:10px;">
							<a class="load_more_likes" id="load_more_likes" value="'.$postid.'" href="#">
								<span>View more likes +</span>
							</a>
						</div>';
        }


        $output .= '</div>';

        echo $output;
    }

    public function ajax_load_more_likes(int $postid, $start_from)
    {
        $like_rs = $this->Post_model->getWhoLikesbyPostid($postid, $start_from);
		$output = "";
        if(count($like_rs) > 0) {
            for($i = 0;$i < count($like_rs);$i++) {
                $output .= '<li style="padding: 5px 10px !important;">
							<div class="author-thumb" style="height: 35px;width: 35px;">
								<img src="'.thumb(ProfileImg($like_rs[$i]['profile_img']), 35, 35).'" alt="author">
							</div>
							<div style="width:76%;padding-left:5px;" class="notification-event">

									<a href="'.file_path('profile/view/'.$like_rs[$i]['username']).'" class="h6 notification-friend">'.$like_rs[$i]['member_name'].'</a>
									<span class="notification-date">
										<time class="entry-date updated" datetime="2004-07-24T18:18">'.time_ago($like_rs[$i]['time_dt']).'</time>
									</span>
							</div>
						</li>';

            }
            $id = 1;
        } else {
            $id = 0;
        }


        $data_json = json_encode(array('id' => $id,'html' => $output));

        echo $data_json;
    }

    public function set_add_id()
    {

        $result = $this->comman_fun->get_table_data('social_post_master', array('status' => 'Active'));

        for($i = 0;$i < count($result);$i++) {

            $data = array();

            if($result[$i]['member_code'] != '0') {

                $data['added_by'] = 	$result[$i]['member_code'];

            } else {

                $data['added_by'] = 	$result[$i]['gp_addby'];

            }

            $this->comman_fun->update($data, 'social_post_master', array('post_id' => $result[$i]['post_id']));

        }

    }



    //mutual friend list

    public function getMutualFriendsList(int $uid)
    {

        $result 	= $this->Member_module->mutual_friends($uid);

        $member_dt = $this->Member_module->get_member_by_id($uid);

        $output = '';

        $output .= '<div class="mCustomScrollbar" data-mcs-theme="dark">

					<ul class="notification-list" id="post-likes-members'.$postid.'">';

        $tot_mutual_frnd = 0;

        for($i = 0;$i < count($result);$i++) {
            $tot_mutual_frnd =  $i + 1;

            $member_rs = $this->Member_module->get_member_by_id($result[$i]['friendID']);

            $output .= '<li style="padding: 5px 10px !important;">

								<div class="author-thumb" style="height: 35px;width: 35px;">

									<img src="'.thumb($member_rs['profile_img'], 35, 35).'" alt="author">

								</div>

								<div style="width:76%;padding-left:5px;" class="notification-event">

										<a href="'.file_path('profile/view/'.$member_rs['username']).'" class="h6 notification-friend">'.$member_rs['fullname'].'</a>

								</div>

							</li>';

        }
        $output .= '</ul>';

        if($tot_mutual_frnd > 10) {
            $output .= '<div style="text-align:center;margin-top:10px;">

							<a style="color:#47a247" id="view_more_mutual_frnds" href="'.file_path('profile/mutual_friends/'.$member_dt['username']).'">

								<span>View more mutual friends +</span>

							</a>

						</div>';

        }


        $output .= '</div>';


        echo $output;

    }


    public function ads_test()
    {

        $this->Ads_model->getAdsForView();

        echo $this->db->last_query();

    }





}
