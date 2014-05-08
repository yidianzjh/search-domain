<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Counter_check_domain extends MY_Controller {

	/**
	 * 
     */
     
    public function __construct()
    {
        parent::__construct();
    }
    
	public function index($p_key = '', $page = 0)
	{
        $key = urldecode($p_key);

        $data['js_path'] = $this->config->item('js_path');
        
        $this->load->view('head', $this->head_var);
        
        if ($key != '' && $key != NULL)
        {
            $this->load->model('Domain_info_model', 'DIM');
            
            
            $data['key'] = $key;
            $data['page'] = $page;
            $data['count'] = $this->DIM->count_by_key($data['key']);
            $data['page_num'] = $this->DIM->page_by_key($data['key']);
            $data['page_size'] = $this->DIM->get_page_size();
            $data['result_record'] = '';
            $data['result_page'] = '';
            
            if ($data['page'] > $data['page_num'])
                    $data['page'] = $data['page_num'];
            
            
            if (intval($data["page"]))
            {
                $this->DIM->query_by_key($key, $data["page"]);
            }
            else
            {
                $this->DIM->query_by_key($key);
                $data['page'] = 0;
            }
            
            $data['n'] = 0;
            while ($data_tmp = $this->DIM->get_next_record())
            {
                $data['record'][] = $data_tmp;

                $data['n']++;
            }
            

            $this->load->view('counter_check_right', $data);
            
        }
        else
        {
            
            
            $this->load->view('counter_check_error', $data);
        }
        
        
        $this->load->view('foot', $this->foot_var);
        
	}
    
}

/* End of file counter_check_domain.php */
/* Location: ./application/controllers/counter_check_domain.php */