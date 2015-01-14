<?php
/**
 * Classname: Actividad
 * Summary: Controller for Actividad objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Actividad extends CI_Controller
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
		
		$this->load->model('actividad_model');
        $this->load->model('especifico_model');
        $this->load->model('planificacion_model');
        //$this->load->model('sub_actividad_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($especifico_id=0, $user_id = 0)
	{
		$this->verify_session->verify_login('administrator/actividad/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/actividad/index/');
		$config['total_rows'] 		= $this->actividad_model->getTotalActividads();
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
		$data['actividads']	 = $this->actividad_model->getAllActividads($per_p, $off_set, $especifico_id, $user_id);
        $especifico = $this->especifico_model->getEspecificoByEspecificoId($especifico_id);
        foreach($especifico as $key=>$value){
            $data[$key] = $value;
        }
        $data['user_id'] = $user_id;
        $data['especifico_id'] = $especifico_id;
		$this->layout->view('administrator/actividad/index',$data);
	}
	
	/**
	 * Method: insertActividad
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertActividad($especifico_id=0, $user_id)
    {
        $this->verify_session->verify_login('administrator/actividad/insertActividad');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_title'), 'required');
        $this->form_validation->set_rules('especifico_id', lang('backend_especifico'), 'required');
        $this->form_validation->set_rules('prioridad', lang('backend_prioridad'), 'required');
        $this->form_validation->set_rules('requisito_legal', lang('backend_requisito_legal'), 'required');
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['nombre'] = $this->input->post('nombre', TRUE);
                $data['requisito_legal'] = $this->input->post('requisito_legal', TRUE);
                $data['prioridad'] = $this->input->post('prioridad', TRUE);
                $data['especifico_id'] = $this->input->post('especifico_id', TRUE);

                $data['user_id'] = $user_id;
                $data['especifico_id'] = $especifico_id;
                $data['valid'] = '0';
                $data['user_id'] = $this->input->post('user_id', TRUE);
                $this->layout->view('administrator/actividad/insertActividad', $data);
            }
            else
            {
				$values = array('nombre' => $this->input->post('nombre', TRUE),
                                'user_id' =>$user_id,
                                'especifico_id' => $especifico_id,
                                'requisito_legal' => $this->input->post('requisito_legal', TRUE),
                                'prioridad' => $this->input->post('prioridad', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
                $prioridad = $this->input->post('prioridad', TRUE);
                if(is_numeric($prioridad)){
                    if($prioridad > 0 && $prioridad < 4){
                        $this->actividad_model->insertActividad($values);
                        redirect('administrator/actividad/index/'.$especifico_id.'/'.$user_id);
                    }

                    else{
                        $data['user_id'] = $user_id;
                        $data['especifico_id'] = $especifico_id;
                        $data['valid'] = '2';
                        $this->layout->view('administrator/actividad/insertActividad',$data);
                    }
                }
                else{
                    $data['user_id'] = $user_id;
                    $data['especifico_id'] = $especifico_id;
                    $data['valid'] = '1';
                    $this->layout->view('administrator/actividad/insertActividad',$data);
                }
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $data['especifico_id'] = $especifico_id;
            $data['valid'] = '0';
            $this->layout->view('administrator/actividad/insertActividad',$data);
        }
    }
	
	/**
	 * Method: updateActividad
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateActividad($actividad_id = 0, $especifico_id = 0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/actividad/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        $this->form_validation->set_rules('requisito_legal', lang('backend_requisito_legal'), 'required');
        $this->form_validation->set_rules('prioridad', lang('backend_prioridad'), 'numeric|required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($actividad_id) AND is_numeric($actividad_id))
            {
                $picture = $this->actividad_model->getActividadByActividadId($actividad_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/actividad/index/'.$especifico_id.'/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $data['especifico_id'] = $especifico_id;
                $data['actividad_id'] = $actividad_id;
                $data['valid'] = 0;
                $this->layout->view('administrator/actividad/updateActividad', $data);
            }
            else
            {
                redirect('administrator/actividad/index/'.$especifico_id.'/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/actividad/updateActividad', $data);
            }
            else
            {

                $values = array( 'nombre' => $this->input->post('nombre', TRUE),
                    'requisito_legal' => $this->input->post('requisito_legal', TRUE),
                    'prioridad' => $this->input->post('prioridad', TRUE)
							);
                $especifico_id = $this->input->post('especifico_id', TRUE);
                $user = $this->input->post('user_id', TRUE);
                $prioridad = $this->input->post('prioridad',TRUE);
                $actividad_id = $this->input->post('actividad_id', TRUE);
                if($prioridad > 0 && $prioridad < 4){
                    $this->actividad_model->updateActividad( $actividad_id, $values );
                    redirect('administrator/actividad/index/'.$especifico_id.'/'.$user);
                }
                else{
                    foreach($_POST as $key=>$value){
                        $data[$key]  = $this->input->post($key, TRUE);
                    }
                    $data['valid'] = 1;
                    $this->layout->view('administrator/actividad/updateActividad', $data);
                }


            }
        }
	}
	
	/**
	 * Method: deleteActividad
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function deleteActividad($actividad_id=0, $especifico_id = 0, $user_id = 0)
    {
        $this->verify_session->verify_login('administrator/actividad/deleteActividad');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->actividad_model->getActividadByActividadId($actividad_id);

            if ( !empty($actividad_id) AND is_numeric($actividad_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/actividad/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $data['especifico_id'] = $especifico_id;
                $this->layout->view('administrator/actividad/deleteActividad', $data);
            }
            else
            {
                redirect('administrator/actividad/index/'.$especifico_id."/".$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('actividad_id', TRUE) as $actividad_id )
                {
                    $data = $this->actividad_model->getActividadByActividadId($actividad_id);
                    $this->actividad_model->deleteActividad($actividad_id);
                }
            }
            else
            {
                $actividad_id = $this->input->post('actividad_id', TRUE);

                $planificaciones = $this->planificacion_model->getAll($actividad_id);
                if($planificaciones){
                    foreach($planificaciones as $planificacion){
                        $this->planificacion_model->deletePlanificacion($planificacion->planificacion_id);
                    }
                }
                $this->actividad_model->deleteActividad($actividad_id);
            }

            redirect('administrator/actividad/index/'.$this->input->post('especifico_id', TRUE)."/".$this->input->post('user_id', TRUE));
        }
    }
}

/* End of file actividad_lang.php */
/* Location: ./system/application/controllers/administrator/actividad_lang.php */
?>