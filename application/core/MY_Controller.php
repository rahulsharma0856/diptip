<?php

/**
 * Class: MY_Controller
 *
 * @see CI_Controller
 */
class MY_Controller extends CI_Controller
{
    /**
     * __construct
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template'); 
    }

    /**
     * isLoggedIn
     *
     */
    public function isLoggedIn()
    { 
        $data = $this->session->userdata['smr_web_login'];
        
        if (is_array($data)) {
            if ($data['login'] == 'true') {
                return true;
            }
        }
        return false;
    }

    /**
     * logout
     *
     */
     
    public function logout()
    {
        $this->CI->session->sess_destroy();
    }
}

/**
 * Class: App
 *
 * @see MY_Controller
 */
class App extends MY_Controller
{

    /**
     * __construct
     *
     */
    public function __construct()
    {
        parent::__construct();

        if (ENVIRONMENT === 'maintenance') {
            if (!in_array(@$this->session->userdata['id'], $this->maintenance_users)) {
                redirect(base_url().'maintenance.php');
            }
        }

        if (ENVIRONMENT === 'development') {
            //$this->output->enable_profiler(true);
        }

        if (!$this->isLoggedIn()) {
            redirect(base_url());
        }

       /* if ($this->uri->rsegment(2) != 'profile') {
            if (!isProfileCompleted()) {
                redirect('dashboard/profile');
            }
        }*/

        $this->load->library('template');
    }
}


/**
 * Class: App
 *
 * @see MY_Controller
 */
class Admin extends MY_Controller
{

    /**
     * __construct
     *
     */
    public function __construct()
    {
        parent::__construct();

        if (ENVIRONMENT === 'maintenance') {
            if (!in_array(@$this->session->userdata['username'], $this->maintenance_users)) {
                redirect(base_url().'maintenance.php');
            }
        }

        if (ENVIRONMENT === 'development') {
            //$this->output->enable_profiler(true);
        }

        $method = $this->uri->rsegment(2);

        if (!$this->isAdminLoggedIn()) {
            redirect(base_url('login'));
        }

        $this->load->library('template');
    }

    /**
     * isLoggedIn
     *
     */
    public function isAdminLoggedIn()
    {
        $data = $this->session->userdata['user'];
        if (is_array($data)) {
            if ($data['is_admin']) {
                return true;
            }
        }
        return false;
    }
}