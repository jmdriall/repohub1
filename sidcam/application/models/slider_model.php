<?php
/**
 * Classname: Slider_Model
 * Summary: Model for Service objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Slider_Model extends CI_Model
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
	 * Method: getAllSlider
	 * Summary: Returns all the services 
	 * @access public
	 * @return 
	 */
	function getAllSlider($per_p=0, $off_set=0)
	{	
		$this->db->order_by('slider_id', 'DESC');
		if( $per_p == 0 AND $off_set == 0 ){
			$query = $this->db->get('slider');
		}else{
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('slider');
		}
		
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;		
		}
	}
	
	/**
	 * Method: getTotalSlider
	 * Summary: Returns the total number of services of the database
	 * @access public
	 * @return integer
	 */
	function getTotalSlider()
	{	
		$query = $this->db->get('slider');
		return $query->num_rows();
	}
	
	/**
	 * Method: getSliderBySliderId
	 * Summary: returns the data for a single service
	 * @access public
	 * @param integer $slider_id
	 * @return 
	 */
	function getSliderBySliderId($slider_id)
	{
		$this->db->where('slider_id',$slider_id);
		$query = $this->db->get('slider');
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
	 * Method: insertSlider
	 * Summary: Insert a new service in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertSlider($data)
	{
		$this->db->insert('slider', $data);
	}
	
	/**
	 * Method: updateSlider
	 * Summary: Update info for a given service
	 * @access public
	 * @param integer $slider_id
	 * @param array $data
	 * @return 
	 */
	function updateSlider($slider_id, $data)
	{
		$this->db->where('slider_id', $slider_id);
		$this->db->update('slider', $data);	
	}
	
	/**
	 * Method: deleteSlider
	 * Summary: Deletes a given service from the database
	 * @access public
	 * @param integer $slider_id
	 */
	function deleteSlider($slider_id)
	{
		$this->db->where('slider_id', $slider_id);
		$this->db->delete('slider');
	}
}

/* End of file service_model.php */
/* Location: ./system/application/models/service_model.php */
?>