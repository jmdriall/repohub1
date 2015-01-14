<?php
/**
 * Classname: Especifico_model
 * Summary: Model for Especifico objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Especifico_Model extends CI_Model
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
	 * Method: getAllEspecificos
	 * Summary: Returns a collection of especificos for one especifico for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllEspecificos($per_p, $off_set, $objetivo_id)
	{
		$this->db->order_by('especifico_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('especifico');
		}
		else
		{
            $this->db->where('objetivo_id', $objetivo_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('especifico');
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
    function getEspecificoByUserId($user_id)
    {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('especifico');
        if ($query->num_rows() >0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
    function getEspecificoByObjetivoId($objetivo_id)
    {
        $this->db->where('objetivo_id',$objetivo_id);
        $query = $this->db->get('especifico');
        if ($query->num_rows() >0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
    /**
     * Method: getAllEspecificos
     * Summary: Returns a collection of especificos for one especifico for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll()
    {
        $this->db->order_by('especifico_id', 'ASC');
        $query = $this->db->get('especifico');

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
	 * Method: getTotalEspecificos
	 * Summary: Returns the total number of especificos of the database
	 * @access public
	 * @return integer
	 */
	function getTotalEspecificos()
	{	

		$query = $this->db->get('especifico');
		return $query->num_rows();
	}
	
	/**
	 * Method: getEspecificoByEspecificoId
	 * Summary: returns the data for a single especifico
	 * @access public
	 * @param integer $especifico_id
	 * @return 
	 */
	function getEspecificoByEspecificoId($especifico_id)
	{
		$this->db->where('especifico_id',$especifico_id);
		$query = $this->db->get('especifico');
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
	 * Method: insertEspecifico
	 * Summary: Insert a new especifico in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertEspecifico($data)
	{
		$this->db->insert('especifico', $data);
	}
	
	/**
	 * Method: updateEspecifico
	 * Summary: Update info for a given especifico
	 * @access public
	 * @param integer $especifico_id
	 * @param array $data
	 * @return 
	 */
	function updateEspecifico($especifico_id, $data)
	{
		$this->db->where('especifico_id', $especifico_id);
		$this->db->update('especifico', $data);	
	}
	
	/**
	 * Method: deleteEspecifico
	 * Summary: Deletes a given especifico from the database
	 * @access public
	 * @param integer $especifico_id
	 */
	function deleteEspecifico($especifico_id)
	{
		$this->db->where('especifico_id', $especifico_id);
		$this->db->delete('especifico');
	}
}

/* End of file especifico_model.php */
/* Location: ./system/application/models/especifico_model.php */
?>