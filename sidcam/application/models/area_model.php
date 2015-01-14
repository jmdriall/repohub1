<?php
/**
 * Classname: Area_model
 * Summary: Model for Area objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Area_Model extends CI_Model
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
	 * Method: getAllAreas
	 * Summary: Returns a collection of areas for one area for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllAreas($per_p, $off_set, $user_id)
	{
		$this->db->order_by('area_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('area');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('area');
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
     * Method: getAllAreas
     * Summary: Returns a collection of areas for one area for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('area_id', 'ASC');
        $query = $this->db->get('area');

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
	 * Method: getTotalAreas
	 * Summary: Returns the total number of areas of the database
	 * @access public
	 * @return integer
	 */
	function getTotalAreas()
	{	

		$query = $this->db->get('area');
		return $query->num_rows();
	}
	
	/**
	 * Method: getAreaByAreaId
	 * Summary: returns the data for a single area
	 * @access public
	 * @param integer $area_id
	 * @return 
	 */
	function getAreaByAreaId($area_id)
	{
		$this->db->where('area_id',$area_id);
		$query = $this->db->get('area');
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
	 * Method: insertArea
	 * Summary: Insert a new area in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertArea($data)
	{
		$this->db->insert('area', $data);
	}
	
	/**
	 * Method: updateArea
	 * Summary: Update info for a given area
	 * @access public
	 * @param integer $area_id
	 * @param array $data
	 * @return 
	 */
	function updateArea($area_id, $data)
	{
		$this->db->where('area_id', $area_id);
		$this->db->update('area', $data);	
	}
	
	/**
	 * Method: deleteArea
	 * Summary: Deletes a given area from the database
	 * @access public
	 * @param integer $area_id
	 */
	function deleteArea($area_id)
	{
		$this->db->where('area_id', $area_id);
		$this->db->delete('area');
	}
}

/* End of file area_model.php */
/* Location: ./system/application/models/area_model.php */
?>