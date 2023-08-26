<?php

class Post_model extends App_model
{
    public function get_post($post_id)
    {

        $this -> db -> select('*');

        $this -> db -> from('social_post_master');

        $this -> db -> where('post_id', $post_id);

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_post_master($post_id)
    {

        $this -> db -> select('*');

        $this -> db -> from('social_posts');

        $this -> db -> where('id', $post_id);

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }


    public function add_post($result)
    {

        $data = array(

            'add_by' 			=> user_session('usercode'),

            'post_text' 		=> isset($result['post_text']) ? $result['post_text'] : "",

            'video_upload' 	 	=> isset($result['video_upload']) ? $result['video_upload'] : "",

            'video_share'   	=> isset($result['video_share']) ? $result['video_share'] : "",

            'share_url'   		=> isset($result['share_url']) ? $result['share_url'] : "",

            'share_url_info'   => isset($result['share_url_info']) ? $result['share_url_info'] : "",

            'time_dt'			=>	time(),

            'status' 			=>  'Active'

        );

        $data['share_url_info'] =  isset($result['share_url_info']) ? $result['share_url_info'] : "";

        $this->db->simple_query('SET NAMES \'utf8mb4\'');

        $post_code = $this->comman_fun->addItem($data, 'social_posts');

        $data = array();

        $data['post_code']			=	$post_code;

        $data['member_code']		=	isset($result['member_code']) ? $result['member_code'] : "0";

        $data['post_category'] 		=   isset($result['post_category']) ? $result['post_category'] : "";

        $data['post_type']			=	isset($result['post_type']) ? $result['post_type'] : "add";

        $data['group_page_id'] 		=  isset($result['group_page_id']) ? $result['group_page_id'] : "0";

        $data['gp_addby'] 			=  isset($result['gp_addby']) ? $result['gp_addby'] : "0";

        $data['share_post_id'] 		=  isset($result['share_post_id']) ? $result['share_post_id'] : "0";

        $data['time_dt']			=	time();

        $data['date_time']			=	date('Y-m-d');

        $data['status']				=	'Active';

        $data['added_by']				=	user_session('usercode');



        $post_id = $this->comman_fun->addItem($data, 'social_post_master');

        $this->post_member_add($post_id);

        if($result['post_category'] == 'tag') {

            $notification = array(

                'type' => 'timeline_write',

                'post_id' => $post_id,

                'usercode' => $result['member_code'],

                'usercode2' => user_session('usercode')

            );

            $this->Notification_module->add_notification($notification);

        }

        return array(

            'post_code' => $post_code,

            'post_id'  => $post_id,

        );

    }



    public function post_member_add($post_id)
    {

        $tagFriend = $_POST['tagFriend'];

        for($i = 0;$i < count($tagFriend);$i++) {

            $data = array(

                'usercode' 		=> 	$tagFriend[$i],

                'post_id' 		=> 	$post_id,

                'type'  		=> 	'tag_friend',

                'status' 		=>  'Active'

            );

            $post_code = $this->comman_fun->addItem($data, 'social_post_member');


            // Add Notification


            $notification = array(

                'type' => 'tagged',

                'post_id' => $post_id,

                'pgCode' => 0,

                'usercode' =>  $tagFriend[$i],

                'usercode2' => user_session('usercode')

            );

            $this->Notification_module->add_notification($notification);


        }

    }


    public function add_post_image($info)
    {

        $data = array();

        $data['post_code']		=	$info['post_code'];

        $data['image_path']		=	$info['image_path'];

        $this->comman_fun->addItem($data, 'social_post_images');

    }

    public function post_image_update($post_id)
    {

        $data = array(

            'tot_image' => count($this->getPostImage($post_id))

        );

        $this->comman_fun->update($data, 'social_posts', array('id' => $post_id));

    }




    public function getPostById($id)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.post_id', $id);

        $this -> db -> where('m.status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        $the_content =  $this->post_arrange($the_content);

        return $the_content[0];

    }



    public function getMasterPostByPostcode($id)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.post_code', $id);

        $this -> db -> where('m.post_type', 'add');

        $this -> db -> where('m.status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        $the_content =  $this->post_arrange($the_content);

        return $the_content[0];

    }



    public function getMembertimelinePost($id, $start_from = 0)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');


        if($id != user_session('usercode')) {
            if($this->Member_module->isMyFriend($id) == true) {
                $this -> db -> where('m.privacy IN ("Public","Friends")');
            } else {
                $this -> db -> where('m.privacy IN ("Public")');
            }
        }

        //if not self {
        //if friend public and friens
        //no friend them only public
        //}
        $this -> db -> where('(
		
		m.gp_addby = "'.$id.'" OR 
		
		m.member_code = "'.$id.'" OR
		
		m.post_id IN ( SELECT post_id FROM social_post_member WHERE usercode  = "'.$id.'" )
		
		)');

        $this -> db -> where('m.post_category IN ("member","tag")');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.post_id', 'DESC');

        $this->db->limit(10, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }


    // get user's posted videos
    public function getMembertimelineVideo($id, $start_from = 0)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('(m.gp_addby = "'.$id.'" OR m.member_code = "'.$id.'")');

        $this -> db -> where('m.post_category IN ("member","tag")');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> where('(p.video_upload != "" OR p.video_share != "")');

        $this -> db -> order_by('m.post_id', 'DESC');

        $this->db->limit(10, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }

    public function checkMembertimelineNewMessages($id, $last)
    {

        $this -> db -> select('COUNT(post_id) as tot');

        $this -> db -> from('social_post_master');

        $this -> db -> where('member_code', $id);

        $this -> db -> where('post_id >', $last);

        $this -> db -> where('post_category', 'member');

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return ((int)$the_content[0]['tot']) > 0 ? true : false;

    }


    public function getMembertimelineNewMessages($id, $last)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.member_code', $id);

        $this -> db -> where('m.post_id >', $last);

        $this -> db -> where('m.post_category', 'member');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.post_id', 'ASC');

        $this -> db -> limit(4);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }


    public function getPostImage($post_code)
    {

        $this -> db -> select('*');

        $this -> db -> from('social_post_images');

        $this -> db -> where('post_code', $post_code);

        $this -> db -> where('status', '1');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;
    }


    public function post_arrange($result)
    {

        for($i = 0;$i < count($result);$i++) {


            $result[$i]['detail'] = $this->PostHederInfoSet($result[$i]);

            if($result[$i]['post_type'] == 'share') {

                $result[$i]['share_detail'] 		= 	$this->getMasterPostByPostcode($result[$i]['post_code']);

                $result[$i]['share_detail']['detail'] = $this->PostHederInfoSet($result[$i]['share_detail']);

            }


            //if($result[$i]['post_category']=='member'){
            //
            //				$result[$i]['r_post_by'] 		= 	$result[$i]['member_name'];
            //
            //				$result[$i]['r_post_by_url'] 	= 	file_path('profile/view/'.$result[$i]['member_username']);
            //
            //				$result[$i]['r_post_by_code'] 	= 	$result[$i]['member_username'];
            //
            //				$result[$i]['r_profile_img'] 	= 	$result[$i]['member_profile_img'];
            //
            //				$result[$i]['path_url'] 	    = 	file_path('profile/view/'.$result[$i]['member_username']);
            //
            //
            //			}
            //
            //			elseif($result[$i]['post_category']=='page'){
            //
            //				$result[$i]['r_post_by'] 		= 	$result[$i]['gp_title'];
            //
            //				$result[$i]['r_post_by_url'] 	= 	file_path('page/view/'.$result[$i]['group_page_id']);
            //
            //				$result[$i]['r_post_by_code'] 	= 	$result[$i]['group_page_id'];
            //
            //				$result[$i]['r_profile_img'] 	= 	$result[$i]['gp_profile_img'];
            //
            //			}
            //
            //			elseif($result[$i]['post_category']=='group'){
            //
            //				$result[$i]['r_post_by'] 		= 	$result[$i]['gp_title'];
            //
            //				$result[$i]['r_post_by_url'] 	= 	file_path('group/view/'.$result[$i]['group_page_id']);
            //
            //				$result[$i]['r_post_by_code'] 	= 	$result[$i]['group_page_id'];
            //
            //				$result[$i]['r_profile_img'] 	= 	$result[$i]['group_member_profile_img'];
            //
            //			}

        }

        return $result;

    }


    public function PostHederInfoSet($data)
    {

        $result = array();

        if($data['post_category'] == 'member') {

            $result['r_post_by'] 		= 	$data['member_name'];

            $result['r_post_by_url'] 	= 	file_path('profile/view/'.$data['member_username']);

            $result['r_post_by_code'] 	= 	$data['member_username'];

            $result['r_profile_img'] 	= 	$data['member_profile_img'];

            $result['path_url'] 	    = 	file_path('profile/view/'.$data['member_username']);


        } elseif($data['post_category'] == 'page') {

            $result['r_post_by'] 		= 	$data['gp_title'];

            $result['r_post_by_url'] 	= 	file_path('page/view/'.$data['group_page_id']);

            $result['r_post_by_code'] 	= 	$data['group_page_id'];

            $result['r_profile_img'] 	= 	$data['gp_profile_img'];

        } elseif($data['post_category'] == 'group') {

            $result['r_post_by'] 		= 	$data['group_member_name'];

            $result['r_post_by_url'] 	= 	file_path('group/view/'.$data['group_page_id']);

            $result['r_user_url'] 		= 	file_path('profile/view/'.$data['group_member_username']);

            $result['r_post_by_code'] 	= 	$data['group_page_id'];

            $result['r_profile_img'] 	= 	$data['group_member_profile_img'];

        } elseif($data['post_category'] == 'tag') {

            $result['r_post_by'] 		= 	$data['group_member_name'];

            $result['r_post_by_url'] 	= 	file_path('profile/view/'.$data['group_member_username']);

            $result['r_post_by_code'] 	= 	$data['group_page_id'];

            $result['r_profile_img'] 	= 	$data['group_member_profile_img'];


            $result['tag_to'] 		= 	$data['member_name'];

            $result['tag_url'] 		= 	file_path('profile/view/'.$data['member_username']);

        }
        return $result;

    }


    public function share_post($arr)
    {

        $result = $this->get_post($arr['post_id']);

        $data = array(

            'post_code' 		=> 		$result[0]['post_code'],

            'share_post_id' 	=> 		$result[0]['post_id'],

            'post_category' 	=> 		$arr['post_category'],

            'share_txt' 		=> 		$arr['share_txt'],

            'post_type' 		=> 		'share',

            'time_dt' 			=> 		time(),

            'date_time' 		=> 		date('Y-m-d'),

            'status' 			=> 		'Active',

            'added_by' 			=> 		user_session('usercode'),

            'is_ads' 			=> 		$result[0]['is_ads'],

            'ads_code' 			=> 		$result[0]['ads_code']

        );

        if($arr['post_category'] == 'member') {

            $data['member_code'] 	= user_session('usercode');


        } elseif($arr['post_category'] == 'page') {

            $data['gp_addby'] 		= user_session('usercode');

            $data['group_page_id'] 	= $arr['pg_code'];

        } elseif($arr['post_category'] == 'group') {

            $data['gp_addby'] 		= 	user_session('usercode');

            $data['group_page_id']  = 	$arr['pg_code'];

        }


        $id = $this->comman_fun->addItem($data, 'social_post_master');

        //notification


        if($arr['post_category'] == 'member') {

            if($result[0]['member_code'] != user_session('usercode')) {


                $notification = array(

                    'type' => 'share_on_timeline',

                    'post_id' => $result[0]['post_id'],

                    'usercode' => $result[0]['member_code'],

                    'usercode2' => user_session('usercode')

                );
            }
        } elseif($arr['post_category'] == 'page') {

            if($result[0]['member_code'] != user_session('usercode')) {

                $notification = array(

                        'type' => 'share_on_page',

                        'post_id' => $result[0]['post_id'],

                        'pgCode' => $arr['pg_code'],

                        'usercode' => $result[0]['member_code'],

                        'usercode2' => user_session('usercode')

                    );
            }

        } elseif($arr['post_category'] == 'group') {

            if($result[0]['member_code'] != user_session('usercode')) {

                $notification = array(

                        'type' => 'share_on_group',

                        'post_id' => $result[0]['post_id'],

                        'pgCode' => $arr['pg_code'],

                        'usercode' =>  $result[0]['member_code'],

                        'usercode2' => user_session('usercode')

                    );
            }

        }

        $this->Notification_module->add_notification($notification);

        return $id;

    }





    public function checkPagetimelineNewMessages($id, $last)
    {

        $this -> db -> select('COUNT(post_id) as tot');

        $this -> db -> from('social_post_master');

        $this -> db -> where('group_page_id', $id);

        $this -> db -> where('post_id >', $last);

        $this -> db -> where('post_category', 'page');

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return ((int)$the_content[0]['tot']) > 0 ? true : false;

    }



    public function getPagetimelineNewMessages($id, $last)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.group_page_id', $id);

        $this -> db -> where('m.post_id >', $last);

        $this -> db -> where('m.post_category', 'page');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.post_id', 'ASC');

        $this->db->limit(4);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }


    public function getPageTimelinePost($id, $start_from = 0)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.group_page_id', $id);

        $this -> db -> where('m.post_category', 'page');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.time_dt', 'DESC');

        $this->db->limit(10, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }




    public function checkMemberHomeNewMessages($last)
    {

        $this -> db -> select('COUNT(post_id) as tot');

        $this -> db -> from('social_post_master');

        $this -> db -> where('post_id >', $last);

        $this -> db -> where('(member_code = "'.user_session('usercode').'" OR group_page_id IN ( SELECT pg_code FROM social_page_group_member WHERE usercode="'.user_session('usercode').'" AND status="1" ) OR member_code IN (  SELECT friend FROM social_friends_detail WHERE usercode="'.user_session('usercode').'" ))');

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return ((int)$the_content[0]['tot']) > 0 ? true : false;

    }

    public function getMemberHomeNewMessages($last)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('(m.member_code = "'.user_session('usercode').'" OR m.group_page_id IN ( SELECT pg_code FROM social_page_group_member WHERE usercode="'.user_session('usercode').'" AND status="1" ) OR m.member_code IN (  SELECT friend FROM social_friends_detail WHERE usercode="'.user_session('usercode').'" ))');

        $this -> db -> where('m.post_id >', $last);

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.post_id', 'ASC');

        $this->db->limit(4);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }

    public function getMemberHomePost($start_from = 0)
    {

        $friendListUid = $this->getfriendsUid();
        ////for emoji
        $this->db->query("SET character_set_connection=utf8mb4");
        $this->db->query("SET character_set_results=utf8mb4");
        $this->db->query("SET character_set_client=utf8mb4");
        ////
        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.share_url, p.share_url_info, p.video_share');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        //--------
        $this -> db -> where('m.privacy IN ("Public","Friends")');
        //--------

        $this -> db -> where('(
			
			m.group_page_id IN ( SELECT pg_code FROM social_page_group_member WHERE usercode="'.user_session('usercode').'" AND status="1" ) OR 
			
			m.member_code IN ('.$friendListUid.') OR 
			
			m.post_id IN ( SELECT post_id FROM social_post_member WHERE usercode IN ('.$friendListUid.') )
			
			)');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.time_dt', 'DESC');

        $this->db->limit(10, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }


    public function getfriendsUid()
    {

        $this -> db -> select('friend');

        $this -> db -> from('social_friends_detail');

        $this -> db -> where('usercode', user_session('usercode'));

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        $arr = array(user_session('usercode'));

        for($i = 0;$i < count($the_content);$i++) {

            $arr[] = $the_content[$i]['friend'];

        }

        return implode(',', $arr);

    }


    public function checkGrouptimelineNewMessages($id, $last)
    {

        $this -> db -> select('COUNT(post_id) as tot');

        $this -> db -> from('social_post_master');

        $this -> db -> where('group_page_id', $id);

        $this -> db -> where('post_id >', $last);

        $this -> db -> where('post_category', 'group');

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return ((int)$the_content[0]['tot']) > 0 ? true : false;

    }



    public function getGrouptimelineNewMessages($id, $last)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share,p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.group_page_id', $id);

        $this -> db -> where('m.post_id >', $last);

        $this -> db -> where('m.post_category', 'group');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.post_id', 'ASC');

        $this -> db -> limit(4);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }


    public function getGroupTimelinePost($id, $start_from = 0)
    {

        $this -> db -> select('m.*');

        $this -> db -> select('p.add_by, p.post_text, p.video_upload, p.video_share, p.share_url, p.share_url_info');

        $this -> db -> select('CONCAT(u1.fname," ",u1.lname) as member_name, u1.username as member_username, u1.profile_img as member_profile_img');

        $this -> db -> select('CONCAT(u2.fname," ",u2.lname) as group_member_name, u2.username as group_member_username, u2.profile_img as group_member_profile_img');

        $this -> db -> select('gp.name as gp_name, gp.title as gp_title, gp.profile_img as gp_profile_img');

        $this -> db -> from('social_post_master m');

        $this -> db -> join('social_posts p', 'm.post_code = p.id', 'left');

        $this -> db -> join('membermaster u1', 'm.member_code = u1.usercode', 'left');

        $this -> db -> join('membermaster u2', 'm.gp_addby = u2.usercode', 'left');

        $this -> db -> join('social_page_group gp', 'm.group_page_id = gp.id', 'left');

        $this -> db -> where('m.group_page_id', $id);

        $this -> db -> where('m.post_category', 'group');

        $this -> db -> where('m.status', 'Active');

        $this -> db -> order_by('m.time_dt', 'DESC');

        $this -> db ->limit(10, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_code']);

        }

        return $this->post_arrange($the_content);

    }


    public function isMemberLikePost($post_id)
    {

        $this -> db -> select('id');

        $this -> db -> from('social_likes');

        $this -> db -> where('post_id', $post_id);

        $this -> db -> where('usercode', user_session('usercode'));

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return (isset($the_content[0])) ? true : false;

    }



    public function countPostTotalLikes($post_id)
    {

        $this -> db -> select('COUNT(*) as tot');

        $this -> db -> from('social_likes');

        $this -> db -> where('post_id', $post_id);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return (int)$the_content[0]['tot'];

    }


    public function do_unlike_post($post_id)
    {

        $this->comman_fun->delete('social_likes', array('post_id' => $post_id,'usercode' => user_session('usercode')));

        $this->comman_fun->delete('social_notification', array('post_id' => $post_id,'usercode2' => user_session('usercode'),'type' => 'like'));

        return true;

    }

    public function do_like_post($post_id)
    {

        if(!$this->isMemberLikePost($post_id)) {

            $result = $this->get_post($post_id);

            $this->_do_like_post($post_id);

            if($result[0]['added_by'] != user_session('usercode')) {

                $data = array(

                    'type' => 'like',

                    'post_id' => $post_id,

                    'usercode' => $result[0]['added_by'],

                    'usercode2' => user_session('usercode')

                );

                $this->Notification_module->add_notification($data);

            }

            return true;

        }

        return false;

    }

    private function _do_like_post($post_id)
    {

        $data = array(

            'post_id' => $post_id,

            'usercode' => user_session('usercode'),

            'time_dt' => time()

        );

        $this->comman_fun->addItem($data, 'social_likes');

    }

    public function postCountLikesCommentShare($post_id)
    {

        $post_id = $this->db->escape($post_id);

        $sQuery = 'SELECT
			
            (SELECT COUNT(*) FROM social_likes WHERE post_id = '.$post_id.') as total_likes, 
			
            (SELECT COUNT(*) FROM social_post_master WHERE share_post_id = '.$post_id.') as total_share,
			
            (SELECT COUNT(*) FROM social_comments WHERE post_id ='.$post_id.') as total_comments,
			
			(SELECT COUNT(*) FROM social_likes WHERE post_id = '.$post_id.' AND usercode = "'.user_session('usercode').'") as is_like
			
			';

        $query = $this->db->query($sQuery);

        $the_content = $query->result_array();

        return $the_content[0];

    }



    public function getUserPostPhotos($usercode, $start_from = 0)
    {

        $this -> db -> select('simg.*');

        $this -> db -> select('sp.*');

        $this -> db -> select('spm.post_id');

        $this -> db -> from('social_post_images simg');

        $this -> db -> join('social_posts sp', 'simg.post_code = sp.id', 'left');

        $this -> db -> join('social_post_master spm', 'spm.post_code = sp.id', 'left');

        $this -> db -> where('sp.add_by', $usercode);

        $this -> db -> where('sp.tot_image>', 0);

        $this -> db -> where('sp.status', 'Active');

        $this -> db -> order_by('sp.time_dt', 'DESC');

        $this -> db -> limit(20, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function countTotUserphotos($usercode)
    {

        $this -> db -> select('count(simg.id) as tot_img');

        $this -> db -> from('social_post_images simg');

        $this -> db -> join('social_posts sp', 'simg.post_code = sp.id', 'left');

        $this -> db -> where('sp.add_by', $usercode);

        $this -> db -> where('sp.tot_image>', 0);

        $this -> db -> where('sp.status', 'Active');

        $this -> db -> order_by('sp.time_dt', 'DESC');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content[0];

    }

    public function getWhoLikesbyPostid($postid, $start_from = 0)
    {
        $this -> db -> select('s.*');

        $this -> db -> select('CONCAT(m.fname," ",m.lname) as member_name,m.username,m.profile_img');

        $this -> db -> from('social_likes s');

        $this -> db -> join('membermaster m', 's.usercode = m.usercode', 'left');

        $this -> db -> where('s.post_id', $postid);

        $this -> db -> limit(5, $start_from);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;
    }


    public function getPostTaggedMember($post_id = null, $limit = 1)
    {

        $this -> db -> select('social_post_member.id,social_post_member.usercode');

        $this -> db -> select('CONCAT(m.fname," ",m.lname) as name,m.username,m.profile_img');

        $this -> db -> from('social_post_member');

        $this -> db -> join('membermaster m', 'social_post_member.usercode = m.usercode', 'INNER');

        $this -> db -> where('social_post_member.post_id', $post_id);

        $this -> db -> where('social_post_member.type', 'tag_friend');

        $this -> db -> limit($limit);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getCountPostTaggedMember($post_id = null)
    {

        $this -> db -> select('COUNT(id) as tot');

        $this -> db -> from('social_post_member');

        $this -> db -> where('type', 'tag_friend');

        $this -> db -> where('post_id', $post_id);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return (int)$the_content[0]['tot'];

    }


    public function delete_post($post_id)
    {

        $result = $this->get_post($post_id);

        if(isset($result[0]) && $result[0]['added_by'] == user_session('usercode')) {

            $data = array(

            'status' => 'Delete'

            );

            $this->comman_fun->update($data, 'social_post_master', array('post_id' => $post_id,'added_by' => user_session('usercode')));

            return true;

        }

        return false;

    }


    public function change_privacy($privacy, $post_id)
    {

        $result = $this->get_post($post_id);

        if(isset($result[0]) && $result[0]['added_by'] == user_session('usercode')) {

            if($privacy != '') {
                $data = array(

                    'privacy' => $privacy

                );

                $this->comman_fun->update($data, 'social_post_master', array('post_id' => $post_id,'added_by' => user_session('usercode')));

                return true;
            }



        }

        return false;

    }



}
