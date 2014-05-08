<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Get_whois_by_history_id extends MY_Controller {

	/**
	 * 
     */
     
    public function __construct()
    {
        parent::__construct();
    }

	public function index($p_domain_name = NULL, $p_domain_id = 0, $p_index_key = NULL, $p_history_id = 0 )
	{
        $this->load->model('Domain_info_model', 'DIM');


        $history_id = $p_history_id;
        $this->DIM->query_by_id ($history_id);
        
        $data = $this->DIM->get_all_data ();
        
        $data["js_path"] = $this->config->item ('js_path');


        $this->load->view ('head', $this->head_var);
        $this->load->view ('get_whois_by_history_id', $data);
        $this->load->view ('foot', $this->foot_var);
        
	}
    
}

/* End of file get_whois_by_history_id.php */
/* Location: ./application/controllers/get_whois_by_history_id.php */