<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Get_history_info extends MY_Controller {

	/**
	 * 
     */
     
    public function __construct()
    {
        parent::__construct();
    }

	public function index($p_domain_name = NULL)
	{
		$domain_name = $p_domain_name;
        //var_dump($p_domain_name);
        $this->load->model('Get_history_info_model', 'DIM');

        $history_info = "\"" . $this->DIM->index($domain_name) . "\"";
        echo $history_info;

	}
    
}

/* End of file get_history_info.php */
/* Location: ./application/controllers/get_history_info.php */