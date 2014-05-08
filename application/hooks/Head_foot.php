<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Head_foot extends MY_Controller {

    //private $head_var = NULL;

    public function load_head ()
    {
        $this->load->view ('head', $this->head_var);
    }

    public function load_foot ()
    {
        $this->load->view ('foot', $this->foot_var);
    }
}

