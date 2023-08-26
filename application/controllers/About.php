<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


    }

    public function privacy()
    {
        $this->load->view('web/privacy', $data);



    }

    public function terms()
    {

        $this->load->view('web/terms', $data);



    }





}
