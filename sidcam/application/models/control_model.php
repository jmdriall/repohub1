<?php
/**
 * Classname: Control_model
 * Summary: Model for Control objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Control_Model extends CI_Model
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
	 * Method: getAllControl
	 * Summary: Returns a collection of control for one control for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllControl($per_p, $off_set, $seguimiento_id)
	{
		$this->db->order_by('control_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('seguimiento_id', $seguimiento_id);
			$query = $this->db->get('control');
		}
		else
		{
            $this->db->where('seguimiento_id', $seguimiento_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('control');
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
     * Method: getAllControl
     * Summary: Returns a collection of control for one control for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($seguimiento_id)
    {
        $this->db->where('seguimiento_id', $seguimiento_id);
        $this->db->order_by('control_id', 'ASC');
        $query = $this->db->get('control');

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
        $this->db->order_by('control_id', 'ASC');
        $query = $this->db->get('control');

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
	 * Method: getTotalControl
	 * Summary: Returns the total number of control of the database
	 * @access public
	 * @return integer
	 */
	function getTotalControl()
	{	

		$query = $this->db->get('control');
		return $query->num_rows();
	}
	
	/**
	 * Method: getControlByControlId
	 * Summary: returns the data for a single control
	 * @access public
	 * @param integer $control_id
	 * @return 
	 */
	function getControlByControlId($control_id)
	{
		$this->db->where('control_id',$control_id);
		$query = $this->db->get('control');
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
	 * Method: insertControl
	 * Summary: Insert a new control in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertControl($data)
	{
		$this->db->insert('control', $data);
	}
	
	/**
	 * Method: updateControl
	 * Summary: Update info for a given control
	 * @access public
	 * @param integer $control_id
	 * @param array $data
	 * @return 
	 */
	function updateControl($control_id, $data)
	{
		$this->db->where('control_id', $control_id);
		$this->db->update('control', $data);	
	}
	
	/**
	 * Method: deleteControl
	 * Summary: Deletes a given control from the database
	 * @access public
	 * @param integer $control_id
	 */
	function deleteControl($control_id)
	{
		$this->db->where('control_id', $control_id);
		$this->db->delete('control');
	}
}

/* End of file control_model.php */
/* Location: ./system/application/models/control_model.php */
?>