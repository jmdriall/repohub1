<?php
/**
 * Classname: Body_Model
 * Summary: Model for Service objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Body_Model extends CI_Model
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
	 * Method: getAllBody
	 * Summary: Returns all the services 
	 * @access public
	 * @return 
	 */
	function getAllBody($user_id = 0)
	{	
		$this->db->order_by('body_id', 'DESC');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('body');
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;		
		}
	}
	
	/**
	 * Method: getTotalBody
	 * Summary: Returns the total number of services of the database
	 * @access public
	 * @return integer
	 */
	function getTotalBody()
	{	
		$query = $this->db->get('body');
		return $query->num_rows();
	}
	
	/**
	 * Method: getBodyByBodyId
	 * Summary: returns the data for a single service
	 * @access public
	 * @param integer $body_id
	 * @return 
	 */
	function getBodyByBodyId($body_id)
	{
		$this->db->where('body_id',$body_id);
		$query = $this->db->get('body');
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
	 * Method: insertBody
	 * Summary: Insert a new service in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertBody($data)
	{
		$this->db->insert('body', $data);
	}
	
	/**
	 * Method: updateBody
	 * Summary: Update info for a given service
	 * @access public
	 * @param integer $body_id
	 * @param array $data
	 * @return 
	 */
	function updateBody($body_id, $data)
	{
		$this->db->where('body_id', $body_id);
		$this->db->update('body', $data);	
	}
	
	/**
	 * Method: deleteBody
	 * Summary: Deletes a given service from the database
	 * @access public
	 * @param integer $body_id
	 */
	function deleteBody($body_id)
	{
		$this->db->where('body_id', $body_id);
		$this->db->delete('body');
	}
}

/* End of file service_model.php */
/* Location: ./system/application/models/service_model.php */
?>