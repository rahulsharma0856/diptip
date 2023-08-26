<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Chat extends App
{
    public function __construct()
    {

        parent::__construct();

        $this->load->library('image_lib');

        $this->load->library('upload');

        $this->load->model('user/Post_model');

        $this->load->model('user/Page_model');

        $this->load->model('user/Group_model');

        $this->load->model('user/Chat_model');

        $this->load->model('user/Notification_module');



        date_default_timezone_set('Asia/Calcutta');

    }



    public function open_chat_box($uid = null)
    {

        $data['member'] = $this->Chat_model->isValidMember($uid);

        $ajax  = array();

        if(isset($data['member']['usercode']) && $uid != user_session('usercode')) {

            $this->Chat_model->readParticularMemberMessage($uid);

            $data['last_msg'] = $this->Chat_model->get_msg_on_load($uid);

            $ajax['box'] = $this->load->view('user/chat/open_chat_box', $data, true);

            echo json_encode($ajax);

            exit;
        }

        echo json_encode($ajax);

        exit;

    }

    public function add_message()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('uid', 'Friend', 'callback_check_valid_member');

            $this->form_validation->set_rules('message', 'Message', 'required');

            if ($this->form_validation->run() === false) {

                $data['text']   =  validation_errors();

                $data['status'] =  'false';

                echo json_encode($data);

                exit;

            } else {

                $id 				= 	$this->_add_message();

                $data['html'] 		=  	$this->load_single_msg($id);

                $data['msg_id'] 	= 	'chat-message-'.$id;

                $data['status'] 	=  'true';

                echo json_encode($data);

                exit;

            }

        }

    }




    private function _add_message()
    {

        $data = array(

            'user_1' => user_session('usercode'),

            'user_2' => $_POST['id'],

            'msg' => $_POST['message'],

            'type' => 'message'
        );


        $id =  $this->Chat_model->add_message($data);

        return $id;

    }



    public function check_valid_member()
    {

        $result = $this->Chat_model->isValidMember($_POST['id']);

        if(!isset($result['usercode'])) {

            $this->form_validation->set_message('check_valid_member', 'Invaild Request');

            return false;

        }

        return true;

    }


    public function load_single_msg($id = null)
    {

        $data['result'] = $this -> Chat_model -> get_msg_by_id($id);

        $html 	= $this->load->view('user/chat/single_msg', $data, true);

        return $html;

    }

    public function load_more_chat()
    {

        $uid = $_GET['id'];

        $last_id = $_GET['last_id'];

        $data['result'] = $this->Chat_model->getOldChat($uid, $last_id);

        $html = '';

        $html = $this->load->view('user/chat/single_msg', $data, true);


        echo json_encode(
            array(

                'html' => $html,

                'total' => count($data['result'])
            )
        );

        exit;

    }



    public function checkNewMessage()
    {

        $friend   = $_GET['friend'];

        $result = $this->Chat_model->checkNewMessage($_GET['friend']);

        $json = array();

        for($i = 0;$i < count($result);$i++) {

            $json[] = array(

                'window' => $result[$i]['window'],

                'html' => $this->load->view('user/chat/single_msg2', array('result' => $result[$i]), true),

                'id' => $result[$i]['id']

            );

            if($result[$i]['user_2'] == user_session('usercode')) {

                $this->Chat_model->update_chat_status($result[$i]['id']);

            }



        }

        $unread_msg 			=  $this->Chat_model->count_receive_unread_msg();

        $UnreadCurrentMessage 	=  $this->Chat_model->UnreadCurrentMessage();


        echo json_encode(
            array(

                'message' => $json,

                'unreadMessge' => $UnreadCurrentMessage,

                'count_recive_unread_msg' => ($unread_msg > 0) ? '<div class="label-avatar bg-yellow-noti">'.$unread_msg.'</div>' : ""

            )
        );

        exit;

    }


    public function message_notification()
    {

        $data['result'] =  $this->Chat_model->get_last_message();

        //var_dump($data['result']);exit;
        if(count($data['result']) >  1) {

            echo  $this->load->view('user/chat/message_notification', $data, true);

        } else {
            echo '<p style="    text-align: center;padding: 5px;font-weight: bold;margin-bottom:0px;line-height: 35px;">No new message</p>';

        }

        $this->Chat_model->all_message_read();

    }

    public function chat_message_delete()
    {

        $result = $this->Chat_model->get_msg_by_id($_GET['id']);

        $return  = array();

        if(isset($result[0])) {

            if($result[0]['user_1'] == user_session('usercode')) {

                $data['delete_u1'] = user_session('usercode');

            } else {

                $data['delete_u2'] = user_session('usercode');

            }

            $this->comman_fun->update($data, 'social_post_chat', array('id' => $_GET['id']));

            $return = array('id' => $_GET['id']);

        }

        echo json_encode($return);

        exit;

    }

    public function chat_message_delete_all()
    {

        $result = $this->Chat_model->getAllMessageBYMember($_GET['id']);

        $return  = array();

        for($i = 0;$i < count($result);$i++) {

            if($result[$i]['user_1'] == user_session('usercode')) {

                $data['delete_u1'] = user_session('usercode');

            } else {

                $data['delete_u2'] = user_session('usercode');

            }

            $this->comman_fun->update($data, 'social_post_chat', array('id' => $result[$i]['id']));

            $return = array('id' => $_GET['id']);

        }


        echo json_encode($return);

        exit;

    }

    public function add_image()
    {


        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('uid', 'Friend', 'callback_check_valid_member');

            if ($this->form_validation->run() === false) {

                $data['text']   =  validation_errors();

                $data['status'] =  'false';

                echo json_encode($data);

                exit;

            } else {

                $id 				= 	$this->_add_image();

                if ($id === '-1') {
                    $data['text']   =  validation_errors('', '');

                    $data['status'] =  'false';

                    echo json_encode($data);

                    exit;
                }

                $data['html'] 		=  	$this->load_single_msg($id);

                $data['msg_id'] 	= 	'chat-message-'.$id;

                $data['status'] 	=  'true';

                echo json_encode($data);

                exit;

            }

        }


    }



    private function _add_image()
    {

        $this->handle_upload('chat_img', user_session('usercode'));

        if (isset($_POST['chat_img'])) {

            if ($_POST['chat_img'] === 'ERROR') {
                return '-1';
            }

            $data = array(

                'user_1' => user_session('usercode'),

                'user_2' => $_POST['id'],

                'msg' => '',

                'img_path' => $_POST['chat_img'],

                'type' => 'image'

            );


            $id =  $this->Chat_model->add_message($data);

            return $id;

        }

    }


    // Handles an image upload
    public function handle_upload($file_id, $prefix = null)
    {

        if (isset($_FILES[$file_id]) && !empty($_FILES[$file_id]['name'])) {

            $config = array();

            $config['upload_path'] 				= 	'./upload/chat';

            $config['allowed_types'] 			= 	'jpg|jpeg|gif|png|bmp';

            $config['max_size'] = '1000';
            $config['max_filename'] = '128';

            $config['max_width'] = '1660';
            $config['max_height'] = '1300';

            $config['min_width'] = '16';
            $config['min_height'] = '16';

            $config['overwrite']     			= 	true;

            $config['remove_spaces'] 			= 	true;

            $config['quality'] 					= 	'70';

            $_FILES['userfile']['name'] 		= 	$_FILES[$file_id]['name'];

            $_FILES['userfile']['type'] 		= 	$_FILES[$file_id]['type'];

            $_FILES['userfile']['tmp_name']		= 	$_FILES[$file_id]['tmp_name'];

            $_FILES['userfile']['error']		= 	$_FILES[$file_id]['error'];

            $_FILES['userfile']['size']			= 	$_FILES[$file_id]['size'];

            // Get temp rand name..
            $rand = md5(uniqid(rand(), true));
            $fileName							=	$prefix.'_'.$rand;
            $fileName 							= 	str_replace(" ", "", $fileName);
            $config['file_name'] 				= 	$fileName;

            $this->upload->display_errors('', '');

            $this->upload->initialize($config);

            // Do upload
            if($this->upload->do_upload()) {
                $fullPath = $this->upload->data('full_path');
                $filePath = $this->upload->data('file_path');
                $fileExt = $this->upload->data('file_ext');

                // Get the hash of the file
                $hashName = substr(hash_file('sha256', $fullPath), 64 - 34, 34);

                // Rename temp file with hash
                rename($fullPath, $filePath . $hashName . $fileExt);

                // Replace new filename and return upload data
                $upload_data = str_replace($fileName, $hashName, $this->upload->data());

                $_POST[$file_id] =  $upload_data['file_name'];

                return true;
            }

            $this->form_validation->add_to_error_array($file_id, $this->upload->display_errors('Upload Image Error:  ', ' The file "' . $_FILES[$file_id]['name'] . '" is not valid.  Max-Dimension: 1660px by 1300px. Max-Size: 1MB.'));

            $_POST[$file_id] = 'ERROR';
        }

        return false;

    }

    ////




}
