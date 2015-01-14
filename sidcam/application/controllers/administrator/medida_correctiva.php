<?php
/**
 * Classname: Medida_correctiva
 * Summary: Medida_correctivaler for Medida_correctiva objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Medida_correctiva extends CI_controller
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

            $this->load->model('medida_correctiva_model');
            $this->load->model('accidente_model');
        //$this->load->model('sub_medida_correctiva_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($accidente_id = 0)
	{
		$this->verify_session->verify_login('administrator/medida_correctiva/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/medida_correctiva/index/');
		$config['total_rows'] 		= $this->medida_correctiva_model->getTotalMedida_correctiva();
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
		$data['medida_correctivas']	 = $this->medida_correctiva_model->getAllMedida_correctiva($per_p, $off_set, $accidente_id);
        $data['accidente_id'] = $accidente_id;
		$this->layout->view('administrator/medida_correctiva/index',$data);
	}
	
	/**
	 * Method: insertMedida_correctiva
	 * Summary: insert a new accidente
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertMedida_correctiva($accidente_id)
    {
        $this->verify_session->verify_login('administrator/medida_correctiva/insertMedida_correctiva');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('evidencia', lang('backend_evidencia'));
        $this->form_validation->set_rules('fecha_medida_correctiva', lang('backend_fecha_medida_correctiva'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['responsable'] = $this->input->post('responsable', TRUE);
                $data['evidencia'] = $this->input->post('evidencia');
                $data['fecha_medida_correctiva'] = $this->input->post('fecha_medida_correctiva', TRUE);
                $data['accidente_id'] = $this->input->post('accidente_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/medida_correctiva/insertMedida_correctiva', $data);
            }
            else
            {
                $user = $this->accidente_model->getAccidenteByAccidenteId($this->input->post('accidente_id', TRUE));
				$values = array('responsable' => $this->input->post('responsable', TRUE),
                    'evidencia' => $this->input->post('evidencia'),
                    'fecha_medida_correctiva' => $this->input->post('fecha_medida_correctiva', TRUE),
                    'accidente_id' =>$accidente_id,
                    'medida' => $this->input->post('medida'),
                    'user_id' => $user->user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->medida_correctiva_model->insertMedida_correctiva($values);

				redirect('administrator/medida_correctiva/index/'.$accidente_id);
            }
        }
        else
        {
            $data['accidente_id'] = $accidente_id;
            $this->layout->view('administrator/medida_correctiva/insertMedida_correctiva',$data);
        }
    }
	
	/**
	 * Method: updateMedida_correctiva
	 * Summary: edit the accidente data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateMedida_correctiva($medida_correctiva_id=0, $accidente_id = 0)
	{

        $this->verify_session->verify_login('administrator/medida_correctiva/updateMedida_correctiva');

        //validation
        $this->form_validation->set_rules('responsable', lang('backend_responsable'), 'required');
        $this->form_validation->set_rules('medida', lang('backend_medida'), 'required');
        $this->form_validation->set_rules('fecha_medida_correctiva', lang('backend_medida_correctiva'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($medida_correctiva_id) AND is_numeric($medida_correctiva_id))
            {
                $picture = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/medida_correctiva/index/'.$accidente_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['accidente_id'] = $accidente_id;
                $this->layout->view('administrator/medida_correctiva/updateMedida_correctiva', $data);
            }
            else
            {
                redirect('administrator/medida_correctiva/index/'.$accidente_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/medida_correctiva/updateMedida_correctiva', $data);
            }
            else
            {
                $values = array( 'responsable' => $this->input->post('responsable', TRUE),
								'evidencia' => $this->input->post('evidencia'),
                                'medida' => $this->input->post('medida'),
								'fecha_medida_correctiva'=> $this->input->post('fecha_medida_correctiva')
							);
                $medida_correctiva_id = $this->input->post('medida_correctiva_id', TRUE);
                $this->medida_correctiva_model->updateMedida_correctiva( $medida_correctiva_id, $values );
				$accidente = $this->input->post('accidente_id', TRUE);
                redirect('administrator/medida_correctiva/index/'.$accidente);
            }
        }
	}
	
	/**
	 * Method: deleteMedida_correctiva
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteMedida_correctiva($medida_correctiva_id=0, $accidente_id)
	{
        $this->verify_session->verify_login('administrator/medida_correctiva/deleteMedida_correctiva');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva_id);

            if ( !empty($medida_correctiva_id) AND is_numeric($medida_correctiva_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/medida_correctiva/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['accidente_id'] = $accidente_id;
                $this->layout->view('administrator/medida_correctiva/deleteMedida_correctiva', $data);
            }
            else
            {
                redirect('administrator/medida_correctiva/index/'.$accidente_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('medida_correctiva_id', TRUE) as $medida_correctiva_id )
                {
                    $data = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva_id);
                    $this->medida_correctiva_model->deleteMedida_correctiva($medida_correctiva_id);
                }
            }
            else
            {
                $medida_correctiva_id = $this->input->post('medida_correctiva_id', TRUE);

                $data = $this->medida_correctiva_model->getMedida_correctivaByMedida_correctivaId($medida_correctiva_id);
                $this->medida_correctiva_model->deleteMedida_correctiva($medida_correctiva_id);
            }

            redirect('administrator/medida_correctiva/index/'.$this->input->post('accidente_id', TRUE));
        }
	}
}

/* End of file medida_correctiva_lang.php */
/* Location: ./system/application/medida_correctivalers/administrator/medida_correctiva_lang.php */
?>