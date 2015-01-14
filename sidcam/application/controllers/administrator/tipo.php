<?php
/**
 * Classname: Tipo
 * Summary: Controller for Tipo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Tipo extends CI_Controller
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
		
		$this->load->model('tipo_model');
        //$this->load->model('sub_tipo_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/tipo/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/tipo/index/');
		$config['total_rows'] 		= $this->tipo_model->getTotalTipos();
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
		$data['tipos']	 = $this->tipo_model->getAllTipos($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/tipo/index',$data);
	}
	
	/**
	 * Method: insertTipo
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertTipo($user_id)
    {
        $this->verify_session->verify_login('administrator/tipo/insertTipo');

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

                $data['user_id'] = $this->input->post('user_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/tipo/insertTipo', $data);
            }
            else
            {
				$values = array('nombre' => $this->input->post('nombre', TRUE),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->tipo_model->insertTipo($values);

				redirect('administrator/tipo/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/tipo/insertTipo',$data);
        }
    }
	
	/**
	 * Method: updateTipo
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateTipo($tipo_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/tipo/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($tipo_id) AND is_numeric($tipo_id))
            {
                $picture = $this->tipo_model->getTipoByTipoId($tipo_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/tipo/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/tipo/updateTipo', $data);
            }
            else
            {
                redirect('administrator/tipo/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/tipo/updateTipo', $data);
            }
            else
            {
                $values = array( 'nombre' => $this->input->post('nombre', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $tipo_id = $this->input->post('tipo_id', TRUE);
                $this->tipo_model->updateTipo( $tipo_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/tipo/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteTipo
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteTipo($tipo_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/tipo/deleteTipo');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->tipo_model->getTipoByTipoId($tipo_id);

            if ( !empty($tipo_id) AND is_numeric($tipo_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/tipo/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/tipo/deleteTipo', $data);
            }
            else
            {
                redirect('administrator/tipo/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('tipo_id', TRUE) as $tipo_id )
                {
                    $data = $this->tipo_model->getTipoByTipoId($tipo_id);
                    $this->tipo_model->deleteTipo($tipo_id);
                }
            }
            else
            {
                $tipo_id = $this->input->post('tipo_id', TRUE);

                $data = $this->tipo_model->getTipoByTipoId($tipo_id);
                $this->tipo_model->deleteTipo($tipo_id);
            }

            redirect('administrator/tipo/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file tipo_lang.php */
/* Location: ./system/application/controllers/administrator/tipo_lang.php */
?>