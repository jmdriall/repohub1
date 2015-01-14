<?php
/**
 * Classname: C_inspeccion
 * Summary: C_inspeccionler for C_inspeccion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class C_inspeccion extends CI_Controller
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
		
            $this->load->model('c_inspeccion_model');
            $this->load->model('inspeccion_model');
        //$this->load->model('sub_c_inspeccion_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($inspeccion_id = 0)
	{
		$this->verify_session->verify_login('administrator/c_inspeccion/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/c_inspeccion/index/');
		$config['total_rows'] 		= $this->c_inspeccion_model->getTotalC_inspeccion();
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
        $inspeccion  = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);
        foreach($inspeccion as $key=>$value){
            $data[$key] = $value;
        }

		$data['c_inspeccions']	 = $this->c_inspeccion_model->getAllC_inspeccion($per_p, $off_set, $inspeccion_id);
        $data['inspeccion_id'] = $inspeccion_id;
		$this->layout->view('administrator/c_inspeccion/index',$data);
	}
	
	/**
	 * Method: insertC_inspeccion
	 * Summary: insert a new inspeccion
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertC_inspeccion($inspeccion_id)
    {
        $this->verify_session->verify_login('administrator/c_inspeccion/insertC_inspeccion');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_titulo'), 'required');
        $this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        $this->form_validation->set_rules('fecha_c_inspeccion', lang('backend_fecha_c_inspeccion'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                $data['evidencia'] = $this->input->post('evidencia');
                $data['fecha_c_inspeccion'] = $this->input->post('fecha_c_inspeccion', TRUE);
                $data['inspeccion_id'] = $this->input->post('inspeccion_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/c_inspeccion/insertC_inspeccion', $data);
            }
            else
            {
                $inspeccion = $this->inspeccion_model->getInspeccionByInspeccionId($inspeccion_id);

				$values = array('responsable' => $this->input->post('responsable', TRUE),
                    'evidencia' => $this->input->post('evidencia'),
                    'fecha_c_inspeccion' => $this->input->post('fecha_c_inspeccion', TRUE),
                    'inspeccion_id' =>$inspeccion_id,
                    'user_id' => $inspeccion->user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->c_inspeccion_model->insertC_inspeccion($values);

				redirect('administrator/c_inspeccion/index/'.$inspeccion_id);
            }
        }
        else
        {
            $data['inspeccion_id'] = $inspeccion_id;
            $this->layout->view('administrator/c_inspeccion/insertC_inspeccion',$data);
        }
    }
	
	/**
	 * Method: updateC_inspeccion
	 * Summary: edit the inspeccion data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateC_inspeccion($c_inspeccion_id=0, $inspeccion_id = 0)
	{

        $this->verify_session->verify_login('administrator/c_inspeccion/updateC_inspeccion');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        //$this->form_validation->set_rules('evidencia', lang('backend_evidencia'), 'required');
        $this->form_validation->set_rules('fecha_c_inspeccion', lang('backend_c_inspeccion'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($c_inspeccion_id) AND is_numeric($c_inspeccion_id))
            {
                $picture = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/c_inspeccion/index/'.$inspeccion_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['inspeccion_id'] = $inspeccion_id;
                $this->layout->view('administrator/c_inspeccion/updateC_inspeccion', $data);
            }
            else
            {
                redirect('administrator/c_inspeccion/index/'.$inspeccion_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/c_inspeccion/updateC_inspeccion', $data);
            }
            else
            {
                $values = array( 'responsable' => $this->input->post('responsable', TRUE),
								'evidencia' => $this->input->post('evidencia'),
								'fecha_c_inspeccion'=> $this->input->post('fecha_c_inspeccion')
							);
                $c_inspeccion_id = $this->input->post('c_inspeccion_id', TRUE);
                $this->c_inspeccion_model->updateC_inspeccion( $c_inspeccion_id, $values );
				$inspeccion = $this->input->post('inspeccion_id', TRUE);
                redirect('administrator/c_inspeccion/index/'.$inspeccion);
            }
        }
	}
	
	/**
	 * Method: deleteC_inspeccion
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteC_inspeccion($c_inspeccion_id=0, $inspeccion_id)
	{
        $this->verify_session->verify_login('administrator/c_inspeccion/deleteC_inspeccion');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);

            if ( !empty($c_inspeccion_id) AND is_numeric($c_inspeccion_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/c_inspeccion/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['inspeccion_id'] = $inspeccion_id;
                $this->layout->view('administrator/c_inspeccion/deleteC_inspeccion', $data);
            }
            else
            {
                redirect('administrator/c_inspeccion/index/'.$inspeccion_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('c_inspeccion_id', TRUE) as $c_inspeccion_id )
                {
                    $data = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
                    $this->c_inspeccion_model->deleteC_inspeccion($c_inspeccion_id);
                }
            }
            else
            {
                $c_inspeccion_id = $this->input->post('c_inspeccion_id', TRUE);

                $data = $this->c_inspeccion_model->getC_inspeccionByC_inspeccionId($c_inspeccion_id);
                $this->c_inspeccion_model->deleteC_inspeccion($c_inspeccion_id);
            }

            redirect('administrator/c_inspeccion/index/'.$this->input->post('inspeccion_id', TRUE));
        }
	}
}

/* End of file c_inspeccion_lang.php */
/* Location: ./system/application/c_inspeccionlers/administrator/c_inspeccion_lang.php */
?>