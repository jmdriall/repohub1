<?php
/**
 * Classname: Control
 * Summary: Controller for Control objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Control extends CI_Controller
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
        //$this->load->model('sub_control_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($seguimiento_id = 0)
	{
		$this->verify_session->verify_login('administrator/control/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/control/index/');
		$config['total_rows'] 		= $this->control_model->getTotalControl();
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

        $seguimiento = $picture = $this->seguimiento_model->getSeguimientoBySeguimientoId($seguimiento_id);
        foreach($seguimiento as $key=>$value){
            $data[$key] = $value;
        }
		$data['controls']	 = $this->control_model->getAllControl($per_p, $off_set, $seguimiento_id);
        $data['seguimiento_id'] = $seguimiento_id;
		$this->layout->view('administrator/control/index',$data);
	}
	
	/**
	 * Method: insertControl
	 * Summary: insert a new seguimiento
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertControl($seguimiento_id)
    {
        $this->verify_session->verify_login('administrator/control/insertControl');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_titulo'), 'required');
        $this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        $this->form_validation->set_rules('fecha_control', lang('backend_fecha_control'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                $data['evidencia'] = $this->input->post('evidencia');
                $data['fecha_control'] = $this->input->post('fecha_control', TRUE);
                $data['seguimiento_id'] = $this->input->post('seguimiento_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/control/insertControl', $data);
            }
            else
            {
                $seguimiento = $this->seguimiento_model->getSeguimientoBySeguimientoId($seguimiento_id);

				$values = array('responsable' => $this->input->post('responsable', TRUE),
                    'evidencia' => $this->input->post('evidencia'),
                    'fecha_control' => $this->input->post('fecha_control', TRUE),
                    'seguimiento_id' =>$seguimiento_id,
                    'user_id' => $seguimiento->user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->control_model->insertControl($values);

				redirect('administrator/control/index/'.$seguimiento_id);
            }
        }
        else
        {
            $data['seguimiento_id'] = $seguimiento_id;
            $this->layout->view('administrator/control/insertControl',$data);
        }
    }
	
	/**
	 * Method: updateControl
	 * Summary: edit the seguimiento data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateControl($control_id=0, $seguimiento_id = 0)
	{

        $this->verify_session->verify_login('administrator/control/updateControl');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('evidencia', lang('backend_evidencia'), 'required');
        $this->form_validation->set_rules('fecha_control', lang('backend_control'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($control_id) AND is_numeric($control_id))
            {
                $picture = $this->control_model->getControlByControlId($control_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/control/index/'.$seguimiento_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['seguimiento_id'] = $seguimiento_id;
                $this->layout->view('administrator/control/updateControl', $data);
            }
            else
            {
                redirect('administrator/control/index/'.$seguimiento_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/control/updateControl', $data);
            }
            else
            {
                $values = array( 'responsable' => $this->input->post('responsable', TRUE),
								'evidencia' => $this->input->post('evidencia'),
								'fecha_control'=> $this->input->post('fecha_control')
							);
                $control_id = $this->input->post('control_id', TRUE);
                $this->control_model->updateControl( $control_id, $values );
				$seguimiento = $this->input->post('seguimiento_id', TRUE);
                redirect('administrator/control/index/'.$seguimiento);
            }
        }
	}
	
	/**
	 * Method: deleteControl
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteControl($control_id=0, $seguimiento_id)
	{
        $this->verify_session->verify_login('administrator/control/deleteControl');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->control_model->getControlByControlId($control_id);

            if ( !empty($control_id) AND is_numeric($control_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/control/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['seguimiento_id'] = $seguimiento_id;
                $this->layout->view('administrator/control/deleteControl', $data);
            }
            else
            {
                redirect('administrator/control/index/'.$seguimiento_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('control_id', TRUE) as $control_id )
                {
                    $data = $this->control_model->getControlByControlId($control_id);
                    $this->control_model->deleteControl($control_id);
                }
            }
            else
            {
                $control_id = $this->input->post('control_id', TRUE);

                $data = $this->control_model->getControlByControlId($control_id);
                $this->control_model->deleteControl($control_id);
            }

            redirect('administrator/control/index/'.$this->input->post('seguimiento_id', TRUE));
        }
	}
}

/* End of file control_lang.php */
/* Location: ./system/application/controllers/administrator/control_lang.php */
?>