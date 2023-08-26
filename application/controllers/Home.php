<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

    }
    public function index($eid = 'admin', $r = null)
    {


        $main_path = str_replace('/sm/index.php/', '', file_path());

        header('Location: '.$main_path);

        exit;


    }

}
