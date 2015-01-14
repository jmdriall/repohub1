<?php
/**
 * Classname: Especifico
 * Summary: Controller for Especifico objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Especifico extends CI_Controller
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
		
		$this->load->model('especifico_model');
        $this->load->model('objetivo_model');
        $this->load->model('actividad_model');
        $this->load->model('planificacion_model');
        //$this->load->model('sub_especifico_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($objetivo_id)
	{
		$this->verify_session->verify_login('administrator/especifico/index');



		//load and config pagination
		$this->load->library('pagination');
        $offset=0;
		$config['base_url'] 		= site_url('administrator/especifico/index/');
		$config['total_rows'] 		= $this->especifico_model->getTotalEspecificos();
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
		$data['especificos']	 = $this->especifico_model->getAllEspecificos($per_p, $off_set, $objetivo_id);
        $picture = $this->objetivo_model->getObjetivoByObjetivoId($objetivo_id);
        foreach($picture as $key=>$value){
            $data[$key] = $value;
        }

        $data['objetivo_id'] = $objetivo_id;
		$this->layout->view('administrator/especifico/index',$data);
	}
	
	/**
	 * Method: insertEspecifico
	 * Summary: insert a new objetivo
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertEspecifico($objetivo_id = 0)
    {
        $this->verify_session->verify_login('administrator/especifico/insertEspecifico');

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
                $data['objetivo_id'] =  $this->input->post('objetivo_id', TRUE);
                $this->layout->view('administrator/especifico/insertEspecifico', $data);
            }
            else
            {
                $picture = $this->objetivo_model->getObjetivoByObjetivoId($this->input->post('objetivo_id', TRUE));
				$values = array('nombre' => $this->input->post('nombre', TRUE),
                                'objetivo_id' => $this->input->post('objetivo_id', TRUE),
                                'user_id' => $picture->user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->especifico_model->insertEspecifico($values);
                $objetivo_id = $this->input->post('objetivo_id', TRUE);
				redirect('administrator/especifico/index/'.$objetivo_id);
            }
        }
        else
        {
            $data['objetivo_id'] = $objetivo_id;
            $this->layout->view('administrator/especifico/insertEspecifico',$data);
        }
    }
	
	/**
	 * Method: updateEspecifico
	 * Summary: edit the objetivo data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateEspecifico($especifico_id=0, $objetivo_id = 0)
	{
        $this->verify_session->verify_login('administrator/especifico/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($especifico_id) AND is_numeric($especifico_id))
            {
                $picture = $this->especifico_model->getEspecificoByEspecificoId($especifico_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/especifico/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/especifico/updateEspecifico', $data);
            }
            else
            {
                redirect('administrator/especifico/index');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/especifico/updateEspecifico', $data);
            }
            else
            {
                $values = array( 'nombre' => $this->input->post('nombre', TRUE),
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $especifico_id = $this->input->post('especifico_id', TRUE);
                $this->especifico_model->updateEspecifico( $especifico_id, $values );

                $objetivo_id = $this->input->post('objetivo_id',TRUE);
                redirect('administrator/especifico/index/'.$objetivo_id);
            }
        }
	}
	
	/**
	 * Method: deleteEspecifico
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteEspecifico($especifico_id=0, $objetivo_id = 0)
	{
        $this->verify_session->verify_login('administrator/especifico/deleteEspecifico');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->especifico_model->getEspecificoByEspecificoId($especifico_id);

            if ( !empty($especifico_id) AND is_numeric($especifico_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/especifico/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $this->layout->view('administrator/especifico/deleteEspecifico', $data);
            }
            else
            {
                redirect('administrator/especifico/index/');
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('especifico_id', TRUE) as $especifico_id )
                {
                    $data = $this->especifico_model->getEspecificoByEspecificoId($especifico_id);
                    $this->especifico_model->deleteEspecifico($especifico_id);
                }
            }
            else
            {
                $especifico_id = $this->input->post('especifico_id', TRUE);

                $actividades = $this->actividad_model->getByEspecificoId($especifico_id);
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
                $this->especifico_model->deleteEspecifico($especifico_id);
            }
            $objetivo_id = $this->input->post('objetivo_id', TRUE);
            redirect('administrator/especifico/index/'.$objetivo_id);
        }
	}
}

/* End of file especifico_lang.php */
/* Location: ./system/application/controllers/administrator/especifico_lang.php */
?>