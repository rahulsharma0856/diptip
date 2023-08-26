<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class: Template
 *
 */
class Template
{
    /**
     * template
     *
     * @var string
     */
    public $template = 'default';

    /**
     * view
     *
     * @var string
     */
    public $view;

    /**
     * data
     *
     * @var array
     */
    public $data = array();

    /**
     * title
     *
     * @var mixed
     */
    public $title;

    /**
     * directory
     *
     * @var mixed
     */
    public $directory;

    /**
     * data
     *
     * @var array
     */
    public $initData = array();

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->view = $this->CI->router->directory.$this->CI->router->class.'/'.$this->CI->router->method;
        $this->title = ucfirst(str_replace('_', ' ', $this->CI->router->method));
    }

    public function getInitData($key)
    {
        if (isset($this->initData[$key])) {
            return $this->initData[$key];
        }
        
        return false;
    }
}
