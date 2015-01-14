<?php
/**
 * Classname: Planificacion
 * Summary: Controller for Planificacion objects
 * @author
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Planificacion extends CI_Controller
{

	/**
	 * Method: __construct
	 * Summary: Method construct
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();

		//lets load our own library to handle layouts
		$params = array('layout' => 'layouts/layout_admin');
		$this->load->library('layout', $params);

		// Cargar librerias
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('form_validation');

		$this->load->model('planificacion_model');
        $this->load->model('actividad_model');
        //$this->load->model('sub_planificacion_model');
	}

	/**
	 * Method: index
	 * Summary:
	 * @access public
	 */
	function index($actividad_id = 0)
	{
		$this->verify_session->verify_login('administrator/planificacion/index');

		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/planificacion/index/');
		$config['total_rows'] 		= $this->planificacion_model->getTotalPlanificacions();
		$config['per_page'] 		= 15;
		$config['uri_segment']		= 5;
		$config['full_tag_open'] 	= '<p align="center" id="pagination">';
		$config['full_tag_close'] 	= '</p>';

		$config['first_link'] = lang('backend_first');
		$config['last_link'] = lang('backend_last');
		$config['next_link'] = lang('backend_next');
		$config['prev_link'] = lang('backend_previous');
		$this->pagination->initialize($config);

		//get with limit
		$per_p 		= $config['per_page'];
		$off_set 	= 0;

        $picture = $this->actividad_model->getActividadByActividadId($actividad_id);
        if ( $picture == FALSE )
        {
            redirect('administrator/planificacion/index/'.$actividad_id);
        }
        else
        {
            foreach($picture as $key=>$value){
                $data[$key] = $value;
            }
        }

		$data['planificacions']	 = $this->planificacion_model->getAllPlanificacions($per_p, $off_set, $actividad_id);

		$this->layout->view('administrator/planificacion/index',$data);
	}

	/**
	 * Method: insertPlanificacion
	 * Summary: insert a new actividad
	 * @access public
	 * @param string $str
	 * @return
	 */
    function insertPlanificacion($actividad_id)
    {
        $this->verify_session->verify_login('administrator/planificacion/insertPlanificacion');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('fecha_ini', lang('backend_fecha_ini'), 'required');
        $this->form_validation->set_rules('fecha_fin', lang('backend_fecha_fin'), 'required');
        $this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                $data['fecha_ini'] = $this->input->post('fecha_ini', TRUE);
                $data['actividad_id'] = $this->input->post('actividad_id', TRUE);
                $data['fecha_fin'] = $this->input->post('fecha_fin', TRUE);
                $data['evidencia'] = $this->input->post('evidencia', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/planificacion/insertPlanificacion', $data);
            }
            else
            {
                $picture = $this->actividad_model->getActividadByActividadId($this->input->post('actividad_id', TRUE));

				$values = array('responsable' => $this->input->post('responsable', TRUE),
                    'fecha_ini' => $this->input->post('fecha_ini', TRUE),
                    'actividad_id' => $this->input->post('actividad_id', TRUE),
                    'fecha_fin' => $this->input->post('fecha_ini', TRUE),
                    'fecha_fin' => $this->input->post('fecha_fin', TRUE),
                    'evidencia' => $this->input->post('evidencia', TRUE),
                    'user_id' => $picture->user_id
							);
				$this->planificacion_model->insertPlanificacion($values);
                echo $this->input->post('fecha_ini', TRUE);
				redirect('administrator/planificacion/index/'.$actividad_id);
            }
        }
        else
        {
            $data['actividad_id'] = $actividad_id;
            $this->layout->view('administrator/planificacion/insertPlanificacion',$data);
        }
    }

	/**
	 * Method: updatePlanificacion
	 * Summary: edit the actividad data
	 * @access public
	 * @param string $str
	 * @return
	 */
	function updatePlanificacion($planificacion_id=0, $actividad_id = 0)
	{

        $this->verify_session->verify_login('administrator/planificacion/updateGallery');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($planificacion_id) AND is_numeric($planificacion_id))
            {
                $picture = $this->planificacion_model->getPlanificacionByPlanificacionId($planificacion_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/planificacion/index/'.$actividad_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['actividad_id'] = $actividad_id;
                $this->layout->view('administrator/planificacion/updatePlanificacion', $data);
            }
            else
            {
                redirect('administrator/planificacion/index/'.$actividad_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/planificacion/updatePlanificacion', $data);
            }
            else
            {
                $values = array('responsable' => $this->input->post('responsable', TRUE),
                    'fecha_ini' => $this->input->post('fecha_ini', TRUE),
                    'actividad_id' => $this->input->post('actividad_id', TRUE),
                    'fecha_fin' => $this->input->post('fecha_ini', TRUE),
                    'fecha_fin' => $this->input->post('fecha_fin', TRUE),
                    'evidencia' => $this->input->post('evidencia', TRUE)
                );
                $planificacion_id = $this->input->post('planificacion_id', TRUE);
                $this->planificacion_model->updatePlanificacion( $planificacion_id, $values );
				$actividad = $this->input->post('actividad_id', TRUE);
                redirect('administrator/planificacion/index/'.$actividad);
            }
        }
	}

	/**
	 * Method: deletePlanificacion
	 * Summary:
	 * @access public
	 * @param string $str
	 * @return
	 */
	function deletePlanificacion($planificacion_id=0, $actividad_id)
	{
        $this->verify_session->verify_login('administrator/planificacion/deletePlanificacion');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->planificacion_model->getPlanificacionByPlanificacionId($planificacion_id);

            if ( !empty($planificacion_id) AND is_numeric($planificacion_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/planificacion/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['actividad_id'] = $actividad_id;
                $this->layout->view('administrator/planificacion/deletePlanificacion', $data);
            }
            else
            {
                redirect('administrator/planificacion/index/'.$actividad_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('planificacion_id', TRUE) as $planificacion_id )
                {
                    $data = $this->planificacion_model->getPlanificacionByPlanificacionId($planificacion_id);
                    $this->planificacion_model->deletePlanificacion($planificacion_id);
                }
            }
            else
            {
                $planificacion_id = $this->input->post('planificacion_id', TRUE);

                $data = $this->planificacion_model->getPlanificacionByPlanificacionId($planificacion_id);
                $this->planificacion_model->deletePlanificacion($planificacion_id);
            }

            redirect('administrator/planificacion/index/'.$this->input->post('actividad_id', TRUE));
        }
	}
}

/* End of file planificacion_lang.php */
/* Location: ./system/application/controllers/administrator/planificacion_lang.php */
?>