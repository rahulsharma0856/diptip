<?php

class Post_module extends App_model
{
    public function get_post($post_id)
    {

        $this -> db -> select('*');

        $this -> db -> from('sm_post_master');

        $this -> db -> where('id', $post_id);

        $this -> db -> where('status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }


    public function getPostById($id)
    {

        $this -> db -> select('m.post_category, m.video_upload, m.video_share');

        $this -> db -> select('d.post_id, d.post_category, d.post_type, d.usercode, d.post_text, d.time_dt, d.endcode');

        $this -> db -> select('u.name as name, u.type as post_by_type');

        $this -> db -> from('sm_post_detail d');

        $this -> db -> join('sm_post_master m', 'm.id=d.post_id', 'inner');

        $this -> db -> join('sm_page_group u', 'm.endcode = u.id', 'left');

        $this -> db -> where('d.id', $id);

        $this -> db -> where('d.status', 'Active');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_id']);

        }

        return $the_content[0];

    }


    public function getPostImage($post_id)
    {

        $this -> db -> select('*');

        $this -> db -> from('sm_post_images');

        $this -> db -> where('post_id', $post_id);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;
    }


    public function get_latest_post()
    {

        $this -> db -> select('m.post_category, m.video_upload, m.video_share');

        $this -> db -> select('d.post_id, d.post_category, d.post_type, d.usercode, d.post_text, d.time_dt, d.endcode');

        $this -> db -> select('u.name as name, u.type as post_by_type');

        $this -> db -> from('sm_post_detail d');

        $this -> db -> join('sm_post_master m', 'm.id=d.post_id', 'inner');

        $this -> db -> join('sm_page_group u', 'm.endcode = u.id', 'left');

        $this -> db -> where('(d.endcode IN (SELECT endcode FROM sm_page_group_member WHERE usercode = "'.user_session('usercode').'") OR d.endcode = "'.user_session('usercode').'")');

        $this -> db -> where('m.post_category IN ("member","page")');

        $this -> db -> where('d.status', 'Active');

        $this -> db -> order_by('d.time_dt', 'desc');

        $this -> db -> limit(40);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_id']);

        }

        return $the_content;


    }


    public function getMyTimelinePost()
    {

        $this -> db -> select('m.post_category, m.video_upload, m.video_share');

        $this -> db -> select('d.post_id, d.post_category, d.post_type, d.usercode, d.post_text, d.time_dt, d.endcode');

        $this -> db -> select('u.name as name, u.type as post_by_type');

        $this -> db -> from('sm_post_detail d');

        $this -> db -> join('sm_post_master m', 'm.id=d.post_id', 'inner');

        $this -> db -> join('sm_page_group u', 'm.endcode = u.id', 'left');

        $this -> db -> where('d.endcode', user_session('usercode'));

        $this -> db -> where('d.status', 'Active');

        $this -> db -> order_by('d.time_dt', 'desc');

        $this -> db -> limit(40);

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        for($i = 0;$i < count($the_content);$i++) {

            $the_content[$i]['image'] = $this->getPostImage($the_content[$i]['post_id']);

        }

        return $the_content;

    }


    public function add_post($result)
    {

        $data = array();

        $data['usercode']	=	user_session('usercode');

        $data['endcode']	=	isset($result['endcode']) ? $result['endcode'] : "";

        $data['post_text']	=	isset($result['post_text']) ? $result['post_text'] : "";

        $data['post_category'] =  isset($result['post_category']) ? $result['post_category'] : "";

        $data['video_share'] =  isset($result['video_share']) ? $result['video_share'] : "";

        $data['video_upload'] =  isset($result['video_upload']) ? $result['video_upload'] : "";

        $data['group_id'] =  isset($result['group_id']) ? $result['group_id'] : "";

        $data['time_dt']	=	time();

        $data['date_time']	=	date('Y-m-d h:i:s');

        $data['status']		=	'Active';

        $post_id = $this->comman_fun->addItem($data, 'sm_post_master');



        $data = array();

        $data['post_id']		=	$post_id;

        $data['post_type']		=	'Add';

        $data['usercode']		=	user_session('usercode');

        $data['endcode']		=	isset($result['endcode']) ? $result['endcode'] : "";

        $data['post_text']		=	isset($result['post_text']) ? $result['post_text'] : "";

        $data['video_share'] 	=  isset($result['video_share']) ? $result['video_share'] : "";

        $data['video_upload'] 	=  isset($result['video_upload']) ? $result['video_upload'] : "";

        $data['group_id'] 		=  isset($result['group_id']) ? $result['group_id'] : "";

        $data['time_dt']		=	time();

        $data['status']			=	'Active';



        $post_dt_id = $this->comman_fun->addItem($data, 'sm_post_detail');


        return array(

            'post_id' => $post_id,

            'post_dt_id' => $post_dt_id

        );

    }


    public function add_post_image($info)
    {

        $data = array();

        $data['post_id']		=	$info['post_id'];

        $data['image_path']		=	$info['image_path'];

        $this->comman_fun->addItem($data, 'sm_post_images');

    }




}
