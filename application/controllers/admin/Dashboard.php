<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_admin()) {
            header('Location: ' . file_path() . 'login');
            exit;
        }
        $this->load->model('Member_model');
    }
    public function index()
    {
        $this->view();
    }
    public function view()
    {
        $page_info['menu_id'] = 'menu-dashboard';
        $data['result1'] = $this->Member_model->new_member_joining();
        $page_info['page_title'] = 'Dashboard';
        $this->load->view('admin/comman/topheader');
        $this->load->view('admin/comman/header_admin', $page_info);
        $this->load->view('admin/dashboard_view', $data);
        $this->load->view('admin/comman/footer_admin');
    }
    public function members()
    {
        $page_info['menu_id'] = 'menu-members';
        $data['list'] = $this->comman_fun->get_table_data('membermaster');
        $page_info['page_title'] = 'Member';
        $this->load->view('admin/comman/topheader');
        $this->load->view('admin/comman/header_admin', $page_info);
        $this->load->view('admin/member_view', $data);
        $this->load->view('admin/comman/footer_admin');
    }
    public function member($eid)
    {
        $page_info['menu_id'] = 'menu-members';
        $panel = 'profile';
        $data['panel'] = $panel;
        $data['member'] = $this->Member_model->get_member_by_id($eid);
        $data['ref'] = $this->Member_model->get_member_by_id($data['member']['referralid']);
        $page_info['page_title'] = 'Member Profile';
        $this->load->view('admin/comman/topheader');
        $this->load->view('admin/comman/header_admin', $page_info);
        $this->load->view('admin/member_profile', $data);
        $this->load->view('admin/comman/footer_admin');
    }
    public function profile_edit($eid)
    {
        $data['result'] = $this->Member_model->get_member_by_id($eid);
        $page_info['page_title'] = 'Update Member Profile';
        $page_info['menu_id'] = 'menu-members';
        $this->load->view('admin/comman/topheader');
        $this->load->view('admin/comman/header_admin', $page_info);
        $this->load->view('admin/member_profile_edit', $data);
        $this->load->view('admin/comman/footer_admin');
    }
    public function profile_edit_insert()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('usercode', 'Usercode', 'required');
            $this->form_validation->set_rules('emailid', 'Email Id', 'required|trim|callback_check_emailid');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|callback_check_username');
            if ($this->form_validation->run() === false) {
                $this->profile_edit($_POST['usercode']);
            } else {
                $this->_profile_edit_insert();
                $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Profile Update Successfully.....'));
                header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/member/' . $_POST['usercode']);
                exit;
            }
        }
    }
    protected function _profile_edit_insert()
    {
        $data = array();
        $data['emailid'] = $_POST['emailid'];
        $data['username'] = $_POST['username'];
        $data['mobileno'] = $_POST['mobileno'];
        $data['skype'] = $_POST['skype'];
        $this->comman_fun->update($data, 'membermaster', array('usercode' => $_POST['usercode']));
        $data = false;
    }
    public function check_emailid()
    {
        if ($this->comman_fun->check_record('membermaster', array('usercode !=' => $_POST['usercode'], 'emailid' => $_POST['emailid']))) {
            $this->form_validation->set_message('check_emailid', 'Email Id "' . $_POST['emailid'] . '" is already exist');
            return false;
        }
        return true;
    }
    public function check_username()
    {
        if ($this->comman_fun->check_record('membermaster', array('usercode !=' => $_POST['usercode'], 'username' => $_POST['username']))) {
            $this->form_validation->set_message('check_username', 'Username "' . $_POST['username'] . '" is already exist');
            return false;
        }
        return true;
    }
    public function disable_2fa($member_id)
    {
        $data = array('usercode' => $member_id);
        $this->comman_fun->addItem($data, 'authentication');
        $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Disable Two Factor Authentication Successfully'));
        header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/member/' . $member_id);
        exit;
    }
    public function enable_2fa($member_id)
    {
        $this->comman_fun->delete('authentication', array('usercode' => $member_id));
        $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Enable Two Factor Authentication Successfully'));
        header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/member/' . $member_id);
        exit;
    }
    public function unblock($member_id)
    {
        $this->comman_fun->delete('member_block', array('usercode' => $member_id));
        $data = array();
        $data['is_block'] = 0;
        $this->comman_fun->update($data, 'membermaster', array('usercode' => $member_id));
        $data = false;
        $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Member Unblock Successfully'));
        header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/member/' . $member_id);
        exit;
    }
    //
    public function block($member_id)
    {
        $data = array('usercode' => $member_id, 'status' => 'Active', 'create_date' => date('Y-m-d h:i:s'));
        $this->comman_fun->addItem($data, 'member_block');
        $data = false;
        $data_update = array();
        $data_update['is_block'] = 1;
        $this->comman_fun->update($data_update, 'membermaster', array('usercode' => $member_id));
        $data_update = false;
        $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Member block Successfully'));
        header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/member/' . $member_id);
        exit;
    }
    public function verify_email_id($member_id)
    {
        $data = array();
        $data['email_verify'] = 'Y';
        $this->comman_fun->update($data, 'membermaster', array('usercode' => $member_id));
        $data = false;
        $this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Member Verify Email Successfully'));
        header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/member/' . $member_id);
        exit;
    }
}
