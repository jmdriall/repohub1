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
class Operacion extends CI_Controller {

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
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        $this->load->model('slider_model');
        $this->load->model('user_model');
        $this->load->model('archivo_model');
        $this->load->model('tipo_model');
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
        if( $this->session->userdata('login') != '' ){
            $user_data = $this->user_model->getUserByLogin( $this->session->userdata('login') );
            $user_id = $user_data->user_id;
        $tipo_nombre = "operacion";
        $tipo_id = $this->tipo_model->getTipoByNombre($user_id, $tipo_nombre);
        //echo $user_id.br();
       // echo $tipo_id->tipo_id;
        $data['archivos_operacion'] = $this->archivo_model->getArchivoByTipoId($user_id,$tipo_id->tipo_id);
        $data['users'] = $this->user_model->getAllUsers();
        $data['sliders'] = $this->slider_model->getAllSlider();
        $data['user_login']= $this->session->userdata('login');
        $this->layout->view('client/operacion/index',$data);
        }
        else{
            redirect('./administrator/login');
        }
	}
    function descargarFile($login = null, $picture = null){
        echo $login.br();
        $path = base_url()."resources/media/archivo/doc/".$login."/operacion/".$picture;
        echo $path;
        /*if(is_dir(base_url()."resources/media/archivo/doc/".$login."/operacion/")){
            mkdir(base_url()."resources/media/archivo/doc/".$login."/operacion/jota");
            echo 'YES';
        }
        else{
            mkdir(base_url()."resources/media/archivo/doc/".$login."/operacion/jota");
            echo 'NO';
        }*/
        $data = file_get_contents($path);
        force_download($picture,$data);
        redirect('client/operacion');

    }
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */