<?php
/**
 * Classname: C_inspeccion_model
 * Summary: Model for C_inspeccion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class C_inspeccion_Model extends CI_Model
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
	 * Method: getAllC_inspeccion
	 * Summary: Returns a collection of c_inspeccion for one c_inspeccion for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllC_inspeccion($per_p, $off_set, $inspeccion_id)
	{
		$this->db->order_by('c_inspeccion_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('inspeccion_id', $inspeccion_id);
			$query = $this->db->get('c_inspeccion');
		}
		else
		{
            $this->db->where('inspeccion_id', $inspeccion_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('c_inspeccion');
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
     * Method: getAllC_inspeccion
     * Summary: Returns a collection of c_inspeccion for one c_inspeccion for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($inspeccion_id)
    {
        $this->db->where('inspeccion_id', $inspeccion_id);
        $this->db->order_by('c_inspeccion_id', 'ASC');
        $query = $this->db->get('c_inspeccion');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
    function getAllByUserId($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('c_inspeccion_id', 'ASC');
        $query = $this->db->get('c_inspeccion');

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
	 * Method: getTotalC_inspeccion
	 * Summary: Returns the total number of c_inspeccion of the database
	 * @access public
	 * @return integer
	 */
	function getTotalC_inspeccion()
	{	

		$query = $this->db->get('c_inspeccion');
		return $query->num_rows();
	}
	
	/**
	 * Method: getC_inspeccionByC_inspeccionId
	 * Summary: returns the data for a single c_inspeccion
	 * @access public
	 * @param integer $c_inspeccion_id
	 * @return 
	 */
	function getC_inspeccionByC_inspeccionId($c_inspeccion_id)
	{
		$this->db->where('c_inspeccion_id',$c_inspeccion_id);
		$query = $this->db->get('c_inspeccion');
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
	 * Method: insertC_inspeccion
	 * Summary: Insert a new c_inspeccion in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertC_inspeccion($data)
	{
		$this->db->insert('c_inspeccion', $data);
	}
	
	/**
	 * Method: updateC_inspeccion
	 * Summary: Update info for a given c_inspeccion
	 * @access public
	 * @param integer $c_inspeccion_id
	 * @param array $data
	 * @return 
	 */
	function updateC_inspeccion($c_inspeccion_id, $data)
	{
		$this->db->where('c_inspeccion_id', $c_inspeccion_id);
		$this->db->update('c_inspeccion', $data);	
	}
	
	/**
	 * Method: deleteC_inspeccion
	 * Summary: Deletes a given c_inspeccion from the database
	 * @access public
	 * @param integer $c_inspeccion_id
	 */
	function deleteC_inspeccion($c_inspeccion_id)
	{
		$this->db->where('c_inspeccion_id', $c_inspeccion_id);
		$this->db->delete('c_inspeccion');
	}
}

/* End of file c_inspeccion_model.php */
/* Location: ./system/application/models/c_inspeccion_model.php */
?>