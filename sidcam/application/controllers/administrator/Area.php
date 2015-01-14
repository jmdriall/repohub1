<?php
/**
 * Classname: rea
 * Summary: Controller for Area objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Area extends CI_Controller
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
		
		$this->load->model('area_model');
        //$this->load->model('sub_area_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/area/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/area/index/');
		$config['total_rows'] 		= $this->area_model->getTotalAreas();
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
		$data['areas']	 = $this->area_model->getAllAreas($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/area/index',$data);
	}
	
	/**
	 * Method: insertArea
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertArea($user_id)
    {
        $this->verify_session->verify_login('administrator/area/insertArea');

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
                $this->layout->view('administrator/area/insertArea', $data);
            }
            else
            {
				$values = array('nombre' => $this->input->post('nombre', TRUE),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->area_model->insertArea($values);

				redirect('administrator/area/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/area/insertArea',$data);
        }
    }
	
	/**
	 * Method: updateArea
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateArea($area_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/area/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($area_id) AND is_numeric($area_id))
            {
                $picture = $this->area_model->getAreaByAreaId($area_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/area/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/area/updateArea', $data);
            }
            else
            {
                redirect('administrator/area/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/area/updateArea', $data);
            }
            else
            {
                $values = array( 'nombre' => $this->input->post('nombre', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $area_id = $this->input->post('area_id', TRUE);
                $this->area_model->updateArea( $area_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/area/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteArea
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteArea($area_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/area/deleteArea');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->area_model->getAreaByAreaId($area_id);

            if ( !empty($area_id) AND is_numeric($area_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/area/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/area/deleteArea', $data);
            }
            else
            {
                redirect('administrator/area/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('area_id', TRUE) as $area_id )
                {
                    $data = $this->area_model->getAreaByAreaId($area_id);
                    $this->area_model->deleteArea($area_id);
                }
            }
            else
            {
                $area_id = $this->input->post('area_id', TRUE);

                $data = $this->area_model->getAreaByAreaId($area_id);
                $this->area_model->deleteArea($area_id);
            }

            redirect('administrator/area/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file area_lang.php */
/* Location: ./system/application/controllers/administrator/area_lang.php */
?>