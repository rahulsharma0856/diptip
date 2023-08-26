<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Email_verification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('Email_model');
    }
    //varification Link Click FuN//
    public function verify($eid)
    {
        $result = $this->comman_fun->get_table_data('email_verification', array('v_key' => $eid, 'status' => 'N'));
        if (isset($result[0])) {
            //User Verify//
            $data = array('email_verify' => 'Y');
            $this->comman_fun->update($data, 'membermaster', array('usercode' => $result[0]['usercode']));
            $data = false;
            ////Update record////
            $data = array('status' => 'Y');
            $this->comman_fun->update($data, 'email_verification', array('verification_code' => $result[0]['verification_code']));
            $data = false;
            $member = $this->comman_fun->get_table_data('membermaster', array('usercode' => $result[0]['usercode']));
            $this->Email_model->after_varification_email_verify($member[0]['usercode']);
            $data['title'] = 'Email Verified Successfully';
            $data['msg'] = '<p>Hi, ' . $member[0]['fname'] . ' ' . $member[0]['lname'] . ' <br>  Thank you for verifying your Account,<br /> Welcome to Vitae.co .<br />Your Account is now Active and you can login to your Vitae.co Back Office.</p>';
            $data['msg'] .= '<p><a class="txt_red" href="' . file_path() . 'login/">Login</a></p>';
            $this->load->view('page/comman_msg', $data);
        } else {
            header('Location: ' . base_url() . '');
            exit;
        }
    }
    //****Manually Click Email Varificatin Link (After Succes login)*****//
    public function send_varification()
    {
        if ($this->session->userdata['smr_email_verify']) {
            $data['result'] = $this->comman_fun->get_table_data('membermaster', array('usercode' => $this->session->userdata['smr_email_verify']['usercode']));
            $this->Email_model->send_email_varification($this->session->userdata['smr_email_verify']['usercode']);
            $data['title'] = 'Email Verification';
            $data['msg'] = '<p>Hi, ' . $data['result'][0]['fname'] . ' ' . $data['result'][0]['lname'] . ' <br> Your email varification link send  to your email id "<i>' . $data['result'][0]['emailid'] . '</i>" login your email account end verify your account</p><p><a href="' . file_path() . 'login/view">login</a></p>';
            $this->load->view('page/comman_msg', $data);
            $this->session->sess_destroy();
        } else {
            header('Location: ' . file_path() . 'login/view/');
            exit;
        }
    }
    public function test_email()
    {
        $this->Email_model->test_email();
        echo '<br> RUN';
    }
    //****Send Email After Varification*****//
    protected function _after_varification($member)
    {
        $text = 'Hi. ' . $member[0]['fname'] . ' ' . $member[0]['lname'] . '<br><br>
		
		Thank you for verifying your Account,<br>
		
		Welcome to Vitae.co .<br>
		
		Your Account is now Active and you can login to your Vitae.co Back Office.';
        $arr = array('subject' => 'Email Verified Successfully', 'msg' => $text);
        $msg = email_tmp($arr);
        $this->email->to($member[0]['emailid']);
        $this->email->from(EMAIL_FROM);
        $this->email->subject('Thank you for email verification');
        $this->email->message($msg);
        $this->email->send();
    }
}
