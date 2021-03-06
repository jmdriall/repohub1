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
class Evaluacion extends CI_Controller {

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
		$params = array("layout" => "layouts/layout_client");
		$this->load->library( 'layout', $params );

        $this->load->model('slider_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @author 
	 * @access public
	 */
	function index()
	{
        $this->verify_session->verify_login('client/home/index');
        $data['users'] = $this->user_model->getAllUsers();
        $data['sliders'] = $this->slider_model->getAllSlider();
        $this->layout->view('client/evaluacion/index',$data);
	}
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */