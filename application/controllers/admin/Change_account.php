<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Change_account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('smr_superadmin')) {
            header('Location: ' . file_path() . 'login');
            exit;
        }
        $this->load->model('Member_model');
    }

    public function member($eid)
    {
        if ($this->session->userdata('smr_superadmin')) {
            $result     = $this->comman_fun->get_table_data('membermaster', ['usercode' => $eid]);
            $admin_code = $this->session->userdata['smr_web_login']['usercode'];
            if (isset($result[0])) {
                $this->session->set_userdata('smr_web_login', false);
                $this->session->set_userdata('smr_web_login_admin', false);
                $sess_array             = [];
                $sess_array['name']     = $result[0]['fname'] . ' ' . $result[0]['lname'];
                $sess_array['usercode'] = $result[0]['usercode'];
                $sess_array['username'] = $result[0]['username'];
                $sess_array['ref']      = $result[0]['referralid'];
                $sess_array['emailid']  = $result[0]['emailid'];
                $sess_array['ref_key']  = $result[0]['ref_key'];
                if ($result[0]['profile_img'] != '') {
                    $sess_array['profile_pic'] = $result[0]['profile_img'];
                } else {
                    $sess_array['profile_pic'] = 'profile.png';
                }
                $sess_array['login']             = 'true';
                $sess_array['isProfileComplate'] = true;
                $sess_array['is_paid']           = $this->Member_model->is_paid($result[0]['usercode']);
                $sess_array['next_payment']      = $result[0]['upgrade_payment_dt'];
                $this->session->set_userdata('smr_web_login', $sess_array);
                $info               = [];
                $info['login']      = true;
                $info['change']     = true;
                $info['admin_code'] = $admin_code;
                $this->session->set_userdata('smr_superadmin', $info);
                header('Location: ' . file_path('user') . 'dashboard/view/');
                exit;
            }
        }
    }

    public function admin()
    {
        if ($this->session->userdata('smr_superadmin')) {
            if ($this->session->userdata['smr_superadmin']['admin_code'] != '') {
                $uid = $this->session->userdata['smr_superadmin']['admin_code'];
            } else {
                $uid = $this->session->userdata['smr_web_login']['usercode'];
            }
            $result = $this->comman_fun->get_table_data('membermaster', ['usercode' => '' . $uid . '']);
            if (isset($result[0])) {
                $this->session->set_userdata('smr_web_login', false);
                $sess_array                      = [];
                $sess_array['name']              = $result[0]['fname'] . ' ' . $result[0]['lname'];
                $sess_array['usercode']          = $result[0]['usercode'];
                $sess_array['username']          = $result[0]['username'];
                $sess_array['ref']               = $result[0]['referralid'];
                $sess_array['ref_key']           = $result[0]['ref_key'];
                $sess_array['isProfileComplate'] = true;
                if ($result[0]['profile_img'] != '') {
                    $sess_array['profile_pic'] = $result[0]['profile_img'];
                } else {
                    $sess_array['profile_pic'] = 'profile.png';
                }
                $sess_array['login']        = 'true';
                $sess_array['is_paid']      = $this->Member_model->is_paid($result[0]['usercode']);
                $sess_array['next_payment'] = $result[0]['upgrade_payment_dt'];
                $this->session->set_userdata('smr_web_login', $sess_array);
                $info          = [];
                $info['login'] = 'true';
                $info['admin'] = 'true';
                $this->session->set_userdata('smr_web_login_admin', $info);
                $info          = [];
                $info['login'] = true;
                $this->session->set_userdata('smr_superadmin', $info);
                header('Location: ' . file_path('admin') . 'dashboard/view/');
                exit;
            }
        }
    }

}
