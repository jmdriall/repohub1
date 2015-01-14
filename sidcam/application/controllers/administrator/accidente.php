<?php
/**
 * Classname: Accidente
 * Summary: Controller for Accidente objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Accidente extends CI_Controller
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
		
        $this->load->model('accidente_model');
        $this->load->model('area_model');
        $this->load->model('accidente_trabajador_model');
        $this->load->model('medida_correctiva_model');
        //$this->load->model('sub_accidente_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/accidente/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/accidente/index/');
		$config['total_rows'] 		= $this->accidente_model->getTotalAccidente();
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
		$data['accidentes']	 = $this->accidente_model->getAllAccidente($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/accidente/index',$data);
	}
	
	/**
	 * Method: insertAccidente
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertAccidente($user_id)
    {
        $this->verify_session->verify_login('administrator/accidente/insertAccidente');

        //validation
        $this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required|numeric');
        //$this->form_validation->set_rules('observacion', lang('backend_observacion'));
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'));
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insertform', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }
                //$data['description'] = $this->input->post('description', TRUE);
                $data['areas'] = $this->area_model->getAll($this->input->post('user_id'));
                $this->layout->view('administrator/accidente/insertAccidente', $data);
            }
            else
            {
				$values = array('titulo' => $this->input->post('titulo', TRUE),
                    'observacion' => $this->input->post('observacion'),
                    'fecha_ocurrida' => $this->input->post('fecha_ocurrida', TRUE),
                    'dias_perdidos' => $this->input->post('dis_perdidos'),
                    'area_id' => $this->input->post('area_id'),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->accidente_model->insertAccidente($values);

				redirect('administrator/accidente/index/'.$user_id);
            }
        }
        else
        {
            $data['areas'] = $this->area_model->getAll($user_id);
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/accidente/insertAccidente',$data);
        }
    }
	
	/**
	 * Method: updateAccidente
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateAccidente($accidente_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/accidente/updateGallery');

        //validation
        $this->form_validation->set_rules('dias_perdidos', lang('backend_dias_perdidos'), 'required|numeric');
       // $this->form_validation->set_rules('observacion', lang('backend_observacion'), 'required');
        $this->form_validation->set_rules('fecha_ocurrida', lang('backend_fecha_ocurrida'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($accidente_id) AND is_numeric($accidente_id))
            {
                $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/accidente/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $accidente = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                $data['areas'] = $this->area_model->getAll($accidente->user_id);
                $this->layout->view('administrator/accidente/updateAccidente', $data);
            }
            else
            {
                redirect('administrator/accidente/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $data['areas'] = $this->area_model->getAll($data['user_id']);
                $this->layout->view('administrator/accidente/updateAccidente', $data);
            }
            else
            {
                $values = array( 'titulo' => $this->input->post('titulo', TRUE),
								'observacion' => $this->input->post('observacion'),
								'fecha_ocurrida'=> $this->input->post('fecha_ocurrida'),
                                'dias_perdidos' => $this->input->post('dias_perdidos'),
                                'area_id' => $this->input->post('area_id')
							);
                $accidente_id = $this->input->post('accidente_id', TRUE);
                $this->accidente_model->updateAccidente( $accidente_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/accidente/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteAccidente
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteAccidente($accidente_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/accidente/deleteAccidente');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);

            if ( !empty($accidente_id) AND is_numeric($accidente_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/accidente/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/accidente/deleteAccidente', $data);
            }
            else
            {
                redirect('administrator/accidente/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('accidente_id', TRUE) as $accidente_id )
                {
                    $data = $this->accidente_model->getAccidenteByAccidenteId($accidente_id);
                    $this->accidente_model->deleteAccidente($accidente_id);
                }
            }
            else
            {
                $accidente_id = $this->input->post('accidente_id', TRUE);

                $medidas_correctivas = $this->medida_correctiva_model->getAll($accidente_id);
                $accidentes_trabajadores = $this->accidente_trabajador_model->getAll($accidente_id);

                if($medidas_correctivas){
                    foreach($medidas_correctivas as $medida_correctiva){
                        $this->medida_correctiva_model->deleteMedida_correctiva($medida_correctiva->medida_correctiva_id);
                    }
                }
                if($accidentes_trabajadores){
                    foreach($accidentes_trabajadores as $accidente_trabajador){
                        $this->accidente_trabajador_model->deleteAccidente_trabajador($accidente_trabajador->accidente_trabajador_id);
                    }
                }
                $this->accidente_model->deleteAccidente($accidente_id);
            }

            redirect('administrator/accidente/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file accidente_lang.php */
/* Location: ./system/application/controllers/administrator/accidente_lang.php */
?>