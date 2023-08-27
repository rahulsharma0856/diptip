<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Post extends App
{
    public function __construct()
    {

        parent::__construct();

        $this->load->library('image_lib');

        $this->load->library('upload');

        $this->load->model('Member_module');

        $this->load->model('user/Post_model');

        $this->load->model('user/Page_model');

        $this->load->model('user/Group_model');

        $this->load->model('user/Comment_model');

        $this->load->model('user/Notification_module');

        $this->load->model('user/Ads_model');

        date_default_timezone_set('Asia/Calcutta');

    }

    public function add_post_share_video()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('type', 'Post Type', 'callback_check_valid_post');

            $this->form_validation->set_rules('post_text2', 'Text', 'callback_check_post_share_video');

            if ($this->form_validation->run() === false) {

                $data['text'] = validation_errors();

                $data['status'] = 'false';

                echo json_encode($data);

                exit;

            } else {

                $result = $this->_add_post_share_video();

                $data['text'] = $this->load_single_post($result['post_id']);

                $data['status'] = 'true';

                echo json_encode($data);

                exit;

            }

        }

    }

    private function _add_post_share_video()
    {

        $video_share = "";

        $data = [

            'post_category' => $this->input->post('type'),

            'post_text'     => $this->input->post('post_text2'),

            'post_type'     => 'add',

        ];

        if (preg_match('/youtube.com|youtu.be|vimeo.com/', $_POST['video_share'])) {

            $data['video_share'] = $this->input->post('video_share');

        } else {

            $item_path = $this->get_url_info($this->input->post('video_share'));

            $data['share_url'] = $this->input->post('video_share');

            $data['share_url_info'] = json_encode($item_path);

        }

        if ($_POST['type'] == 'member') {

            $data['member_code'] = user_session('usercode');

        } elseif ($_POST['type'] == 'page') {

            $data['gp_addby'] = user_session('usercode');

            $data['group_page_id'] = $this->input->post('endcode');

        } elseif ($_POST['type'] == 'group') {

            $data['gp_addby'] = user_session('usercode');

            $data['group_page_id'] = $this->input->post('endcode');

        } elseif ($_POST['type'] == 'tag') {

            $data['member_code'] = $this->input->post('endcode');

            $data['gp_addby'] = user_session('usercode');

        }

        $result = $this->Post_model->add_post($data);

        return $result;

    }

    public function check_valid_rss()
    {

        return true;

    }

    public function check_valid_post()
    {

        $type = ['member', 'page', 'group', 'tag'];

        if ( ! in_array($_POST['type'], $type)) {

            $this->form_validation->set_message('check_valid_post', 'Invaild Request');

            return false;

        }

        if ($_POST['type'] == 'page') {

            if ( ! $this->Page_model->isAdmin($_POST['endcode'])) {

                $this->form_validation->set_message('check_valid_post', 'Invaild Request');

                return false;

            } else {

                return true;

            }

        }
        if ($_POST['type'] == 'group') {

            $result = $this->Group_model->getGroupById($_POST['endcode']);

            $isGroupAdmin = $this->Group_model->isAdmin($_POST['endcode']);

            $isGroupJoined = $this->Group_model->isGroupJoined($_POST['endcode']);

            if ($result[0]['group_posts'] == 'Admin') {

                if ($isGroupAdmin == true) {

                    return true;

                }

            }

            if ($result[0]['group_posts'] == 'Any') {

                if ($isGroupJoined == true || $isGroupAdmin == true) {

                    return true;

                }

            }

            $this->form_validation->set_message('check_valid_post', 'Invaild Request');

            return false;

        }

        if ($_POST['type'] == 'tag') {

            if ($this->Member_module->isMyFriend($_POST['endcode'])) {

                return true;

            }

            $this->form_validation->set_message('check_valid_post', 'Invaild Request friend timeline');

            return false;
        }

        return true;

    }

    public function check_post_share_video()
    {

        if ($_POST['post_text2'] == '' && $_POST['video_share'] == '') {

            $this->form_validation->set_message('check_post_share_video', 'Invaild Request');

            return false;

        }

        return true;
    }

    public function add_post_status()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('type', 'Post Type', 'callback_check_valid_post');

            $this->form_validation->set_rules('post_text', 'Text', 'callback_check_post_status');

            // Upload Video
            if ($_FILES['uploadStatusVideo']['name'] != '') {

                $this->form_validation->set_rules('uploadStatusVideo', 'Video', 'callback_upload_video');

            }

            if ($this->form_validation->run() === false) {

                $data['text'] = validation_errors();

                $data['status'] = 'false';

                echo json_encode($data);

                exit;

            } else {

                $result = $this->_add_post_status();

                // Validate Image Check..
                if ($result[0]['notification'] != '') {
                    $data['text'] = validation_errors();

                    $data['status'] = 'false';

                    echo json_encode($data);

                    exit;
                }

                $data['text'] = $this->load_single_post($result['post_id'], $_POST['type']);

                $data['status'] = 'true';

                echo json_encode($data);

                exit;

            }

        }
    }

    private function _add_post_status()
    {

        $post_text = $this->input->post('post_text');

        $data = [

            'post_category' => $this->input->post('type'),

            'post_text'     => $post_text,

            'post_type'     => 'add',

        ];

        if ($_POST['type'] == 'member') {

            $data['member_code'] = user_session('usercode');

        } elseif ($_POST['type'] == 'page') {

            $data['gp_addby'] = user_session('usercode');

            $data['group_page_id'] = $this->input->post('endcode');

        } elseif ($_POST['type'] == 'group') {

            $data['gp_addby'] = user_session('usercode');

            $data['group_page_id'] = $this->input->post('endcode');

        } elseif ($_POST['type'] == 'tag') {

            $data['member_code'] = $this->input->post('endcode');

            $data['gp_addby'] = user_session('usercode');

        }

        // Upload Video Prep
        if ($_FILES['uploadStatusVideo']['name'] != '') {

            $data['video_upload'] = $this->input->post('uploadVideo');

        }

        $result                    = [];
        $result[0]['notification'] = '';

        // Upload Image and Check
        if (count($_FILES['uploadStatusImg']['name']) > 0) {
            // Upload the image
            $upload_data = $this->upload_image();

            $count    = count($upload_data);
            $validImg = true;

            // Check for returned errors..
            for ($i = 0; $i < $count; $i++) {
                if ($upload_data[$i]['notification'] != '') {
                    $result[$i]['notification'] = $upload_data[$i]['notification'];
                    $validImg                   = false;
                }
            }
            // Return here if not valid image.
            if ($validImg === false) {
                return $result;
            }
        }

        // Add Post
        $result = $this->Post_model->add_post($data);

        // Post Image
        if (count($_FILES['uploadStatusImg']['name']) > 0) {

            $count = count($upload_data);

            for ($i = 0; $i < $count; $i++) {
                if ($upload_data[$i]['notification'] != '') {
                    $result[$i]['notification'] = $upload_data[$i]['notification'];
                    continue;
                }
                $data = [
                    'post_code'  => $result['post_code'],
                    'image_path' => $upload_data[$i]['file_name'],
                ];
                $this->Post_model->add_post_image($data);
            }

            $this->Post_model->post_image_update($result['post_code']);
        }

        return $result;
    }

    public function upload_video()
    {

        $config = [];

        $config['upload_path'] = './upload/video';

        //$config['allowed_types'] = 'mp4|ogv|avi|mkv';

        $ex_type = explode('/', $_FILES['uploadStatusVideo']['type']);

        if ($ex_type[0] != 'video') {

            $this->form_validation->set_message('upload_video', 'Invalid File Upload');

            return false;

        }

        $config['allowed_types'] = '*';

        $config['max_size'] = '30720';

        $config['overwrite'] = false;

        $_FILES['userfile']['name'] = $_FILES['uploadStatusVideo']['name'];

        $_FILES['userfile']['type'] = $_FILES['uploadStatusVideo']['type'];

        $_FILES['userfile']['tmp_name'] = $_FILES['uploadStatusVideo']['tmp_name'];

        $_FILES['userfile']['error'] = $_FILES['uploadStatusVideo']['error'];

        $_FILES['userfile']['size'] = $_FILES['uploadStatusVideo']['size'];

        $rand = md5(uniqid(rand(), true));

        $fileName = user_session('usercode') . '_' . $rand;

        $fileName = str_replace(" ", "", $fileName);

        $config['file_name'] = $fileName;

        $this->upload->initialize($config);

        if ($this->upload->do_upload()) {

            $upload_data = $this->upload->data();

            $_POST['uploadVideo'] = $upload_data['file_name'];

            return true;

        } else {

            $this->form_validation->set_message('upload_video', $this->upload->display_errors());

            return false;

        }
    }

    private function upload_image()
    {
        $cpt = count($_FILES['uploadStatusImg']['name']);

        $files = $_FILES;

        $config = [];

        $config['upload_path'] = './upload/post/';

        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $config['max_size']     = '2000';
        $config['max_filename'] = '128';

        $config['max_width']  = '2000';
        $config['max_height'] = '1600';

        $config['min_width']  = '32';
        $config['min_height'] = '32';

        $config['overwrite'] = true;

        $config['quality'] = '90%';

        $this->upload->display_errors('', '');

        $upload_data = [];

        for ($i = 0; $i < $cpt; $i++) {

            if ($files['uploadStatusImg']['name'][$i]) {

                $_FILES['userfile']['name'] = $files['uploadStatusImg']['name'][$i];

                $_FILES['userfile']['type'] = $files['uploadStatusImg']['type'][$i];

                $_FILES['userfile']['tmp_name'] = $files['uploadStatusImg']['tmp_name'][$i];

                $_FILES['userfile']['error'] = $files['uploadStatusImg']['error'][$i];

                $_FILES['userfile']['size'] = $files['uploadStatusImg']['size'][$i];

                // Get temp rand name..
                $rand                = md5(uniqid(rand(), true));
                $fileName            = user_session('usercode') . '_' . $rand;
                $fileName            = str_replace(" ", "", $fileName);
                $config['file_name'] = $fileName;

                $this->upload->initialize($config);

                $upload_data[$i]['notification'] = '';

                // Do upload
                if ($this->upload->do_upload()) {
                    $fullPath = $this->upload->data('full_path');
                    $filePath = $this->upload->data('file_path');
                    $fileExt  = $this->upload->data('file_ext');

                    // Get the hash of the file
                    $hashName = substr(hash_file('sha256', $fullPath), 64 - 34, 34);

                    // Rename temp file with hash
                    rename($fullPath, $filePath . $hashName . $fileExt);

                    // Replace new filename and return upload data
                    $upload_data[$i] = str_replace($fileName, $hashName, $this->upload->data());

                } else {

                    $upload_data[$i]['notification'] = $this->upload->display_errors();

                    $this->form_validation->add_to_error_array('uploadStatusImg', $this->upload->display_errors('Upload Error:  ', ' The file "' . $files['uploadStatusImg']['name'][$i] . '" is not valid.'));

                }
            }
        }
        return $upload_data;
    }

    public function check_post_status()
    {

        if ($_POST['post_text'] == '' && ! isset($_FILES['uploadStatusImg']['name'][0])) {

            $this->form_validation->set_message('check_post_status', 'Invalid Request');

            return false;

        }

        return true;
    }

    public function load_single_post($id, $section = 'member', $inner = '0')
    {

        $data['result'] = $this->Post_model->getPostById($id);

        $data['section'] = $section;

        $data['inner'] = ($inner == '0') ? '0' : $inner;

        return $this->load->view('user/post/post_single', $data, true);

    }

    public function test()
    {

        $result = $this->Post_model->getMembertimelinePost(1);

    }

    public function do_like_post($post_id)
    {

        $result = $this->Post_model->do_like_post($post_id);

        $data = [

            'html' => $this->PostLikesHtml($post_id),

        ];

        echo json_encode($data);

        exit;

    }

    public function do_unlike_post($post_id)
    {

        $result = $this->Post_model->do_unlike_post($post_id);

        $data = [

            'html' => $this->PostLikesHtml($post_id),

        ];

        echo json_encode($data);

        exit;

    }

    public function PostLikesHtml($post_id)
    {

        $totalLikes = $this->Post_model->countPostTotalLikes($post_id);

        if ($totalLikes == 1) {
            $post_like = 'Like';
        } else {
            $post_like = 'Likes';
        }

        if ($this->Post_model->isMemberLikePost($post_id)) {

            $html = '<span><a href="#" class="post-add-icon inline-items" id="do_unlike_post" value="' . $post_id . '"><i class="fa fa-heart"></i> </a></span>

					 <span><a style="color:#888da8;" href="' . file_path('dashboard/getWhoPostLikesMember/' . $post_id) . '" class="who-likes-popover like-post-' . $post_id . '" id="who-likes-popover">' . $totalLikes . ' ' . $post_like . '</a>

					 </span>';

        } else {

            $html = '<span><a href="#" class="post-add-icon inline-items" id="do_like_post" value="' . $post_id . '"> <i class="fa fa-heart-o"></i></a></span>

					 <span><a style="color:#888da8;" href="' . file_path('dashboard/getWhoPostLikesMember/' . $post_id) . '" class="who-likes-popover like-post-' . $post_id . '" id="who-likes-popover"> ' . $totalLikes . ' ' . $post_like . '</a>

					 </span>';

        }

        return $html;

    }

    public function share_popup($post_id = null, $section = 'member')
    {

        $balance = $this->Member_module->payment_summery_by_wallet(user_session('usercode'), 'USD');

        $detail = $this->Post_model->get_post($post_id);

        $result = $this->Post_model->getMasterPostByPostcode($detail[0]['post_code']);

        $data = [

            'detail'  => $detail[0],

            'result'  => $result,

            'section' => $section,

        ];

        if ( ! $this->check_rss_valid()) {

            $this->load->view('user/load/popup_msg', ['msg' => 'Sorry! you do not have enough USD Credits in your Account to Share this Post.']);

        } elseif ($section == 'page') {

            $data['pages'] = $this->Page_model->getMyPages();

            if (count($data['pages']) > 0) {

                $this->load->view('user/load/share_popup_file', $data);

            } else {

                $this->load->view('user/load/popup_msg', ['msg' => 'You have no any page to post share']);
            }

        } elseif ($section == 'group') {

            $groups = $this->Group_model->getJoinedGroupListForPost();

            $mygroup = $this->Group_model->getMyGroup();

            $data['groups'] = array_merge($groups, $mygroup);

            if (count($data['groups']) > 0) {

                $this->load->view('user/load/share_popup_file', $data);

            } else {

                $this->load->view('user/load/popup_msg', ['msg' => 'You have no any group to post share']);

            }

        } elseif ($section == 'member') {

            $this->load->view('user/load/share_popup_file', $data);

        }

    }

    public function check_rss_valid()
    {

        return true;
    }

    public function post_share_submit()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('type', 'Post Type', 'callback_check_valid_post');

            $this->form_validation->set_rules('post_id', 'Post Id', 'callback_check_valid_rss');

            if ($this->form_validation->run() === false) {

                $data['text'] = validation_errors();

                $data['status'] = 'false';

                echo json_encode($data);

                exit;

            } else {

                $result = $this->_post_share_submit();

                $data['status'] = 'true';

                echo json_encode($data);

                exit;

            }

        }
    }

    private function _post_share_submit()
    {

        $data = [

            'post_category' => $_POST['type'],

            'pg_code'       => $_POST['endcode'],

            'share_txt'     => $this->input->post('share_txt'),

            'post_id'       => $_POST['post_id'],

        ];

        $post_id = $this->Post_model->share_post($data);

        $this->isShareAds($_POST['post_id']);

    }

    private function isShareAds($post_id = null)
    {

        $detail = $this->Post_model->get_post($post_id);

        if ($detail[0]['post_category'] == 'Ads' && $detail[0]['is_ads'] == '1') {

            $totAdsShare = $this->Ads_model->totAdsShare($detail[0]['ads_code'], $post_id);

            $result = $this->Ads_model->getAdById($detail[0]['ads_code']);

            $is_paid = $this->Member_module->is_paid(user_session('usercode'));

            if ($totAdsShare == 1 && (int) $result[0]['tot_share'] > (int) $result[0]['get_share'] && $is_paid == true) {

                $data = [

                    'usercode'    => user_session('usercode'),

                    'ads_code'    => $detail[0]['ads_code'],

                    'amount'      => 0.10,

                    'wallet_type' => 'ads_share',

                    'wallet'      => 'USD',

                    'type_dt'     => 'Share_Ads',

                    'time_dt'     => time(),

                ];

                $this->comman_fun->addItem($data, 'm_income');

                $this->Ads_model->updateShares($detail[0]['ads_code']);

            }

        }

    }

    public function delete_post($id = null)
    {

        if ($this->Post_model->delete_post($id)) {

            $data['status'] = 'true';

            echo json_encode($data);

            exit;

        } else {

            $data['status'] = 'false';

            echo json_encode($data);

            exit;

        }

    }

    public function change_privacy($privacy, $id = null)
    {

        if ($this->Post_model->change_privacy($privacy, $id)) {

            $data['status'] = 'true';

            echo json_encode($data);

            exit;

        } else {

            $data['status'] = 'false';

            echo json_encode($data);

            exit;

        }

    }

    public function edit_post(int $post_id)
    {

        $data = [];

        $data['detail'] = $this->Post_model->get_post($post_id);

        $data['master'] = $this->Post_model->get_post_master($data['detail'][0]['post_code']);

        $data['PostImage'] = $this->Post_model->getPostImage($data['detail'][0]['post_code']);

        $data['TaggedMember'] = $this->Post_model->getPostTaggedMember($post_id, 50);

        $this->load->view('user/post_edit', $data);

    }

    public function postImageDelete(int $imgID)
    {

        $result = $this->comman_fun->get_table_data('social_post_images', ['id' => $imgID]);

        $post = $this->comman_fun->get_table_data('social_posts', ['id' => $result[0]['post_code'], 'add_by' => user_session('usercode')]);

        if (isset($post[0])) {

            $data = [

                'status' => '0',

            ];

            $this->comman_fun->update($data, 'social_post_images', ['id' => $imgID]);

        }

    }

    public function post_edit_submit()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('type', 'Post Type', 'callback_check_valid_edit_post');
            if ($_FILES['uploadStatusVideo']['name'] != '') {
                $this->form_validation->set_rules('uploadStatusVideo', 'Video', 'callback_upload_video');
            }

            $data = [];
            if ($this->form_validation->run() === false) {

                $data['text'] = validation_errors();

                $data['status'] = 'false';

                echo json_encode($data);

                exit;

            } else {

                $this->_post_edit_submit();

                $data['text'] = $this->load_single_post($_POST['post_id'], 'member', 'only_inner');

                $data['divID'] = 'post' . $_POST['post_id'];

                $data['status'] = 'true';

                echo json_encode($data);

                exit;

            }

        }
    }

    private function _post_edit_submit()
    {

        $detail = $this->Post_model->get_post($_POST['post_id']);

        //$master = $this->Post_model->get_post_master($detail[0]['post_code']);

        if ($detail[0]['post_type'] == 'add') {

            if (count($_FILES['uploadStatusImg']['name']) > 0) {

                $result = [

                    'post_code' => $detail[0]['post_code'],

                    'post_id'   => $_POST['post_id'],

                ];

                $this->upload_image($result);

            }

            $data = [];

            if ($_FILES['uploadStatusVideo']['name'] != "" && $_POST['uploadVideo'] != "") {

                $data['video_upload'] = $_POST['uploadVideo'];

                $data['video_share'] = "";

            } else {

                if ($_POST['video_share'] != "") {

                    $data['video_share'] = $_POST['video_share'];

                }
            }

            $data['post_text'] = $_POST['post_text_r'];

            $this->comman_fun->update($data, 'social_posts', ['id' => $detail[0]['post_code']]);

        } else {

            $data = [];

            $data['share_txt'] = $_POST['post_text_r'];

            $this->comman_fun->update($data, 'social_post_master', ['post_id' => $detail[0]['post_id']]);

        }

        $tag_members = $_POST['tagFriend'];

        $tag_members_usercode = $_POST['tagFriendUsercode'];

        if (isset($tag_members[0])) {

            $this->comman_fun->delete('social_post_member', ['post_id' => $_POST['post_id']]);

            for ($i = 0; $i < count($tag_members); $i++) {
                $tag_data = [

                    'usercode' => $tag_members_usercode[$i],

                    'post_id'  => $_POST['post_id'],

                    'type'     => 'tag_friend',

                    'status'   => 'Active',

                ];

                $this->comman_fun->addItem($tag_data, 'social_post_member');
            }

        } else {
            $checkTagMember = $this->Post_model->getPostTaggedMember($_POST['post_id'], 50);

            if (isset($checkTagMember[0])) {

                $this->comman_fun->delete('social_post_member', ['post_id' => $_POST['post_id']]);

            }
        }
    }

    public function check_valid_edit_post()
    {

        $post = $this->comman_fun->get_table_data('social_post_master', ['post_id' => $_POST['post_id'], 'added_by' => user_session('usercode')]);

        if ( ! isset($post[0])) {

            $this->form_validation->set_message('check_valid_edit_post', 'Invaild Request');

            return false;

        }

        return true;
    }

    public function get_url_info($url = null)
    {

        $this->load->model('Share_link_module');

        $item_path = $this->check_share_link_from_db($url);

        if ($item_path == false) {

            if (preg_match('/facebook.com/', $url)) {

                //if fb link

                $item_path = $this->Share_link_module->get_info($url);

            } else {

                //if not fb link

                $item_path = $this->Share_link_module->get_info_api($url);

            }

            $item_path2 = $item_path;

            $data = [

                'url'      => $url,

                'url_info' => json_encode($item_path),

                'timedt'   => time(),

            ];

            //insert in db
            $share_url_id = $this->comman_fun->addItem($data, 'social_share_url');
        }

        return $item_path;

    }

    public function check_share_link_from_db($url)
    {

        //result
        $result = $this->comman_fun->get_table_data('social_share_url', ['url' => $url]);

        if (isset($result[0])) {

            return json_decode($result[0]['url_info'], true);

        } else {

            return false;

        }

    }

    public function payment_test($id)
    {

        $this->load->model('Payment2_module');

        $rt = $this->Payment2_module->test_post_share($id);

        //
        var_dump($rt);
    }

}
