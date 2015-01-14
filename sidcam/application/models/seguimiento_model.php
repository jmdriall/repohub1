<?php
/**
 * Classname: Seguimiento_model
 * Summary: Model for Seguimiento objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Seguimiento_Model extends CI_Model
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
	 * Method: getAllSeguimiento
	 * Summary: Returns a collection of seguimiento for one seguimiento for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllSeguimiento($per_p, $off_set, $user_id)
	{
		$this->db->order_by('seguimiento_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('seguimiento');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('seguimiento');
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
     * Method: getAllSeguimiento
     * Summary: Returns a collection of seguimiento for one seguimiento for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('seguimiento_id', 'ASC');
        $query = $this->db->get('seguimiento');

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
	 * Method: getTotalSeguimiento
	 * Summary: Returns the total number of seguimiento of the database
	 * @access public
	 * @return integer
	 */
	function getTotalSeguimiento()
	{	

		$query = $this->db->get('seguimiento');
		return $query->num_rows();
	}
	
	/**
	 * Method: getSeguimientoBySeguimientoId
	 * Summary: returns the data for a single seguimiento
	 * @access public
	 * @param integer $seguimiento_id
	 * @return 
	 */
	function getSeguimientoBySeguimientoId($seguimiento_id)
	{
		$this->db->where('seguimiento_id',$seguimiento_id);
		$query = $this->db->get('seguimiento');
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
	 * Method: insertSeguimiento
	 * Summary: Insert a new seguimiento in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertSeguimiento($data)
	{
		$this->db->insert('seguimiento', $data);
	}
	
	/**
	 * Method: updateSeguimiento
	 * Summary: Update info for a given seguimiento
	 * @access public
	 * @param integer $seguimiento_id
	 * @param array $data
	 * @return 
	 */
	function updateSeguimiento($seguimiento_id, $data)
	{
		$this->db->where('seguimiento_id', $seguimiento_id);
		$this->db->update('seguimiento', $data);	
	}
	
	/**
	 * Method: deleteSeguimiento
	 * Summary: Deletes a given seguimiento from the database
	 * @access public
	 * @param integer $seguimiento_id
	 */
	function deleteSeguimiento($seguimiento_id)
	{
		$this->db->where('seguimiento_id', $seguimiento_id);
		$this->db->delete('seguimiento');
	}
}

/* End of file seguimiento_model.php */
/* Location: ./system/application/models/seguimiento_model.php */
?>