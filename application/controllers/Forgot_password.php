<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Forgot_password extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('Email_model');
        $this->load->model('Comman_model');
    }
    function view() {
        $this->index();
    }
    public function index($arr = NULL) {
        $this->load->view('page/forgot_password_view', $data);
    }
    function check() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('emailid', 'Email Id', 'required|trim|xss_clean|valid_email|callback_check_emailid');
            if ($this->form_validation->run() === FALSE) {
                $this->index();
            } else {
                $result = $this->comman_fun->get_table_data('membermaster', array('emailid' => filter_data($this->input->post('emailid'))));
                $verification_code = $this->Email_model->forgot_password($result[0]['usercode']);
                $data = array('usercode' => $result[0]['usercode'], 'verification_code' => $verification_code, 'time_dt' => time());
                $this->comman_fun->addItem(filter_data($data), 'social_verification');
                $data = false;
                $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Reset Password link sent to your Registered Email Address'));
                header('Location: ' . file_path() . $this->uri->rsegment(1) . '/');
                exit;
            }
        } else {
            $this->index();
        }
    }
    function reset_password($key = "") {
        if ($key != "") {
            $result = $this->comman_fun->get_table_data('social_verification', array('verification_code' => filter_data($key)));
            if (isset($result[0])) {
                $data = array();
                $data['reset_code'] = $key;
                $this->load->view('page/reset_password', $data);
            }
        }
    }
    function check_emailid() {
        if (!$this->comman_fun->check_record('membermaster', array('emailid' => filter_data($this->input->post('emailid', TRUE)), 'status' => 'Active'))) {
            $this->form_validation->set_message('check_emailid', 'This Email Address is not registered with us, Please enter the Email Address associated with your Vitae.co Account');
            return false;
        }
        return true;
    }
    function reset_rassword_submit() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('reset_code', 'Code', 'required|callback_check_valid_request');
            $this->form_validation->set_rules('password', 'password', 'required|trim|callback_check_valid_password');
            $this->form_validation->set_rules('con_password', 'con_password', 'required|trim|min_length[9]|max_length[30]|matches[password]');
            if ($this->form_validation->run() === FALSE) {
                $this->reset_password($this->input->post('reset_code'));
            } else {
                $this->_reset_rassword_submit();
                redirect('user/login/view', 'refresh');
            }
        }
    }
    private function _reset_rassword_submit() {
        $result = $this->comman_fun->get_table_data('social_verification', array('verification_code' => filter_data($this->input->post('reset_code'))));
        $data = array('password' => pass_encrypt($this->input->post('password')), 'verification_code' => '', 'is_account_lock' => '0',);
        $this->comman_fun->update(filter_data($data), 'membermaster', array('usercode' => $result[0]['usercode']));
        $data = false;
        $this->comman_fun->update(array('invaild_password_clear' => '1'), 'web_login_info', array('usercode' => $result[0]['usercode']));
    }
    function check_valid_request() {
        $result = $this->comman_fun->get_table_data('social_verification', array('verification_code' => filter_data($this->input->post('reset_code'))));
        if (!isset($result[0])) {
            $this->form_validation->set_message('check_valid_request', 'Invalid Request');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function check_valid_password() {
        if (!is_valid_password_pattern($this->input->post('password'))) {
            $this->form_validation->set_message('check_valid_password', 'Password must contain minimum 9 characters and maximum 30 characters, at least one uppercase letter, one lowercase letter and one number and one special character');
            return FALSE;
        }
        return TRUE;
    }
}
