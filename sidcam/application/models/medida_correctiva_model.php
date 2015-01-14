<?php
/**
 * Classname: Medida_correctiva_model
 * Summary: Model for Medida_correctiva objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Medida_correctiva_Model extends CI_Model
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
	 * Method: getAllMedida_correctiva
	 * Summary: Returns a collection of medida_correctiva for one medida_correctiva for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllMedida_correctiva($per_p, $off_set, $accidente_id)
	{
		$this->db->order_by('medida_correctiva_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('accidente_id', $accidente_id);
			$query = $this->db->get('medida_correctiva');
		}
		else
		{
            $this->db->where('accidente_id', $accidente_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('medida_correctiva');
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
     * Method: getAllMedida_correctiva
     * Summary: Returns a collection of medida_correctiva for one medida_correctiva for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($accidente_id)
    {
        $this->db->where('accidente_id', $accidente_id);
        $this->db->order_by('medida_correctiva_id', 'ASC');
        $query = $this->db->get('medida_correctiva');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
    function getAllByUserID($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('medida_correctiva_id', 'ASC');
        $query = $this->db->get('medida_correctiva');

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
	 * Method: getTotalMedida_correctiva
	 * Summary: Returns the total number of medida_correctiva of the database
	 * @access public
	 * @return integer
	 */
	function getTotalMedida_correctiva()
	{	

		$query = $this->db->get('medida_correctiva');
		return $query->num_rows();
	}
	
	/**
	 * Method: getMedida_correctivaByMedida_correctivaId
	 * Summary: returns the data for a single medida_correctiva
	 * @access public
	 * @param integer $medida_correctiva_id
	 * @return 
	 */
	function getMedida_correctivaByMedida_correctivaId($medida_correctiva_id)
	{
		$this->db->where('medida_correctiva_id',$medida_correctiva_id);
		$query = $this->db->get('medida_correctiva');
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
	 * Method: insertMedida_correctiva
	 * Summary: Insert a new medida_correctiva in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertMedida_correctiva($data)
	{
		$this->db->insert('medida_correctiva', $data);
	}
	
	/**
	 * Method: updateMedida_correctiva
	 * Summary: Update info for a given medida_correctiva
	 * @access public
	 * @param integer $medida_correctiva_id
	 * @param array $data
	 * @return 
	 */
	function updateMedida_correctiva($medida_correctiva_id, $data)
	{
		$this->db->where('medida_correctiva_id', $medida_correctiva_id);
		$this->db->update('medida_correctiva', $data);	
	}
	
	/**
	 * Method: deleteMedida_correctiva
	 * Summary: Deletes a given medida_correctiva from the database
	 * @access public
	 * @param integer $medida_correctiva_id
	 */
	function deleteMedida_correctiva($medida_correctiva_id)
	{
		$this->db->where('medida_correctiva_id', $medida_correctiva_id);
		$this->db->delete('medida_correctiva');
	}
}

/* End of file medida_correctiva_model.php */
/* Location: ./system/application/models/medida_correctiva_model.php */
?>