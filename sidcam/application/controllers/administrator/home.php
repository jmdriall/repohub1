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
		$params = array("layout" => "layouts/layout_admin");
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
        if( $this->session->userdata('login') != '' ){
            $user_data = $this->user_model->getUserByLogin( $this->session->userdata('login') );
            $user_name = $user_data->lastname . ", " . $user_data->firstname;
            if($user_data->user_id!=1){
                redirect('administrator/login/logout');
            }
        }

        $this->verify_session->verify_login('administrator/user/copyindex');
        $data['users'] = $this->user_model->getAllUsers();
        $this->layout->view('administrator/home/index', $data);
	}
    function copyindex($user_id = 0)
    {
        $this->verify_session->verify_login('administrator/home/index');
        $data['log_result'] = $this->user_model->getAllLogged();
        $data['user_id'] = $user_id;
        $this->layout->view('administrator/home/copyindex', $data);
    }
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */