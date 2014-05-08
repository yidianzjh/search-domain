<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_new_history_model extends MY_Model {

	/**
	 * 
     */
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function escape($sql_array)
    {
        if(isset($sql_array["id"]))
        {
            $sql_array["id"] = $this->db->escape($sql_array["id"]);
        }
        else
        {
            $sql_array["id"] = '';
        }
        
        if(isset($sql_array["domain_name"]))
        {
            $sql_array["domian_name"] = $this->db->escape($sql_array["domain_name"]);
        }
        else
        {
            $sql_array["domain_name"] = '';
        }
        
        if(isset($sql_array["owner_email"]))
        {
            $sql_array["owner_email"] = $this->db->escape($sql_array["owner_email"]);
        }
        else
        {
            $sql_array["owner_email"] = '';
        }
        
        if(isset($sql_array["owner_name"]))
        {
            $sql_array["owner_name"] = $this->db->escape($sql_array["owner_name"]);
        }
        else
        {
            $sql_array["owner_name"] = '';
        }
        
        if(isset($sql_array["owner_organization"]))
        {
            $sql_array["owner_organization"] = $this->db->escape($sql_array["owner_organization"]);
        }
        else
        {
            $sql_array["owner_organization"] = '';
        }
        
        if(isset($sql_array["registrar"]))
        {
            $sql_array["registrar"] = $this->db->escape($sql_array["registrar"]);
        }
        else
        {
            $sql_array["registrar"] = '';
        }
        
        if(isset($sql_array["whois_server"]))
        {
            $sql_array["whois_server"] = $this->db->escape($sql_array["whois_server"]);
        }
        else
        {
            $sql_array["whois_server"] = '';
        }
        
        if(isset($sql_array["creation_date"]))
        {
            $sql_array["creation_date"] = $this->db->escape($sql_array["creation_date"]);
        }
        else
        {
            $sql_array["creation_date"] = '';
        }
        
        if(isset($sql_array["expiration_date"]))
        {
            $sql_array["expiration_date"] = $this->db->escape($sql_array["expiration_date"]);
        }
        else
        {
            $sql_array["expiration_date"] = '';
        }
        
        if(isset($sql_array["updated_date"]))
        {
            $sql_array["updated_date"] = $this->db->escape($sql_array["updated_date"]);
        }
        else
        {
            $sql_array["updated_date"] = '';
        }
        
        if(isset($sql_array["status"]))
        {
            $sql_array["status"] = $this->db->escape($sql_array["status"]);
        }
        else
        {
            $sql_array["status"] = '';
        }
        
        if(isset($sql_array["nameserver"]))
        {
            $sql_array["nameserver"] = $this->db->escape($sql_array["nameserver"]);
        }
        else
        {
            $sql_array["nameserver"] = '';
        }
        
        if(isset($sql_array["md5"]))
        {
            $sql_array["md5"] = $this->db->escape($sql_array["md5"]);
        }
        else
        {
            $sql_array["md5"] = '';
        }
        
        if(isset($sql_array["query_time"]))
        {
            $sql_array["query_time"] = $this->db->escape($sql_array["query_time"]);
        }
        else
        {
            $sql_array["query_time"] = '';
        }
        
        return $sql_array;
        
        
    }
    public function select($sql_array)
	{
		$sql_array = $this->escape();
        $query = $this->db->query($sql);
        return $query->result();
        
	}
	public function query($sql)
	{
		
        $query = $this->db->query($sql);
        return $query->result();
        
	}
    public function insert_id($sql)
	{
        $this->query($sql);
        return $this->db->insert_id();
        
	}
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */