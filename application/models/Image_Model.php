<?php

class Image_Model extends App_model
{
    public function __construct()
    {

        $this->load->library('image_lib');

        $this->load->library('upload');

    }
}
