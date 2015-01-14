<?php
/**
 * Classname: Trabajador_model
 * Summary: Model for Trabajador objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Trabajador_Model extends CI_Model
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
	 * Method: getAllTrabajadors
	 * Summary: Returns a collection of trabajadors for one trabajador for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllTrabajadors($per_p, $off_set, $user_id)
	{
		$this->db->order_by('trabajador_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('trabajador');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('trabajador');
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
     * Method: getAllTrabajadors
     * Summary: Returns a collection of trabajadors for one trabajador for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->order_by('trabajador_id', 'ASC');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('trabajador');

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
	 * Method: getTotalTrabajadors
	 * Summary: Returns the total number of trabajadors of the database
	 * @access public
	 * @return integer
	 */
	function getTotalTrabajadors()
	{	

		$query = $this->db->get('trabajador');
		return $query->num_rows();
	}
	
	/**
	 * Method: getTrabajadorByTrabajadorId
	 * Summary: returns the data for a single trabajador
	 * @access public
	 * @param integer $trabajador_id
	 * @return 
	 */
	function getTrabajadorByTrabajadorId($trabajador_id)
	{
		$this->db->where('trabajador_id',$trabajador_id);
		$query = $this->db->get('trabajador');
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
	 * Method: insertTrabajador
	 * Summary: Insert a new trabajador in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertTrabajador($data)
	{
		$this->db->insert('trabajador', $data);
	}
	
	/**
	 * Method: updateTrabajador
	 * Summary: Update info for a given trabajador
	 * @access public
	 * @param integer $trabajador_id
	 * @param array $data
	 * @return 
	 */
	function updateTrabajador($trabajador_id, $data)
	{
		$this->db->where('trabajador_id', $trabajador_id);
		$this->db->update('trabajador', $data);	
	}
	
	/**
	 * Method: deleteTrabajador
	 * Summary: Deletes a given trabajador from the database
	 * @access public
	 * @param integer $trabajador_id
	 */
	function deleteTrabajador($trabajador_id)
	{
		$this->db->where('trabajador_id', $trabajador_id);
		$this->db->delete('trabajador');
	}
}

/* End of file trabajador_model.php */
/* Location: ./system/application/models/trabajador_model.php */
?>