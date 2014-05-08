<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_domain extends MY_Controller {

	/**
	 * 
     */

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['js_path'] = $this->config->item('js_path');
    }

	public function index($p_domain_name = NULL)
    {
		$domain_name = trim($p_domain_name);
        $this->load->view('head', $this->head_var);
        if (!empty($domain_name))
        {
            $domain_name = strtolower($domain_name);
            $str_empty = strripos($domain_name, ' ');
            $substr_start = strripos($domain_name, '.');
            if($substr_start == "" || $substr_start == 0 || $str_empty != "")
            {
                $data['error_str'] = '域名格式错误';
                $this->load->view('search_error',$data);
            }
            else
            {
                $this->load->library ('domain_info', $domain_name);

                $this->domain_info->lookup($domain_name);
                $string = $this->domain_info->get_string ();
                $pos = stripos($string, 'No match for domain');
                if ($pos !== FALSE)
                {
                    $data['error_str'] = "暂不支持查询的后缀。";
                    $this->load->view('search_error', $data);

                }
                else
                {
                    $data = $this->domain_info->get_all_data();
                    if ($data['registered'])
                    {
                        $data_list = '';
                        if (is_array($data['nameserver']))
                        {
                            $data_list = '';
                            foreach ($data['nameserver'] as $data_tmp)
                            {
                                $data_list .= $data_tmp.'<br/>';
                            }
                            $data['nameserver'] = $data_list;
                        }

                        if (is_array($data['status']))
                        {
                            $data_list = '';
                            foreach($data['status'] as $data_tmp)
                            {
                                $data_list .= $data_tmp.'<br/>';
                            }
                            $data['status'] = $data_list;
                        }

                        if (is_array($data['rawdata']))
                        {
                            $data_list = '';
                            foreach ($data['rawdata'] as $data_tmp)
                            {
                                $data_list .= $data_tmp.'<br/>';
                            }
                            $data['rawdata'] = $data_list;
                        }

                    }
                    
                    $this->load->view('search_right',$data);
                }
            }

        }
        else
        {
            $data['error_str'] = "必须输入域名名称";
            $this->load->view('search_error', $data);
            //include "searchError.php";
        }
        
        $this->load->view('foot',$this->foot_var);
	}
    
}

/* End of file search_domain.php */
/* Location: ./application/controllers/search_domain.php */