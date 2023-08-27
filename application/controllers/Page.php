<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Page extends App
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user/Page_model', '', true);
        $this->load->model('user/Post_model', '', true);
        $this->load->model('user/Comment_model');
        $this->load->model('user/Notification_module');
        $this->load->model('Member_module', '', true);
        $this->load->library('image_lib');
        $this->load->library('upload');

    }

    public function index()
    {

    }

    public function add()
    {
        $this->Member_module->check_paid(user_session('usercode'));
        $data['mode']     = 'add';
        $data['myPages']  = $this->Page_model->getMyPages();
        $data['category'] = $this->comman_fun->get_table_data('sm_page_category', ['status' => 'Active']);

        $this->template->data  = $data;
        $this->template->title = 'Login';
        $this->template->view  = 'user/page/page_add';
        $this->load->view('user/layout');
    }

    public function insert()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->Member_module->check_paid(user_session('usercode'));
            $this->form_validation->set_rules('name', 'Page Name', 'required|trim');
            $this->form_validation->set_rules('title', 'Page title', 'required|trim');
            $this->form_validation->set_rules('description', 'Page Description', 'required|trim');
            $this->form_validation->set_rules('category', 'Page Category', 'required|trim');

            if ($this->form_validation->run() === false) {
                $this->add();
            } else {
                $i = $this->_insert();
                redirect('/page/view/' . $i, 'refresh');
            }
        } else {
            $this->index();
        }
    }

    public function is_cover_img_selected()
    {
        $this->form_validation->set_message('is_cover_img_selected', 'Please select profile image.');
        if (empty($_FILES['cover_img']['name']) && $_POST['mode'] == 'add') {
            return false;
        } else {
            return true;
        }
    }

    public function is_profile_img_selected()
    {
        $this->form_validation->set_message('is_profile_img_selected', 'Please select profile image.');
        if (empty($_FILES['profile_img']['name']) && $_POST['mode'] == 'add') {
            return false;
        } else {
            return true;
        }
    }

    protected function _insert()
    {

        $data                = [];
        $data['name']        = ($_POST['name']);
        $data['title']       = filter_text($_POST['title']);
        $data['description'] = ($_POST['description']);
        $data['category']    = ($_POST['category']);

        if ($_POST['mode'] == 'edit') {
            $this->comman_fun->update($data, 'social_page_group', ['id' => $_POST['eid']]);
            return $_POST['eid'];

        } else {
            $data['type']         = 'page';
            $data['uid']          = user_session('usercode');
            $data['status']       = 'Active';
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by']   = user_session('usercode');
            $page_id              = $this->comman_fun->addItem($data, 'social_page_group');
            $this->Page_model->do_like($page_id, user_session('usercode'));
            return $page_id;

        }
    }

    public function handle_upload($file_id, $prefix = null)
    {

        if (isset($_FILES[$file_id]) && ! empty($_FILES[$file_id]['name'])) {
            $config                         = [];
            $config['upload_path']          = './upload/post';
            $config['allowed_types']        = 'jpg|jpeg|gif|png';
            $config['max_size']             = '2000';
            $config['max_filename']         = '128';
            $config['max_width']            = '2000';
            $config['max_height']           = '1600';
            $config['min_width']            = '32';
            $config['min_height']           = '32';
            $config['overwrite']            = true;
            $config['remove_spaces']        = true;
            $_FILES['userfile']['name']     = $_FILES[$file_id]['name'];
            $_FILES['userfile']['type']     = $_FILES[$file_id]['type'];
            $_FILES['userfile']['tmp_name'] = $_FILES[$file_id]['tmp_name'];
            $_FILES['userfile']['error']    = $_FILES[$file_id]['error'];
            $_FILES['userfile']['size']     = $_FILES[$file_id]['size'];

            // Get temp rand name..
            $rand                = md5(uniqid(rand(), true));
            $fileName            = $prefix . '_' . $rand;
            $fileName            = str_replace(" ", "", $fileName);
            $config['file_name'] = $fileName;

            $this->upload->display_errors('', '');

            $this->upload->initialize($config);

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
                $upload_data = str_replace($fileName, $hashName, $this->upload->data());

                return $upload_data['file_name'];

            }
        }
        return false;
    }

    public function view($id = null)
    {

        $data['result'] = $this->Page_model->getPageById($id);
        if (isset($data['result'][0])) {
            $data['isPageAdmin']      = $this->Page_model->isAdmin($id);
            $data['isPagelike']       = $this->Page_model->isPageliked($id);
            $data['MemberLikedPages'] = $this->Page_model->getMemberLikedPages(user_session('usercode'));
            $data['MyPages']          = $this->Page_model->getMyPages();
            $data['TotalPageLikes']   = $this->Page_model->countTotalPageLikes($id);

            $this->template->data  = $data;
            $this->template->title = 'Login';
            $this->template->view  = 'user/page/page_timeline';
            $this->load->view('user/layout_page');

        } else {
            $this->load->view('user/not_found');
        }
    }

    public function likes($id = null)
    {

        $data['result'] = $this->Page_model->getPageById($id);

        if (isset($data['result'][0])) {

            $data['isPageAdmin']     = $this->Page_model->isAdmin($id);
            $data['isPagelike']      = $this->Page_model->isPageliked($id);
            $data['myPages']         = $this->Page_model->getMemberLikedPages(user_session('usercode'));
            $data['TotalPageLikes']  = $this->Page_model->countTotalPageLikes($id);
            $data['PagelikesMember'] = $this->Page_model->pageLikedMemberList($id);

            $this->template->data  = $data;
            $this->template->title = 'Login';
            $this->template->view  = 'user/page/page_likes';
            $this->load->view('user/layout_page');

        } else {

            $this->load->view('user/not_found');

        }

    }

    public function do_like($page_id)
    {
        $result = $this->Page_model->getPageById($page_id);
        if (isset($result[0])) {
            $this->Page_model->do_like($page_id, $result[0]['uid']);
            $data           = [];
            $data['status'] = 'true';
            $data['html']   = '<a href="#" class="btn btn-control bg-green f30" title="like page" id="do_unlike" value="' . $page_id . '">
			<i class="fa fa-thumbs-down f30"></i>
			</a>';

            $data['TotalPageLikes'] = $this->Page_model->countTotalPageLikes($page_id);

        } else {
            $data['status'] = 'false';
        }

        echo json_encode($data);
        exit;

    }

    public function do_like_co($page_id)
    {
        $result = $this->Page_model->getPageById($page_id);
        if (isset($result[0])) {

            $this->Page_model->do_like($page_id, $result[0]['uid']);

            $result = $this->Page_model->getPageById($page_id);

            $data = [];

            $data['status'] = 'true';

            $data['html'] = $this->load->view('user/search/page_html', ['result' => $result[0], 'only_inner' => true], true);

        } else {

            $data['status'] = 'false';

        }

        echo json_encode($data);

        exit;

    }

    public function do_unlike_co($page_id)
    {

        $result = $this->Page_model->getPageById($page_id);
        if (isset($result[0])) {
            $this->Page_model->do_unlike($page_id);
            $result         = $this->Page_model->getPageById($page_id);
            $data['status'] = 'true';
            $data['html']   = $this->load->view('user/search/page_html', ['result' => $result[0], 'only_inner' => true], true);

        } else {
            $data['status'] = 'false';
        }

        echo json_encode($data);

        exit;

    }

    public function do_unlike($page_id)
    {

        $result = $this->Page_model->getPageById($page_id);
        if (isset($result[0])) {
            $this->Page_model->do_unlike($page_id);
            $data['status'] = 'true';
            $data['html']   = '<a href="#" class="btn btn-control bg-primary f30" title="like page" id="do_like" value="' . $page_id . '">
			<i class="fa fa-thumbs-up f30"></i>
			</a>';

            $data['TotalPageLikes'] = $this->Page_model->countTotalPageLikes($page_id);

        } else {
            $data['status'] = 'false';
        }

        echo json_encode($data);

        exit;

    }

    public function load_post()
    {

        $html = $this->ajax_timeline_post();
        $data = [
            'html' => $html,
            'id'   => ($html == "") ? '0' : '1',
        ];

        echo json_encode($data);

        exit;

    }

    public function ajax_timeline_post()
    {

        $start_from = isset($_GET['s']) ? $_GET['s'] : 0;
        $result     = $this->Post_model->getPageTimelinePost($_GET['u'], $start_from);
        $html       = '';

        for ($i = 0; $i < count($result); $i++) {
            $html .= $this->load->view('user/post/post_single', ['result' => $result[$i]], true);
        }

        return $html;
    }

    public function checkNewMessages()
    {

        $data = [];

        if (isset($_GET['uid']) && isset($_GET['last'])) {

            $last = $_GET['last'];

            if ($this->Post_model->checkPagetimelineNewMessages($_GET['uid'], $last)) {

                $result = $this->Post_model->getPagetimelineNewMessages($_GET['uid'], $last);

                for ($i = 0; $i < count($result); $i++) {

                    $data['post' . $result[$i]['post_id']] = $this->load->view('user/post/post_single', ['result' => $result[$i]], true);

                }

            }

        }

        echo json_encode($data);

        exit;

    }

    public function page_edit($id)
    {

        $data['isPageAdmin'] = $this->Page_model->isAdmin($id);

        if ($data['isPageAdmin'] != true) {
            redirect('/sm/dashboard/view/' . $i);
        }

        $data['result']         = $this->Page_model->getPageById($id);
        $data['TotalPageLikes'] = $this->Page_model->countTotalPageLikes($id);
        $data['category']       = $this->comman_fun->get_table_data('sm_page_category', ['status' => 'Active']);

        $this->template->data  = $data;
        $this->template->title = 'Login';
        $this->template->view  = 'user/page/page_edit';
        $this->load->view('user/layout_page');

    }

    public function mypages()
    {
        $data['myPages']       = $this->Page_model->getMyPages();
        $this->template->data  = $data;
        $this->template->title = 'Login';
        $this->template->view  = 'user/page/my_pages';
        $this->load->view('user/layout');

    }
    public function likedpages()
    {
        $data['MemberLikedPages'] = $this->Page_model->getMemberLikedPages(user_session('usercode'));
        $this->template->data     = $data;
        $this->template->title    = 'Login';
        $this->template->view     = 'user/page/liked_pages';
        $this->load->view('user/layout');
    }

    public function remove_cover_photo($page_id)
    {
        $record = $this->comman_fun->get_table_data('social_page_group', ['id' => $page_id, 'type' => 'page', 'created_by' => user_session('usercode')]);

        if ($record[0]['cover_img'] != '') {
            $data['cover_img'] = '';
            $this->comman_fun->update($data, 'social_page_group', ['id' => $page_id, 'type' => 'page']);
            $filename = './upload/post/' . $record[0]['cover_img'];
            unlink($filename);
            $file_path   = thumb('g_cover.jpg', 0, 0);
            $return_data = [
                'status'    => 'true',
                'file_path' => $file_path,
            ];
            echo json_encode($return_data);
        } else {
            echo json_encode(['status' => 'false', 'msg' => 'Something went wrong...!!!']);
        }

    }

    public function remove_profile_photo($page_id)
    {
        $record = $this->comman_fun->get_table_data('social_page_group', ['id' => $page_id, 'type' => 'page', 'created_by' => user_session('usercode')]);

        if ($record[0]['profile_img'] != '') {
            $data['profile_img'] = '';
            $this->comman_fun->update($data, 'social_page_group', ['id' => $page_id, 'type' => 'page']);
            $filename = './upload/post/' . $record[0]['profile_img'];
            unlink($filename);
            $file_path   = thumb('g_profile.jpg', 0, 0);
            $return_data = [
                'status'    => 'true',
                'file_path' => $file_path,
            ];
            echo json_encode($return_data);
        } else {
            echo json_encode(['status' => 'false', 'msg' => 'Something went wrong...!!!']);
        }

    }
}
