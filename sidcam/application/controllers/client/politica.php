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
class Politica extends CI_Controller {

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
        $this->load->model('tipo_model');
        $this->load->model('archivo_model');

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
        if( $this->session->userdata('login') != '' ){
            $user_data = $this->user_model->getUserByLogin( $this->session->userdata('login') );
            $user_id = $user_data->user_id;
            $tipo_nombre = "politica";
            $tipo_id = $this->tipo_model->getTipoByNombre($user_id, $tipo_nombre);
            //echo $user_id.br();
            // echo $tipo_id->tipo_id;
            $data['archivos_politica'] = $this->archivo_model->getArchivoByTipoId($user_id,$tipo_id->tipo_id);
            $data['users'] = $this->user_model->getAllUsers();
            $data['sliders'] = $this->slider_model->getAllSlider();
            $data['user_login']= $this->session->userdata('login');
            $this->layout->view('client/politica/index',$data);
        }
        else{
            redirect('./administrator/login');
        }
	}
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */