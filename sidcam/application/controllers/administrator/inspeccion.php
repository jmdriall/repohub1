<?php
/**
 * Classname: Inspeccion
 * Summary: Controller for Inspeccion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Inspeccion extends CI_Controller
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
		
            $this->load->model('inspeccion_model');
        $this->load->model('c_inspeccion_model');
        //$this->load->model('sub_inspeccion_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/inspeccion/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/inspeccion/index/');
		$config['total_rows'] 		= $this->inspeccion_model->getTotalInspeccion();
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
		$data['inspeccions']	 = $this->inspeccion_model->getAllInspeccion($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/inspeccion/index',$data);
	}
	
	/**
	 * Method: insertInspeccion
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertInspeccion($user_id)
    {
        $this->verify_session->verify_login('administrator/inspeccion/insertInspeccion');

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
                $this->layout->view('administrator/inspeccion/insertInspeccion', $data);
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
				$this->inspeccion_model->insertInspeccion($values);

				redirect('administrator/inspeccion/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/inspeccion/insertInspeccion',$data);
        }
    }
	
	/**
	 * Method: updateInspeccion
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateInspeccion($inspeccion_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/inspeccion/updateGallery');

        //validation
        $this->form_validation->set_rules('titulo', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'), 'required');
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($inspeccion_id) AND is_numeric($inspeccion_id))
            {
                $picture = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/inspeccion/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/inspeccion/updateInspeccion', $data);
            }
            else
            {
                redirect('administrator/inspeccion/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/inspeccion/updateInspeccion', $data);
            }
            else
            {
                $values = array( 'titulo' => $this->input->post('titulo', TRUE),
								'observacion' => $this->input->post('observacion'),
								'fecha_ocurrida'=> $this->input->post('fecha_ocurrida')
							);
                $inspeccion_id = $this->input->post('inspeccion_id', TRUE);
                $this->inspeccion_model->updateInspeccion( $inspeccion_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/inspeccion/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteInspeccion
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteInspeccion($inspeccion_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/inspeccion/deleteInspeccion');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);

            if ( !empty($inspeccion_id) AND is_numeric($inspeccion_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/inspeccion/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/inspeccion/deleteInspeccion', $data);
            }
            else
            {
                redirect('administrator/inspeccion/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('inspeccion_id', TRUE) as $inspeccion_id )
                {
                    $data = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);
                    $this->inspeccion_model->deleteInspeccion($inspeccion_id);
                }
            }
            else
            {
                $inspeccion_id = $this->input->post('inspeccion_id', TRUE);
                $c_inspecciones = $this->c_inspeccion_model->getAll($inspeccion_id);
                if($c_inspecciones){
                    foreach($c_inspecciones as $c_inspeccion){
                        $this->c_inspeccion_model->deleteC_inspeccion($c_inspeccion->c_inspeccion_id);
                    }
                }

                $this->inspeccion_model->deleteInspeccion($inspeccion_id);
            }

            redirect('administrator/inspeccion/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file inspeccion_lang.php */
/* Location: ./system/application/controllers/administrator/inspeccion_lang.php */
?>