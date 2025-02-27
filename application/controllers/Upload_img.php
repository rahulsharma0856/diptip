<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Upload_img extends App
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('image_lib');

        $this->load->library('upload');

        $this->load->model('Member_module');

        $this->load->model('Comman_c_module');

        date_default_timezone_set('Asia/Calcutta');

    }

    //Cover Image Submit Event
    public function upload_cover_image()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_error_delimiters('', '');

            $this->form_validation->set_rules('Id', 'ID', 'callback_check_upload_cover_image_size');

            $this->form_validation->set_rules('cover_image', 'Cover Image', 'callback_check_upload_cover_image');

            if ($this->form_validation->run() === false) {

                $data = [

                    'status' => 'false',

                    'msg'    => validation_errors(),

                ];

                echo json_encode($data);

                exit;

            } else {

                $file_path = $this->_upload_cover_image();

                $data = [

                    'status'    => 'true',

                    'file_path' => $file_path,

                ];

                echo json_encode($data);

                exit;

            }
        }

    }

    //Cover Image Insert Event
    private function _upload_cover_image()
    {

        $result = $this->Member_module->get_member_by_id(user_session('usercode'));

        $data = [

            'cover_img' => $_POST['cover_image'],

        ];

        $this->comman_fun->update($data, 'membermaster', ['usercode' => user_session('usercode')]);

        $filename = './upload/post/' . $result['cover_img'];

        unlink($filename);

        return thumb($_POST['cover_image'], 0, 0);
    }

    //Cover Image Size Check
    public function check_upload_cover_image_size()
    {

        if (isset($_FILES['cover_image']['name'])) {

            $image_info = getimagesize($_FILES["cover_image"]["tmp_name"]);

            $image_width = $image_info[0];

            $image_height = $image_info[1];

            if ($image_width > 1368 || $image_height > 402) {

                $this->form_validation->set_message('check_upload_cover_image_size', 'Error Image too Large:  Please Upload Profile Cover Image with Min Size of 1000px by 200px and Max Size of 1368px by 402px.  Recommended: 1268px by 300px');

                return false;

            } elseif ($image_width < 1000 || $image_height < 200) {

                $this->form_validation->set_message('check_upload_cover_image_size', 'Error Image too Small:  Please Upload Profile Cover Image with Min Size of 1000px by 200px and Max Size of 1368px by 402px.  Recommended: 1268px by 300px');

                return false;

            } else {

                return true;

            }

        }

        $this->form_validation->set_message('check_upload_cover_image_size', 'File Not Selected');

        return false;

    }

    //Cover Image Validation
    public function check_upload_cover_image()
    {

        $return = $this->upload_image('cover_image', 'member_cover');

        if ($return['status'] == true) {

            return true;

        } else {

            $this->form_validation->set_message('check_upload_cover_image', $return['msg']);

            return false;

        }

    }

    //profile Image Submit Event
    public function upload_profile_image()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_error_delimiters('', '');

            $this->form_validation->set_rules('Id', 'ID', 'callback_check_upload_profile_image_size');

            $this->form_validation->set_rules('cover_image', 'Cover Image', 'callback_check_upload_profile_image');

            if ($this->form_validation->run() === false) {

                $data = [

                    'status' => 'false',

                    'msg'    => validation_errors(),

                ];

                echo json_encode($data);

                thumb($_POST['profile_image'], 250, 250);

                exit;

            } else {

                $file_path = $this->_upload_profile_image();

                $data = [

                    'status'    => 'true',

                    'file_path' => $file_path,

                ];

                echo json_encode($data);

                exit;

            }
        }

    }

    //profile Image Insert Event
    private function _upload_profile_image()
    {

        $result = $this->Member_module->get_member_by_id(user_session('usercode'));

        $data = [

            'profile_img' => $_POST['profile_image'],

        ];

        $this->comman_fun->update($data, 'membermaster', ['usercode' => user_session('usercode')]);

        $filename = './upload/post/' . $result['profile_image'];

        if ($result['profile_img'] != 'profile.png') {

            unlink($filename);

        }

        $session = $this->session->userdata['smr_web_login'];

        $session['profile_img'] = $_POST['profile_image'];

        $this->session->set_userdata('smr_web_login', $session);

        return thumb($_POST['profile_image'], 250, 250);
    }

    //profile Image Size Check
    public function check_upload_profile_image_size()
    {

        if (isset($_FILES['profile_image']['name'])) {

            $image_info = getimagesize($_FILES["profile_image"]["tmp_name"]);

            $image_width = $image_info[0];

            $image_height = $image_info[1];

            if ($image_width > 512 || $image_height > 512) {

                $this->form_validation->set_message('check_upload_profile_image_size', 'Error Image too Large:  Please Upload Profile Image with Min Size of 128px by 128px and Max Size of 512px by 512px');

                return false;

            } elseif ($image_width < 128 || $image_height < 128) {

                $this->form_validation->set_message('check_upload_profile_image_size', 'Error Image too Small:  Please Upload Profile Image with Min Size of 128px by 128px and Max Size of 512px by 512px');

                return false;

            } else {

                return true;

            }

        }

        $this->form_validation->set_message('check_upload_profile_image_size', 'File Not Selected2');

        return false;

    }

    //profile Image Validation
    public function check_upload_profile_image()
    {

        $return = $this->upload_image('profile_image', 'profile_image');

        if ($return['status'] == true) {

            return true;

        } else {

            $this->form_validation->set_message('check_upload_profile_image', $return['msg']);

            return false;

        }

    }

    //Upload Image
    public function upload_image($file_id, $prefix = null)
    {

        if (isset($_FILES[$file_id]) && ! empty($_FILES[$file_id]['name'])) {

            $config = [];

            $config['upload_path'] = './upload/post';

            $config['allowed_types'] = 'jpg|jpeg|gif|png';

            $config['max_size'] = '1000';

            $config['max_width']  = '2000';
            $config['max_height'] = '600';

            $config['min_width']  = '16';
            $config['min_height'] = '16';

            $config['overwrite'] = true;

            $config['remove_spaces'] = true;

            $config['quality'] = '80%';

            $_FILES['userfile']['name'] = $_FILES[$file_id]['name'];

            $_FILES['userfile']['type'] = $_FILES[$file_id]['type'];

            $_FILES['userfile']['tmp_name'] = $_FILES[$file_id]['tmp_name'];

            $_FILES['userfile']['error'] = $_FILES[$file_id]['error'];

            $_FILES['userfile']['size'] = $_FILES[$file_id]['size'];

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

                $_POST[$file_id] = $upload_data['file_name'];

                return ['status' => true];

            } else {

                return ['status' => false, 'msg' => $this->upload->display_errors('', '')];

            }
        }
        return ['status' => false, 'msg' => 'File Not Selected'];
    }

}
