<?php

class Smileys extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // $this->load->helper('smiley');
        //    $this->load->library('table');
        //
        //    $image_array = get_clickable_smileys(base_url().'smileys/', 'comments');
        //
        //    $col_array = $this->table->make_columns($image_array, 8);
        //
        //    $data['smiley_table'] = $this->table->generate($col_array);

        $data = [];
        $this->load->view('web/smiley_view', $data);
    }


    public function insert()
    {
        $this->db->simple_query('SET NAMES \'utf8mb4\'');
        $data['post_text'] = $_POST['emoji'];
        $post_code = $this->comman_fun->addItem($data, 'social_posts');
    }

}
