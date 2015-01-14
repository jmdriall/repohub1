<?php
/**
 * Classname: Capacitacion
 * Summary: Controller for Capacitacion objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Capacitacion extends CI_Controller
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
		
		$this->load->model('capacitacion_model');
        //$this->load->model('sub_capacitacion_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/capacitacion/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/capacitacion/index/');
		$config['total_rows'] 		= $this->capacitacion_model->getTotalCapacitacions();
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
		$data['capacitacions']	 = $this->capacitacion_model->getAllCapacitacions($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/capacitacion/index',$data);
	}
	
	/**
	 * Method: insertCapacitacion
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertCapacitacion($user_id)
    {
        $this->verify_session->verify_login('administrator/capacitacion/insertCapacitacion');

        //validation
        $this->form_validation->set_rules('title', lang('backend_title'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ( $this->input->post('insert', TRUE) != NULL )
        {
            if ( !$this->form_validation->run())
            {
                $data['title'] = $this->input->post('title', TRUE);

                $data['user_id'] = $this->input->post('user_id', TRUE);
                //$data['description'] = $this->input->post('description', TRUE);
                $this->layout->view('administrator/capacitacion/insertCapacitacion', $data);
            }
            else
            {
				$values = array('title' => $this->input->post('title', TRUE),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->capacitacion_model->insertCapacitacion($values);

				redirect('administrator/capacitacion/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/capacitacion/insertCapacitacion',$data);
        }
    }
	
	/**
	 * Method: updateCapacitacion
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateCapacitacion($capacitacion_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/capacitacion/updateGallery');

        //validation
        $this->form_validation->set_rules('title', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($capacitacion_id) AND is_numeric($capacitacion_id))
            {
                $picture = $this->capacitacion_model->getCapacitacionByCapacitacionId($capacitacion_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/capacitacion/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/capacitacion/updateCapacitacion', $data);
            }
            else
            {
                redirect('administrator/capacitacion/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/capacitacion/updateCapacitacion', $data);
            }
            else
            {
                $values = array( 'title' => $this->input->post('title', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $capacitacion_id = $this->input->post('capacitacion_id', TRUE);
                $this->capacitacion_model->updateCapacitacion( $capacitacion_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/capacitacion/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteCapacitacion
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteCapacitacion($capacitacion_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/capacitacion/deleteCapacitacion');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->capacitacion_model->getCapacitacionByCapacitacionId($capacitacion_id);

            if ( !empty($capacitacion_id) AND is_numeric($capacitacion_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/capacitacion/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/capacitacion/deleteCapacitacion', $data);
            }
            else
            {
                redirect('administrator/capacitacion/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('capacitacion_id', TRUE) as $capacitacion_id )
                {
                    $data = $this->capacitacion_model->getCapacitacionByCapacitacionId($capacitacion_id);
                    $this->capacitacion_model->deleteCapacitacion($capacitacion_id);
                }
            }
            else
            {
                $capacitacion_id = $this->input->post('capacitacion_id', TRUE);

                $data = $this->capacitacion_model->getCapacitacionByCapacitacionId($capacitacion_id);
                $this->capacitacion_model->deleteCapacitacion($capacitacion_id);
            }

            redirect('administrator/capacitacion/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file capacitacion_lang.php */
/* Location: ./system/application/controllers/administrator/capacitacion_lang.php */
?>