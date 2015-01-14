<?php
/**
 * Classname: Trabajador
 * Summary: Controller for Trabajador objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Trabajador extends CI_Controller
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
		
		$this->load->model('trabajador_model');
       $this->load->model('cargo_model');
        $this->load->model('capacitacion_work_model');
        $this->load->model('epp_work_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id=0)
	{
		$this->verify_session->verify_login('administrator/trabajador/index');



		//load and config pagination
		$this->load->library('pagination');
        $offset=0;
		$config['base_url'] 		= site_url('administrator/trabajador/index/');
		$config['total_rows'] 		= $this->trabajador_model->getTotalTrabajadors();
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
		$data['trabajadors']	 = $this->trabajador_model->getAllTrabajadors($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/trabajador/index',$data);
	}
	
	/**
	 * Method: insertTrabajador
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertTrabajador($user_id = 0)
    {

        $this->verify_session->verify_login('administrator/trabajador/insertTrabajador/');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
        $this->form_validation->set_rules('apellidos', lang('backend_apellidos'), 'required');
        $this->form_validation->set_rules('cargo_id', lang('backend_cargo_id'), 'required');
        $this->form_validation->set_rules('dni', lang('backend_dni'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['nombre'] = $this->input->post('nombre', TRUE);
                $data['apellidos'] = $this->input->post('apellidos', TRUE);
                $data['cargo_id'] = $this->input->post('cargo_id', TRUE);
                $data['dni'] = $this->input->post('dni', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                $data['cargos']=$this->cargo_model->getAll($data['user_id']);

                //$data['sub_title'] = $this->input->post('sub_title', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/trabajador/insertTrabajador', $data);
            }
            else
            {


				$values = array('nombre' => $this->input->post('nombre', TRUE),
								'apellidos' => $this->input->post('apellidos',TRUE),
								'cargo_id' => $this->input->post('cargo_id', TRUE),
                                'dni' => $this->input->post('dni', TRUE),
                                'user_id' => $this->input->post('user_id', TRUE)
							);
				$this->trabajador_model->insertTrabajador($values);
                $user_id = $this->input->post('user_id', TRUE);
				redirect('administrator/trabajador/index/'.$user_id);
            }
        }
        else
        {
            $data['cargos']=$this->cargo_model->getAll($user_id);
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/trabajador/insertTrabajador',$data);
        }
    }
	
	/**
	 * Method: updateTrabajador
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateTrabajador($trabajador_id=0, $user_id=0)
	{
        $this->verify_session->verify_login('administrator/trabajador/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        $this->form_validation->set_rules('apellidos', lang('backend_apellidos'), 'required');
        $this->form_validation->set_rules('cargo_id', lang('backend_cargo_id'), 'required');
        $this->form_validation->set_rules('dni', lang('backend_dni'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($trabajador_id) AND is_numeric($trabajador_id))
            {
                $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/trabajador/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['cargos']=$this->cargo_model->getAll($user_id);
                $this->layout->view('administrator/trabajador/updateTrabajador', $data);
            }
            else
            {
                redirect('administrator/trabajador/index');
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }
                $data['cargos']=$this->cargo_model->getAll();
                $this->layout->view('administrator/trabajador/updateTrabajador', $data);
            }
            else
            {
                $values = array('nombre' => $this->input->post('nombre', TRUE),
                    'apellidos' => $this->input->post('apellidos',TRUE),
                    'cargo_id' => $this->input->post('cargo_id', TRUE),
                    'dni' => $this->input->post('dni', TRUE)
                );
                $trabajador_id = $this->input->post('trabajador_id', TRUE);
                $this->trabajador_model->updateTrabajador( $trabajador_id, $values );
				
                redirect('administrator/trabajador/index/');
            }
        }
	}
    /**
     * Method: deleteTrabajador
     * Summary:
     * @access public
     * @param string $str
     * @return
     */
    function UpCapacitacionTrabajador($trabajador_id=0, $key = 0, $user_id = 0)
    {
        if($key == 0){
            $data = array(
                'capacitacion' => 1
            );
        }
        else{
            $data = array(
                'capacitacion' => 0
            );
        }

        $this->trabajador_model->updateTrabajador($trabajador_id, $data);
        redirect('administrator/trabajador/index/'.$user_id);
    }
    function UpExamen_medicoTrabajador($trabajador_id=0, $key = 0, $user_id = 0)
    {
        if($key == 0){
            $data = array(
                'examen_medico' => 1
            );
        }
        else{
            $data = array(
                'examen_medico' => 0
            );
        }

        $this->trabajador_model->updateTrabajador($trabajador_id, $data);
        redirect('administrator/trabajador/index/'.$user_id);
    }
    function UpRegla_recomendacionesTrabajador($trabajador_id=0, $key = 0, $user_id = 0)
    {
        if($key == 0){
            $data = array(
                'regla_recomendaciones' => 1
            );
        }
        else{
            $data = array(
                'regla_recomendaciones' => 0
            );
        }

        $this->trabajador_model->updateTrabajador($trabajador_id, $data);
        redirect('administrator/trabajador/index/'.$user_id);
    }
    function UpEppTrabajador($trabajador_id=0, $key = 0, $user_id = 0)
    {
        if($key == 0){
            $data = array(
                'epp' => 1
            );
        }
        else{
            $data = array(
                'epp' => 0
            );
        }

        $this->trabajador_model->updateTrabajador($trabajador_id, $data);
        redirect('administrator/trabajador/index/'.$user_id);
    }
	
	/**
	 * Method: deleteTrabajador
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteTrabajador($trabajador_id=0, $user_id = 0)
	{
        $this->verify_session->verify_login('administrator/trabajador/deleteTrabajador');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);

            if ( !empty($trabajador_id) AND is_numeric($trabajador_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/trabajador/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/trabajador/deleteTrabajador', $data);
            }
            else
            {
                redirect('administrator/trabajador/index/');
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('trabajador_id', TRUE) as $trabajador_id )
                {
                    $data = $this->trabajador_model->getTrabajadorByTrabajadorId($trabajador_id);
                    $this->trabajador_model->deleteTrabajador($trabajador_id);
                }
            }
            else
            {
                $trabajador_id = $this->input->post('trabajador_id', TRUE);
                $capacitaciones = $this->capacitacion_work_model->getAll($trabajador_id);
                $epps = $this->epp_work_model->getAll($trabajador_id);
                if($capacitaciones){
                    foreach($capacitaciones as $capacitacion_work){
                        $this->capacitacion_work_model->deleteCapacitacion_work($capacitacion_work->capacitacion_work_id);
                    }
                }
                if($epps){
                    foreach($epps as $epp_work){
                        $this->epp_work_model->deleteEpp_work($epp_work->epp_work_id);
                    }
                }
                $this->trabajador_model->deleteTrabajador($trabajador_id);
            }
            $user_id = $this->input->post('user_id', TRUE);
            redirect('administrator/trabajador/index/'.$user_id);
        }
	}
}

/* End of file trabajador_lang.php */
/* Location: ./system/application/controllers/administrator/trabajador_lang.php */
?>