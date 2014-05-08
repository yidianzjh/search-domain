<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');
//error_reporting(0);

class Domain_info_model extends MY_Model {

	/**
	 * 
     */
     
    private $sql_array = array();
    
    private $result;
    private $format_result;
    private $result_array;
    private $n = 0;
    private $count = 0;
    private $page = 0; //0为一页
    private $page_size = 20;
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct()
    {

    }

    private function formatting()
    {
        $this->get_rawdata();
        if (is_object($this->result))
        {
            $this->format_result['id'] = $this->result->id;
            $this->format_result['domain_name'] = $this->result->domain_name;
            $this->format_result['owner_email'] = $this->result->owner_email;
            $this->format_result['owner_name'] = $this->result->owner_name;
            $this->format_result['owner_organization'] = $this->result->owner_organization;
            $this->format_result['registrar'] = $this->result->registrar;
            $this->format_result['whois_server'] = $this->result->whois_server;
            $this->format_result['creation_date'] = date('Y-m-d',$this->result->creation_date);
            $this->format_result['expiration_date'] = date('Y-m-d',$this->result->expiration_date);
            $this->format_result['updated_date'] = date('Y-m-d',$this->result->updated_date);
            $this->format_result['status'] = $this->result->status;
            $this->format_result['nameserver'] = $this->result->nameserver;
            if (isset($this->result->rawdata))
                $this->format_result['rawdata'] = $this->result->rawdata;
            else
                $this->format_result['rawdata'] = '';
            $this->format_result['md5'] = $this->result->md5;
            $this->format_result['query_time'] = date('Y-m-d',$this->result->query_time);
        }
        else
        {
            $this->format_result['id'] = 0;
            $this->format_result['domain_name'] = '';
            $this->format_result['owner_email'] = '';
            $this->format_result['owner_name'] = '';
            $this->format_result['owner_organization'] = '';
            $this->format_result['registrar'] = '';
            $this->format_result['whois_server'] = '';
            $this->format_result['creation_date'] = '';
            $this->format_result['expiration_date'] = '';
            $this->format_result['updated_date'] = '';
            $this->format_result['status'] = '';
            $this->format_result['nameserver'] = '';
            $this->format_result['rawdata'] = '';
            $this->format_result['md5'] = '';
            $this->format_result['query_time'] = '';
        }

//var_dump($this->result);
    }

    public function get_all_data()
    {
        return $this->format_result;
    }
	public function _escape($sql_array)
    {

        if(isset($sql_array['id']))
        {
            $this->sql_array['id'] = $this->db->escape($sql_array['id']);
        }
        else
        {
            $this->sql_array['id'] = '';
        }
        
        if(isset($sql_array['domain_name']))
        {
            
            $this->sql_array['domain_name'] = $this->db->escape($sql_array['domain_name']);
           
        }
        else
        {
            $this->sql_array['domain_name'] = '';
        }
        
        if(isset($sql_array['owner_email']))
        {
            $this->sql_array['owner_email'] = $this->db->escape($sql_array['owner_email']);
        }
        else
        {
            $this->sql_array['owner_email'] = '';
        }
        
        if(isset($sql_array['owner_name']))
        {
            $this->sql_array['owner_name'] = $this->db->escape($sql_array['owner_name']);
        }
        else
        {
            $this->sql_array['owner_name'] = '';
        }
        
        if(isset($sql_array['owner_organization']))
        {
            $this->sql_array['owner_organization'] = $this->db->escape($sql_array['owner_organization']);
        }
        else
        {
            $this->sql_array['owner_organization'] = '';
        }
        
        if(isset($sql_array['registrar']))
        {
            $this->sql_array['registrar'] = $this->db->escape($sql_array['registrar']);
        }
        else
        {
            $this->sql_array['registrar'] = '';
        }
        
        if(isset($sql_array['whois_server']))
        {
            $this->sql_array['whois_server'] = $this->db->escape($sql_array['whois_server']);
        }
        else
        {
            $this->sql_array['whois_server'] = '';
        }
        
        if(isset($sql_array['creation_date']))
        {
            
            $this->sql_array['creation_date'] = $this->db->escape(strtotime($sql_array['creation_date']));
        }
        else
        {
            $this->sql_array['creation_date'] = '';
        }
        
        if(isset($sql_array['expiration_date']))
        {
            $this->sql_array['expiration_date'] = $this->db->escape(strtotime($sql_array['expiration_date']));

        }
        else
        {
            $this->sql_array['expiration_date'] = '';
        }
        
        if(isset($sql_array['updated_date']))
        {
            $this->sql_array['updated_date'] = $this->db->escape(strtotime($sql_array['updated_date']));
        }
        else
        {
            $this->sql_array['updated_date'] = '';
        }
        
        if(isset($sql_array['status']))
        {
            $this->sql_array['status'] = $this->db->escape($sql_array['status']);
        }
        else
        {
            $this->sql_array['status'] = '';
        }
        
        if(isset($sql_array['nameserver']))
        {
            $this->sql_array['nameserver'] = $this->db->escape($sql_array['nameserver']);
        }
        else
        {
            $this->sql_array['nameserver'] = '';
        }
        
        if(isset($sql_array['md5']))
        {
            $this->sql_array['md5'] = $this->db->escape($sql_array['md5']);
        }
        else
        {
            $this->sql_array['md5'] = '';
        }
        
        if(isset($sql_array['query_time']))
        {
            $this->sql_array['query_time'] = $this->db->escape($sql_array['query_time']);
        }
        else
        {
            $this->sql_array['query_time'] = '';
        }
        
        if(isset($sql_array['md5']))
        {
            $this->sql_array['md5'] = $sql_array['md5'];
        }
        else
        {
            $this->sql_array['md5'] = '';
        }
        
        return $this->sql_array;
        
        
    }
    
    public function select_newest_record($domain_name)
	{
		$sql_array ['domain_name'] = $domain_name;
        
        $this->_escape($sql_array);

        $sql = "SELECT `id`, `query_time`,`md5` \n"
            . "FROM `domain_info`\n"
            . "WHERE domain_name = ".$this->sql_array['domain_name']."\n"
            . "ORDER BY query_time DESC\n"
            . "LIMIT 1";
        $query = $this->db->query($sql);
        return $query->result();
        
	}
    
    public function select_by_domain($domain_name)
    {
        
        $sql_array['domain_name'] = $domain_name;
        
        $this->_escape($sql_array);
        
        
        $sql = "SELECT `id`, `query_time`,`md5` \n"
            . "FROM `domain_info`\n"
            . "WHERE domain_name = ".$this->sql_array['domain_name']."\n"
            . "ORDER BY query_time DESC";
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function insert($sql_array)
    {
        $sql_array = $this->_escape($sql_array);
        $sql = "INSERT INTO `domain_info`\n"
            ."(`domain_name`, `owner_email`, `owner_name`, `owner_organization`, `registrar`, `whois_server`, `creation_date`, `expiration_date`, `updated_date`, `status`, `nameserver`, `md5`, `query_time`) \n"
            ."VALUES (" . $sql_array['domain_name'] . "," . $sql_array['owner_email'] . ","
            . $sql_array['owner_name'] . "," . $sql_array['owner_organization'] . "," . $sql_array['registrar'] . ","
            . $sql_array['whois_server'] . "," . $sql_array['creation_date']."," . $sql_array['expiration_date'] . ","
            . $sql_array['updated_date'] . "," . $sql_array['status'] . "," . $sql_array['nameserver'] . ",'" . $sql_array['md5'] . "'," . time() . ")";

        $query = $this->db->query($sql);

        
        return $query;
        
    }
    
	public function query($sql)
	{
		
        $query = $this->db->query($sql);
        return $query->result();
        
	}
    
    public function insert_id($sql_array)
	{
        $this->insert($sql_array);
        return $this->db->insert_id();
        
	}
    
   
    public function query_by_id($id=0)
    {
        if($id != 0)
        {
            $sql = "SELECT * FROM `domain_info` WHERE `id`=".$this->db->escape($id)." ";
            $query = $this->db->query($sql);
            $result = $query->result();
            $this->n=0;
            $this->result_array=$result;
            $this->result=$result[0];

            $this->formatting();
        }
        else
        {
            return false;
        }

    }
    
    public function count_by_key($key=" ")
    {
        $sql="SELECT COUNT(*) as records_count FROM `domain_info` WHERE (`domain_name` LIKE '%".$this->db->escape_like_str($key)."%' OR `owner_email` LIKE '%".$this->db->escape_like_str($key)."%' OR `owner_name` LIKE '%".$this->db->escape_like_str($key)."%' )";

        $query = $this->db->query($sql);
        $result = $query->result();

        return $this->count=$result[0]->records_count;

    }
    
    public function page_by_key($p_key = '')
    {
        if($this->count == 0)
        {
            $this->count_by_key($p_key = " ");
        }
        else
        {
            $this->page=intval($this->count/$this->page_size);
            if(($this->count%$this->page_size)==0)
            {
                $this->page-=1;
            }

        }
        return $this->page;

    }
    
    public function get_page_size()
    {
        return $this->page_size;
    }
    
    public function query_by_key($p_key = '', $p_page = 0)
    {
        $key = $p_key;
        $page = $p_page;
        if($page > $this->page)
            $page=$this->page;
        $sql="SELECT `domain_name`,`registrar`,`owner_organization`,`creation_date`,`expiration_date` FROM `domain_info` WHERE (`domain_name` LIKE '%".$this->db->escape_like_str($key)."%' OR `owner_email` LIKE '%".$this->db->escape_like_str($key)."%' OR `owner_name` LIKE '%".$this->db->escape_like_str($key)."%' OR `owner_organization` LIKE '%".$this->db->escape_like_str($key)."%' )";
        $sql.=" LIMIT ".$this->page_size*$page.",".$this->page_size." ";
//echo "sql = $sql";
        $this->n=0;

        $query = $this->db->query($sql);
        $result = $query->result();
        if(is_array($result) && !empty($result))
        {
            $this->result_array=$result;
            $this->result=$result[0];
            $this->formatting();
        }



    }

    public function get_next_record()
    {
        if(isset($this->result_array[$this->n]))
        {
            $this->result=$this->result_array[$this->n];
            $this->n+=1;

            $this->formatting();
            return $this->format_result;
        }
        return false;
    }

    public function get_id()
    {
        if(isset($this->result->id))
            return $this->result->id;
        return null;
    }
    public function get_domain_name()
    {
        if(isset($this->result->domain_name))
            return $this->result->domain_name;
        return null;
    }





    public function get_all ()
    {
        $this->get_rawdata();
        $this->result=(object)($this->result);

        return $this->result;
    }

    public function get_rawdata ()
    {

        //if(isset($this->result->rawdata))
            //return $this->result->rawdata;
        $id = $this->get_id();
        if ($id == 0)
            return '';

        $CI = & get_instance();

        $CI->load->model ('registrar_info_model');
        $result = $CI->registrar_info_model->get_content ($id);


        if(isset($result[0]->content))
        {
            $this->result->rawdata = $result[0]->content;
            return $this->result->rawdata;
        }

        return '';
    }


    
}

/* End of file domain_info_model.php */
/* Location: ./application/controllers/domain_info_model.php */