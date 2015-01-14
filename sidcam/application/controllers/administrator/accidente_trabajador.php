<?php
/**
 * Classname: Accidente_trabajador
 * Summary: Accidente_trabajadorler for Accidente_trabajador objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Accidente_trabajador extends CI_controller
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

            $this->load->model('accidente_trabajador_model');
            $this->load->model('accidente_model');
            $this->load->model('trabajador_model');
            $this->load->model('body_model');
        //$this->load->model('sub_accidente_trabajador_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($accidente_id = 0)
	{
		$this->verify_session->verify_login('administrator/accidente_trabajador/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/accidente_trabajador/index/');
		$config['total_rows'] 		= $this->accidente_trabajador_model->getTotalAccidente_trabajador();
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

        $accidente = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
        foreach($accidente as $key=>$value){
            $data[$key] = $value;
        }
        $trab_id = $data['user_id'];
        $data['trabajadores'] = $this->trabajador_model->getAll($trab_id);
		$data['accidente_trabajadors']	 = $this->accidente_trabajador_model->getAllAccidente_trabajador($per_p, $off_set, $accidente_id);
        $data['accidente_id'] = $accidente_id;
		$this->layout->view('administrator/accidente_trabajador/index',$data);
	}
	
	/**
	 * Method: insertAccidente_trabajador
	 * Summary: insert a new accidente
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertAccidente_trabajador($accidente_id = 0)
    {
        $this->verify_session->verify_login('administrator/accidente_trabajador/insertAccidente_trabajador');

        //validation
        //$this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
        //$this->form_validation->set_rules('trabajador_id', lang('backend_trabajador'));
        //$this->form_validation->set_rules('fecha_accidente_trabajador', lang('backend_fecha_accidente_trabajador'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if($this->input->post('tipo', TRUE)){
                $values = array('nombre' => $this->input->post('nombre', TRUE),
                    'trabajador_id' => 0,
                    'accidente_id' =>$this->input->post('accidente_id', TRUE),
                    'body_id' => $this->input->post('body_id')
                );
            }
            else{
                $nombre = $this->input->post('trabajador_id');
                $picture = $this->trabajador_model->getTrabajadorByTrabajadorId($nombre);
                if ( $picture == FALSE )
                {
                    redirect('administrator/accidente_trabajador/index/'.$accidente_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $user = $this->accidente_model->getAccidenteByAccidenteId($this->input->post('accidente_id', TRUE));
                $values = array('nombre' => $data['nombre'].' '.$data['apellidos'],
                    'trabajador_id' => $this->input->post('trabajador_id'),
                    'accidente_id' =>$this->input->post('accidente_id', TRUE),
                    'body_id' => $this->input->post('body_id'),
                    'user_id' => $user->user_id
                );
            }



            $this->accidente_trabajador_model->insertAccidente_trabajador($values);
                $accidente_id = $this->input->post('accidente_id', TRUE);
				redirect('administrator/accidente_trabajador/index/'.$accidente_id);
        }
        else
        {
            $accidente = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
            foreach($accidente as $key=>$value){
                $data[$key] = $value;
            }
            $trab_id = $data['user_id'];
            $data['trabajadores'] = $this->trabajador_model->getAll($trab_id);
            $data['bodies'] = $this->body_model->getAllBody($trab_id);
            $data['accidente_id'] = $accidente_id;
            $data['accidente_trabajadores']	 = $this->accidente_trabajador_model->getAll($accidente_id);
            $this->layout->view('administrator/accidente_trabajador/insertAccidente_trabajador',$data);
        }
    }
	
	/**
	 * Method: updateAccidente_trabajador
	 * Summary: edit the accidente data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateAccidente_trabajador($accidente_trabajador_id=0, $accidente_id = 0)
	{

        $this->verify_session->verify_login('administrator/accidente_trabajador/updateAccidente_trabajador');

        //validation
        //$this->form_validation->set_rules('nombre', lang('backend_nombre'), 'required');
        $this->form_validation->set_rules('trabajador_id', lang('backend_trabajador_id'), 'required');
        //$this->form_validation->set_rules('fecha_accidente_trabajador', lang('backend_accidente_trabajador'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($accidente_trabajador_id) AND is_numeric($accidente_trabajador_id))
            {

                $accidente = $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                foreach($accidente as $key=>$value){
                    $data[$key] = $value;
                }
                $trab_id = $data['user_id'];
                $data['trabajadores'] = $this->trabajador_model->getAll($trab_id);
                $data['bodies'] = $this->body_model->getAllBody($trab_id);
                $data['accidente_id'] = $accidente_id;
                $picture = $this->accidente_trabajador_model->getAccidente_trabajadorByAccidente_trabajadorId($accidente_trabajador_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/accidente_trabajador/index/'.$accidente_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['accidente_trabajadores']	 = $this->accidente_trabajador_model->getAll($accidente_id);
                $this->layout->view('administrator/accidente_trabajador/updateAccidente_trabajador', $data);
            }
            else
            {
                redirect('administrator/accidente_trabajador/index/'.$accidente_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }


                $this->layout->view('administrator/accidente_trabajador/updateAccidente_trabajador', $data);
            }
            else
            {
                $trabajador = $this->trabajador_model->getTrabajadorByTrabajadorId($this->input->post('trabajador_id'));
                foreach($trabajador as $key=>$value){
                    $data[$key] = $value;
                }

                $values = array( 'nombre' => $data['nombre'].' '.$data['apellidos'],
								'trabajador_id' => $this->input->post('trabajador_id'),
                                'body_id' => $this->input->post('body_id')

								//'fecha_accidente_trabajador'=> $this->input->post('fecha_accidente_trabajador')
							);
                $accidente_trabajador_id = $this->input->post('accidente_trabajador_id', TRUE);
                $this->accidente_trabajador_model->updateAccidente_trabajador( $accidente_trabajador_id, $values );
				$accidente = $this->input->post('accidente_id', TRUE);
                redirect('administrator/accidente_trabajador/index/'.$accidente);
            }
        }
	}
	
	/**
	 * Method: deleteAccidente_trabajador
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteAccidente_trabajador($accidente_trabajador_id=0, $accidente_id)
	{
        $this->verify_session->verify_login('administrator/accidente_trabajador/deleteAccidente_trabajador');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->accidente_trabajador_model->getAccidente_trabajadorByAccidente_trabajadorId($accidente_trabajador_id);

            if ( !empty($accidente_trabajador_id) AND is_numeric($accidente_trabajador_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/accidente_trabajador/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['accidente_id'] = $accidente_id;
                $this->layout->view('administrator/accidente_trabajador/deleteAccidente_trabajador', $data);
            }
            else
            {
                redirect('administrator/accidente_trabajador/index/'.$accidente_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('accidente_trabajador_id', TRUE) as $accidente_trabajador_id )
                {
                    $data = $this->accidente_trabajador_model->getAccidente_trabajadorByAccidente_trabajadorId($accidente_trabajador_id);
                    $this->accidente_trabajador_model->deleteAccidente_trabajador($accidente_trabajador_id);
                }
            }
            else
            {
                $accidente_trabajador_id = $this->input->post('accidente_trabajador_id', TRUE);

                $data = $this->accidente_trabajador_model->getAccidente_trabajadorByAccidente_trabajadorId($accidente_trabajador_id);
                $this->accidente_trabajador_model->deleteAccidente_trabajador($accidente_trabajador_id);
            }

            redirect('administrator/accidente_trabajador/index/'.$this->input->post('accidente_id', TRUE));
        }
	}
}

/* End of file accidente_trabajador_lang.php */
/* Location: ./system/application/accidente_trabajadorlers/administrator/accidente_trabajador_lang.php */
?>