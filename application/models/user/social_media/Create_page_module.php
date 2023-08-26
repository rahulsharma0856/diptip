<?php

class Create_page_module extends App_model
{
    public function get_created_page_list($usercode)
    {

        $this -> db -> select('page_name');
        $this -> db -> from('sm_user_pages');
        $this -> db -> where('usercode', $usercode);
        $this -> db -> where('status', 'Active');
        $this -> db -> order_by('id', 'DESC');
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;

    }


    public function getPageById()
    {

    }


    public function get_created_page_data($usercode)
    {

        $this -> db -> select('*');
        $this -> db -> from('sm_user_pages');
        $this -> db -> where('usercode', $usercode);
        $this -> db -> where('status!=', 'Delete');
        $this -> db -> order_by('id', 'DESC');
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;

    }

    public function get_page_details($pageid, $usercode)
    {
        $this -> db -> select('*');
        $this -> db -> from('sm_user_pages');
        $this -> db -> where('id', $pageid);
        $this -> db -> where('usercode', $usercode);
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;

    }

}
