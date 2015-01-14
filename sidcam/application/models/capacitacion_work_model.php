<?php
/**
 * Classname: Capacitacion_work_model
 * Summary: Model for Capacitacion_work objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Capacitacion_work_Model extends CI_Model
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
	 * Method: getAllCapacitacion_work
	 * Summary: Returns a collection of capacitacion_work for one capacitacion_work for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllCapacitacion_work($per_p, $off_set, $trabajador_id)
	{
		$this->db->order_by('capacitacion_work_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('trabajador_id', $trabajador_id);
			$query = $this->db->get('capacitacion_work');
		}
		else
		{
            $this->db->where('trabajador_id', $trabajador_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('capacitacion_work');
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
     * Method: getAllCapacitacion_work
     * Summary: Returns a collection of capacitacion_work for one capacitacion_work for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($trabajador_id)
    {
        $this->db->where('trabajador_id', $trabajador_id);
        $this->db->order_by('capacitacion_work_id', 'ASC');
        $query = $this->db->get('capacitacion_work');

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
        $this->db->order_by('capacitacion_work_id', 'ASC');
        $query = $this->db->get('capacitacion_work');

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
	 * Method: getTotalCapacitacion_work
	 * Summary: Returns the total number of capacitacion_work of the database
	 * @access public
	 * @return integer
	 */
	function getTotalCapacitacion_work()
	{	

		$query = $this->db->get('capacitacion_work');
		return $query->num_rows();
	}
	
	/**
	 * Method: getCapacitacion_workByCapacitacion_workId
	 * Summary: returns the data for a single capacitacion_work
	 * @access public
	 * @param integer $capacitacion_work_id
	 * @return 
	 */
	function getCapacitacion_workByCapacitacion_workId($capacitacion_work_id)
	{
		$this->db->where('capacitacion_work_id',$capacitacion_work_id);
		$query = $this->db->get('capacitacion_work');
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
	 * Method: insertCapacitacion_work
	 * Summary: Insert a new capacitacion_work in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertCapacitacion_work($data)
	{
		$this->db->insert('capacitacion_work', $data);
	}
	
	/**
	 * Method: updateCapacitacion_work
	 * Summary: Update info for a given capacitacion_work
	 * @access public
	 * @param integer $capacitacion_work_id
	 * @param array $data
	 * @return 
	 */
	function updateCapacitacion_work($capacitacion_work_id, $data)
	{
		$this->db->where('capacitacion_work_id', $capacitacion_work_id);
		$this->db->update('capacitacion_work', $data);	
	}
	
	/**
	 * Method: deleteCapacitacion_work
	 * Summary: Deletes a given capacitacion_work from the database
	 * @access public
	 * @param integer $capacitacion_work_id
	 */
	function deleteCapacitacion_work($capacitacion_work_id)
	{
		$this->db->where('capacitacion_work_id', $capacitacion_work_id);
		$this->db->delete('capacitacion_work');
	}
}

/* End of file capacitacion_work_model.php */
/* Location: ./system/application/models/capacitacion_work_model.php */
?>