<?php

class Email_module extends App_model
{
    public function get_list_all()
    {
        $aColumns = array( 'membermaster.usercode','membermaster.usercode','membermaster.fname','membermaster.username','membermaster.emailid');

        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
        }


        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0 ; $i < intval($_GET['iSortingCols']) ; $i++) {
                if ($_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true") {
                    $sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i]) ]." ".$_GET['sSortDir_'.$i] .", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        $sWhere = "";
        if ($_GET['sSearch'] != "") {
            $sWhere = "WHERE";
            $filter = 	preg_replace('/\s\s+/', ' ', $_GET['sSearch']);
            $filter	=	explode(" ", $filter);
            if(isset($filter[1])) {
                $sWhere .= '(membermaster.fname="'.$filter[0].'" and membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[1]).'%")';
            } else {
                if (ctype_digit($filter[0])) {
                    $sWhere .= '(membermaster.usercode="'.$this->db->escape($filter[0]).'")';
                } else {
                    $sWhere .= '(membermaster.fname  LIKE "%'.$this->db->escape_like_str($filter[0]).'%" or membermaster.lname  LIKE "%'.$this->db->escape_like_str($filter[0]).'%" or membermaster.username LIKE "%'.$this->db->escape_like_str($filter[0]).'%")';
                }
            }
        }


        $sQuery = 'SELECT membermaster.*
			FROM membermaster 
			
			'.$sWhere.'
			'.$sOrder.'
			'.$sLimit.'';

        $query = $this->db->query($sQuery);
        $the_content = $query->result_array();

        $return['where']	=	$sWhere;
        $return['result']	=	$the_content;

        return $return;
    }

    public function count_record_all($where)
    {
        $sQuery = 'SELECT count(*) as tot FROM membermaster  '.$where.'';
        $query = $this->db->query($sQuery);
        $the_content = $query->result_array();
        return $the_content;
    }

    public function get_send_email()
    {
        $this -> db -> select('email_master.*');
        $this -> db -> select('email_template.template');
        $this -> db -> from('email_master');
        $this -> db -> join('email_template', 'email_template.template_id = email_master.template_id', 'left');
        $this -> db -> where('email_master.status !=', 'Delete');
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;
    }

    public function get_send_email_by_code($eid)
    {
        $this -> db -> select('email_master.*');
        $this -> db -> from('email_master');
        $this -> db -> where('email_master.status !=', 'Delete');
        $this -> db -> where('email_master.id', ''.$eid.'');
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;
    }

    public function get_email_priview()
    {
        $this -> db -> select('email_preview.*');
        //$this -> db -> select('email_template.template, email_template.form_name, email_template.status');
        $this -> db -> from('email_preview');
        //$this -> db -> join('email_template','email_template.template_id = email_preview.template_id');
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;
    }

    public function get_member($usercode)
    {

        $this -> db -> select('membermaster.*');
        $this -> db -> select('ref.fname as ref_fname, ref.lname as ref_lname,ref.username as ref_username,ref.emailid as ref_emailid');
        $this -> db -> from('membermaster');
        $this -> db -> join('membermaster ref', 'ref.usercode = membermaster.referralid', 'left');
        $this -> db -> where('membermaster.usercode', ''.$usercode.'');
        $query = $this -> db -> get();
        $the_content = $query->result_array();
        return $the_content;
    }

    public function get_send_email_to_all()
    {

        $this -> db -> select('*');

        $this -> db -> from('email_master');

        $this -> db -> where('status', 'Active');

        $this -> db -> where('type', 'All');

        $query = $this -> db -> get();

        $the_content = $query->result_array();

        return $the_content;

    }





}
