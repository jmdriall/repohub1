<?php
/**
 * Classname: Inspeccion_model
 * Summary: Model for Inspeccion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Inspeccion_Model extends CI_Model
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
	 * Method: getAllInspeccion
	 * Summary: Returns a collection of inspeccion for one inspeccion for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllInspeccion($per_p, $off_set, $user_id)
	{
		$this->db->order_by('inspeccion_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('inspeccion');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('inspeccion');
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
     * Method: getAllInspeccion
     * Summary: Returns a collection of inspeccion for one inspeccion for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('inspeccion_id', 'ASC');
        $query = $this->db->get('inspeccion');

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
	 * Method: getTotalInspeccion
	 * Summary: Returns the total number of inspeccion of the database
	 * @access public
	 * @return integer
	 */
	function getTotalInspeccion()
	{	

		$query = $this->db->get('inspeccion');
		return $query->num_rows();
	}
	
	/**
	 * Method: getInspeccionByInspeccionId
	 * Summary: returns the data for a single inspeccion
	 * @access public
	 * @param integer $inspeccion_id
	 * @return 
	 */
	function getInspeccionByInspeccionId($inspeccion_id)
	{
		$this->db->where('inspeccion_id',$inspeccion_id);
		$query = $this->db->get('inspeccion');
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
	 * Method: insertInspeccion
	 * Summary: Insert a new inspeccion in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertInspeccion($data)
	{
		$this->db->insert('inspeccion', $data);
	}
	
	/**
	 * Method: updateInspeccion
	 * Summary: Update info for a given inspeccion
	 * @access public
	 * @param integer $inspeccion_id
	 * @param array $data
	 * @return 
	 */
	function updateInspeccion($inspeccion_id, $data)
	{
		$this->db->where('inspeccion_id', $inspeccion_id);
		$this->db->update('inspeccion', $data);	
	}
	
	/**
	 * Method: deleteInspeccion
	 * Summary: Deletes a given inspeccion from the database
	 * @access public
	 * @param integer $inspeccion_id
	 */
	function deleteInspeccion($inspeccion_id)
	{
		$this->db->where('inspeccion_id', $inspeccion_id);
		$this->db->delete('inspeccion');
	}
}

/* End of file inspeccion_model.php */
/* Location: ./system/application/models/inspeccion_model.php */
?>