<?php
if (!defined('BASEPATH'))
		exit('No direct script access allowed');

class Authentication 
{

	var $login = "";
	var $password = "";
	var $auth = FALSE;
	
	function Authentication($auto = TRUE)
	{
		if($auto)
		{
			$CI =& get_instance();
			if ($this->login($CI->session->userdata('login'), $CI->session->userdata('password')))
			{
				$this->login = $CI->session->userdata('login');
			}
		}
	}
	
	function getLogin()
	{
		return $this->login;
	}
	
	function login($login = "", $password = "")
	{
		if (empty($login) OR empty($password))
		{
			return FALSE;
		}
		
		$CI =& get_instance();		

		$sql = 'SELECT * FROM user WHERE login =? AND password =?';
		$query = $CI->db->query($sql, array($login, $password));

		//Login ok
		if ($query->num_rows() == 1)
		{
			$row = $query->row();

			$CI->session->set_userdata('login', $login);
			$this->login = $login;
			$this->auth = TRUE;

			return TRUE;
		}
		else
		{
			$this->auth = FALSE;
			$this->logout();

			return FALSE;
		}
	}
	
	function logout()
	{
		$CI =& get_instance();
		$CI->session->sess_destroy();
		$this->auth = FALSE;
	}
	
}
/* End of file authentication.php */
/* Location: ./system/application/libraries/authentication.php */