<?php
/**
 * Classname: Planificacion_model
 * Summary: Model for Planificacion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Planificacion_Model extends CI_Model
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
	 * Method: getAllPlanificacions
	 * Summary: Returns a collection of planificacions for one planificacion for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
    function getPlanificacionByUserId($user_id)
    {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('planificacion');
        if ($query->num_rows() >0)
        {
            return $query->result();
        }
        else
        {
            return FALSE;
        }
    }
	function getAllPlanificacions($per_p, $off_set, $actividad_id)
	{
		$this->db->order_by('planificacion_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('actividad_id', $actividad_id);
			$query = $this->db->get('planificacion');
		}
		else
		{
            $this->db->where('actividad_id', $actividad_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('planificacion');
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
     * Method: getAllPlanificacions
     * Summary: Returns a collection of planificacions for one planificacion for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($actividad_id)
    {
        $this->db->where('actividad_id', $actividad_id);
        $this->db->order_by('planificacion_id', 'ASC');
        $query = $this->db->get('planificacion');

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
	 * Method: getTotalPlanificacions
	 * Summary: Returns the total number of planificacions of the database
	 * @access public
	 * @return integer
	 */
	function getTotalPlanificacions()
	{	

		$query = $this->db->get('planificacion');
		return $query->num_rows();
	}
	
	/**
	 * Method: getPlanificacionByPlanificacionId
	 * Summary: returns the data for a single planificacion
	 * @access public
	 * @param integer $planificacion_id
	 * @return 
	 */
	function getPlanificacionByPlanificacionId($planificacion_id)
	{
		$this->db->where('planificacion_id',$planificacion_id);
		$query = $this->db->get('planificacion');
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		} 
		else
		{
			return FALSE;		
		}			
	}
    function  betwen($user_id, $anio, $mes){
        $this->db->where('user_id', $user_id);
        //$query = $this->db->query("SELECT * FROM planificacion WHERE fecha_ini BETWEEN '".$ini."' AND '".$fin."' ");
        $query = $this->db->query("SELECT * FROM planificacion p1 WHERE  YEAR (p1.fecha_ini)= '".$anio."' and MONTH (p1.fecha_ini)= '".$mes."' and p1.user_id = '".$user_id."'");
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
	 * Method: insertPlanificacion
	 * Summary: Insert a new planificacion in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertPlanificacion($data)
	{
		$this->db->insert('planificacion', $data);
	}
	
	/**
	 * Method: updatePlanificacion
	 * Summary: Update info for a given planificacion
	 * @access public
	 * @param integer $planificacion_id
	 * @param array $data
	 * @return 
	 */
	function updatePlanificacion($planificacion_id, $data)
	{
		$this->db->where('planificacion_id', $planificacion_id);
		$this->db->update('planificacion', $data);	
	}
	
	/**
	 * Method: deletePlanificacion
	 * Summary: Deletes a given planificacion from the database
	 * @access public
	 * @param integer $planificacion_id
	 */
	function deletePlanificacion($planificacion_id)
	{
		$this->db->where('planificacion_id', $planificacion_id);
		$this->db->delete('planificacion');
	}

}

/* End of file planificacion_model.php */
/* Location: ./system/application/models/planificacion_model.php */
?>