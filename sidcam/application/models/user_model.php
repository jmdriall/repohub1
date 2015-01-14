<?php
/**
 * Classname: User_model
 * Summary: Model for User objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class User_model extends CI_Model
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
	 * Method: getEveryone
	 * Summary: Get all users order by firstname
	 * @access public
	 * @param 
	 * @return Array objects user
	 */
	function getAllUsers()
	{
		$this->db->order_by('login', 'asc');
		$query = $this->db->get('user');
		return $query;
	}

	/**
	 * Method: getTotals
	 * Summary: Get total users revised
	 * @access public
	 * @param 
	 * @return Array objects user
	 */
	function getTotalUsers()	
	{
		$query = $this->db->get('user');
		return $query->num_rows();
	}


	/**
	 * Method: getUserByLogin
	 * Summary: Get info user by login revised
	 * @access public
	 * @param string	$login
	 * @return Array	User data	
	 */
	function getUserByLogin($login) 
	{
		$this->db->where('login', $login);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
    function getArchivoByTipoId($user_id, $tipo_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('tipo_id', $tipo_id);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	/**
	 * Method: getUserByUserId
	 * Summary: Get info user by user_id revised
	 * @access public
	 * @param string	$user_id
	 * @return Array	User data	
	 */
	function getUserByUserId($user_id) 
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
    /**
     * Method: getUserByUserId
     * Summary: Get info user by user_id revised
     * @access public
     * @param string	$user_id
     * @return Array	User data
     */
    function getUserTypeByLogPass($log = "", $pass = "")
    {
        $this->db->where('login', $log);
        $this->db->where('password', $pass);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $cad = $query->row();
            return $cad->user_level_id;
        } else {
            return FALSE;
        }
    }

	/**
	 * Method: searchUserInsert
	 * Summary: This function assures the login to be unique
	 * @access public
	 * @param string	$login	
	 * @return string	If login is duplicated or no
	 */
	function searchUserInsert($login)
	{
		$result = TRUE;
		$this->db->where('login', $login);
		$query = $this->db->get('user');
		if ($query->num_rows() > 0)
		{
			$result = FALSE;
		}
		return $result;
	}
	
	/**
	 * Method: searchUserEdit
	 * Summary: Search user 
	 * @access public
	 * @param string	$login	
	 * @param int	$user_id	
	 * @return string	If login is duplicated or no
	 */
	function searchUserEdit($login, $user_id)
	{
		$result = TRUE;
		$query = $this->db->query( 'SELECT * FROM user WHERE login = "' . $login . '" AND user_id NOT IN ( ' . $user_id . ' )' );
		if ($query->num_rows() > 0)
		{
			$result = FALSE;
		}
		return $result;
	}
	
	/**
	 * Method: insertUser
	 * Summary: Insert a user 
	 * @author 
	 * @access public
	 * @param array	$data	
	 * @return boolean	True if user was insert
	 */
	function insertUser($data) 
	{
		$this->db->insert('user', $data);
	}
	

	/**
	 * Method: updateUser
	 * Summary: Update info user 
	 * @access public
	 * @param int	$user_id	
	 * @param array	$data	
	 * @return boolean	True if info user was updated
	 */
	function updateUser($user_id,$data) 
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);	
	}

	/**
	 * Method: deleteUser
	 * Summary: Delete user 
	 * @access public
	 * @param int	$user_id	
	 * @return boolean	True if user was delete
	 */
	function deleteUser($user_id) 
	{
		if($$user_id!=1){
		$this->db->where('user_id', $user_id);
		$this->db->delete('user');
		}
	}
	
	/**
	 * Method: insertLogged
	 * Summary: Insert user logged revised
	 * @access public
	 * @param array	$data 	
	 * @return boolean	
	 */
	function insertLogged($data) 
	{
		$this->db->insert('user_logged', $data);
	}

	/**
	 * Method: retrieveLoggedList
	 * Summary: List all user logged revised
	 * @access public
	 * @return Array	List user logged
	 */
	function getAllLogged()
	{
		$query = $this->db->query('SELECT * FROM user_logged ORDER BY user_logged_id DESC LIMIT 0, 10');
		return $query;
	}
	
}

/* End of file user_model.php */
/* Location: ./system/application/models/user_model.php */