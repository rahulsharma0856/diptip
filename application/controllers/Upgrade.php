<?php

if ( ! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Upgrade extends App
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Member_module', '', true);

        date_default_timezone_set('Asia/Calcutta');

    }

    public function index()
    {

        $data['mode'] = 'add';

        $this->load->view('user/home/comman/topheader');

        $this->load->view('user/home/comman/header');

        $this->load->view('user/upgrade', $data);

        $this->load->view('user/home/comman/footer');

    }

}
