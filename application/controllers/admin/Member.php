<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_logged_admin()) {
            header('Location: ' . file_path() . 'login');
            exit;
        }
        $this->load->model('admin/Admin_model', 'ObjM', true);
        $this->load->model('Member_model');
    }
    public function all()
    {
        $page_info['page_title'] = 'Members';
        $data['sub_title'] = 'Message To Member';
        $page_info['menu_id'] = 'menu-members';
        $this->load->view('admin/comman/topheader');
        $this->load->view('admin/comman/header_admin', $page_info);
        $this->load->view('admin/member_view', $data);
        $this->load->view('admin/comman/footer_admin');
    }
    public function listing()
    {
        $data = $this->ObjM->get_list_all();
        $result = $data['result'];
        $count = $this->ObjM->count_record_all($data['where']);
        $output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $count[0]['tot'], "iTotalDisplayRecords" => '' . $count[0]['tot'] . '', "aaData" => array());
        for ($i = 0;$i < count($result);$i++) {
            $btn = '<a  href="' . file_path('admin/member/view') . $result[$i]['usercode'] . '"><i class="fa fa-eye"></i></a>';
            $row = array($result[$i]['usercode'], $result[$i]['fname'] . ' ' . $result[$i]['lname'], $result[$i]['username'], $result[$i]['emailid'], $result[$i]['create_date'], $btn);
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }
    public function view($eid)
    {
        $panel = 'profile';
        $data['panel'] = $panel;
        $page_info['menu_id'] = 'menu-members';
        $data['member'] = $this->Member_model->get_member_by_id($eid);
        $data['ref'] = $this->Member_model->get_member_by_id($data['member']['referralid']);
        $page_info['page_title'] = 'Member Profile';
        $this->load->view('admin/comman/topheader');
        $this->load->view('admin/comman/header_admin', $page_info);
        $this->load->view('admin/member_profile', $data);
        $this->load->view('admin/comman/footer_admin');
    }
}
