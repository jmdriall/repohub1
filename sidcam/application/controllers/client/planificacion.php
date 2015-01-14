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
class Planificacion extends CI_Controller {

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

        $this->load->model('planificacion_model');
        $this->load->model('objetivo_model');
        $this->load->model('especifico_model');
        $this->load->model('actividad_model');
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
            $this->verify_session->verify_login('client/home/index');
           // echo $user_id;return;
            $data['objetivos'] = $this->objetivo_model->getObjetivoByUserId($user_id);
            $data['especificos'] = $this->especifico_model->getEspecificoByUserId($user_id);
            $data['actividades'] = $this->actividad_model->getActividadByUserId($user_id);
            $data['planificaciones'] = $this->planificacion_model->getPlanificacionByUserId($user_id);

            $this->layout->view('client/planificacion/index',$data);
        }
        else{
            redirect('./administrator/login');
        }


	}

    function updatePlanificacion($planificacion_id=0)
    {

        $this->verify_session->verify_login('client/planificacion/updatePlanificacion');

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
                    redirect('client/planificacion/index/');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('client/planificacion/updatePlanificacion',$data);
            }
            else
            {
                redirect('client/planificacion/index/');
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
                redirect('client/planificacion/index/');

        }
    }
	
}

/* End of file home.php */
/* Location: ./system/application/controllers/administrator/home.php */