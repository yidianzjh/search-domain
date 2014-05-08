<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Controller extends CI_Controller {

    var $head_var = array();
    var $foot_var = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->head_var["base_url"] = $this->config->item('base_url');
        $this->head_var["css_path"] = $this->config->item('css_path');
        $this->head_var["image_path"] = $this->config->item('image_path');
        $this->head_var["js_path"] = $this->config->item('js_path');
    }
}

/* End of file MY_Controller.php */