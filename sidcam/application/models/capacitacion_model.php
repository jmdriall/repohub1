<?php
/**
 * Classname: Capacitacion_model
 * Summary: Model for Capacitacion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Capacitacion_Model extends CI_Model
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
	 * Method: getAllCapacitacions
	 * Summary: Returns a collection of capacitacions for one capacitacion for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllCapacitacions($per_p, $off_set, $user_id)
	{
		$this->db->order_by('capacitacion_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('capacitacion');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('capacitacion');
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
     * Method: getAllCapacitacions
     * Summary: Returns a collection of capacitacions for one capacitacion for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('capacitacion_id', 'ASC');
        $query = $this->db->get('capacitacion');

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
	 * Method: getTotalCapacitacions
	 * Summary: Returns the total number of capacitacions of the database
	 * @access public
	 * @return integer
	 */
	function getTotalCapacitacions()
	{	

		$query = $this->db->get('capacitacion');
		return $query->num_rows();
	}
	
	/**
	 * Method: getCapacitacionByCapacitacionId
	 * Summary: returns the data for a single capacitacion
	 * @access public
	 * @param integer $capacitacion_id
	 * @return 
	 */
	function getCapacitacionByCapacitacionId($capacitacion_id)
	{
		$this->db->where('capacitacion_id',$capacitacion_id);
		$query = $this->db->get('capacitacion');
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
	 * Method: insertCapacitacion
	 * Summary: Insert a new capacitacion in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertCapacitacion($data)
	{
		$this->db->insert('capacitacion', $data);
	}
	
	/**
	 * Method: updateCapacitacion
	 * Summary: Update info for a given capacitacion
	 * @access public
	 * @param integer $capacitacion_id
	 * @param array $data
	 * @return 
	 */
	function updateCapacitacion($capacitacion_id, $data)
	{
		$this->db->where('capacitacion_id', $capacitacion_id);
		$this->db->update('capacitacion', $data);	
	}
	
	/**
	 * Method: deleteCapacitacion
	 * Summary: Deletes a given capacitacion from the database
	 * @access public
	 * @param integer $capacitacion_id
	 */
	function deleteCapacitacion($capacitacion_id)
	{
		$this->db->where('capacitacion_id', $capacitacion_id);
		$this->db->delete('capacitacion');
	}
}

/* End of file capacitacion_model.php */
/* Location: ./system/application/models/capacitacion_model.php */
?>