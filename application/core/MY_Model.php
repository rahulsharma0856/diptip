<?php

/**
 * Class: MY_Model
 *
 * @see CI_Model
 */
class MY_Model extends CI_Model
{
    /**
     * __construct
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
}

/**
 * Class: App_model
 *
 * @see MY_Model
 */
class App_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate($rules)
    {
        if ($this->config->item($rules) != "" and (is_array($this->config->item($rules)))) {
            $this->form_validation->set_rules($this->config->item($rules));
            if ($this->form_validation->run() == true) {
                return true;
            }
        } else {
            die('validate rules not exist');
        }

        return false;
    }
}
