<?php
/**
 * Classname: Accidente_model
 * Summary: Model for Accidente objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Accidente_Model extends CI_Model
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
	 * Method: getAllAccidente
	 * Summary: Returns a collection of accidente for one accidente for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
    function getAllByMonth($user_id,$anio,$mes){
        $query = $this->db->query("SELECT accidente.area_id,accidente.observacion descripcion,accidente.accidente_id,accidente.user_id,accidente.fecha_ocurrida,accidente.titulo,accidente.dias_perdidos FROM `accidente` where YEAR(accidente.fecha_ocurrida)='".$anio."' and MONTH(accidente.fecha_ocurrida)='".$mes."' and accidente.user_id = ".$user_id." ORDER BY accidente.fecha_ocurrida" );
        if($query->num_rows() > 0)
            return $query->result();
        else
            return FALSE;
    }
    function getSumByMonth($user_id,$anio,$mes){
        $query = $this->db->query("SELECT sum(dias_perdidos) totalPerdidosMes FROM accidente where user_id=".$user_id." and YEAR(fecha_ocurrida)=".$anio." and MONTH(fecha_ocurrida)=".$mes);
        if($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }
    function getCountByMonth($user_id,$anio,$mes){
        $query = $this->db->query("SELECT count(accidente_id) hhrt FROM accidente where user_id=".$user_id." and YEAR(fecha_ocurrida)=".$anio." and MONTH(fecha_ocurrida)=".$mes);
        if($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }
    function getPorcentajeByMonth($user_id,$area_id,$anio,$mes){
        $query = $this->db->query("SELECT count(dias_perdidos) porcentaje FROM accidente where area_id=".$area_id." and YEAR(fecha_ocurrida)=".$anio." and MONTH(fecha_ocurrida)=".$mes." and user_id=".$user_id);
        if($query->num_rows() > 0)
            return $query->row();
        else
            return FALSE;
    }
	function getAllAccidente($per_p, $off_set, $user_id)
	{
		$this->db->order_by('fecha_ocurrida', 'DESC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('accidente');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('accidente');
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
     * Method: getAllAccidente
     * Summary: Returns a collection of accidente for one accidente for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('accidente_id', 'ASC');
        $query = $this->db->get('accidente');

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
	 * Method: getTotalAccidente
	 * Summary: Returns the total number of accidente of the database
	 * @access public
	 * @return integer
	 */
	function getTotalAccidente()
	{	

		$query = $this->db->get('accidente');
		return $query->num_rows();
	}
	
	/**
	 * Method: getAccidenteByAccidenteId
	 * Summary: returns the data for a single accidente
	 * @access public
	 * @param integer $accidente_id
	 * @return 
	 */
	function getAccidenteByAccidenteId($accidente_id)
	{
		$this->db->where('accidente_id',$accidente_id);
		$query = $this->db->get('accidente');
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
	 * Method: insertAccidente
	 * Summary: Insert a new accidente in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertAccidente($data)
	{
		$this->db->insert('accidente', $data);
	}
	
	/**
	 * Method: updateAccidente
	 * Summary: Update info for a given accidente
	 * @access public
	 * @param integer $accidente_id
	 * @param array $data
	 * @return 
	 */
	function updateAccidente($accidente_id, $data)
	{
		$this->db->where('accidente_id', $accidente_id);
		$this->db->update('accidente', $data);	
	}
	
	/**
	 * Method: deleteAccidente
	 * Summary: Deletes a given accidente from the database
	 * @access public
	 * @param integer $accidente_id
	 */
	function deleteAccidente($accidente_id)
	{
		$this->db->where('accidente_id', $accidente_id);
		$this->db->delete('accidente');
	}
}

/* End of file accidente_model.php */
/* Location: ./system/application/models/accidente_model.php */
?>