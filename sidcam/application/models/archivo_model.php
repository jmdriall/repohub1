<?php
/**
 * Classname: Archivo_model
 * Summary: Model for Archivo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Archivo_Model extends CI_Model
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
	 * Method: getAllArchivos
	 * Summary: Returns a collection of archivos for one archivo for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllArchivos($user_id, $per_p, $off_set)
	{
		$this->db->where('user_id',$user_id);
		$this->db->order_by('archivo_id', 'DESC');
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('archivo');
		}
		else
		{
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('archivo');
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
	 * Method: getAllArchivos
	 * Summary: Returns a collection of archivos for one archivo for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getVisitArchivos($user_id, $per_p, $off_set)
	{
		$this->db->where('user_id',$user_id);
		$this->db->order_by('visit', 'DESC');
		$this->db->limit(5);
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('archivo');
		}
		else
		{
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('archivo');
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
     * Method: getAllArchivos
     * Summary: Returns a collection of archivos for one archivo for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll()
    {
        $this->db->order_by('archivo_id', 'ASC');
        $query = $this->db->get('archivo');

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
	 * Method: getTotalArchivos
	 * Summary: Returns the total number of archivos of the database
	 * @access public
	 * @return integer
	 */
	function getTotalArchivos()
	{	

		$query = $this->db->get('archivo');
		return $query->num_rows();
	}
    function getTotalArchivosBy_userId($user_id)
    {
        $this->db->where('user_id',$user_id);

        $query = $this->db->get('archivo');
        return $query->num_rows();
    }
	
	/**
	 * Method: getArchivoByArchivoId
	 * Summary: returns the data for a single archivo
	 * @access public
	 * @param integer $archivo_id
	 * @return 
	 */
	function getArchivoByArchivoId($archivo_id)
	{
		$this->db->where('archivo_id',$archivo_id);
		$query = $this->db->get('archivo');
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		} 
		else
		{
			return FALSE;		
		}			
	}
    function getArchivoByTipoId($user_id, $tipo_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->where('tipo_id',$tipo_id);
        $this->db->order_by('codigo', 'ASC');
        $query = $this->db->get('archivo');
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
     * Method: getArchivoByArchivoId
     * Summary: returns the data for a single archivo
     * @access public
     * @param integer $archivo_id
     * @return
     */
    function getArchivoByArchivoPicture($picture, $user_id)
    {
        $this->db->where('picture',$picture);
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('archivo');
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	/**
	 * Method: insertArchivo
	 * Summary: Insert a new archivo in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertArchivo($data)
	{
		$this->db->insert('archivo', $data);
	}
	
	/**
	 * Method: updateArchivo
	 * Summary: Update info for a given archivo
	 * @access public
	 * @param integer $archivo_id
	 * @param array $data
	 * @return 
	 */
	function updateArchivo($archivo_id, $data)
	{
		$this->db->where('archivo_id', $archivo_id);
		$this->db->update('archivo', $data);	
	}
	
	/**
	 * Method: deleteArchivo
	 * Summary: Deletes a given archivo from the database
	 * @access public
	 * @param integer $archivo_id
	 */
	function deleteArchivo($archivo_id)
	{
		$this->db->where('archivo_id', $archivo_id);
		$this->db->delete('archivo');
	}
}

/* End of file archivo_model.php */
/* Location: ./system/application/models/archivo_model.php */
?>