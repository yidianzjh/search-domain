<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_history_info_model extends MY_Model {

    /**
     *
     */

    public function __construct ()
    {
        parent::__construct ();
    }


    public function index($p_domain_name = NULL)
    {
        $domain_name = $p_domain_name;
        $CI = get_instance();
        $CI->load->model('domain_info_model');


        if($domain_name != NULL && $domain_name != "")
        {

            $result_array = $CI->domain_info_model->select_by_domain($domain_name);
            //var_dump($result_array);
            $i = 0;
            $str = "";
            if(!is_bool($result_array))
            {
                foreach($result_array as $tmp)
                {
                    $time=date("Y-m-d",$tmp->query_time);
                    $str.="<dd><input type='checkbox' name='history[]' id='his_".$i."' class='hisInput' /><label for='his_".$i."'>".$time."</label><span class='contrasBtn' style='display:none' historyId='".$tmp->id."'></span><span class='see_whois' MD5='".$tmp->md5."'  style='display:none' historyId='".$tmp->id."' for='his_".$i."'></span></dd>";
                    $i+=1;
                }
            }
            else
            {

            }
            $str .= "<dd id='mcheck' style='float:right;display:inline;margin-right:10px;text-align:right;color:#0399D7;cursor:pointer'>更多</dd>";
            return $str;

        }
        return '';

    }


}

/* End of file domain_info_by_net.php */
/* Location: ./application/controllers/domain_info_by_net.php */