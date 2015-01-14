<?php
/**
 * Classname: Category_model
 * Summary: Model for Category objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Category_Model extends CI_Model
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
	 * Method: getAllCategorys
	 * Summary: Returns a collection of categorys for one category for pagination display
	 * @access public
	 * @param integer $per_p
	 * @param integer $off_set
	 * @return 
	 */
	function getAllCategorys($per_p, $off_set)
	{
		$this->db->order_by('category_id', 'ASC');
		if( $per_p == 0 AND $off_set == 0 )
		{
			$query = $this->db->get('category');
		}
		else
		{
			$this->db->limit($per_p, $off_set);
			$query = $this->db->get('category');
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
     * Method: getAllCategorys
     * Summary: Returns a collection of categorys for one category for pagination display
     * @access public
     * @param integer $per_p
     * @param integer $off_set
     * @return
     */
    function getAll()
    {
        $this->db->order_by('category_id', 'ASC');
        $query = $this->db->get('category');

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
	 * Method: getTotalCategorys
	 * Summary: Returns the total number of categorys of the database
	 * @access public
	 * @return integer
	 */
	function getTotalCategorys()
	{	

		$query = $this->db->get('category');
		return $query->num_rows();
	}
	
	/**
	 * Method: getCategoryByCategoryId
	 * Summary: returns the data for a single category
	 * @access public
	 * @param integer $category_id
	 * @return 
	 */
	function getCategoryByCategoryId($category_id)
	{
		$this->db->where('category_id',$category_id);
		$query = $this->db->get('category');
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
	 * Method: insertCategory
	 * Summary: Insert a new category in the database
	 * @access public
	 * @param array $data
	 * @return 
	 */
	function insertCategory($data)
	{
		$this->db->insert('category', $data);
	}
	
	/**
	 * Method: updateCategory
	 * Summary: Update info for a given category
	 * @access public
	 * @param integer $category_id
	 * @param array $data
	 * @return 
	 */
	function updateCategory($category_id, $data)
	{
		$this->db->where('category_id', $category_id);
		$this->db->update('category', $data);	
	}
	
	/**
	 * Method: deleteCategory
	 * Summary: Deletes a given category from the database
	 * @access public
	 * @param integer $category_id
	 */
	function deleteCategory($category_id)
	{
		$this->db->where('category_id', $category_id);
		$this->db->delete('category');
	}
}

/* End of file category_model.php */
/* Location: ./system/application/models/category_model.php */
?>