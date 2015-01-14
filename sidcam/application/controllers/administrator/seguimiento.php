<?php
/**
 * Classname: Seguimiento
 * Summary: Controller for Seguimiento objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Seguimiento extends CI_Controller
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

            $this->load->model('control_model');
            $this->load->model('seguimiento_model');
        //$this->load->model('sub_seguimiento_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/seguimiento/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/seguimiento/index/');
		$config['total_rows'] 		= $this->seguimiento_model->getTotalSeguimiento();
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
		$data['seguimientos']	 = $this->seguimiento_model->getAllSeguimiento($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/seguimiento/index',$data);
	}
	
	/**
	 * Method: insertSeguimiento
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertSeguimiento($user_id)
    {
        $this->verify_session->verify_login('administrator/seguimiento/insertSeguimiento');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_titulo'), 'required');
        $this->form_validation->set_rules('observacion', lang('backend_observacion'));
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_titulo'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['titulo'] = $this->input->post('titulo', TRUE);
                $data['observacion'] = $this->input->post('observacion');
                $data['fecha_ocurrida'] = $this->input->post('fecha_ocurrida', TRUE);
                $data['user_id'] = $this->input->post('user_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/seguimiento/insertSeguimiento', $data);
            }
            else
            {
				$values = array('titulo' => $this->input->post('titulo', TRUE),
                    'observacion' => $this->input->post('observacion'),
                    'fecha_ocurrida' => $this->input->post('fecha_ocurrida', TRUE),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->seguimiento_model->insertSeguimiento($values);

				redirect('administrator/seguimiento/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/seguimiento/insertSeguimiento',$data);
        }
    }
	
	/**
	 * Method: updateSeguimiento
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateSeguimiento($seguimiento_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/seguimiento/updateGallery');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_name'), 'required');
        $this->form_validation->set_rules('observacion', lang('backend_observacion'), 'required');
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($seguimiento_id) AND is_numeric($seguimiento_id))
            {
                $picture = $this->seguimiento_model->getSeguimientoBySeguimientoId($seguimiento_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/seguimiento/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/seguimiento/updateSeguimiento', $data);
            }
            else
            {
                redirect('administrator/seguimiento/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/seguimiento/updateSeguimiento', $data);
            }
            else
            {
                $values = array( 'titulo' => $this->input->post('titulo', TRUE),
								'observacion' => $this->input->post('observacion'),
								'fecha_ocurrida'=> $this->input->post('fecha_ocurrida')
							);
                $seguimiento_id = $this->input->post('seguimiento_id', TRUE);
                $this->seguimiento_model->updateSeguimiento( $seguimiento_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/seguimiento/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteSeguimiento
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteSeguimiento($seguimiento_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/seguimiento/deleteSeguimiento');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->seguimiento_model->getSeguimientoBySeguimientoId($seguimiento_id);

            if ( !empty($seguimiento_id) AND is_numeric($seguimiento_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/seguimiento/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/seguimiento/deleteSeguimiento', $data);
            }
            else
            {
                redirect('administrator/seguimiento/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('seguimiento_id', TRUE) as $seguimiento_id )
                {
                    $this->seguimiento_model->deleteSeguimiento($seguimiento_id);
                }
            }
            else
            {
                $seguimiento_id = $this->input->post('seguimiento_id', TRUE);

                $controles = $this->control_model->getAll($seguimiento_id);
                if($controles){
                    foreach($controles as $control){
                        $this->control_model->deleteControl($control->control_id);
                    }
                }
                $this->seguimiento_model->deleteSeguimiento($seguimiento_id);
            }

            redirect('administrator/seguimiento/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file seguimiento_lang.php */
/* Location: ./system/application/controllers/administrator/seguimiento_lang.php */
?>