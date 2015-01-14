<?php
/**
 * Classname: Cargo
 * Summary: Controller for Cargo objects
 * @author 
 * @copyright (c) 2009 DesignBox, Inc. All Rights Reserved
 */
class Cargo extends CI_Controller
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
		
		$this->load->model('cargo_model');
        //$this->load->model('sub_cargo_model');
	}
	
	/**
	 * Method: index
	 * Summary: 
	 * @access public
	 */
	function index($user_id = 0)
	{
		$this->verify_session->verify_login('administrator/cargo/index');



		//load and config pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('administrator/cargo/index/');
		$config['total_rows'] 		= $this->cargo_model->getTotalCargos();
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
		$data['cargos']	 = $this->cargo_model->getAllCargos($per_p, $off_set, $user_id);
        $data['user_id'] = $user_id;
		$this->layout->view('administrator/cargo/index',$data);
	}
	
	/**
	 * Method: insertCargo
	 * Summary: insert a new user
	 * @access public
	 * @param string $str
	 * @return 
	 */
    function insertCargo($user_id)
    {
        $this->verify_session->verify_login('administrator/cargo/insertCargo');

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
                $this->layout->view('administrator/cargo/insertCargo', $data);
            }
            else
            {
				$values = array('nombre' => $this->input->post('nombre', TRUE),
                    'user_id' =>$user_id
								//'description' => $this->input->post('description'),
								//'sub_title' => $this->input->post('sub_title', TRUE)
							);
				$this->cargo_model->insertCargo($values);

				redirect('administrator/cargo/index/'.$user_id);
            }
        }
        else
        {
            $data['user_id'] = $user_id;
            $this->layout->view('administrator/cargo/insertCargo',$data);
        }
    }
	
	/**
	 * Method: updateCargo
	 * Summary: edit the user data
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function updateCargo($cargo_id=0, $user_id = 0)
	{

        $this->verify_session->verify_login('administrator/cargo/updateGallery');

        //validation
        $this->form_validation->set_rules('nombre', lang('backend_name'), 'required');
        //$this->form_validation->set_rules('sub_title', lang('backend_sub_title'), '');
        //$this->form_validation->set_rules('description', lang('backend_description'), 'required');

        $this->form_validation->set_error_delimiters('<p class="warning">', '</p>');

        if ($this->input->post('update_form', TRUE) == NULL)
        {
            if ( !empty($cargo_id) AND is_numeric($cargo_id))
            {
                $picture = $this->cargo_model->getCargoByCargoId($cargo_id);
                if ( $picture == FALSE )
                {
                    redirect('administrator/cargo/index/'.$user_id);
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/cargo/updateCargo', $data);
            }
            else
            {
                redirect('administrator/cargo/index/'.$user_id);
            }
        }
        else
        {
            if ( !$this->form_validation->run())
            {
                foreach($_POST as $key=>$value){
                    $data[$key]  = $this->input->post($key, TRUE);
                }

                $this->layout->view('administrator/cargo/updateCargo', $data);
            }
            else
            {
                $values = array( 'nombre' => $this->input->post('nombre', TRUE)
								//'description' => $this->input->post('description'),
								//'sub_title'=> $this->input->post('sub_title')
							);
                $cargo_id = $this->input->post('cargo_id', TRUE);
                $this->cargo_model->updateCargo( $cargo_id, $values );
				$user = $this->input->post('user_id', TRUE);
                redirect('administrator/cargo/index/'.$user);
            }
        }
	}
	
	/**
	 * Method: deleteCargo
	 * Summary: 
	 * @access public
	 * @param string $str
	 * @return 
	 */
	function deleteCargo($cargo_id=0, $user_id)
	{
        $this->verify_session->verify_login('administrator/cargo/deleteCargo');

        if ($this->input->post('subm_form', TRUE) == NULL)
        {
            $picture = $this->cargo_model->getCargoByCargoId($cargo_id);

            if ( !empty($cargo_id) AND is_numeric($cargo_id) ) //verify id in url
            {
                if ($picture == FALSE)
                {
                    redirect('administrator/cargo/index');
                }
                else
                {
                    foreach($picture as $key=>$value){
                        $data[$key] = $value;
                    }
                }
                $data['user_id'] = $user_id;
                $this->layout->view('administrator/cargo/deleteCargo', $data);
            }
            else
            {
                redirect('administrator/cargo/index/'.$user_id);
            }
        }
        else
        {
            if ( $this->input->post('subm_form', TRUE) == 'batch' )
            {

                foreach ( $this->input->post('cargo_id', TRUE) as $cargo_id )
                {
                    $data = $this->cargo_model->getCargoByCargoId($cargo_id);
                    $this->cargo_model->deleteCargo($cargo_id);
                }
            }
            else
            {
                $cargo_id = $this->input->post('cargo_id', TRUE);

                $data = $this->cargo_model->getCargoByCargoId($cargo_id);
                $this->cargo_model->deleteCargo($cargo_id);
            }

            redirect('administrator/cargo/index/'.$this->input->post('user_id', TRUE));
        }
	}
}

/* End of file cargo_lang.php */
/* Location: ./system/application/controllers/administrator/cargo_lang.php */
?>