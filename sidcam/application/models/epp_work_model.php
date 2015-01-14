<?php
/**
 * Classname: Epp_work_model
 * Summary: Model for Epp_work objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Epp_work_Model extends CI_Model
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
	 * Method: getAllEpp_work
	 * Summary: Returns a collection of epp_work for one epp_work for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllEpp_work($per_p, $off_set, $trabajador_id)
	{
		$this->db->order_by('epp_work_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('trabajador_id', $trabajador_id);
			$query = $this->db->get('epp_work');
		}
		else
		{
            $this->db->where('trabajador_id', $trabajador_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('epp_work');
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
     * Method: getAllEpp_work
     * Summary: Returns a collection of epp_work for one epp_work for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($trabajador_id)
    {
        $this->db->where('trabajador_id', $trabajador_id);
        $this->db->order_by('epp_work_id', 'ASC');
        $query = $this->db->get('epp_work');

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
        $this->db->order_by('epp_work_id', 'ASC');
        $query = $this->db->get('epp_work');

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
	 * Method: getTotalEpp_work
	 * Summary: Returns the total number of epp_work of the database
	 * @access public
	 * @return integer
	 */
	function getTotalEpp_work()
	{	

		$query = $this->db->get('epp_work');
		return $query->num_rows();
	}
	
	/**
	 * Method: getEpp_workByEpp_workId
	 * Summary: returns the data for a single epp_work
	 * @access public
	 * @param integer $epp_work_id
	 * @return 
	 */
	function getEpp_workByEpp_workId($epp_work_id)
	{
		$this->db->where('epp_work_id',$epp_work_id);
		$query = $this->db->get('epp_work');
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
	 * Method: insertEpp_work
	 * Summary: Insert a new epp_work in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertEpp_work($data)
	{
		$this->db->insert('epp_work', $data);
	}
	
	/**
	 * Method: updateEpp_work
	 * Summary: Update info for a given epp_work
	 * @access public
	 * @param integer $epp_work_id
	 * @param array $data
	 * @return 
	 */
	function updateEpp_work($epp_work_id, $data)
	{
		$this->db->where('epp_work_id', $epp_work_id);
		$this->db->update('epp_work', $data);	
	}
	
	/**
	 * Method: deleteEpp_work
	 * Summary: Deletes a given epp_work from the database
	 * @access public
	 * @param integer $epp_work_id
	 */
	function deleteEpp_work($epp_work_id)
	{
		$this->db->where('epp_work_id', $epp_work_id);
		$this->db->delete('epp_work');
	}
}

/* End of file epp_work_model.php */
/* Location: ./system/application/models/epp_work_model.php */
?>