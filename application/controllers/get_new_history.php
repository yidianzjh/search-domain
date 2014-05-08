<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Get_new_history extends MY_Controller {

	/**
	 * 
     */

    private $data;

    public function __construct()
    {
        parent::__construct();
    }
	public function index ($p_domain_name = NULL)
	{
		$domain_name = $p_domain_name;
        $this->load->model ('domain_info_model', 'DIM');
        
        if($domain_name != NULL && $domain_name != '')
        {
            
            $result_array = $this->DIM->select_newest_record ($domain_name);
            
            //var_dump($result_array );

            if(!is_bool($result_array) )
            {
                $this->load->library ('domain_info', $domain_name);
//echo $domain_name;
                $this->domain_info->lookup($domain_name);
                $data = $this->domain_info->get_all_data ();

//var_dump($data);
                if($data['registered'])
                {
                    $data_list = '';
                    if(is_array($data['nameserver']))
                    {
                        $data_list = '';
                        foreach($data['nameserver'] as $data_tmp)
                        {
                            $data_list .= $data_tmp.'</br>';
                        }
                        $data['nameserver'] = $data_list;
                    }

                    if(is_array($data['status']))
                    {
                        $data_list = '';
                        foreach($data['status'] as $data_tmp)
                        {
                            $data_list .= $data_tmp . '</br>';
                        }
                        $data['status'] = $data_list;
                    }

                    if(is_array($data['rawdata']))
                    {
                        $data_list = '';
                        foreach($data['rawdata'] as $data_tmp)
                        {
                            $data_list .= $data_tmp . '</br>';
                        }
                        $data['rawdata'] = $data_list;
                    }

                }

                $rawdata_array = $this->data['rawdata_array'];
                if(is_array($rawdata_array))
                {
                    $rawdata_array[0] = preg_replace('/\"/', '\\"', $rawdata_array[0]);
                    $rawdata_array[1] = preg_replace('/\"/', '\\"', $rawdata_array[1]);
                    $rawdata_array[0] = preg_replace('/>>>(.*\s*)*/', 'r', $rawdata_array[0]);
                    $rawdata_array[1] = preg_replace('/>>>(.*\s*)*/', 'r', $rawdata_array[1]);
                }

                $md51 = md5($rawdata_array[0] . $rawdata_array[1]);
                
                //var_dump($result_array[0]);
                if(isset($result_array[0]) && is_object($result_array[0]))
                    $md52 = $result_array[0]->md5;
                else
                    $md52 = -1;
                
                if($md51 == $md52)
                {
                    $str = "{\"VValue\":\"true\",\"query_time\":\"" . date("Y-m-d",$result_array[0]->query_time) . "\"}";
                }
                else
                {
                    
                    $data['md5'] = $md51;
                    

                    $id = $this->DIM->insert_id($data);

                    if($id > 0)
                    {
//var_dump($rawdata_array);
                        if(!isset($data['rawdata_array'][1]))
                            $data['rawdata_array'][1] = $data['rawdata_array'][0];
                        $sql_array = array();
                        $sql_array['id'] = $id;
                        $sql_array['content'] = $data['rawdata_array'][1];
//var_dump($data['rawdata_array']);
                        //注册商
                        $this->load->model('Registrar_info_model', 'RIM');
                        $this->RIM->insert($sql_array);
                        
                        //注册局
                        $sql_array['content'] = $data['rawdata_array'][0];
                        $this->load->model('Registry_info_model', 'RIM_');
                        $this->RIM_->insert($sql_array);
                        
                    }
                    $str = "{\"VValue\":\"false\",\"query_time\":-2}";
                }
            

            }
            else
            {   
                $str = "{\"VValue\":\"false\",\"query_time\":-1}";

            }

            echo $str;
        
        }

	}
    
}

/* End of file get_new_history.php */
/* Location: ./application/controllers/get_new_history.php */