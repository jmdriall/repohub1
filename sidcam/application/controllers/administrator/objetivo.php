<?php
/**
 * Classname: Objetivo
 * Summary: Controller for Objetivo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Objetivo extends CI_Controller
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
        $this->load->model('planificacion_model');

        $this->load->model('especifico_model');
		$this->load->model('objetivo_model');
        //$this->load->model('sub_objetivo_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id)
	{
		$this->verify_session->verify_login('administrator/objetivo/index');



		//load and config pagination
		$this->load->library('pagination');
        $offset=0;
		$config['base_url'] 		= site_url('administrator/objetivo/index/');
		$config['total_rows'] 		= $this->objetivo_model->getTotalObjetivos();
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
		$off_set 	= $offset;
		$data['objetivos']	 = $this->objetivo_model->getAllObjetivos($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/objetivo/index',$data);
	}
	
	/**
	 * Method: insertObjetivo
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertObjetivo($user_id = 0)
    {
        $this->verify_session->verify_login('administrator/objetivo/insertObjetivo');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['nombre'] = $this->input->post('title', TRUE);
                //$data['sub_title'] = $this->input->post('sub_title', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $data['user_id'] =  $this->input->post('user_id', TRUE);
                $this->layout->view('administrator/objetivo/insertObjetivo', $data);
            }
            else
            {
				$values = array('nombre' => $this->input->post('nombre', TRUE),
                                'user_id' => $this->input->post('user_id', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->objetivo_model->insertObjetivo($values);
                $user_id = $this->input->post('user_id', TRUE);
				redirect('administrator/objetivo/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/objetivo/insertObjetivo',$data);
        }
    }
	
	/**
	 * Method: updateObjetivo
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateObjetivo($objetivo_id=0, $user_id = 0)
	{
        $this->verify_session->verify_login('administrator/objetivo/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($objetivo_id) AND is_numeric($objetivo_id))
            {
                $picture = $this->objetivo_model->getObjetivoByObjetivoId($objetivo_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/objetivo/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/objetivo/updateObjetivo', $data);
            }
            else
            {
                redirect('administrator/objetivo/index');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/objetivo/updateObjetivo', $data);
            }
            else
            {
                $values = array( 'nombre' => $this->input->post('nombre', TRUE),
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $objetivo_id = $this->input->post('objetivo_id', TRUE);
                $this->objetivo_model->updateObjetivo( $objetivo_id, $values );

                $user_id = $this->input->post('user_id',TRUE);
                redirect('administrator/objetivo/index/'.$user_id);
            }
        }
	}
	
	/**
	 * Method: deleteObjetivo
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteObjetivo($objetivo_id=0, $user_id = 0)
	{
        $this->verify_session->verify_login('administrator/objetivo/deleteObjetivo');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->objetivo_model->getObjetivoByObjetivoId($objetivo_id);

            if ( !empty($objetivo_id) AND is_numeric($objetivo_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/objetivo/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/objetivo/deleteObjetivo', $data);
            }
            else
            {
                redirect('administrator/objetivo/index/');
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('objetivo_id', TRUE) as $objetivo_id )
                {
                    $this->objetivo_model->deleteObjetivo($objetivo_id);
                }
            }
            else
            {
                $objetivo_id = $this->input->post('objetivo_id', TRUE);

                $especificos = $this->especifico_model->getEspecificoByObjetivoId($objetivo_id);
                if($especificos){
                    foreach($especificos as $especifico){
                        $actividades = $this->actividad_model->getByEspecificoId($especifico->especifico_id);
                        if($actividades){
                            foreach($actividades as $actividad){
                                $planificaciones = $this->planificacion_model->getAll($actividad->actividad_id);
                                if($planificaciones){
                                    foreach($planificaciones as $planificacion){
                                        $this->planificacion_model->deletePlanificacion($planificacion->planificacion_id);
                                    }
                                }
                                $this->actividad_model->deleteActividad($actividad->actividad_id);
                            }
                        }
                        $this->especifico_model->deleteEspecifico($especifico->especifico_id);
                    }
                }
                $this->objetivo_model->deleteObjetivo($objetivo_id);
            }
            $user_id = $this->input->post('user_id', TRUE);
            redirect('administrator/objetivo/index/'.$user_id);
        }
	}
}

/* End of file objetivo_lang.php */
/* Location: ./system/application/controllers/administrator/objetivo_lang.php */
?>