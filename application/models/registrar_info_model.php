<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrar_info_model extends MY_Model {

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
    
    public function get_content ($p_id)
	{
        $id = $p_id;
        $sql = "SELECT * \n"
            . "FROM `registrar_info`\n"
            . "WHERE id = " . $this->db->escape($id) . "";
//echo "sql = $sql";
        $query = $this->db->query($sql);
        $result = $query->result();
//echo "result = $result";
        return $result;
        
	}
    
    public function insert ($sql_array)
    {
        $this->_escape($sql_array);
        $sql = "INSERT INTO `registrar_info`\n"
            ."(`id`, `content`) \n"
            ."VALUES (".$this->sql_array["id"].",".$this->sql_array["content"].")";
        
        //var_dump($sql_array);
        //var_dump($this->sql_array);
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

/* End of file registrar_info_model.php */
/* Location: ./application/controllers/registrar_info_model.php */