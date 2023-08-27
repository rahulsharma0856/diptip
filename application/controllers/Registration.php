<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Registration extends MY_Controller
{
    public function __construct()
    {
        header('X-Frame-Options: DENY');
        parent::__construct();
        $this->load->model('Member_model', '', true);
        $this->load->model('Email_model', '', true);
    }

    public function view($eid = '')
    {

        if ($eid != '') {
            $data['user'] = $this->db->select('*')
                ->where('username', $eid)
                ->limit(1)->get('membermaster')->result_array();

        }

        $this->load->view('page/registration_form', $data);
    }

    public function check()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('fname', 'First Name', 'required|trim|min_length[3]|max_length[20]', ['min_length' => 'First Name is too short', 'max_length' => 'First Name is too long']);
            $this->form_validation->set_rules('lname', 'Last Name', 'required|trim|min_length[3]|max_length[20]', ['min_length' => 'Last Name is too short', 'max_length' => 'Last Name is too long']);
            $this->form_validation->set_rules('emailid', 'emailid', 'required|trim|valid_email|is_unique[membermaster.emailid]', ['is_unique' => 'This Email Address is already Registered. Please use a different Email.']);
            $this->form_validation->set_rules('username', 'username', 'required|callback_check_valid_username');
            $this->form_validation->set_rules('password', 'password', 'required|trim|callback_check_valid_password');
            $this->form_validation->set_rules('con_password', 'con_password', 'required|trim|matches[password]');
            $this->form_validation->set_rules('dob', 'dob', 'required|callback_check_valid_dob');
            $this->form_validation->set_rules('gender', 'gender', 'required|in_list[M,F,O]');
            $this->form_validation->set_rules('agree_terms_condi', 'agree_terms_condi', 'required', ['required' => 'Please indicate that you accept the Terms and Conditions']);
            // $this->form_validation->set_rules('ref_key', 'Referral', 'required|trim|callback_check_referralid');
            if ($this->form_validation->run() === false) {
                // var_dump("HI Vir");exit();
                $this->view($this->input->post('ref_key'));
            } else {
                $this->_check();
                $this->session->set_flashdata('msg_show', 'Registration Successful. Please we have sent a verification link to your mail.<br> Kindly check and verify your email address. Thank you.');
                redirect('/registration/success', 'refresh');
            }
        }
    }

    public function success()
    {
        if ($this->session->flashdata('msg_show') != '') {
            $this->load->view('page/registration_success', $data);
        } else {
            header('Location: ' . base_url() . '');
            exit;
        }
    }

    public function check_referralid()
    {
        if ($this->db->select('*')->where('username', $this->input->post('ref_key'))->limit(1)->get('membermaster')->row()) {
            return true;
        } else {
            $this->form_validation->set_message('check_referralid', 'Your Referral Id is Invalid');
            return false;
        }
    }

    public function check_google_validate_captcha()
    {
        $google_captcha  = $this->input->post('g-recaptcha-response');
        $google_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf1An4UAAAAAOeHGxXqwBK6gX47tWv7uh_9FANq&response=" . $google_captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($google_response . 'success' == false) {
            $this->form_validation->set_message('check_google_validate_captcha', 'Please check the the captcha form');
            return false;
        } else {
            return true;
        }
    }

    public function check_valid_password()
    {
        if ( ! is_valid_password_pattern($this->input->post('password'))) {
            $this->form_validation->set_message('check_valid_password', 'Password must contain minimum 9 characters and maximum 30 characters, at least one uppercase letter, one lowercase letter and one number and one special character');
            return false;
        }
        return true;
    }

    public function check_valid_dob()
    {
        $legalAge       = strtotime(date('Y-m-d', strtotime('-18 year')));
        $selected_date  = strtotime($this->input->post('dob'));
        $legalAge1      = date('d-m-Y', strtotime(date('Y-m-d', strtotime('-18 year'))));
        $selected_date1 = date('d-m-Y', strtotime($this->input->post('dob')));
        if ($selected_date > $legalAge) {
            $this->form_validation->set_message('check_valid_dob', 'Age must be at least 18 years');
            return false;
        }
        $mindate = strtotime(date('Y-m-d', strtotime('-100 year')));
        if ($selected_date < $mindate) {
            $this->form_validation->set_message('check_valid_dob', 'Select Validate Date');
            return false;
        }
        return true;
    }

    public function check_valid_username()
    {
        $value = $this->input->post('username');
        $check = $this->comman_fun->check_record('membermaster', ['username' => $value]);
        if ($check) {
            $this->form_validation->set_message('check_valid_username', 'This Username is already taken. Please use a different Username.');
            return false;
        }
        if (strlen($value) < 5 || strlen($value) > 30) {
            $this->form_validation->set_message('check_valid_username', 'Minimum Length : 5 And Maximum Length : 30');
            return false;
        }
        if (preg_match('/\s/', $value)) {
            $this->form_validation->set_message('check_valid_username', 'Username Whitespace Not Allow');
            return false;
        }
        return true;
    }

    protected function _check()
    {
        $result           = $this->db->select('*')->where('username', $this->input->post('ref_key'))->limit(1)->get('membermaster')->row();
        $data             = [];
        $data['fname']    = $this->input->post('fname');
        $data['lname']    = $this->input->post('lname');
        $data['fullname'] = $this->input->post('fname') . ' ' . $this->input->post('lname');
        $data['username'] = $this->input->post('username');
        $data['password'] = pass_encrypt($this->input->post('password'));
        $data['emailid']  = $this->input->post('emailid');
        // $data['referralid'] = $result->usercode;
        $data['status']       = 'Active';
        $data['gender']       = $this->input->post('gender');
        $data['dob']          = date('Y-m-d', strtotime($this->input->post('dob')));
        $data['email_verify'] = 'N';
        $data['create_date']  = date('Y-m-d H:i:s');
        // var_dump($data);exit();
        $member_id = $this->comman_fun->addItem(($data), 'membermaster');
        $this->Email_model->registration_email($member_id);
    }

    private function free_position($member_id)
    {
        $this->Garden_model->get_new_position($member_id, 1, 'Free On Registration');
    }

}
