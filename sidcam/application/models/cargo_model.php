<?php
/**
 * Classname: Cargo_model
 * Summary: Model for Cargo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Cargo_Model extends CI_Model
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
	 * Method: getAllCargos
	 * Summary: Returns a collection of cargos for one cargo for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllCargos($per_p, $off_set, $user_id)
	{
		$this->db->order_by('cargo_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('cargo');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('cargo');
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
     * Method: getAllCargos
     * Summary: Returns a collection of cargos for one cargo for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('cargo_id', 'ASC');
        $query = $this->db->get('cargo');

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
	 * Method: getTotalCargos
	 * Summary: Returns the total number of cargos of the database
	 * @access public
	 * @return integer
	 */
	function getTotalCargos()
	{	

		$query = $this->db->get('cargo');
		return $query->num_rows();
	}
	
	/**
	 * Method: getCargoByCargoId
	 * Summary: returns the data for a single cargo
	 * @access public
	 * @param integer $cargo_id
	 * @return 
	 */
	function getCargoByCargoId($cargo_id)
	{
		$this->db->where('cargo_id',$cargo_id);
		$query = $this->db->get('cargo');
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
	 * Method: insertCargo
	 * Summary: Insert a new cargo in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertCargo($data)
	{
		$this->db->insert('cargo', $data);
	}
	
	/**
	 * Method: updateCargo
	 * Summary: Update info for a given cargo
	 * @access public
	 * @param integer $cargo_id
	 * @param array $data
	 * @return 
	 */
	function updateCargo($cargo_id, $data)
	{
		$this->db->where('cargo_id', $cargo_id);
		$this->db->update('cargo', $data);	
	}
	
	/**
	 * Method: deleteCargo
	 * Summary: Deletes a given cargo from the database
	 * @access public
	 * @param integer $cargo_id
	 */
	function deleteCargo($cargo_id)
	{
		$this->db->where('cargo_id', $cargo_id);
		$this->db->delete('cargo');
	}
}

/* End of file cargo_model.php */
/* Location: ./system/application/models/cargo_model.php */
?>