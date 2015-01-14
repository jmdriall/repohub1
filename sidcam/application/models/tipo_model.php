<?php
/**
 * Classname: Tipo_model
 * Summary: Model for Tipo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Tipo_Model extends CI_Model
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
	 * Method: getAllTipos
	 * Summary: Returns a collection of tipos for one tipo for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllTipos($per_p, $off_set, $user_id)
	{
		$this->db->order_by('tipo_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
            $this->db->where('user_id', $user_id);
			$query = $this->db->get('tipo');
		}
		else
		{
            $this->db->where('user_id', $user_id);
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('tipo');
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
     * Method: getAllTipos
     * Summary: Returns a collection of tipos for one tipo for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('tipo_id', 'ASC');
        $query = $this->db->get('tipo');

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
	 * Method: getTotalTipos
	 * Summary: Returns the total number of tipos of the database
	 * @access public
	 * @return integer
	 */
	function getTotalTipos()
	{	

		$query = $this->db->get('tipo');
		return $query->num_rows();
	}
	
	/**
	 * Method: getTipoByTipoId
	 * Summary: returns the data for a single tipo
	 * @access public
	 * @param integer $tipo_id
	 * @return 
	 */
	function getTipoByTipoId($tipo_id)
	{
		$this->db->where('tipo_id',$tipo_id);
		$query = $this->db->get('tipo');
		if ($query->num_rows() == 1) 
		{
			return $query->row();
		} 
		else
		{
			return FALSE;		
		}			
	}
    function getTipoByNombre($user_id, $nombre)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('nombre',$nombre);
        $query = $this->db->get('tipo');
        if ($query->num_rows() == 1)
        {
            return $query->row();
        }
        else
        {
            return 'ja';
        }
    }
	
	/**
	 * Method: insertTipo
	 * Summary: Insert a new tipo in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertTipo($data)
	{
		$this->db->insert('tipo', $data);
	}
	
	/**
	 * Method: updateTipo
	 * Summary: Update info for a given tipo
	 * @access public
	 * @param integer $tipo_id
	 * @param array $data
	 * @return 
	 */
	function updateTipo($tipo_id, $data)
	{
		$this->db->where('tipo_id', $tipo_id);
		$this->db->update('tipo', $data);	
	}
	
	/**
	 * Method: deleteTipo
	 * Summary: Deletes a given tipo from the database
	 * @access public
	 * @param integer $tipo_id
	 */
	function deleteTipo($tipo_id)
	{
		$this->db->where('tipo_id', $tipo_id);
		$this->db->delete('tipo');
	}
}

/* End of file tipo_model.php */
/* Location: ./system/application/models/tipo_model.php */
?>