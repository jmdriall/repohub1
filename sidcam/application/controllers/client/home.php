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
		$params = array("layout" => "layouts/layout_client");
		$this->load->library( 'layout', $params );

        $this->load->model('slider_model');
        $this->load->model('user_model');
        $this->load->model('archivo_model');
        $this->load->model('tipo_model');
        $this->load->model('actividad_model');
        $this->load->model('planificacion_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @author 
	 * @access public
	 */
	function index()
	{
        if( $this->session->userdata('login')!=''){
            $this->verify_session->verify_login('client/home/index');
            $user = $this->session->userdata('login');
            $data['login'] = $user;
            $user = $this->user_model->getUserByLogin($user);
            $data['sliders'] = $this->slider_model->getAllSlider();
            $data['archivos'] = $this->archivo_model->getAll($user->user_id);
            $data['tipos'] = $this->tipo_model->getAll($user->user_id);
            $data['actividades'] = $this->actividad_model->getAll($user->user_id);
            $mes = date('m');
            $anio = date('Y');
            $data['planificaciones_mes'] = $this->planificacion_model->betwen($user->user_id,$anio, $mes);
            if($mes == 1){
                $mes = 12;
                $anio = $anio-1;
            }
            else
                $mes = $mes - 1;
            $data['planificaciones_mes_anterior'] = $this->planificacion_model->betwen($user->user_id,$anio, $mes);
/*
            $fecha = $this->planificacion_model->betwen($user->user_id,$anio, $mes);
           echo br(). count($fecha). br();
            foreach($fecha as $fe){
                echo $fe->responsable;
            }
            echo count($data['actividades']);
            echo count($data['planificaciones_mes']);
            return;*/
            $this->layout->view('client/home/index',$data);
        }
        else{
            redirect('./administrator/login');
        }
	}
    function updatePlanificacion($planificacion_id=0)
    {

        $this->verify_session->verify_login('client/home/updatePlanificacion');

        //validation
        //$this->form_validation->set_rules('responsable', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        //$this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($planificacion_id) AND is_numeric($planificacion_id))
            {
                $picture = $this->planificacion_model->getPlanificacionByPlanificacionId($planificacion_id);
                if ( $picture == FALSE )
                {
                    redirect('client/home/index/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/home/updatePlanificacion',$data);
            }
            else
            {
                redirect('client/home/index/');
            }
        }
        else
        {

            $values = array(/*'responsable' => $this->input->post('responsable', TRUE),
                    'fecha_ini' => $this->input->post('fecha_ini', TRUE),
                    'actividad_id' => $this->input->post('actividad_id', TRUE),
                    'fecha_fin' => $this->input->post('fecha_ini', TRUE),
                    'fecha_fin' => $this->input->post('fecha_fin', TRUE),*/
                'evidencia' => $this->input->post('evidencia')
            );
            $planificacion_id = $this->input->post('planificacion_id', TRUE);
            $this->planificacion_model->updatePlanificacion( $planificacion_id, $values );
            $actividad = $this->input->post('actividad_id', TRUE);
            redirect('client/home/index/');

        }
    }
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */