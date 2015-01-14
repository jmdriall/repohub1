<?php
/**
 * Classname: Sub_category_model
 * Summary: Model for Sub_category objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Sub_category_Model extends CI_Model
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
	 * Method: getAllSub_categorys
	 * Summary: Returns a collection of sub_categorys for one sub_category for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllSub_categorys($category_id, $per_p, $off_set)
	{
		$this->db->where('category_id',$category_id);
		$this->db->order_by('sub_category_id', 'DESC');
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('sub_category');
		}
		else
		{
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('sub_category');
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
	 * Method: getAllSub_categorys
	 * Summary: Returns a collection of sub_categorys for one sub_category for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getVisitSub_categorys($category_id, $per_p, $off_set)
	{
		$this->db->where('category_id',$category_id);
		$this->db->order_by('visit', 'DESC');
		$this->db->limit(5);
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('sub_category');
		}
		else
		{
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('sub_category');
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
     * Method: getAllSub_categorys
     * Summary: Returns a collection of sub_categorys for one sub_category for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll()
    {
        $this->db->order_by('sub_category_id', 'ASC');
        $query = $this->db->get('sub_category');

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
	 * Method: getTotalSub_categorys
	 * Summary: Returns the total number of sub_categorys of the database
	 * @access public
	 * @return integer
	 */
	function getTotalSub_categorys()
	{	

		$query = $this->db->get('sub_category');
		return $query->num_rows();
	}
    function getTotalSub_categorysBy_categoryId($category_id)
    {
        $this->db->where('category_id',$category_id);

        $query = $this->db->get('sub_category');
        return $query->num_rows();
    }
	
	/**
	 * Method: getSub_categoryBySub_categoryId
	 * Summary: returns the data for a single sub_category
	 * @access public
	 * @param integer $sub_category_id
	 * @return 
	 */
	function getSub_categoryBySub_categoryId($sub_category_id)
	{
		$this->db->where('sub_category_id',$sub_category_id);
		$query = $this->db->get('sub_category');
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		} 
		else
		{
			return FALSE;		
		}			
	}
    /**
     * Method: getSub_categoryBySub_categoryId
     * Summary: returns the data for a single sub_category
     * @access public
     * @param integer $sub_category_id
     * @return
     */
    function getSub_categoryBySub_categoryPicture($picture)
    {
        $this->db->where('picture',$picture);
        $query = $this->db->get('sub_category');
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
	 * Method: insertSub_category
	 * Summary: Insert a new sub_category in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertSub_category($data)
	{
		$this->db->insert('sub_category', $data);
	}
	
	/**
	 * Method: updateSub_category
	 * Summary: Update info for a given sub_category
	 * @access public
	 * @param integer $sub_category_id
	 * @param array $data
	 * @return 
	 */
	function updateSub_category($sub_category_id, $data)
	{
		$this->db->where('sub_category_id', $sub_category_id);
		$this->db->update('sub_category', $data);	
	}
	
	/**
	 * Method: deleteSub_category
	 * Summary: Deletes a given sub_category from the database
	 * @access public
	 * @param integer $sub_category_id
	 */
	function deleteSub_category($sub_category_id)
	{
		$this->db->where('sub_category_id', $sub_category_id);
		$this->db->delete('sub_category');
	}
}

/* End of file sub_category_model.php */
/* Location: ./system/application/models/sub_category_model.php */
?>