<?php
/**
 * Classname: Actividad_model
 * Summary: Model for Actividad objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Actividad_Model extends CI_Model
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
	 * Method: getAllActividads
	 * Summary: Returns a collection of actividads for one actividad for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllActividads($per_p, $off_set, $especifico_id = 0, $user_id)
	{
		$this->db->order_by('actividad_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
            $this->db->where('especifico_id', $especifico_id);
			$query = $this->db->get('actividad');
		}
		else
		{
            $this->db->where('user_id', $user_id);
            $this->db->where('especifico_id', $especifico_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('actividad');
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
     * Method: getAllActividads
     * Summary: Returns a collection of actividads for one actividad for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('actividad_id', 'ASC');
        $query = $this->db->get('actividad');

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }

    function getByEspecificoId($especifico_id)
    {
        $this->db->where('especifico_id', $especifico_id);
        $this->db->order_by('actividad_id', 'ASC');
        $query = $this->db->get('actividad');

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
	 * Method: getTotalActividads
	 * Summary: Returns the total number of actividads of the database
	 * @access public
	 * @return integer
	 */
	function getTotalActividads()
	{	

		$query = $this->db->get('actividad');
		return $query->num_rows();
	}
	
	/**
	 * Method: getActividadByActividadId
	 * Summary: returns the data for a single actividad
	 * @access public
	 * @param integer $actividad_id
	 * @return 
	 */
    function getActividadByUserId($user_id)
    {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('actividad');
        if ($query->num_rows() >0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
	function getActividadByActividadId($actividad_id)
	{
		$this->db->where('actividad_id',$actividad_id);
		$query = $this->db->get('actividad');
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
	 * Method: insertActividad
	 * Summary: Insert a new actividad in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertActividad($data)
	{
		$this->db->insert('actividad', $data);
	}
	
	/**
	 * Method: updateActividad
	 * Summary: Update info for a given actividad
	 * @access public
	 * @param integer $actividad_id
	 * @param array $data
	 * @return 
	 */
	function updateActividad($actividad_id, $data)
	{
		$this->db->where('actividad_id', $actividad_id);
		$this->db->update('actividad', $data);	
	}
	
	/**
	 * Method: deleteActividad
	 * Summary: Deletes a given actividad from the database
	 * @access public
	 * @param integer $actividad_id
	 */
	function deleteActividad($actividad_id)
	{
		$this->db->where('actividad_id', $actividad_id);
		$this->db->delete('actividad');
	}
}

/* End of file actividad_model.php */
/* Location: ./system/application/models/actividad_model.php */
?>