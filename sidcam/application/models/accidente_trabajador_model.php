<?php
/**
 * Classname: Accidente_trabajador_model
 * Summary: Model for Accidente_trabajador objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Accidente_trabajador_Model extends CI_Model
{
	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Method: getAllAccidente_trabajador
	 * Summary: Returns a collection of accidente_trabajador for one accidente_trabajador for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllAccidente_trabajador($per_p, $off_set, $accidente_id)
	{
		$this->db->order_by('accidente_trabajador_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('accidente_id', $accidente_id);
			$query = $this->db->get('accidente_trabajador');
		}
		else
		{
            $this->db->where('accidente_id', $accidente_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('accidente_trabajador');
		}
		
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		} 
		else
		{
			return FALSE;		
		}
	}
    /**
     * Method: getAllAccidente_trabajador
     * Summary: Returns a collection of accidente_trabajador for one accidente_trabajador for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($accidente_id)
    {
        $this->db->where('accidente_id', $accidente_id);
        $this->db->order_by('accidente_trabajador_id', 'ASC');
        $query = $this->db->get('accidente_trabajador');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
    function getAllByUserID($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('accidente_trabajador_id', 'ASC');
        $query = $this->db->get('accidente_trabajador');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

	
	/**
	 * Method: getTotalAccidente_trabajador
	 * Summary: Returns the total number of accidente_trabajador of the database
	 * @access public
	 * @return integer
	 */
	function getTotalAccidente_trabajador()
	{	

		$query = $this->db->get('accidente_trabajador');
		return $query->num_rows();
	}
	
	/**
	 * Method: getAccidente_trabajadorByAccidente_trabajadorId
	 * Summary: returns the data for a single accidente_trabajador
	 * @access public
	 * @param integer $accidente_trabajador_id
	 * @return 
	 */
	function getAccidente_trabajadorByAccidente_trabajadorId($accidente_trabajador_id)
	{
		$this->db->where('accidente_trabajador_id',$accidente_trabajador_id);
		$query = $this->db->get('accidente_trabajador');
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		} 
		else
		{
			return FALSE;		
		}			
	}
	
	/**
	 * Method: insertAccidente_trabajador
	 * Summary: Insert a new accidente_trabajador in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertAccidente_trabajador($data)
	{
		$this->db->insert('accidente_trabajador', $data);
	}
	
	/**
	 * Method: updateAccidente_trabajador
	 * Summary: Update info for a given accidente_trabajador
	 * @access public
	 * @param integer $accidente_trabajador_id
	 * @param array $data
	 * @return 
	 */
	function updateAccidente_trabajador($accidente_trabajador_id, $data)
	{
		$this->db->where('accidente_trabajador_id', $accidente_trabajador_id);
		$this->db->update('accidente_trabajador', $data);	
	}
	
	/**
	 * Method: deleteAccidente_trabajador
	 * Summary: Deletes a given accidente_trabajador from the database
	 * @access public
	 * @param integer $accidente_trabajador_id
	 */
	function deleteAccidente_trabajador($accidente_trabajador_id)
	{
		$this->db->where('accidente_trabajador_id', $accidente_trabajador_id);
		$this->db->delete('accidente_trabajador');
	}
}

/* End of file accidente_trabajador_model.php */
/* Location: ./system/application/models/accidente_trabajador_model.php */
?>