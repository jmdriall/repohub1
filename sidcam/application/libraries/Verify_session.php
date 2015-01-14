<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Classname: Verify_session
 * Summary: Library for session and redirection validation
 * @author DBox
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
 
class Verify_session 
{
	var $url_address = '';
	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @access public
	 */
	function __construct( $url_address = 'administrator/login/index' )
	{
		$this->url_address = $url_address;
	}
	
	/**
	 * Method: veryfy_login
	 * Summary: Verify the Session and redirects to a given url address
	 * @access public
	 */
	function verify_login( $url_address = 'administrator/login/index' )
	{
		$CI =& get_instance();
		
		if ( $CI->session->userdata('login') == NULL )
		{
			redirect('administrator/login/index');
		}
	}

}
/* End of file Verify_session.php */
/* Location: ./system/application/libraries/Verify_session.php */