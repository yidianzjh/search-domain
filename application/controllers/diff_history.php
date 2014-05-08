<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Diff_history extends MY_Controller {

    /**
     *
     */
    private $data;
    public function __construct()
    {
        parent::__construct();
        $this->data['js_path'] = $this->config->item('js_path');
    }
    public function index($p_older_id = 0, $p_newer_id = 0, $p_domain_name = '')
    {
        $older_id = $p_older_id;
        $newer_id = $p_newer_id;
        $domain_name = $p_domain_name;

        $this->load->view('head', $this->head_var);
        if((!empty($older_id)) && (!empty($newer_id)))
        {
            $this->load->model ('domain_info_model', 'DIM');
            $search_id = array ();
            $search_id[0] = $newer_id;
            $search_id[1] = $older_id;

            $this->DIM->query_by_id ($search_id[0]);
            $data['newer'] = $this->DIM->get_all_data ();
            $this->DIM->query_by_id ($search_id[1]);
            $data['older'] = $this->DIM->get_all_data ();
            $data['domain_name'] = $domain_name;

            if($data['newer']['domain_name'] != $domain_name || $data['older']['domain_name'] != $domain_name)
            {
                $data['error_message'] = '没有该域名的历史信息						点此返回';
                $this->load->view('diff_history_error', $data);
            }

            $this->load->model('Get_history_info_model', 'GHIM');

            $data['history_info'] = $this->GHIM->index($domain_name);
            //echo $data['history_info'];

            $this->load->view('diff_history_right', $data);
        }
        else
        {

            $data['error_message'] = '必须输入对比记录ID						点此返回';
            $this->load->view ('diff_history_error', $data);
        }

        $this->load->view ('foot', $this->foot_var);

    }

}

/* End of file Diff_history.php */
/* Location: ./application/controllers/Diff_history.php */