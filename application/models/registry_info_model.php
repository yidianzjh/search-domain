<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registry_info_model extends MY_Model {

	/**
	 * 
     */
     
    var $sql_array = array();
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
	public function _escape($sql_array)
    {
        if(isset($sql_array["id"]))
        {
            $this->sql_array["id"] = $this->db->escape($sql_array["id"]);
        }
        else
        {
            $this->sql_array["id"] = '';
        }
        
        if(isset($sql_array["content"]))
        {
            $this->sql_array["content"] = $this->db->escape($sql_array["content"]);
        }
        else
        {
            $this->sql_array["content"] = '';
        }
        
        
        return $this->sql_array;
        
        
    }
    
    public function select($sql_array)
	{
		$this->_escape($sql_array);
        $sql = "SELECT `id`, `query_time`,`md5` \n"
            . "FROM `registry_info`\n"
            . "WHERE id = ".$sql_array["id"]."";
        $query = $this->db->query($sql);
        return $query->result();
        
	}
    
    public function insert($sql_array)
    {
        $this->_escape($sql_array);
        $sql = "INSERT INTO `registry_info`\n"
            ."(`id`, `content`) \n"
            ."VALUES (".$this->sql_array["id"].",".$this->sql_array["content"].")";
//echo "$sql";
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
    
    
    
}

/* End of file registry.php */
/* Location: ./application/controllers/registry.php */