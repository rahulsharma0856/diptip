<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('check_ajax_request')){

	function check_ajax_request()
	{ 
		$ci =& get_instance();

		if (!$ci->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
	}
}