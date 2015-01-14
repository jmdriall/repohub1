<?php
/**
 * Classname: Objetivo_model
 * Summary: Model for Objetivo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Objetivo_Model extends CI_Model
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
	 * Method: getAllObjetivos
	 * Summary: Returns a collection of objetivos for one objetivo for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllObjetivos($per_p, $off_set, $user_id)
	{
		$this->db->order_by('objetivo_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('objetivo');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('objetivo');
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
     * Method: getAllObjetivos
     * Summary: Returns a collection of objetivos for one objetivo for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll()
    {
        $this->db->order_by('objetivo_id', 'ASC');
        $query = $this->db->get('objetivo');

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
	 * Method: getTotalObjetivos
	 * Summary: Returns the total number of objetivos of the database
	 * @access public
	 * @return integer
	 */
	function getTotalObjetivos()
	{	

		$query = $this->db->get('objetivo');
		return $query->num_rows();
	}
	
	/**
	 * Method: getObjetivoByObjetivoId
	 * Summary: returns the data for a single objetivo
	 * @access public
	 * @param integer $objetivo_id
	 * @return 
	 */
	function getObjetivoByObjetivoId($objetivo_id)
	{
		$this->db->where('objetivo_id',$objetivo_id);
		$query = $this->db->get('objetivo');
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		} 
		else
		{
			return FALSE;		
		}			
	}
    function getObjetivoByUserId($user_id)
    {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('objetivo');
        if ($query->num_rows() >0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
	
	/**
	 * Method: insertObjetivo
	 * Summary: Insert a new objetivo in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertObjetivo($data)
	{
		$this->db->insert('objetivo', $data);
	}
	
	/**
	 * Method: updateObjetivo
	 * Summary: Update info for a given objetivo
	 * @access public
	 * @param integer $objetivo_id
	 * @param array $data
	 * @return 
	 */
	function updateObjetivo($objetivo_id, $data)
	{
		$this->db->where('objetivo_id', $objetivo_id);
		$this->db->update('objetivo', $data);	
	}
	
	/**
	 * Method: deleteObjetivo
	 * Summary: Deletes a given objetivo from the database
	 * @access public
	 * @param integer $objetivo_id
	 */
	function deleteObjetivo($objetivo_id)
	{
		$this->db->where('objetivo_id', $objetivo_id);
		$this->db->delete('objetivo');
	}
}

/* End of file objetivo_model.php */
/* Location: ./system/application/models/objetivo_model.php */
?>