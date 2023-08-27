<?php

class Comman_c_module extends App_model
{
    public function filter_member()
    {

        $filter = preg_replace('/\s\s+/', ' ', $_GET['term']);

        $filter = explode(" ", $filter);

        $this->db->select('*');

        $this->db->from('membermaster');

        if (isset($filter[1])) {

            $this->db->where('(fname="' . $filter[0] . '" and lname  LIKE "%' . $filter[1] . '%")');
        } else {

            if (ctype_digit($filter[0])) {

                $sWhere .= '(usercode="' . $filter[0] . '")';

                $this->db->where('(usercode="' . $filter[0] . '")');

            } else {

                $sWhere .= '(fname  LIKE "%' . $filter[0] . '%" or lname  LIKE "%' . $filter[0] . '%")';

                $this->db->where('(fname  LIKE "%' . $filter[0] . '%" or lname  LIKE "%' . $filter[0] . '%")');

            }

        }

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function active_ticket()
    {

        $uid = $this->session->userdata['smr_web_login']['usercode'];

        $this->db->select('support_master.*');

        $this->db->select('COUNT(support_detail.support_code) as rpy');

        $this->db->from('support_master');

        $this->db->join('support_detail', 'support_detail.support_code = support_master.support_code AND support_detail.type="A"', 'left');

        $this->db->where('support_master.usercode', '' . $uid . '');

        $this->db->where('support_master.status', 'Active');

        $this->db->group_by('support_master.support_code');

        $this->db->order_by('support_master.support_code', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function close_ticket()
    {

        $uid = $this->session->userdata['smr_web_login']['usercode'];

        $this->db->select('support_master.*');

        $this->db->select('COUNT(support_detail.support_code) as rpy');

        $this->db->from('support_master');

        $this->db->join('support_detail', 'support_detail.support_code = support_master.support_code AND support_detail.type="A"', 'left');

        $this->db->where('support_master.usercode', '' . $uid . '');

        $this->db->where('support_master.status', 'Close');

        $this->db->group_by('support_master.support_code');

        $this->db->order_by('support_master.support_code', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function active_ticket_by_code($eid)
    {

        $uid = $this->session->userdata['smr_web_login']['usercode'];

        $this->db->select('support_master.*');

        $this->db->from('support_master');

        $this->db->where('support_master.usercode', '' . $uid . '');

        $this->db->where('support_master.support_code', '' . $eid . '');

        $this->db->where('support_master.status !=', 'Delete');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function conversion_history($eid)
    {

        $this->db->select('*');

        $this->db->from('support_detail');

        $this->db->where('support_code', '' . $eid . '');

        $this->db->where('status', 'Active');

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function testimonial_member($eid)
    {

        $this->db->select('testimonial.*');

        $this->db->select('membermaster.fname, membermaster.lname');

        $this->db->from('testimonial');

        $this->db->join('membermaster', 'membermaster.usercode = testimonial.usercode', 'left');

        $this->db->where('testimonial.status', 'Active');

        if ($eid != '') {

            $this->db->where('testimonial.id', '' . $eid . '');

        }

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function get_page_list($section)
    {

        $this->db->select('page_title, id');

        $this->db->from('custom_cms_pages');

        $this->db->where('page_link', '' . $section . '');

        $this->db->where('status', 'Active');

        $this->db->order_by('sort_order', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;
    }

    public function getCountryList()
    {

        $this->db->select('*');

        $this->db->from('web_countries');

        $this->db->where('status', 'Active');

        $this->db->order_by('name', 'ASC');

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

    public function getCountryById($id)
    {

        $this->db->select('*');

        $this->db->from('web_countries');

        $this->db->where('id', $id);

        $query = $this->db->get();

        $the_content = $query->result_array();

        return $the_content;

    }

}
