<?php
/**
 * Classname: Home
 * Summary: Controller for Home objects
 * @author 
 * @package /controllers
 * History:
 * 	Created: June 01, 2007
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Home extends CI_Controller {

	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @author 
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();
		
		//Lets load our own library to handle layouts
		$params = array("layout" => "layouts/layout_main");
		$this->load->library( 'layout', $params );
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @author 
	 * @access public
	 */
	function index()
	{
		//Vacio
		$data = array();
		
		$this->layout->view('home/index', $data);
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */