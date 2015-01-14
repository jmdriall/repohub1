<?php
/**
 * Classname: Epp_model
 * Summary: Model for Epp objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Epp_Model extends CI_Model
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
	 * Method: getAllEpps
	 * Summary: Returns a collection of epps for one epp for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllEpps($per_p, $off_set, $user_id)
	{
		$this->db->order_by('epp_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('epp');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('epp');
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
     * Method: getAllEpps
     * Summary: Returns a collection of epps for one epp for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('epp_id', 'ASC');
        $query = $this->db->get('epp');

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
	 * Method: getTotalEpps
	 * Summary: Returns the total number of epps of the database
	 * @access public
	 * @return integer
	 */
	function getTotalEpps()
	{	

		$query = $this->db->get('epp');
		return $query->num_rows();
	}
	
	/**
	 * Method: getEppByEppId
	 * Summary: returns the data for a single epp
	 * @access public
	 * @param integer $epp_id
	 * @return 
	 */
	function getEppByEppId($epp_id)
	{
		$this->db->where('epp_id',$epp_id);
		$query = $this->db->get('epp');
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
	 * Method: insertEpp
	 * Summary: Insert a new epp in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertEpp($data)
	{
		$this->db->insert('epp', $data);
	}
	
	/**
	 * Method: updateEpp
	 * Summary: Update info for a given epp
	 * @access public
	 * @param integer $epp_id
	 * @param array $data
	 * @return 
	 */
	function updateEpp($epp_id, $data)
	{
		$this->db->where('epp_id', $epp_id);
		$this->db->update('epp', $data);	
	}
	
	/**
	 * Method: deleteEpp
	 * Summary: Deletes a given epp from the database
	 * @access public
	 * @param integer $epp_id
	 */
	function deleteEpp($epp_id)
	{
		$this->db->where('epp_id', $epp_id);
		$this->db->delete('epp');
	}
}

/* End of file epp_model.php */
/* Location: ./system/application/models/epp_model.php */
?>